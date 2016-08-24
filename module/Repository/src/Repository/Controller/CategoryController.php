<?php

namespace Repository\Controller;

use Zend\View\Model\ViewModel;
use Base\Controller\CrudController;

class CategoryController extends CrudController
{

    use \Repository\Entity\CategoryTrait;

    public function __construct()
    {
        
    }

    public function setCategoryTable($categoryTable)
    {
        $this->setServiceTable($categoryTable);
    }

    public function IndexAction()
    {
        $this->layout('layout/tables');
        $this->layout()->setVariable('headerTitle', 'Categoria');
        $this->layout()->setVariable('headerSubTitle', 'Lista de');
        $this->layout()->setVariable('headerIconName', 'iconfa-tags');

        return parent::IndexAction();
    }

    public function newAction()
    {
        $this->layout('layout/wizard');
        $this->layout()->setVariable('headerTitle', 'Categoria');
        $this->layout()->setVariable('headerSubTitle', 'Adicionar');
        $this->layout()->setVariable('headerIconName', 'iconfa-tags');
        
        return parent::newAction();
    }
    
    public function editAction()
    {
        $this->layout('layout/wizard');
        $this->layout()->setVariable('headerTitle', 'Categoria');
        $this->layout()->setVariable('headerSubTitle', 'Editar');
        $this->layout()->setVariable('headerIconName', 'iconfa-tags');
        
        return parent::newAction();
    }
}
