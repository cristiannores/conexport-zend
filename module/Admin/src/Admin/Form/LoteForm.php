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

use Admin\Model\MaterialTable;
use Admin\Model\NaveTable;
use Admin\Model\BodegaTable;
use Admin\Model\ClienteTable;

 class LoteForm extends Form

 {
     
     protected $materialTable;
     protected $naveTable;
     protected $bodegaTable;
     protected $clienteTable;
     
     
     public function __construct(MaterialTable $materialTable,NaveTable $naveTable, BodegaTable $bodegaTable, ClienteTable $clienteTable)
             
     {
         $this->setMaterialTable($materialTable);
         $this->setNaveTable($naveTable);
         $this->setBodegaTable($bodegaTable);
         $this->setClienteTable($clienteTable);
         // we want to ignore the name passed
         parent::__construct('db-adapter-form');

         $this->add(array(
             'name' => 'id_lote',
             'type' => 'Hidden',
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
             'type' => 'Zend\Form\Element\Select',
             'name' => 'id_cliente',
             'options' => array(
                     'label' => 'Cliente',
                     'empty_option' => 'Seleccione el cliente',
                     'value_options' => $this->getClienteForSelect(),
                 ),
            'attributes' => array(
                
                'class' => 'form-control',
                'placeholder' => 'Selecciona el cliente',
                
            )
             
        ));
          $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'nro_bodega',
             'options' => array(
                     'label' => 'Bodega',
                     'empty_option' => 'Seleccione la bodega',
                     'value_options' => $this->getBodegaForSelect(),
                 ),
            'attributes' => array(
                
                'class' => 'form-control',
                'placeholder' => 'Selecciona la bodega',
                
            )
             
        ));
         $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'producto',
             'options' => array(
                     'label' => 'Material',
                     'empty_option' => 'Seleccione el material',
                     'value_options' => $this->getMaterialForSelect(),
                 ),
            'attributes' => array(
                
                'class' => 'form-control',
                'placeholder' => 'Selecciona el material',
                
            )
             
        ));
        $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'nave',
             'options' => array(
                     'label' => 'Nave',
                     'empty_option' => 'Seleccione la nave',
                     'value_options' => $this->getNaveForSelect(),
                 ),
            'attributes' => array(
                
                'class' => 'form-control',
                'placeholder' => 'Selecciona la nave',
                
            )
             
        ));
         $this->add(array(
             'name' => 'destino',
              'options' => array(
                 'label' => 'Destino :',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa el destino',
                
            )
         ));
         $this->add(array(
             'name' => 'numero_lote',
              'options' => array(
                 'label' => 'Numero de lote :',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa el numero de lote',
                
            )
         ));
         $this->add(array(
             'name' => 'numero_entrega',
              'options' => array(
                 'label' => 'Numero entrega :',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa el numero de entrega',
                
            )
         ));
         $this->add(array(
             'name' => 'codigo_sap',
              'options' => array(
                 'label' => 'Codigo Sap :',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa el Codigo Sap',
                
            )
         ));
         $this->add(array(
             'name' => 'caracteristicas',
              'options' => array(
                 'label' => 'Caracteristicas :',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa las caracteristicas',
                
            )
         ));
         $this->add(array(
             'name' => 'pieza_danada',
              'options' => array(
                 'label' => 'Piezas Dañadas :',
               
             ),
             'attributes' => array(
                 'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa las piezas dañadas',
                
            )
         ));
         $this->add(array(
             'name' => 'pieza_paquete',
              'options' => array(
                 'label' => 'Piezas paquete :',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'damage form-control',
                'placeholder' => 'Ingresa las piezas del paquete',
                
            )
         ));
         $this->add(array(
             'name' => 'estado',
              'options' => array(
                 'label' => 'Estado: ',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa el estado del lote',
                
            )
         ));
                  $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'tipo',
             'options' => array(
                     'label' => 'Tipo de inspeccion',
                     'empty_option' => 'Seleccione el tipo de inspeccion',
                     'value_options' => array(
                             'daños' => 'Daños',
                             'diferencias' => 'Diferencias',
                             
                     ),
                 ),
            'attributes' => array(
                'id'    => 'tipo',                
                'class' => 'form-control',
                'placeholder' => 'Selecciona las caracteristicas',
                
            )
             
        ));
         
         $file = new Element\File('image-file');
        $file->setLabel('Avatar Image Upload')
             ->setAttribute('id', 'image-file')
             ->setAttribute('multiple', true);   // That's it
        $this->add($file);
         
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
                 'class' => 'btn btn-primary'
             )
         ));
         $this->add(array(
             'name' => 'observaciones',
              'options' => array(
                 'label' => 'Observaciones: ',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa la observacion : ',
                
            )
         ));
     }
     
     // OBTENER MATERIALES 
     
      public function getMaterialForSelect()
    {
        $table = $this->getMaterialTable();
        $data =  $table->fetchALL();
        

        $selectData = array();

        foreach ($data as $material) {
            $selectData[$material->id_material] = $material->nombre;
        }

        return $selectData;
    }
        
    public function setMaterialTable($materialTable)
    {
        $this->materialTable = $materialTable;

        return $this;
    }

    public function getMaterialTable()
    {
        return $this->materialTable;
    }
    
     // OBTENER NAVES 
    
      public function getNaveForSelect()
    {
        $table = $this->getNaveTable();
        $data =  $table->fetchALL();
        

        $selectData = array();

        foreach ($data as $nave) {
            $selectData[$nave->id_nave] = $nave->nombre;
        }

        return $selectData;
    }
        
    public function setNaveTable($naveTable)
    {
        $this->naveTable = $naveTable;

        return $this;
    }

    public function getNaveTable()
    {
        return $this->naveTable;
    }
    
    // OBTENER BODEGAS 
    
      public function getBodegaForSelect()
    {
        $table = $this->getBodegaTable();
        $data =  $table->fetchALL();
        

        $selectData = array();

        foreach ($data as $bodega) {
            $selectData[$bodega->nro_bodega] = $bodega->descripcion;
        }

        return $selectData;
    }
        
    public function setBodegaTable($bodegaTable)
    {
        $this->bodegaTable = $bodegaTable;

        return $this;
    }

    public function getBodegaTable()
    {
        return $this->bodegaTable;
    }
    
    
    // OBTENER CLIENTES 
    
      public function getClienteForSelect()
    {
        $table = $this->getClienteTable();
        $data =  $table->fetchALL();
        

        $selectData = array();

        foreach ($data as $cliente) {
            $selectData[$cliente->id_cliente] = $cliente->organizacion;
        }

        return $selectData;
    }
        
    public function setClienteTable($clienteTable)
    {
        $this->clienteTable = $clienteTable;

        return $this;
    }

    public function getClienteTable()
    {
        return $this->clienteTable;
    }
    
 }