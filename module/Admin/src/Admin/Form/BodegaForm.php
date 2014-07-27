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

 class BodegaForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('bodega');
        
         $this->add(array(
             'name' => 'nro_bodega',
              'options' => array(
                 'label' => 'Numero de bodega :',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Numero de bodega',
                
            )
         ));
         
         $this->add(array(
             'name' => 'descripcion',
              'options' => array(
                 'label' => 'Descripcion :',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa la descripcion',
                
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