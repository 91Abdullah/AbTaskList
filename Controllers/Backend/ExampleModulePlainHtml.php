<?php

use Doctrine\DBAL\Driver\PDOStatement;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Expr\Join;
use Shopware\Components\CSRFWhitelistAware;

use AbTaskList\Models\Task;

/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Shopware_Controllers_Backend_ExampleModulePlainHtml extends Enlight_Controller_Action implements CSRFWhitelistAware
{
    protected $taskRepository = null;

    protected $taskListRepository = null;

    protected $entityManager;

    /**
     * @var FormRepo
     */
    protected $formRepository = null;

    public function preDispatch()
    {
        $this->get('template')->addTemplateDir(__DIR__ . '/../../Resources/views/');
    }

    public function postDispatch()
    {
        $csrfToken = $this->container->get('BackendSession')->offsetGet('X-CSRF-Token');
        $this->View()->assign([ 'csrfToken' => $csrfToken ]);
    }

    private function getTaskListRepository()
    {
        if($this->taskListRepository === null) {
            $this->taskListRepository = $this->getModelManager()->getRepository('AbTaskList\Models\TaskList');
        }
        return $this->taskListRepository;
    }

    private function getTaskRepository()
    {
        if($this->taskRepository === null) {
            $this->taskRepository = $this->getModelManager()->getRepository('AbTaskList\Models\Task');
        }

        return $this->taskRepository;
    }

    private function getEntityManager()
    {
        if ($this->entityManager === null) {
            $this->entityManager = $this->get('models');
        }
        return $this->entityManager;
    }

    public function indexAction()
    {
        if($this->Request()->getMethod() == 'POST') {

            $params = $this->Request()->getParams();

            $em = $this->getEntityManager();
            $params = $this->Request()->getParams();
            $list = $this->getTaskListRepository()->findOneById($params['id']);
            $tasks = $list->getTasks();
            $done = true;
            if($params['form_method'] !== null && $params['form_method'] == 'mark_undone') {
                $done = false;
            }
            foreach ($tasks as $key => $task) {
                $task->setDone($done);
                $em->flush();
            }
            $query = $this->getTaskListRepository()->createQueryBuilder('c')->getQuery();
            $tasks_list = $query->getResult(Query::HYDRATE_ARRAY);

            $this->View()->assign(['task_lists' => $tasks_list,'success' => true, 'done' => $done]);
        } else {
            $query = $this->getTaskListRepository()->createQueryBuilder('c')->getQuery();
            $tasks_list = $query->getResult(Query::HYDRATE_ARRAY);

            $this->View()->assign(['task_lists' => $tasks_list]);
        }
    }

    public function editTaskAction()
    {
        if($this->Request()->getMethod() == 'POST') {
            $em = $this->getEntityManager();
            $params = $this->Request()->getParams();
            $task = $this->getTaskRepository()->findOneById($params['id']);
            $task->setName($params['name']);
            $list = $this->getTaskListRepository()->findOneById($params['taskListId']);
            $task->setTaskList($list);
            $params['done'] == 'on' ? $task->setDone(true) : $task->setDone(false);
            $task->setDescription($params['description']);
            $task->setCreateDate(new DateTime());
            $em->flush();
            $this->View()->assign(['task' => $task, 'success' => true]);
        } else {
            $params = $this->Request()->getParams();
            $task = $this->getTaskRepository()->findOneById($params['id']);
            $query = $this->getTaskListRepository()->createQueryBuilder('c')->getQuery();
            $tasks_list = $query->getResult(Query::HYDRATE_ARRAY);
            $selected = $task->getTaskList();
            // print_r($task);
            $this->View()->assign(['task' => $task, 'selected'=>$selected,'task_list' => $tasks_list]);
        }
    }

    public function createListAction()
    {
        if($this->Request()->getMethod() == 'POST') {
            $em = $this->getEntityManager();
            $params = $this->Request()->getParams();
            $list = new \AbTaskList\Models\TaskList();
            $list->setCreateDate(new \DateTime());
            $em->persist($list);
            $em->flush();
            $this->View()->assign(['success' => true]);
        }
    }

    public function createTaskAction()
    {
        //print_r($this->Request()->getMethod());
        if($this->Request()->getMethod() == 'POST') {
            $em = $this->getEntityManager();
            $params = $this->Request()->getParams();
            $task = new Task();
            $task->setName($params['name']);
            $list = $this->getTaskListRepository()->findOneById($params['taskListId']);
            $task->setTaskList($list);
            $params['done'] == 'on' ? $task->setDone(true) : $task->setDone(false);
            $task->setDescription($params['description']);
            $task->setCreateDate(new DateTime());
            $em->persist($task);
            $em->flush();
            $this->View()->assign(['success' => true]);
        } else {
            $query = $this->getTaskListRepository()->createQueryBuilder('c')->getQuery();
            $tasks = $query->getResult(Query::HYDRATE_ARRAY);

            $this->View()->assign(['task_list' => $tasks]);
        }
    }

    public function taskAction()
    {
        $query = $this->getTaskRepository()->createQueryBuilder('c')->getQuery();
        $total = $this->getModelManager()->getQueryCount($query);
        $tasks = $query->getResult(Query::HYDRATE_ARRAY);

        $this->View()->assign(['tasks' => $tasks, 'totalTasks' => $total]);
    }

    public function getWhitelistedCSRFActions()
    {
        return ['index'];
    }
}
