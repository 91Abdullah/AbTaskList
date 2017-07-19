<?php

namespace AbTaskList;

use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;

use AbTaskList\Models\Task;

class AbTaskList extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Dispatcher_ControllerPath_Backend_ExampleModulePlainHtml' => 'onGetBackendController',
            'Shopware_CronJob_DeleteCompletedTasks' => 'DeleteCompletedTasks'
        ];
    }

    /**
     * @return string
     */
    public function onGetBackendController()
    {
        return __DIR__ . '/Controllers/Backend/ExampleModulePlainHtml.php';
    }

    public function install(InstallContext $context)
    {
        $this->installSchema();
        $this->addCron();
        parent::install($context);
    }

    public function uninstall(UninstallContext $context)
    {
        $this->uninstallSchema();
        $this->removeCron();
        parent::uninstall($context);
    }

    public function addCron()
    {
        $connection = $this->container->get('dbal_connection');
        $connection->insert(
            's_crontab',
            [
                'name'             => 'DeleteCompletedTasks',
                'action'           => 'DeleteCompletedTasks',
                'next'             => new \DateTime(),
                'start'            => new \DateTime('2017-07-20 00:00:00'),
                '`interval`'       => '86400',
                'active'           => 1,
                'end'              => new \DateTime(),
                'pluginID'         => null
            ],
            [
                'next' => 'datetime',
                'end'  => 'datetime',
            ]
        );
    }
    public function removeCron()
    {
        $this->container->get('dbal_connection')->executeQuery('DELETE FROM s_crontab WHERE `name` = ?', [
            'DeleteCompletedTasks'
        ]);
    }
    public function DeleteCompletedTasks(\Shopware_Components_Cron_CronJob $job)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder()
            ->delete('t')
            ->from('s_task', 't')
            ->where('done = 1');
        return true;
    }

    protected function installSchema()
    {
        $tool = new \Doctrine\ORM\Tools\SchemaTool($this->container->get('models'));
        $classes = [
            $this->container->get('models')->getClassMetaData(Task::class),
            $this->container->get('models')->getClassMetaData(\AbTaskList\Models\TaskList::class)
        ];

        $tool->createSchema($classes);
    }

    public function uninstallSchema()
    {
        $tool = new \Doctrine\ORM\Tools\SchemaTool($this->container->get('models'));
        $classes = [
            $this->container->get('models')->getClassMetaData(Task::class),
            $this->container->get('models')->getClassMetaData(\AbTaskList\Models\TaskList::class)
        ];
        $tool->dropSchema($classes);
    }
}
