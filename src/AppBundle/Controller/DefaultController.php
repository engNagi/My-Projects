<?php

namespace AppBundle\Controller;

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
            'default/users.html.twig'
        );
    }

    /**
     * @Route("/getTasks", name="task_overview")
     */
    public function getTasksAction()
    {
        return $this->render(
            'default/task.html.twig'
        );
    }

    /**
     * @Route("/getDocuments", name="documents_overview")
     */
    public function getDocumentsAction()
    {
        return $this->render(
            'default/documents.html.twig'
        );
    }
}
