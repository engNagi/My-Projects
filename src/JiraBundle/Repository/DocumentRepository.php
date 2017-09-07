<?php

namespace JiraBundle\Repository;

use Doctrine\ORM\EntityRepository;
use JiraBundle\Entity\DocumentWithUser;

class DocumentRepository extends EntityRepository
{
    /**
     * @return DocumentWithUser[]
     */
    public function getAll()
    {
        return $this->getEntityManager()->getRepository(DocumentWithUser::class)->findAll();
    }

    /**
     * @return DocumentWithUser|null
     */
    public function getById($document_id)
    {
        return $this->getEntityManager()->getRepository(DocumentWithUser::class)->find($document_id);
    }

    /**
     * @param $taskId
     * @return DocumentWithUser[]
     */
    public function getByTask($taskId)
    {
        $documents = $this->getEntityManager()->getRepository(DocumentWithUser::class);
        return $documents->findBy(array('task_id'=>$taskId));
    }
}
