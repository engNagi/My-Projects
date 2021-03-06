<?php

namespace JiraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="tasks")
 * @ORM\Entity(repositoryClass="JiraBundle\Repository\TaskRepository")
 */
class TaskWithUser
{
    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id"),
     *   @ORM\JoinColumn(name="task_id", referencedColumnName="task_id")
     * })
     */
    private $author;

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @ORM\Column(type="string")
     * @ORM\Column(unique=true)
     * @ORM\Id
     */
    protected $task_id;

    /**
     * @ORM\Column(type="string")
     */
    protected $languages;

    /**
     * @ORM\Column(type="string")
     */
    protected $tasks_date;

    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @ORM\Column(type="integer")
     */
    protected $original_document_id;

    /**
     * @ORM\Column(type="string")
     */
    protected $state;

    /**
     * @ORM\Column(type="string")
     */
    protected $user_id;

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getOriginalDocumentId()
    {
        return $this->original_document_id;
    }

    /**
     * @param mixed $original_document_id
     */
    public function setOriginalDocumentId($original_document_id)
    {
        $this->original_document_id = $original_document_id;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @return array
     */
    public function getLanguagesAsArray()
    {
        return explode(
            ',',
            str_replace(' ', '', $this->languages)
        );
    }

    /**
     * @param mixed $languages
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;
    }

    /**
     * @return mixed
     */
    public function getTasksDate()
    {
        return $this->tasks_date;
    }

    /**
     * @param mixed $tasks_date
     */
    public function setTasksDate($tasks_date)
    {
        $this->tasks_date = $tasks_date;
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
}
