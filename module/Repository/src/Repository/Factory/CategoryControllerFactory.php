<?php

namespace Repository\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Repository\Controller\CategoryController;

class CategoryControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm = $serviceLocator->getServiceLocator();

        $controller = new CategoryController();
        $controller->setControllerName('Category');
        $controller->setRoute('repository/category');
        $controller->setCategoryTable($sm->get('Repository\Service\CategoryTable'));
        $controller->setForm($sm->get('Repository\Form\Category'));

        return $controller;
    }

}
