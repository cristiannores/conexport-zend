<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */
namespace Admin\Model;


use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;
 
class Detalledano implements InputFilterAwareInterface
{
    public $id_detalle;
    public $id_lote;
    public $imp_o_zcho;
    public $imp_o_taco;
    public $imp_d_zcho;
    public $imp_d_taco;
    public $imp_piezas_o;
    public $imp_piezas_d;
    public $observaciones;
    
    protected $inputFilter;  
    
    
    public function exchangeArray($data)
     {
         $this->id_detalle = (!empty($data['id_detalle'])) ? $data['id_detalle'] : null;
         $this->id_lote = (!empty($data['id_lote'])) ? $data['id_lote'] : null;
         $this->imp_o_zcho = (!empty($data['imp_o_zcho'])) ? $data['imp_o_zcho'] : null;
         $this->imp_o_taco = (!empty($data['imp_o_taco'])) ? $data['imp_o_taco'] : null;
         $this->imp_d_zcho = (!empty($data['imp_d_zcho'])) ? $data['imp_d_zcho'] : null;
         $this->imp_d_taco = (!empty($data['imp_d_taco'])) ? $data['imp_d_taco'] : null;
         $this->imp_piezas_o = (!empty($data['imp_piezas_o'])) ? $data['imp_piezas_o'] : null;
         $this->imp_piezas_d = (!empty($data['imp_piezas_d'])) ? $data['imp_piezas_d'] : null;
         $this->observaciones = (!empty($data['observaciones'])) ? $data['observaciones'] : null;
         
     }
     
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }
     
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }

     public function getInputFilter()
     {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();

             $inputFilter->add(array(
                 'name'     => 'id_bodega',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'nombre',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'codigo',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
    
}
