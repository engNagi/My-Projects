<?php

namespace AppBundle\Controller;

use JiraBundle\Entity\Document;
use JiraBundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/getUsers", name="users_overview")
     */
    public function getUsersAction()
    {
        return $this->render(
            'users/users.html.twig'
        );
    }

    /**
     * @Route("/", name="tasks_overview")
     */
    public function getTasksAction()
    {
        return $this->render(
            'tasks/tasks.html.twig',
            [
                'tasks' => $this->getDoctrine()
                    ->getRepository(Task::class)
                    ->getAll()
            ]
        );
    }

    /**
     * @Route("/getDocuments", name="documents_overview")
     */
    public function getDocumentsAction()
    {
        return $this->render(
            'documents/documents.html.twig',
            [
                'documents' => $this->getDoctrine()
                    ->getRepository(Document::class)
                    ->getAll()
            ]
        );
    }

    /**
     * @Route("/getTask/{id}", name="task_detail")
     */
    public function getTasksDetailAction($id)
    {
        return $this->render(
            'tasks/detailedtasks.html.twig'
        );
    }
}
