<?php

namespace JiraBundle\Command;


use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use JiraBundle\Entity\Document;
//use JiraBundle\Entity\Task;
//use JiraBundle\Entity\User;
class JiraUpdateCommand extends ContainerAwareCommand
{
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

         // Create a client with a base URI
            $client = new Client(['base_uri' => 'http://192.168.44.92']);

            // Send a request to http://192.168.44.92/rest/api/latest/issue/XCNT-1833
            $response = $client->request('GET', '/rest/api/latest/issue/XCNT-1833');

            //Getting the body of response as object and save it to the result
            $result=$response->getBody();

            //Decoding the Json Object and store it as string in $decodedResults
            $decodedResults = json_decode($result);

            //method gets Doctrine's entity manager object, which is the most important object in Doctrine.
            // It's responsible for saving objects to, and fetching objects from, the database.
            $em = $this->getContainer()->get('doctrine')->getManager();

            //loop through the attachment of the json object
            foreach ($decodedResults->fields->attachment as $attachment)
            {
            //Creating a new document Object, Which is used to store
            //-Date of the document
            //-name of the document
            //-URL of the document
            //-Task-iD  of the document into the database.
                $document = new Document();

                $document->setCreateDate($attachment->created);
                $document->setFilename($attachment->filename);
                $document->setUrl($attachment->content);


            //Creating a new document Object, Which is used to store
            //-name of the User
            //-Email of the user
               // $user = new User();

                //$user->setTalent($author->displayName);
                //$user->setRole($attachment->name);

            // It will delay most SQL commands until EntityManager#flush() is invoked
            // which will then issue all necessary SQL statements to synchronize your objects with the database in the most efficient way and a single,
            //short transaction, taking care of maintaining referential integrity.
                $em->persist($document);
            }
        $em->flush();
        $output->writeln('Command result.');
    }

}
