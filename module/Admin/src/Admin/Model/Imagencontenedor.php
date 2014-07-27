<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */
namespace Admin\Model;


 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;
 use Zend\Validator;
 use Zend\I18n\Validator as I18nValidator;
 use Zend\I18n\Filter;

class Imagencontenedor 
{
    public $id_img_c;
    public $id_cont;
    public $codigo;
    protected $inputFilter;  
    
    
    public function exchangeArray($data)
     {
         $this->id_img_c = (!empty($data['id_img_c'])) ? $data['id_img_c'] : null;
         $this->id_cont = (!empty($data['id_cont'])) ? $data['id_cont'] : null;
         $this->codigo  = (!empty($data['codigo'])) ? $data['codigo'] : null;
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
