<?php

namespace AbTaskList\Models;

use Shopware\Components\Model\ModelEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="s_task")
 */
class Task extends ModelEntity
{
    /**
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var TaskList $taskList
     *
     * @ORM\ManyToOne(targetEntity="AbTaskList\Models\TaskList")
     * @ORM\JoinColumn(name="taskList", referencedColumnName="id")
     */
    private $taskList;

    /**
     * @var string $name
     *
     * @ORM\Column()
     */
    private $name;

    /**
     * @var integer $done
     *
     * @ORM\Column(type="boolean")
     */
    private $done = false;

    /**
     * @var string $description
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description = null;

    /**
     * @var \DateTime $added
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $createDate = null;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $active
     */
    public function setDone($done)
    {
        $this->done = $done;
    }

    /**
     * @return int
     */
    public function getDone()
    {
        return $this->done;
    }

    /**
     * @param \DateTime $createDate
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function getTaskList()
    {
        return $this->taskList;
    }

    public function setTaskList($taskList)
    {
        $this->taskList = $taskList;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}