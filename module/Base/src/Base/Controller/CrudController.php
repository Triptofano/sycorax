<?php

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Form\Form;
use Base\Service\AbstractTable;

abstract class CrudController extends AbstractActionController
{

    protected $service;
    protected $form;
    protected $route;
    protected $controller;

    public function setForm(Form $form)
    {
        $this->form = $form;
        return $this;
    }

    public function setServiceTable(AbstractTable $serviceTable)
    {
        $this->service = $serviceTable;
        return $this;
    }

    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }

    public function setControllerName($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    public function indexAction()
    {
        $list = $this->service->findAll();
        $page = $this->params()->fromRoute('page');

        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);

        return new ViewModel(array(
            'data' => $paginator,
            'page' => $page,
        ));
    }

    public function newAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $this->form->setData($request->getPost());
            if ($this->form->isValid()) {
                $this->service->insert($request->getPost()->toArray());

                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }

        return new ViewModel(array(
            'form' => $this->form
        ));
    }

    public function editAction()
    {
        $request = $this->getRequest();

        $entity = $this->service->findById($this->params()->fromRoute('id', 0));

        if ($this->params()->fromRoute('id', 0)) {
            $this->form->setData($entity->toArray());
        }

        if ($request->isPost()) {
            $this->form->setData($request->getPost());
            if ($this->form->isValid()) {
                $this->service->update($request->getPost()->toArray());

                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }

        return new ViewModel(array('form' => $this->form));
    }

    public function deleteAction()
    {
        if ($this->service->delete($this->params()->fromRoute('id', 0))) {
            return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
        }
    }

}
