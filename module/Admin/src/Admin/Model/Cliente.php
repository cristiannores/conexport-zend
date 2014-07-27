<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */
namespace Admin\Model;
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;
class Cliente
{
    public $id_cliente;
    public $organizacion;
    public $razon_social;
    public $rut_cliente;
    public $direccion;
    public $fono_cliente;
    protected $inputFilter; 
    
    public function exchangeArray($data)
     {
         $this->id_cliente = (!empty($data['id_cliente'])) ? $data['id_cliente'] : null;
         $this->organizacion = (!empty($data['organizacion'])) ? $data['organizacion'] : null;
         $this->razon_social  = (!empty($data['razon_social'])) ? $data['razon_social'] : null;
         $this->rut_cliente  = (!empty($data['rut_cliente'])) ? $data['rut_cliente'] : null;
         $this->direccion  = (!empty($data['direccion'])) ?  $data['direccion'] : null;
         $this->fono_cliente  = (!empty($data['fono_cliente'])) ? $data['fono_cliente'] : null;
           
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
                 'name'     => 'organizacion',
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
                             'max'      => 50,
                         ),
                     ),
                     array(
                         'name'    => 'Alpha',
                         'options' => array(
                             'allowWhiteSpace' => true,
                         ),
                         
                        
                     ),
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'razon_social',
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
                             'min'      => 6,
                             'max'      => 50,
                         ),
                     ),
                     array(
                         'name'    => 'Alnum',
                         'options' => array(
                             'allowWhiteSpace' => true,
                         ),
                        
                     )
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'rut_cliente',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     
                     array(
					'name'		=> 'Zend\Validator\Db\NoRecordExists',
					'options' => array(
						'table'   => 'cliente',
						'field'   => 'rut_cliente',
						'adapter' => $sm->get('Zend\Db\Adapter\Adapter'),
					),
				),
                     
                   
                     )
                 
               
                 
               
             ));
             $inputFilter->add(array(
                 'name'     => 'direccion',
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
                             'min'      => 8,
                             'max'      => 50,
                         ),
                     ),
                     array(
                         'name'    => 'Alnum',
                         'options' => array(
                             'allowWhiteSpace' => true,
                         ),
                        
                     )
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'fono_cliente',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'PhoneNumber',
                         'options' => array(
                             'country' => 'CL',
                             
                         ),
                         ),
                     ),
                     
               
             ));
             
             
             
             
             $inputFilter->add(array(
                 'name'     => 'supervisor_id',
                 'required' => false,
             ));
             
                 
             
             
             
             

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
    
    
}
