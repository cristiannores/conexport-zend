<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */
namespace Admin\Model;

 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;


class Desconsolidacion
{
    public $id_cont;  
    public $cliente;   
    public $producto; 
    public $id_contenedor; 
    public $lote;
    public $imp_o_zcho;
    public $imp_o_taco;
    public $imp_d_zcho;
    public $imp_d_taco;
    public $imp_piezas_o;
    public $imp_piezas_d;
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
         $this->cliente = (!empty($data['cliente'])) ? $data['cliente'] : null;
         $this->producto = (!empty($data['producto'])) ? $data['producto'] : null;
         $this->id_contenedor  = (!empty($data['id_contenedor'])) ? $data['id_contenedor'] : null;
         $this->lote  = (!empty($data['lote'])) ? $data['lote'] : null;
         $this->id_contenedor  = (!empty($data['id_contenedor'])) ? $data['id_contenedor'] : null;
         $this->imp_o_zcho  = (!empty($data['imp_o_zcho'])) ? $data['imp_o_zcho'] : null;
         $this->imp_o_taco  = (!empty($data['imp_o_taco'])) ? $data['imp_o_taco'] : null;
         $this->imp_d_zcho  = (!empty($data['imp_d_zcho'])) ? $data['imp_d_zcho'] : null;
         $this->imp_d_taco = (!empty($data['imp_d_taco'])) ? $data['imp_d_taco'] : null;
         $this->imp_piezas_o = (!empty($data['imp_piezas_o'])) ? $data['imp_piezas_o'] : null;
         $this->imp_piezas_d  = (!empty($data['imp_piezas_d'])) ? $data['imp_piezas_d'] : null;
         $this->observaciones  = (!empty($data['observaciones'])) ? $data['observaciones'] : null;
         $this->imagenes  = (!empty($data['imagenes'])) ? $data['imagenes'] : null;
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
