<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Model\Cliente; 
use Admin\Form\ClienteForm; 

use Zend\Form\Element;
use Zend\Validator;
use Zend\Form;
use Zend\Crypt\Password\Bcrypt;
use Zend\Dom\Query;


class ClienteController extends AbstractActionController
{
    protected $clienteTable;
    
    public function indexAction()
    {
       $paginator = $this->getClienteTable()->fetchAll(true);
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        $paginator->setItemCountPerPage(10);
        
        return new ViewModel(array(
         'paginator' => $paginator,
         'template' => $this->layout('layout/layout2'),   
     ));
    }
    public function agregarAction()
    {
        $form = new ClienteForm();
         $form->get('submit')->setValue('Agregar');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $cliente = new Cliente();
             $form->setInputFilter($cliente->getInputFilter($this->getServiceLocator()));
             $form->setData($request->getPost());
            if($this->validaRut($form->get('rut_cliente')->getValue()) == false){
                 $form->setAttributes(array(
                     'class="form-control "'
                 ));
                     
                 $form->setMessages(array(
                    'rut_cliente' => array(
                        'messages' => 'Rut Invalido'
                    )
                ));
              
             }else{
                 $form->get('rut_cliente')->setValue($this->validaRut($form->get('rut_cliente')->getValue()));
             };
             if ($form->isValid()) {
                 $cliente->exchangeArray($form->getData());
                 
                 $this->getClienteTable()->saveCliente($cliente);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('admin-cliente');
             }
             }
         
         $title = "Cliente";
         $subtitle = "Agregar Cliente";
         return array(
             'form' => $form,
             'template' => $this->layout('layout/layout2'),
             'title' => $title,
             'subtitle' => $subtitle,
             );
      
    }
    
    public function editarAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
         if (!$id) {
             return $this->redirect()->toRoute('admin-cliente', array(
                 'action' => 'agregar'
             ));
         }

         // Get the Album with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $cliente = $this->getClienteTable()->getCliente($id);
             
             
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('admin-cliente', array(
                 'action' => 'index'
             ));
         }

         $form  = new ClienteForm();
         $form->bind($cliente);
        
         $form->get('submit')->setAttribute('value', 'Editar');
         
         $request = $this->getRequest();
         if ($request->isPost()) {
             
             $form->setInputFilter($cliente->getInputFilter());
             
             $form->setData($request->getPost());

             if ($form->isValid()) {
                

                $this->getClienteTable()->saveCliente($cliente);
                
                 // Redirect to list of albums
                 return $this->redirect()->toRoute('admin-cliente');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
             'template' => $this->layout('layout/layout2'),
         );
      
    }
    
    public function borrarAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('admin-cliente');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getClienteTable()->deleteCliente($id);
             }

             // Redirect to list of albums
             return $this->redirect()->toRoute('admin-cliente');
         }

         return array(
             'id'    => $id,
             'cliente' => $this->getClienteTable()->getCliente($id),
             'template' => $this->layout('layout/layout2'),
         );
      
    }
     public function getClienteTable()
     {
         if (!$this->clienteTable) {
             $sm = $this->getServiceLocator();
             $this->clienteTable = $sm->get('Admin\Model\ClienteTable');
         }
         return $this->clienteTable;
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
