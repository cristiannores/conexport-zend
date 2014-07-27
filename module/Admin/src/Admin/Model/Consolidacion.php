<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */
namespace Admin\Model;

 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;


class Consolidacion
{
    
    public $id_cont;   
    public $exportador; 
    public $producto; 
    public $nave;
    public $id_contenedor;
    public $destino;
    public $entrega;
    public $lote;
    public $danos;
    public $piezas_totales;
    public $observaciones;
    public $imagenes;
    public $fecha;  
    public $hora;  
    public $inspector;  
    public $turno;  
    public $bodega;  
    protected $inputFilter; 
    
    
    public function exchangeArray($data)
     {
         $this->id_cont = (!empty($data['id_cont'])) ? $data['id_cont'] : null;
         $this->exportador = (!empty($data['exportador'])) ? $data['exportador'] : null;
         $this->producto  = (!empty($data['producto'])) ? $data['producto'] : null;
         $this->nave  = (!empty($data['nave'])) ? $data['nave'] : null;
         $this->id_contenedor  = (!empty($data['id_contenedor'])) ? $data['id_contenedor'] : null;
         $this->destino  = (!empty($data['destino'])) ? $data['destino'] : null;
         $this->contenedor  = (!empty($data['contenedor'])) ? $data['contenedor'] : null;
         $this->turno  = (!empty($data['turno'])) ? $data['turno'] : null;
         $this->entrega = (!empty($data['entrega'])) ? $data['entrega'] : null;
         $this->lote = (!empty($data['lote'])) ? $data['lote'] : null;
         $this->danos  = (!empty($data['danos'])) ? $data['danos'] : null;
         $this->piezas_totales  = (!empty($data['piezas_totales'])) ? $data['piezas_totales'] : null;
         $this->observaciones  = (!empty($data['observaciones'])) ? $data['observaciones'] : null;
         $this->imagenes = (!empty($data['imagenes'])) ? $data['imagenes'] : null;
         $this->fecha  = (!empty($data['fecha'])) ? $data['fecha'] : null;
         $this->hora  = (!empty($data['hora'])) ? $data['hora'] : null;
         $this->inspector  = (!empty($data['inspector'])) ? $data['inspector'] : null;
         $this->turno = (!empty($data['turno'])) ? $data['turno'] : null;
         $this->bodega = (!empty($data['bodega'])) ? $data['bodega'] : null;
                  
     }
   
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }
     
     public function getInputFilter()
     {
        if (!$this->inputFilter) {
             $inputFilter = new InputFilter();

             

             $this->inputFilter = $inputFilter;
             
         }

         return $this->inputFilter;
     }
    
    
}
