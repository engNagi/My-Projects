<?php

namespace JiraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="JiraBundle\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Column(type="string")
     * @ORM\Id
     */
    public $user_id;

    /**
     * @ORM\Column(type="string")
     */
    private $task_id;

    /**
     * @return mixed
     */
    public function getTaskId()
    {
        return $this->task_id;
    }

    /**
     * @param mixed $task_id
     */
    public function setTaskId($task_id)
    {
        $this->task_id = $task_id;
    }

    /**
     * @ORM\Column(type="string")
     */
    public $talent;
    /**
     * @ORM\Column(type="string")
     */
    public $email;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getTalent()
    {
        return $this->talent;
    }

    /**
     * @param mixed $talent
     */
    public function setTalent($talent)
    {
        $this->talent = $talent;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}

