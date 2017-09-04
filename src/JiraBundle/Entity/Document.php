<?php

namespace JiraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="document")
 * @ORM\Entity(repositoryClass="JiraBundle\Repository\DocumentRepository")
 */
class Document
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $document_id;

    /**
     * @ORM\Column(type="string")
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
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */

    /**
     * @ORM\Column(type="string")
     */
    private $filename;

    /**
     * @ORM\Column(type="string")
     */
    private $url;

    /**
     * @ORM\Column(type="string")
     */
    private $create_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $task_id;

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param mixed $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getCreateDate()
    {
        return $this->create_date;
    }

    /**
     * @param mixed $create_date
     */
    public function setCreateDate($create_date)
    {
        $this->create_date = $create_date;
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
     * Get id
     *
     * @return int
     */
    public function getDocumentId()
    {
        return $this->document_id;
    }
}

