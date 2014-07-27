<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */
namespace Admin\Model;


use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;
 
class Nave 
{
    public $id_nave;
    public $nombre;
    public $codigo;
    protected $inputFilter;  
    
    
    public function exchangeArray($data)
     {
         $this->id_nave = (!empty($data['id_nave'])) ? $data['id_nave'] : null;
         $this->nombre = (!empty($data['nombre'])) ? $data['nombre'] : null;
         $this->codigo  = (!empty($data['codigo'])) ? $data['codigo'] : null;
     }
     
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }
     
     

     public function getInputFilter($sm)
     {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();

             $inputFilter->add(array(
                 'name'     => 'id_nave',
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
                             'min'      => 4,
                             'max'      => 100,
                         ),
                     ),
                     array(
                         'name' => 'Alpha'
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
                     array(
                         'name' => 'Alpha'
                     ),
                 ),
             ));

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
    
}
