<?php

namespace JiraBundle\Command;


use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use JiraBundle\Entity\Document;
use JiraBundle\Entity\Task;
use JiraBundle\Entity\User;

class JiraUpdateCommand extends ContainerAwareCommand
{
    const CUSTOMFIELD_LANGUAGES = 'customfield_10306';

    protected function configure()
    {
        $this
            ->setName('jira:update')
            ->setDescription('Update the data from the Jira API')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new Client(['base_uri' => 'http://192.168.44.92']);
        $response = $client->request('GET', '/rest/api/latest/issue/XCNT-1833');
        $result = $response->getBody();
        $decodedResults = json_decode($result);
        $em = $this->getContainer()->get('doctrine')->getManager();

        $this->isValidResponse($decodedResults);
        $this->truncateTables($em);

        $task = new Task();
        $task->setTaskId($decodedResults->id);
        $task->setTasksDate(date('Y-m-d H:i:s', strtotime($decodedResults->fields->created)));
        $task->setLanguages(
            $this->getLanguagesFromCustomfield($decodedResults->fields->{self::CUSTOMFIELD_LANGUAGES})
        );
        $em->persist($task);

        foreach ($decodedResults->fields->attachment as $attachment)
        {
            if ($this->isPdf($attachment->filename)) {
                $document = new Document();
                $document->setCreateDate(date('Y-m-d H:i:s', strtotime($attachment->created)));
                $document->setFilename($attachment->filename);
                $document->setUrl($attachment->content);
                $document->setTaskId($decodedResults->key);
                $document->setAuthor($attachment->author->name);
                /*
                            $user = new User();
                            $user->setUserId($attachment->author->name);
                            $user->setEmail($attachment->author->emailAddress);
                            $user->setTalent($attachment->author->displayName);
                */
                $em->persist($document);
            }
        }

        $em->flush();
        $output->writeln('Command result.');
    }

    /**
     * @param array $langFields
     * @return string
     */
    private function getLanguagesFromCustomfield(array $langFields) {
        $languages = [];
        foreach($langFields as $language) {
            $languages[] = $language->value;
        }
        return implode(',' , $languages);
    }

    /**
     * @param string $filename
     * @return bool
     */
    private function isPdf(string $filename): bool {
        return substr(strtolower($filename), -3)== 'pdf';
    }

    /**
     * @param $em
     */
    private function truncateTables($em)
    {
        $connection = $em->getConnection();
        $platform = $connection->getDatabasePlatform();
        $connection->executeUpdate($platform->getTruncateTableSQL('tasks', true));
        $connection->executeUpdate($platform->getTruncateTableSQL('document', true));
    }

    /**
     * @param $decodedResults
     */
    private function isValidResponse($decodedResults)
    {
        if ($decodedResults === NULL) {
            exit;
        }
    }

}
