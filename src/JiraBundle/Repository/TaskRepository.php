<?php

namespace JiraBundle\Repository;
use JiraBundle\Entity\Task;
use Doctrine\ORM\EntityRepository;

class TaskRepository extends EntityRepository
{
    /**
     * @return Task[]
     */
    public function getAll() {
        return $this->getEntityManager()->getRepository(Task::class)->findAll();
    }
}
