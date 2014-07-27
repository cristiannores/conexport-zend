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


 class DesconsolidacionForm extends Form
 {
     protected $usuarioTable;
     
     public function __construct(UsuarioTable $usuarioTable)
     {
         $this->setUsuarioTable($usuarioTable);
         // we want to ignore the name passed
         parent::__construct('db-adapter-form');

         $this->add(array(
             'name' => 'id_consolidacion',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'type' => 'text',
             'name' => 'contenedor',
             'options' => array(
                     'label' => 'Contnedor',
                      ),
            'attributes' => array(
                
                'class' => 'form-control',
                'placeholder' => 'Ingresa el ID Contenedor',
                
            )
             
        ));
         $this->add(array(
            'type' => 'Zend\Form\Element\Date',
            'name' => 'fecha',
            'options' => array(
                    'label' => 'Fecha',
                    'format' => 'Y-m-d'
            ),
            'attributes' => array(
                    'class' => 'form-control',
                    'min' => '2012-01-01',
                    'max' => '2020-01-01',
                    'step' => '1', // days; default step interval is 1 day
            )
        ));
         $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'turno',
             'options' => array(
                     'label' => 'Turno',
                     'empty_option' => 'Seleccione el turno',
                     'value_options' => array(
                             '1' => 'Turno 1',
                             '2' => 'Turno 2',
                             '3' => 'Turno 3',
                             
                     ),
                 ),
            'attributes' => array(
                
                'class' => 'form-control',
                'placeholder' => 'Selecciona las caracteristicas',
                
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
     
     // OBTENER MATERIALES 
     
      public function getUsuarioForSelect()
    {
        $table = $this->getUsuarioTable();
        $tipo = 'inspector';
        $data =  $table->getInspector($tipo);
        

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