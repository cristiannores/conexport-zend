<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */
namespace Admin\Model;

 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;


class Damage
{
    public $id_lote;
    public $cliente;
    public $producto;   
    public $nave; 
    public $destino; 
    public $numero_entrega;
    public $codigo_sap;
    public $numero_lote;
    public $caracteristicas;
    public $piezas_danadas;
    public $piezas_paquete;
    public $estado;
    public $imagenes;
    public $fecha;  
    public $hora;  
    public $inspector;  
    public $turno;  
    public $bodega;  
    protected $inputFilter; 
    
    
    public function exchangeArray($data)
     {
        $this->id_lote = (!empty($data['id_lote'])) ? $data['id_lote'] : null;
         $this->cliente = (!empty($data['cliente'])) ? $data['cliente'] : null;
         $this->producto = (!empty($data['producto'])) ? $data['producto'] : null;
         $this->nave = (!empty($data['nave'])) ? $data['nave'] : null;
         $this->destino = (!empty($data['destino'])) ? $data['destino'] : null;
         $this->numero_entrega  = (!empty($data['numero_entrega'])) ? $data['numero_entrega'] : null;
         $this->codigo_sap  = (!empty($data['codigo_sap'])) ? $data['codigo_sap'] : null;
         $this->numero_lote  = (!empty($data['numero_lote'])) ? $data['numero_lote'] : null;
         $this->caracteristicas  = (!empty($data['caracteristicas'])) ? $data['caracteristicas'] : null;
         $this->piezas_danadas  = (!empty($data['piezas_danadas'])) ? $data['piezas_danadas'] : null;
         $this->piezas_paquete  = (!empty($data['piezas_paquete'])) ? $data['piezas_paquete'] : null;
         $this->estado = (!empty($data['estado'])) ? $data['estado'] : null;
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
