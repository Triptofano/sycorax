<?php

namespace Repository\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class AlgorithmsForm extends Form
{

    public function __construct($name = null, $categories, $options = null)
    {
        parent::__construct($name, $options);

        $this->setAttribute('method', 'POST');

        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'hash',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-default',
                'id' => '',
                'readonly' => 'true'
            ),
            'options' => array(
                'label' => 'Hash',
            )
        ));

        $this->add(array(
            'name' => 'category_id',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'class' => 'chzn-select',
                'id' => '',
                'required' => 'required',
                'style' => 'width:300px',
            ),
            'options' => array(
                'label' => 'Hash',
                'value_options' => $categories,
            )
        ));

        $this->add(array(
            'name' => 'title',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-default',
                'maxLength' => 255,
                'required' => 'required',
                'placeholder' => 'Nome do Algoritmo',
                'id' => '',
            ),
            'options' => array(
                'label' => 'Nome',
            )
        ));

        $this->add(array(
            'name' => 'developer',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-default',
                'maxLength' => 255,
                'required' => 'required',
                'placeholder' => 'Nome do desenvolvedor do algoritmo',
                'id' => '',
            ),
            'options' => array(
                'label' => 'Desenvolvedor',
            )
        ));

        $this->add(array(
            'name' => 'description',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'class' => 'form-control input-default',
                'required' => 'required',
                'placeholder' => 'Descrição do algoritmo',
                'id' => '',
            ),
            'options' => array(
                'label' => 'Descrição',
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
