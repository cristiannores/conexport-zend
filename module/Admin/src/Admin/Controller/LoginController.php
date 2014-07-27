<?php
namespace Admin\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Validator;
use Zend\I18n\Validator as I18nValidator;
use Zend\Db\Adapter\Adapter;
use Zend\Crypt\Password\Bcrypt;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
 
//Componentes de autenticación
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use Zend\Session\Container;
 
//Incluir modelos
use Admin\Model\Usuario;
 
//Incluir formularios
use Admin\Form\LoginForm;
 
class LoginController extends AbstractActionController{
    private $dbAdapter;
    private $auth;
     
    public function __construct() {
        //Cargamos el servicio de autenticación en el constructor
        $this->auth = new AuthenticationService();
    }
     
    public function indexAction(){
    //Vamos a utilizar otros métodos
        return new ViewModel();
    }
     
     public function loginAction(){
     //
         $auth = $this->auth;
         
         // Lee la identidad que esta almacenada
         $identi=$auth->getStorage()->read();
         // si no hay identidad retorna 
         if($identi!=false && $identi!=null){
            return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/admin/inicio');
         }
         
        //DbAdapter
        $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
         
        //Creamos el formulario de login
        $form=new LoginForm("form");
        
        // Captcha 
        
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
        //Si nos llegan datos por post
        if($this->getRequest()->isPost()){
         
            /* Creamos la autenticación a la que le pasamos:
                1. La conexión a la base de datos
                2. La tabla de la base de datos
                3. El campo de la bd que hará de username
                4. El campo de la bd que hará de contraseña
            */
            $authAdapter = new AuthAdapter($this->dbAdapter,
                                           'usuario',
                                           'correo',
                                           'password'
                                           );
                                            
           /* 
            Podemos hacer lo mismo de esta manera:
            $authAdapter = new AuthAdapter($dbAdapter);
            $authAdapter
                ->setTableName('users')
                ->setIdentityColumn('username')
                ->setCredentialColumn('password');
           */
 
           /*

           En el caso de que la contraseña en la db este cifrada
           tenemos que utilizar el mismo algoritmo de cifrado
           */
            $bcrypt = new Bcrypt(array(
                                'salt' => 'algoritmo_cifrado_conexport_2014_cnores',
                                'cost' => 10));
            
            $securePass = $bcrypt->create($this->request->getPost("password"));
             
            //Establecemos como datos a autenticar los que nos llegan del formulario
            $authAdapter->setIdentity($this->getRequest()->getPost("email"))
                        //->setCredential($this->request->getPost("password"));
                        ->setCredential($securePass);
                
            
           //Le decimos al servicio de autenticación que el adaptador
           $auth->setAdapter($authAdapter);
            
           //Le decimos al servicio de autenticación que lleve a cabo la identificacion
           $result=$auth->authenticate();
          
           //Si el resultado del login es falso, es decir no son correctas las credenciales
           if($authAdapter->getResultRowObject()==false){
                 
               //Crea un mensaje flash y redirige
               $this->flashMessenger()->addMessage("Credenciales incorrectas, intentalo de nuevo");
               return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/admin/login');
           }else{
            
             // Le decimos al servicio que guarde en una sesión
             // el resultado del login cuando es correcto
             $auth->getStorage()->write($authAdapter->getResultRowObject());
              
             //Nos redirige a una pagina interior
             return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/admin/inicio');
           }
        }     
        
        
         
        
        return new ViewModel(
                array(
                    "form"=>$form,
                    "recaptcha"=>$recaptcha,
                    'template' => $this->layout('layout/login'),
                )
                );
    }
     
    
     
    public function cerrarAction(){
        //Cerramos la sesión borrando los datos de la sesión.
        $this->auth->clearIdentity();
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/admin/login');
    }
}
