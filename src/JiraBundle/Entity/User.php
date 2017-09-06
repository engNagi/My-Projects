<?php

namespace JiraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="JiraBundle\Repository\UserRepository")
 */
class User implements \JsonSerializable
{
    /**
     * @ORM\Column(type="string")
     * @ORM\Id
     */
    private $user_id;

    /**
     * @ORM\Column(type="string")
     * @ORM\Id
     */
    private $task_id;

    /**
     * @ORM\Column(type="string")
     */
    private $talent;

    /**
     * @ORM\Column(type="string")
     */
    private $email;


    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getTalent()
    {
        return $this->talent;
    }
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

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
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @param mixed $talent
     */
    public function setTalent($talent)
    {
        $this->talent = $talent;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUserAvatarUrl()
    {
     return "https://tasks.trivago.com/secure/useravatar?size=medium&ownerId=".$this->getUserId();
}

    public function jsonSerialize()
    {
        return array('user_id'=> $this->getUserId(),
                     'email'=> $this->getEmail(),
                     'talent'=>$this->getTalent(),
                     'avatarUrl'=>$this->getUserAvatarUrl()
                    );
    }
}

