<?php

namespace JiraBundle\Command;


use GuzzleHttp\Client;
use JiraBundle\Entity\Document;
use JiraBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

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
        $response = $client->request('GET', '/rest/api/latest/search.json');

        $result = $response->getBody();
        $decodedResults = json_decode($result);

        $em = $this->getContainer()->get('doctrine')->getManager();
        $this->isValidResponse($decodedResults);
        $this->truncateTables($em);

        if ($decodedResults->total > 0)
        {
            foreach ( $decodedResults->issues as $issue )
            {
                $output->writeln('processing ' . $issue->key);

                $response = $client->request('GET', '/rest/api/latest/issue/' . $issue->key);
                $result = $response->getBody();
                $issue = json_decode($result);
                $originalDocument = $this->getOriginalDocument($issue);

                $task = new Task();
                $task->setTaskId($issue->key);
                $task->setTasksDate(date('Y-m-d H:i:s', strtotime($issue->fields->created)));
                $task->setLanguages($this->getLanguagesFromCustomfield($issue->fields->{self::CUSTOMFIELD_LANGUAGES}));
                $task->setOriginalDocumentId($originalDocument->getDocumentId());
                $task->setTitle($issue->fields->summary);
                $task->setState($issue->fields->status->name);
                $task->setUserId($issue->fields->creator->displayName);
                $em->persist($task);

                try
                {
                    $url = 'http://192.168.44.92/rest/api/latest/attachment/' . $issue->key . '/' . str_replace(' ', '%20', $originalDocument->getFilename());
                    if ($this->isPdf($url))
                    {
                        $taskImage = new \Imagick($url);
                        for ($x = 1; $x <= $taskImage->getNumberImages(); $x++)
                        {
                            $taskImage->previousImage();
                            if ($x === $taskImage->getNumberImages())
                            {
                                // we reached the first page
                                $taskImage->setImageFormat('jpg');
                                $taskImage->writeImage($this->getContainer()->getParameter('kernel.cache_dir') . '/' . $issue->key . '.jpg');
                            }
                        }
                    } else {
                        //@TODO provide dummy image
                    }
                } catch (\ImagickException $exception) {
                    $output->writeln($url);
                    $output->writeln($exception->getMessage());
                }

                foreach ($issue->fields->attachment as $attachment) {
                    if (!$this->isIdml($attachment->filename)) {
                        $document = new Document();
                        $document->setCreateDate(date('Y-m-d H:i:s', strtotime($attachment->created)));
                        $document->setFilename($attachment->filename);
                        $document->setUrl($attachment->content);
                        $document->setTaskId($issue->key);
                        $document->setAuthor($attachment->author->name);
                        $document->setDocumentId($attachment->id);

                        $em->persist($document);
                    }
                }
                $em->flush();
            }
        }

        $output->writeln('Success.');
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
    private function isIdml(string $filename): bool {
        return substr(strtolower($filename), -4)== 'idml';
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

    /**
     * @param string $decodedResults
     * @return Document
     */
    private function getOriginalDocument($decodedResults): Document
    {
        $original = new Document();
        foreach ($decodedResults->fields->attachment as $attachment) {
            if(
                (
                    $original->getCreateDate() === null
                    || $original->getCreateDate() > $attachment->created
                )
                && !$this->isIdml($attachment->filename)
            ) {
                $original->setDocumentId($attachment->id);
                $original->setCreateDate($attachment->created);
                $original->setFilename($attachment->filename);
            }
        }
        return $original;
    }
}
