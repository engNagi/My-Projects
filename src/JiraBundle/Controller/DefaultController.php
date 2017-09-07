<?php

namespace JiraBundle\Controller;
use GuzzleHttp\Psr7\Response;
use JiraBundle\Entity\Document;
use JiraBundle\Entity\Task;
use JiraBundle\Entity\User;
use JiraBundle\Repository\DocumentRepository;
use JiraBundle\Service\TaskService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="tasks_overview")
     */
    public function getTasksAction()
    {
        /** @var DocumentRepository $documentRepository */
        $documentRepository = $this->getDoctrine()->getRepository(Document::class);

        $tasks = $this->getDoctrine()
            ->getRepository(Task::class)
            ->getAll();

        $taskToDocument = [];
        $collectedDocument = [];
        foreach ($tasks as $task )
        {
            $taskToDocument[$task->getTaskId()] = $documentRepository->getById($task->getOriginalDocumentId());
            $collectedDocument[$task->getTaskId()] =$this->getTranslatedDocument($task->getTaskId());

        }


        return $this->render(
            'tasks/tasks.html.twig',
            [
                'tasks' => $tasks,
                'taskToDocument' => $taskToDocument,
                'translatedDocuments' => $collectedDocument

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
        $task = $this->getDoctrine()
            ->getRepository(Task::class)
            ->find($id);

        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->getByTask($id);

        $document = $this->getDoctrine()
            ->getRepository(Document::class)
            ->getById($task->getOriginalDocumentId());


        return $this->render(
            'tasks/detailedtasks.html.twig',
            [
                'translatedDocuments' => $this->getTranslatedDocument($id),
                'task' => $task,
                'users' => $users,
                'originalDocument' => $document
            ]
        );
    }

    /**
     * @Route("/getTaskImage/{id}", name="task_image")
     */
    public function getImagesAction($id){
        return new BinaryFileResponse($this->getParameter('kernel.cache_dir') . '/' . $id . '.jpg');
    }

    /**
     * @Route("/getUser/{id}/{task}", name="user_detail")
     * @param $id
     * @return Response
     */
    public function getUsersDetailAction($id,$task)
    {
        /** @var User $user */
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->getByUserId($id,$task);

        return new JsonResponse($user);
    }

    private function getTranslatedDocument($id)
    {
        $documents = $this->getDoctrine()
        ->getRepository(Document::class)
        ->getByTask($id);

        $languages = $this->getDoctrine()
            ->getRepository(Task::class)
            ->find($id)
            ->getLanguagesAsArray();

        $service = new TaskService();
        $matchedDocuments = $service->sortDocumentsByRequestedLanguage($documents,$languages);
        $isoMatches = $service->sortDocumentsByIsoCode($matchedDocuments['--']);
        $looseMatches = $service->sortDocumentsMock($matchedDocuments['--']);

        return array_merge($matchedDocuments, $isoMatches, $looseMatches);
    }
}


