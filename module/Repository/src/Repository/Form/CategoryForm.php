<?php

namespace Repository\Form;

use Zend\Form\Form;

class CategoryForm extends Form
{

    public function __construct($name = null, $options = null)
    {
        parent::__construct($name, $options);

        $this->setAttribute('method', 'POST');

        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-default',
                'id' => ''
            ),
            'options' => array(
                'label' => 'Categoria',
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn btn-primary',
            ),
        ));
    }

}
