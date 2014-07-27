<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */
namespace Admin\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class Graficos
{
     // Cantidad de inspecciones realizadas por inspector
    public $inspector;
    // Cantidad de inspecciones por tipo de inspeccion
    public $inspeccion;
    //Inspecciones por cliente
    public $cliente;
    //Inspecciones por bodega
    public $bodega;
    //Inspecciones por material
    public $material;
    //Inspecciones por nave
    public $nave;
    
    public $cantidad;
    
    protected $inputFilter; 
    
    public function exchangeArray($data)
     {
         $this->id_cliente = (!empty($data['id_cliente'])) ? $data['id_cliente'] : null;
         $this->organizacion = (!empty($data['organizacion'])) ? $data['organizacion'] : null;
         $this->razon_social  = (!empty($data['razon_social'])) ? $data['razon_social'] : null;
         $this->rut_cliente  = (!empty($data['rut_cliente'])) ? $data['rut_cliente'] : null;
         $this->direccion  = (!empty($data['direccion'])) ?  $data['direccion'] : null;
         $this->fono_cliente  = (!empty($data['fono_cliente'])) ? $data['fono_cliente'] : null;
           
     }
     
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }
     
     public function getInputFilter($sm)
     {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();
 

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
    
    
}
