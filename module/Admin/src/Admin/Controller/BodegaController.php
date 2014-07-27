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
use Admin\Model\Bodega; 
use Admin\Form\BodegaForm; 

//Incluir componentes de validación
use Zend\Validator;
use Zend\I18n\Validator as I18nValidator;

class BodegaController extends AbstractActionController
{
    protected $bodegaTable;
    
    public function indexAction()
    {
        $paginator = $this->getBodegaTable()->fetchAll(true);
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        $paginator->setItemCountPerPage(10);
        
        return new ViewModel(array(
         'paginator' => $paginator,
         'template' => $this->layout('layout/layout2'),   
     ));
    }
    public function agregarAction()
    {
         $form = new BodegaForm();
         $form->get('submit')->setValue('Agregar');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $bodega = new Bodega();
             $form->setInputFilter($bodega->getInputFilter());
             $form->setData($request->getPost());
             
             
             if ($form->isValid()) {
                 $bodega->exchangeArray($form->getData());
                 var_dump($bodega);
                 $this->getBodegaTable()->saveBodega($bodega);

                 // Redirect to list of albums
                 //return $this->redirect()->toRoute('admin-bodega');
             }else{
                 $err=$form->getMessages();
                 return array(
                    'form' => $form,
                    'template' => $this->layout('layout/layout2'),
                     "error"=>$err,

                    );
               
             }
         }
         
         return array(
             'form' => $form,
             'template' => $this->layout('layout/layout2'),
             
             );
      
    }
    
    public function editarAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
         if (!$id) {
             return $this->redirect()->toRoute('admin-bodega', array(
                 'action' => 'agregar'
             ));
         }

         // Get the Album with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $bodega = $this->getBodegaTable()->getBodega($id);
             
             
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('admin-bodega', array(
                 'action' => 'index'
             ));
         }

         $form  = new BodegaForm();
         $form->bind($bodega);
        
         $form->get('submit')->setAttribute('value', 'Editar');
         
         $request = $this->getRequest();
         if ($request->isPost()) {
             
             $form->setInputFilter($bodega->getInputFilter());
             
             $form->setData($request->getPost());

             if ($form->isValid()) {
                

                $this->getBodegaTable()->saveBodega($bodega);
                
                 // Redirect to list of albums
                 return $this->redirect()->toRoute('admin-bodega');
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
             return $this->redirect()->toRoute('admin-bodega');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getBodegaTable()->deleteBodega($id);
             }

             // Redirect to list of albums
             return $this->redirect()->toRoute('admin-bodega');
         }

         return array(
             'id'    => $id,
             'bodega' => $this->getBodegaTable()->getBodega($id),
             'template' => $this->layout('layout/layout2'),
         );
      
    }
     public function getBodegaTable()
     {
         if (!$this->bodegaTable) {
             $sm = $this->getServiceLocator();
             $this->bodegaTable = $sm->get('Admin\Model\BodegaTable');
         }
         return $this->bodegaTable;
     }
}
