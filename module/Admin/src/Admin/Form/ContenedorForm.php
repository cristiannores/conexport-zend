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
use Admin\Model\ClienteTable;
use Admin\Model\BodegaTable;

 class ContenedorForm extends Form
 {
     protected $materialTable;
     protected $naveTable;
     protected $clienteTable;
     protected $bodegaTable;
     
     public function __construct(MaterialTable $materialTable, NaveTable $naveTable, ClienteTable $clienteTable, BodegaTable $bodegaTable)
             
     {
         $this->setMaterialTable($materialTable);
         $this->setNaveTable($naveTable);
         $this->setClienteTable($clienteTable);
         $this->setBodegaTable($bodegaTable);
         
         // we want to ignore the name passed
         parent::__construct('db-adapter-form');

         $this->add(array(
             'name' => 'id_cont',
             'type' => 'Hidden',
             'attributes' => array(
                
                'value' => 0
                
            )
         ));
         $this->add(array(
             'name' => 'fecha',
             'type' => 'Hidden'));
         $this->add(array(
             'name' => 'hora',
             'type' => 'Hidden'));
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
             'name' => 'tipo',
             'options' => array(
                     'label' => 'Tipo de inspeccion',
                     'empty_option' => 'Seleccione el tipo de inspeccion',
                     'value_options' => array(
                             'consolidacion' => 'Consolidacion daños',
                             'desconsolidacion' => 'Desconsolidacion daño',
                             
                     ),
                 ),
            'attributes' => array(
                'id' => 'tipo',
                'class' => 'form-control',
                'placeholder' => 'Selecciona las caracteristicas',
                
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
             'name' => 'codigo_contenedor',
              'options' => array(
                 'label' => 'Contenedor :',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa el ID del contenedor',
                
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
             'name' => 'numero_lote',
              'options' => array(
                 'label' => 'Lote:',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa el lote',
                
            )
         ));
          

         $this->add(array(
             'name' => 'pieza_danada',
              'options' => array(
                 'label' => 'Daños: ',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa los daños',
                
            )
         ));
         $this->add(array(
             'name' => 'pieza_paquete',
              'options' => array(
                 'label' => 'Piezas totales: ',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Ingresa los piezas : ',
                
            )
         ));
         
         
         $this->add(array(
             'name' => 'imp_o_zcho',
              'options' => array(
                 'label' => 'Origen zuncho: ',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Origen zuncho : ',
                
            )
         ));
         
         $this->add(array(
             'name' => 'imp_o_taco',
              'options' => array(
                 'label' => 'Origen taco: ',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Origen taco : ',
                
            )
         ));
         
         $this->add(array(
             'name' => 'imp_d_zcho',
              'options' => array(
                 'label' => 'Destino zuncho: ',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Destino zuncho : ',
                
            )
         ));
         
         $this->add(array(
             'name' => 'imp_d_taco',
              'options' => array(
                 'label' => 'Destino taco: ',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Destino taco : ',
                
            )
         ));
         $this->add(array(
             'name' => 'imp_piezas_o',
              'options' => array(
                 'label' => 'Daño origen: ',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Daño origen: ',
                
            )
         ));
         
         $this->add(array(
             'name' => 'imp_piezas_d',
              'options' => array(
                 'label' => 'Daño destino: ',
               
             ),
             'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Daño destino : ',
                
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
 }