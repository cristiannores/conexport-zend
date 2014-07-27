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

class Material 
{
    public $id_material;
    public $nombre;
    public $codigo;
    protected $inputFilter;  
    
    
    public function exchangeArray($data)
     {
         $this->id_material = (!empty($data['id_material'])) ? $data['id_material'] : null;
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
                 'name'     => 'id_material',
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
                             'min'      => 2,
                             'max'      => 30,
                         ),
                     ),
                     array(
                         'name'    => 'Alpha',
                         'options' => array(
                             'allowWhiteSpace' => true,
                         ),
                        
                     ),
                     array(
					'name'		=> 'Zend\Validator\Db\NoRecordExists',
					'options' => array(
						'table'   => 'material',
						'field'   => 'nombre',
						'adapter' => $sm->get('Zend\Db\Adapter\Adapter'),
                                                'messages' => array(
                                                    \Zend\Validator\Db\NoRecordExists::ERROR_RECORD_FOUND => 'Material ya existe, ingrese otro'
                                                ),
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
                             'max'      => 20,
                         ),
                        
                     ),
                     array(
                         'name'    => 'Alnum',
                         'options' => array(
                             'allowWhiteSpace' => true,
                         ),
                         
                        
                     ),
                 ),
             ));
             
             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
    
}
