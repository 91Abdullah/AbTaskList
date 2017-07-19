<?php

namespace AbTaskList\Models;

use Shopware\Components\Model\ModelEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="s_task_list")
 */
class TaskList extends ModelEntity
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
     * @var TaskList|null the group of task this task belongs (if any)
     * @ORM\OneToMany(targetEntity="AbTaskList\Models\Task", mappedBy="taskList")
     */
    private $tasks;

    /**
     * @var \DateTime $added
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $createDate = null;

    public function getCreateDate()
    {
        return $this->createDate;
    }

    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getTasks()
    {
        return $this->tasks;
    }
}