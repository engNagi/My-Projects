<?php

namespace JiraBundle\Repository;
use JiraBundle\Entity\Document;
use Doctrine\ORM\EntityRepository;

class DocumentRepository extends EntityRepository
{
    /**
     * @return Document[]
     */
    public function getAll() {
        return $this->getEntityManager()->getRepository(Document::class)->findAll();
    }

    /**
     * @return Document|null
     */
    public function getById($document_id)
    {
        return $this->getEntityManager()->getRepository(Document::class)->find($document_id);

    }
}