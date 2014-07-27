<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */
namespace Admin\Model;

 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;


class Usuario
{
    
    
    public $id_usuario;
    public $nombre;
    public $apellido;
    public $rut;
    public $supervisor_id;
    public $supervisor_rut;
    public $correo;
    public $tipo;
    public $fono;
    public $password;
    protected $inputFilter; 
   
    
    
    
    public function exchangeArray($data)
     {
         $this->id_usuario = (!empty($data['id_usuario'])) ? $data['id_usuario'] : null;
         $this->nombre = (!empty($data['nombre'])) ? $data['nombre'] : null;
         $this->apellido  = (!empty($data['apellido'])) ? $data['apellido'] : null;
         $this->rut  = (!empty($data['rut'])) ? $data['rut'] : null;
         $this->supervisor_id  = (!empty($data['supervisor_id'])) ? $data['supervisor_id'] : null;
         $this->supervisor_rut  = (!empty($data['supervisor_rut'])) ? $data['supervisor_rut'] : null;
         $this->correo  = (!empty($data['correo'])) ? $data['correo'] : null;
         $this->tipo  = (!empty($data['tipo'])) ? $data['tipo'] : null;
         $this->fono  = (!empty($data['fono'])) ? $data['fono'] : null;
         $this->password  = (!empty($data['password'])) ? $data['password'] : null;
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
                             'min'      => 3,
                             'max'      => 30,
                         ),
                     ),
                     array(
                         'name'    => 'Alpha',
                         
                        
                     ),
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'apellido',
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
                             'min'      => 3,
                             'max'      => 30,
                         ),
                     ),
                     array(
                         'name'    => 'Alpha',
                         
                        
                     ),
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'rut',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                    
                     array(
					'name'		=> 'Zend\Validator\Db\NoRecordExists',
					'options' => array(
						'table'   => 'usuario',
						'field'   => 'rut',
						'adapter' => $sm->get('Zend\Db\Adapter\Adapter'),
                                                'messages' => array(
                                                \Zend\Validator\Db\NoRecordExists::ERROR_RECORD_FOUND => 'Este rut ya existe, ingrese otro'
                                            ),
					),
				),
                     
                   
                     )
               
                 
               
             ));
             $inputFilter->add(array(
                 'name'     => 'correo',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'EmailAddress',
                         ),
                     array(
					'name'		=> 'Zend\Validator\Db\NoRecordExists',
					'options' => array(
						'table'   => 'usuario',
						'field'   => 'correo',
						'adapter' => $sm->get('Zend\Db\Adapter\Adapter'),
                                                'messages' => array(
                                                    \Zend\Validator\Db\NoRecordExists::ERROR_RECORD_FOUND => 'Este correo ya existe, ingrese otro'
                                                ),
					),
				),
                     
                   
                     )
               
             ));
             
               

             $inputFilter->add(array(
                 'name'     => 'fono',
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
                 'name'     => 'password',
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
                             'max'      => 30,
                         ),
                         ),
                     ),
                     
               
             ));
             $inputFilter->add(array(
                 'name'     => 'password2',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'Identical',
                         'options' => array(
                             'token' => 'password',
                             
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
