<?php

namespace Repository\Controller;

use Zend\View\Model\ViewModel;
use Base\Controller\CrudController;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class AlgorithmsController extends CrudController
{

    use \Repository\Entity\AlgorithmsTrait;
    use \Repository\Entity\CategoryTrait;

    public function __construct()
    {
        
    }

    public function setAlgorithmsTable($algorithmsTable)
    {
        $this->setServiceTable($algorithmsTable);
    }

    public function IndexAction()
    {
        $list = $this->service->findAll();
        $page = $this->params()->fromRoute('page');

        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);

        $this->layout('layout/tables');
        $this->layout()->setVariable('headerTitle', 'Algoritimos');
        $this->layout()->setVariable('headerSubTitle', 'Lista de');
        $this->layout()->setVariable('headerIconName', 'iconfa-code-fork');

        return new ViewModel(array(
            'data' => $paginator,
            'categories' => $this->categoryTable->findAll(),
            'page' => $page,
        ));
    }

    public function newAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $this->form->setData($request->getPost());
            if ($this->form->isValid()) {

                $data = $request->getPost()->toArray();
                $this->service->insert($request->getPost()->toArray());

                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }

        $this->layout('layout/wizard');
        $this->layout()->setVariable('headerTitle', 'Algoritimos');
        $this->layout()->setVariable('headerSubTitle', 'Adicionar');
        $this->layout()->setVariable('headerIconName', 'iconfa-code-fork');

        return new ViewModel(array(
            'form' => $this->form
        ));
    }

    public function editAction()
    {
        $this->layout('layout/wizard');
        $this->layout()->setVariable('headerTitle', 'Algoritimos');
        $this->layout()->setVariable('headerSubTitle', 'Editar');
        $this->layout()->setVariable('headerIconName', 'iconfa-code-fork');

        return parent::editAction();
    }

    public function itemAction()
    {
        $hash = $this->params()->fromRoute('id', 0);
        
        $algorithm = $this->service->find(array('hash' => $hash));
        $category = $this->categoryTable->findById($algorithm->getCategoryId());
        
        $this->layout()->setVariable('headerTitle', $algorithm->getTitle());
        $this->layout()->setVariable('headerSubTitle', $category->getName());
        $this->layout()->setVariable('headerIconName', 'iconfa-code');
        
        return new ViewModel(array(
            'algorithm' => $algorithm,
            'codes' => array(),
        ));
    }

}
