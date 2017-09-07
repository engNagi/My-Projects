<?php

namespace JiraBundle\Repository;
use JiraBundle\Entity\TaskWithUser;
use Doctrine\ORM\EntityRepository;

class TaskRepository extends EntityRepository
{
    /**
     * @return Task[]
     */
    public function getAll() {
        return $this->getEntityManager()->getRepository(TaskWithUser::class)->findAll();
    }
}
