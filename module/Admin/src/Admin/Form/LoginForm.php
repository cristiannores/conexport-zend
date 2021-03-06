<?php

namespace Admin\Form;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\Factory;

class LoginForm extends Form
{
    public function __construct($name = null)
     {
        parent::__construct($name);
         
      // $this->setInputFilter(new \Modulo\Form\AddUsuarioValidator());

       $this->setAttributes(array(
            //'action' => $this->url.'/modulo/recibirformulario',
            'action'=>"",
            'method' => 'post'
        ));
    
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type' => 'email',
                'class' => 'input form-control',
                'required'=>'required',
                'placeholder' => 'Correo electronico'
                
        )
        ));
         
         $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type' => 'password',
                'class' => 'input form-control',
                'required'=>'required',
                'placeholder' => 'Contraseña'
            )
        ));
          
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(    
               'type' => 'submit',
                'value' => 'Entrar',
                'title' => 'Entrar',
                'class' => 'btn btn-lg btn-success btn-block'
            ),
        ));
  
     }
}
 
?>
