<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */
namespace Admin\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;       
use Zend\Validator;
use Zend\I18n\Validator as I18nValidator;



class Bodega
{
    public $nro_bodega;
    public $descripcion;
    
    protected $inputFilter; 
    
    
    
    
    public function exchangeArray($data)
     {
         $this->nro_bodega = (!empty($data['nro_bodega'])) ? $data['nro_bodega'] : null;
         $this->descripcion = (!empty($data['descripcion'])) ? $data['descripcion'] : null;
         
         
     }
     
     public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
    
    
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }
     
     public function getInputFilter()
     {
         
         
         
         if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();
            
            
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'nro_bodega',
                'required' => true,
                'validators' => array(
                    array(
                        'name'    => 'Digits',
                        'options' => array(
                            'encoding' => 'UTF-8',
                           

                        ),
                    ),
                    
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'descripcion',
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
                            'min'      => 5,
                            'max'      => 15,
                            'messages' => array(
                                              
                       

                        ),

                        ),
                    ),
                    array('name'    => 'NotEmpty'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'title',
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
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
     }
     
     
    
    
}
