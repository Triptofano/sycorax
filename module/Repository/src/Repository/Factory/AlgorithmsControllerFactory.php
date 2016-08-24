<?php

namespace Repository\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Repository\Controller\AlgorithmsController;

class AlgorithmsControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm = $serviceLocator->getServiceLocator();

        $controller = new AlgorithmsController();
        $controller->setControllerName('Algorithms');
        $controller->setRoute('repository/algorithms');
        $controller->setAlgorithmsTable($sm->get('Repository\Service\AlgorithmsTable'));
        $controller->setCategoryTable($sm->get('Repository\Service\CategoryTable'));
        $controller->setForm($sm->get('Repository\Form\Algorithms'));

        return $controller;
    }

}
