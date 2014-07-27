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


 class ClienteForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('cliente');

         $this->add(array(
             'name' => 'id_cliente',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'organizacion',
              'options' => array(
                 'label' => 'Organizacion :',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa la organizacion',
                
            )
         ));
         
         $this->add(array(
             'name' => 'razon_social',
              'options' => array(
                 'label' => 'Razon Social :',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa la razon social',
                
            )
         ));
         $this->add(array(
             'name' => 'rut_cliente',
              'options' => array(
                 'label' => 'Rut :',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa el rut',
                
            )
         ));
         $this->add(array(
             'name' => 'direccion',
              'options' => array(
                 'label' => 'Direccion :',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa la direccion',
                
            )
         ));
         $this->add(array(
             'name' => 'fono_cliente',
              'options' => array(
                 'label' => 'Telefono :',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa el telefono',
                
            )
         ));
         $this->add(array(
             'name' => 'usuario_cliente',
              'options' => array(
                 'label' => 'Usuario :',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa el usuario',
                
            )
         ));
         $this->add(array(
             'name' => 'pass_cliente',
              'options' => array(
                 'label' => 'Contraseña :',
               
             ),
             'attributes' => array(
                'type' => 'password',
                'class' => 'form-control',
                'placeholder' => 'Ingresa la contraseña',
                
            )
         ));
         $this->add(array(
             'name' => 'password2',
              'options' => array(
                 'label' => 'Contraseña :',
               
             ),
             'attributes' => array(
                'type' => 'password',
                'class' => 'form-control',
                'placeholder' => 'Ingresa la contraseña',
                
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