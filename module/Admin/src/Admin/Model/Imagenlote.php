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

class Imagenlote 
{
    public $id_img_l;
    public $id_lote;
    public $codigo;
    protected $inputFilter;  
    
    
    public function exchangeArray($data)
     {
         $this->id_img_l = (!empty($data['id_img_l'])) ? $data['id_img_l'] : null;
         $this->id_lote = (!empty($data['id_lote'])) ? $data['id_lote'] : null;
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
