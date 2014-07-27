<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */
namespace Admin\Form;

use Zend\Captcha\AdapterInterface as CaptchaAdapter;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Captcha;
use Zend\Form\Factory;

 class NaveForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('nave');

         $this->add(array(
             'name' => 'id_nave',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'nombre',
              'options' => array(
                 'label' => 'Nombre :',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa el nave',
                
            )
         ));
         
         $this->add(array(
             'name' => 'codigo',
              'options' => array(
                 'label' => 'Codigo :',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa el codigo',
                
            )
         ));
         
         
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
                 'class' => 'btn btn-primary'
             )
         ));
     }
 }