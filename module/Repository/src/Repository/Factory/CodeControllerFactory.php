<?php

namespace Repository\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Repository\Controller\CodeController;

class AlgorithmsControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm = $serviceLocator->getServiceLocator();

        $controller = new CodeController();
        $controller->setControllerName('Code');
        $controller->setRoute('repository/algorithms/code');
        $controller->setAlgorithmsTable($sm->get('Repository\Service\AlgorithmsTable'));
        $controller->setCodeTable($sm->get('Repository\Service\CodeTable'));
        $controller->setForm($sm->get('Repository\Form\Code'));

        return $controller;
    }

}
