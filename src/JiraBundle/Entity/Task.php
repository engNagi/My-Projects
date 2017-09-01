<?php

namespace JiraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="JiraBundle\Repository\TaskRepository")
 */
class Task
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Column(unique="true")
     * @ORM\Id
     */private $task_id;
    /**
     * @ORM\Column(type="string")
     */
    private $languages;
    /**
     * @ORM\Column(type="string")
     */
    private $tasks_date;

    /**
     * @return mixed
     */
    public function getLanguages()
    {
        return $this->languages;
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
