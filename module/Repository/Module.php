<?php

namespace Repository;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $eventManager->attach('dispatch.error', function($event) {
            $exception = $event->getResult()->exception;
            if ($exception) {
                $sm = $event->getApplication()->getServiceManager();
                $service = $sm->get('ErrorHandling');
                $service->logException($exception);
            }
        });

        // "dispatch" event 
        // context: $this, method: onDispatch()

        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'), 100);
    }

    public function onDispatch(MvcEvent $e)
    {
        $sm = $e->getApplication()->getServiceManager();
        $categories = $sm->get('Menu/Category');
        $menu = $sm->get('Menu/Navigation');

        $vm = $e->getViewModel();
        $vm->setVariable('categories', $categories);
        $vm->setVariable('menu', $menu);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Menu/Category' => function ($sm) {
                    $table = $sm->get('Repository\Service\CategoryTable');
                    $list = $table->findAll();
                    asort($list);

                    $AlgorithmsTable = $sm->get('Repository\Service\AlgorithmsTable');
                    $aList = $AlgorithmsTable->findAll();

                    $array = array();
                    foreach ($list as $category) {

                        $aArray = array();
                        foreach ($aList as $algorithms) {
                            if($algorithms->getCategoryId() == $category->getId()) {
                                $aArray[] = array(
                                    'name' => $algorithms->getTitle(),
                                    'name_link' => $algorithms->getHash(),
                                );
                            }
                        }

                        $array[] = array(
                            'icon' => ' ',
                            'name' => $category->getName(),
                            'itens' => $aArray,
                        );
                    }

                    return $array;
                },
                        'Repository\Service\CategoryTable' => function($sm) {
                    return new Service\CategoryTableService($sm->get('CategoryTableGateway'));
                },
                        'CategoryTableGateway' => function ($sm) {
                    $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entity\Category);
                    return new \Zend\Db\TableGateway\TableGateway(Service\CategoryTableService::$tableName, $sm->get('db'), null, $resultSetPrototype);
                },
                        'Repository\Form\Category' => function($sm) {
                    return new Form\CategoryForm('Category');
                },
                        'Repository\Service\AlgorithmsTable' => function($sm) {
                    return new Service\AlgorithmsTableService($sm->get('AlgorithmsTableGateway'));
                },
                        'AlgorithmsTableGateway' => function ($sm) {
                    $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entity\Algorithms);
                    return new \Zend\Db\TableGateway\TableGateway(Service\AlgorithmsTableService::$tableName, $sm->get('db'), null, $resultSetPrototype);
                },
                        'Repository\Form\Algorithms' => function($sm) {
                    $table = $sm->get('Repository\Service\CategoryTable');

                    $array = array();
                    foreach ($table->findAll() as $category) {
                        $array[$category->getId()] = $category->getName();
                    }

                    return new Form\AlgorithmsForm('Algorthms', $array);
                },
                    ),
                );
            }

}
        