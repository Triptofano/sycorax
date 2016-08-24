<?php

namespace Repository\Controller;

use Zend\View\Model\ViewModel;
use Base\Controller\CrudController;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class CodeController extends CrudController
{

    use \Repository\Entity\AlgorithmsTrait;
    use \Repository\Entity\CodeTrait;

    public function __construct()
    {
        
    }

    public function setCodeTable($algorithmsTable)
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
        $this->layout()->setVariable('headerTitle', 'Código');
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
        $this->layout('layout/wizard');
        $this->layout()->setVariable('headerTitle', 'Código');
        $this->layout()->setVariable('headerSubTitle', 'Adicionar');
        $this->layout()->setVariable('headerIconName', 'iconfa-code-fork');
        
        return parent::newAction();
    }

    public function editAction()
    {
        $this->layout('layout/wizard');
        $this->layout()->setVariable('headerTitle', 'Código');
        $this->layout()->setVariable('headerSubTitle', 'Editar');
        $this->layout()->setVariable('headerIconName', 'iconfa-code-fork');

        return parent::editAction();
    }

}
