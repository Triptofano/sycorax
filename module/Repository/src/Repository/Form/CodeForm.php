<?php

namespace Repository\Form;

use Zend\Form\Form;

class CodeForm extends Form
{

    public function __construct($name, $language, $options = null)
    {
        parent::__construct($name, $options);

        $this->setAttribute('method', 'POST');

        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'algorithms_id',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'language',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'class' => 'chzn-select',
                'id' => '',
                'required' => 'required',
                'style' => 'width:300px',
            ),
            'options' => array(
                'label' => 'Linguagens',
                'value_options' => $language,
            )
        ));       

        $this->add(array(
            'name' => 'version',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-default',
                'maxLength' => 255,
                'required' => 'required',
                'placeholder' => 'Versão do algoritmo',
                'id' => '',
            ),
            'options' => array(
                'label' => 'Versão',
            )
        ));

        $this->add(array(
            'name' => 'code',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-default',
                'required' => 'required',
                'placeholder' => 'Código do algoritmo',
                'id' => '',
            ),
            'options' => array(
                'label' => 'Código',
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
