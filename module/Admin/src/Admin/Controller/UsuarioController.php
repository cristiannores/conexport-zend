<?php
/*


*/
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Model\Usuario; 
use Admin\Form\UsuarioForm; 
use Zend\Form\Element;
use Zend\Validator;
use Zend\Form;
use Zend\Crypt\Password\Bcrypt;

class UsuarioController extends AbstractActionController
{
    protected $usuarioTable;
    
    public function indexAction()
    {
        
        
      $paginator = $this->getUsuarioTable()->fetchAll(true);
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        $paginator->setItemCountPerPage(10);
        
        return new ViewModel(array(
         'paginator' => $paginator,
         'template' => $this->layout('layout/layout2'),   
     ));
    }
    public function agregarAction()
    {
         $tableGateway = $this->getServiceLocator()->get('admin-model-usuariotable');
         $form = new UsuarioForm($tableGateway);
         $form->get('submit')->setValue('Agregar');
         
         $request = $this->getRequest();
         if ($request->isPost()) {
             
             $usuario = new Usuario();
             $form->setInputFilter($usuario->getInputFilter($this->getServiceLocator()));
             $form->setData($request->getPost());
             // VALIDANDO EL RUT. 
             if($this->validaRut($form->get('rut')->getValue()) == false){
                 
                 $form->setMessages(array(
                    'rut' => array(
                        'messages' => 'Rut Invalido'
                    )
                ));
              
             }else{
                 $form->get('rut')->setValue($this->validaRut($form->get('rut')->getValue()));
             }
             //
             // VALIDANDO SUPERVISOR
             if ($form->get('supervisor_id')->getValue()!= ''){
                $supervisor = $this->getUsuarioTable()->getUsuario($form->get('supervisor_id')->getValue());
             }
             
             if ($form->isValid()) {
                 
                 
                                 
                 $usuario->exchangeArray($form->getData());
                 $usuario->supervisor_rut = $supervisor->rut;
                 // Encriptando la contraseña.
                 $bcrypt = new Bcrypt(array(
                                'salt' => 'algoritmo_cifrado_conexport_2014_cnores',
                                'cost' => 10));
                 $usuario->password = $bcrypt->create($usuario->password);
                 
                 // Password abcd1234
                 $this->getUsuarioTable()->saveUsuario($usuario);
                
                 // Redirect to list of albums
                 return $this->redirect()->toRoute('admin-usuario');
                 
             }
         }
         $title = "Usuario";
         $subtitle = "Agregar Usuario";
         
         /*
         
        $pubKey="6LcT2fYSAAAAAOpss5RXYgzyJJCTr3rkBLveJpz9";
        $privKey="6LcT2fYSAAAAAFAidOSJXW7qRG7lFFGSGpFMvnCU";
         
        //Instanciamos el servicio ReCaptcha le pasamos las claves y las opciones.
        $recaptcha=new \ZendService\ReCaptcha\ReCaptcha($pubKey,$privKey,null, array("theme"=>"white","lang"=>"es"));
         
        //Si se ha enviado el captcha
       if(isset($_POST["recaptcha_challenge_field"])){     
            $result = $recaptcha->verify($_POST['recaptcha_challenge_field'],$_POST['recaptcha_response_field']);
            
            //Comprueba la validez del captcha
            if(!$result->isValid()) {
               $title .=" - Captcha Incorrecto";
            }else{
               $title .=" - Captcha Correcto";
            }
       }
            */
         return array(
             'form' => $form,
             'template' => $this->layout('layout/layout2'),
             'title' => $title,
             'subtitle' => $subtitle,
             //"recaptcha"=>$recaptcha,

             
             );
      
    }
    
    public function editarAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
         if (!$id) {
             return $this->redirect()->toRoute('admin-usuario', array(
                 'action' => 'agregar'
             ));
         }

         // Get the Album with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $usuario = $this->getUsuarioTable()->getUsuario($id);
             
             
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('admin-usuario', array(
                 'action' => 'index'
             ));
         }

         $tableGateway = $this->getServiceLocator()->get('admin-model-usuariotable');
         $form = new UsuarioForm($tableGateway);
         $form->bind($usuario);
         
         $form->get('submit')->setAttribute('value', 'Editar');
         
         $request = $this->getRequest();
         if ($request->isPost()) {
             
             $form->setInputFilter($usuario->getInputFilter($this->getServiceLocator()));
             
             $form->setData($request->getPost());
             
             
             if ($form->isValid()) {
                 
                 // Encriptando la contraseña.
                 $bcrypt = new Bcrypt(array(
                                'salt' => 'algoritmo_cifrado_conexport_2014_cnores',
                                'cost' => 10));
                 $usuario->password = $bcrypt->create($usuario->password);
                

                $this->getUsuarioTable()->saveUsuario($usuario);
                
                 // Redirect to list of albums
                 return $this->redirect()->toRoute('admin-usuario');
             }
         }
         
        $pubKey="6LcT2fYSAAAAAOpss5RXYgzyJJCTr3rkBLveJpz9";
        $privKey="6LcT2fYSAAAAAFAidOSJXW7qRG7lFFGSGpFMvnCU";
         
        //Instanciamos el servicio ReCaptcha le pasamos las claves y las opciones.
        $recaptcha=new \ZendService\ReCaptcha\ReCaptcha($pubKey,$privKey,null, array("theme"=>"white","lang"=>"es"));
         
        //Si se ha enviado el captcha
       if(isset($_POST["recaptcha_challenge_field"])){     
            $result = $recaptcha->verify($_POST['recaptcha_challenge_field'],$_POST['recaptcha_response_field']);
 
            //Comprueba la validez del captcha
            if(!$result->isValid()) {
               $title .=" - Captcha Incorrecto";
            }else{
               $title .=" - Captcha Correcto";
            }
        }   

         return array(
             'id' => $id,
             'form' => $form,
             'template' => $this->layout('layout/layout2'),
             "recaptcha"=>$recaptcha,
         );
      
    }
    
    public function borrarAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('admin-usuario');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getUsuarioTable()->deleteUsuario($id);
             }

             // Redirect to list of albums
             return $this->redirect()->toRoute('admin-usuario');
         }

         return array(
             'id'    => $id,
             'usuario' => $this->getUsuarioTable()->getUsuario($id),
             'template' => $this->layout('layout/layout2'),
         );
      
    }
     public function getUsuarioTable()
     {
         if (!$this->usuarioTable) {
             $sm = $this->getServiceLocator();
             $this->usuarioTable = $sm->get('Admin\Model\UsuarioTable');
         }
         return $this->usuarioTable;
     }
     
        public function getAdapter()
   {
      if (!$this->adapter) {
         $sm = $this->getServiceLocator();
         $this->adapter = $sm->get('Zend\Db\Adapter\Adapter');
      }
      return $this->adapter;
   }
     
    function validaRut($r = false){
        if((!$r) or (is_array($r)))
            return false; /* Hace falta el rut */

        if(!$r = preg_replace('|[^0-9kK]|i', '', $r))
            return false; /* Era código basura */

        if(!((strlen($r) == 8) or (strlen($r) == 9)))
            return false; /* La cantidad de carácteres no es válida. */

        $v = strtoupper(substr($r, -1));
        if(!$r = substr($r, 0, -1))
            return false;

        if(!((int)$r > 0))
            return false; /* No es un valor numérico */

        $x = 2; $s = 0;
        for($i = (strlen($r) - 1); $i >= 0; $i--){
            if($x > 7)
                $x = 2;
            $s += ($r[$i] * $x);
            $x++;
        }
        $dv=11-($s % 11);
        if($dv == 10)
            $dv = 'K';
        if($dv == 11)
            $dv = '0';
        if($dv == $v)
            return number_format($r, 0, '', '.').'-'.$v; /* Formatea el RUT */
        return false;
    }
}
