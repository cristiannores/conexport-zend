<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */
namespace Admin\Model;


use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;
 
class Inspeccioncontenedor implements InputFilterAwareInterface
{
    public $id_ic;
    public $id_usuario;
    public $rut;
    public $fecha;
    public $hora;
    public $id_cont;
    public $turno;
    public $observaciones;
    public $tipo;
    
    protected $inputFilter;  
    
    
    public function exchangeArray($data)
     {
         $this->id_ic = (!empty($data['id_ic'])) ? $data['id_ic'] : null;
         $this->id_usuario = (!empty($data['id_usuario'])) ? $data['id_usuario'] : null;
         $this->rut = (!empty($data['rut'])) ? $data['rut'] : null;
         $this->fecha = (!empty($data['fecha'])) ? $data['fecha'] : null;
         $this->hora = (!empty($data['hora'])) ? $data['hora'] : null;
         $this->id_cont = (!empty($data['id_cont'])) ? $data['id_cont'] : null;
         $this->turno = (!empty($data['turno'])) ? $data['turno'] : null;
         $this->observaciones = (!empty($data['observaciones'])) ? $data['observaciones'] : null;
         $this->tipo = (!empty($data['tipo'])) ? $data['tipo'] : null;
         
         
         
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
                 'name'     => 'id_ic',
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
