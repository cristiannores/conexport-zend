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

use Admin\Model\UsuarioTable;

 class UsuarioForm extends Form
 {
     protected $usuarioTable;
    
     
     public function __construct(UsuarioTable $usuarioTable)
     {
         
         $this->setUsuarioTable($usuarioTable);

         parent::__construct('db-adapter-form');

         $this->add(array(
             'name' => 'id_usuario',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'supervisor_rut',
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
                'placeholder' => 'Ingresa el usuario',
                
            )
         ));
         
         $this->add(array(
             'name' => 'apellido',
              'options' => array(
                 'label' => 'Apellido :',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa el apellido',
                
            )
         ));
         $this->add(array(
             'name' => 'rut',
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
             'type' => 'Zend\Form\Element\Select',
             'name' => 'supervisor_id',
             'options' => array(
                     'label' => 'Supervisor',
                     'empty_option' => 'Seleccione el supervisor',
                     'value_options' => $this->getOptionsForSelect(),
                 ),
            'attributes' => array(
                
                'class' => 'form-control',
                'placeholder' => 'Selecciona las caracteristicas',
                
            )
             
        ));
        $this->add(array(
             'name' => 'correo',
              'options' => array(
                 'label' => 'Correo :',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa el correo',
                
            )
         ));
         $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'tipo',
             'options' => array(
                     'label' => 'Tipo usuario',
                     'empty_option' => 'Seleccione el tipo de usuario',
                     'value_options' => array(
                         'supervisor' => 'Supervisor',
                         'inspector' => 'Inspector',
                         'gerente' => 'Gerente',
                         'cliente' => 'Cliente',
                     )
                 ),
            'attributes' => array(
                
                'class' => 'form-control',
                'placeholder' => 'Selecciona las caracteristicas',
                
            )
             
        ));
         $this->add(array(
             'name' => 'fono',
              'options' => array(
                 'label' => 'Fono :',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa el fono',
                
            )
         ));
         $this->add(array(
             'name' => 'password',
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
     
     
     public function getOptionsForSelect()
    {
        $table = $this->getUsuarioTable();
        $data = $table->fetchALL();
        

        $selectData = array();

        foreach ($data as $usuario) {
            $selectData[$usuario->id_usuario] = $usuario->nombre;
        }

        return $selectData;
    }
        
    public function setUsuarioTable($usuarioTable)
    {
        $this->usuarioTable = $usuarioTable;

        return $this;
    }

    public function getUsuarioTable()
    {
        return $this->usuarioTable;
    }
    
   
 }