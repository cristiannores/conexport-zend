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
use Admin\Model\Nave; 
use Admin\Form\NaveForm; 

class NaveController extends AbstractActionController
{
    protected $naveTable;
    
    public function indexAction()
    {
      $paginator = $this->getNaveTable()->fetchAll(true);
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        $paginator->setItemCountPerPage(10);
        
        return new ViewModel(array(
         'paginator' => $paginator,
         'template' => $this->layout('layout/layout2'),   
     ));
    }
    public function agregarAction()
    {
        $form = new NaveForm();
         $form->get('submit')->setValue('Agregar');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $nave = new Nave();
             $form->setInputFilter($nave->getInputFilter($this->getServiceLocator()));
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $nave->exchangeArray($form->getData());
                 $this->getNaveTable()->saveNave($nave);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('admin-nave');
             }
         }
         $title = "Nave";
         $subtitle = "Agregar Nave";
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
             return $this->redirect()->toRoute('admin-nave', array(
                 'action' => 'agregar'
             ));
         }

         // Get the Album with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $nave = $this->getNaveTable()->getNave($id);
             
             
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('admin-nave', array(
                 'action' => 'index'
             ));
         }

         $form  = new NaveForm();
         $form->bind($nave);
        
         $form->get('submit')->setAttribute('value', 'Editar');
         
         $request = $this->getRequest();
         if ($request->isPost()) {
             
             $form->setInputFilter($nave->getInputFilter($this->getServiceLocator()));
             
             $form->setData($request->getPost());

             if ($form->isValid()) {
                

                $this->getNaveTable()->saveNave($nave);
                
                 // Redirect to list of albums
                 return $this->redirect()->toRoute('admin-nave');
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
             return $this->redirect()->toRoute('admin-nave');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getNaveTable()->deleteNave($id);
             }

             // Redirect to list of albums
             return $this->redirect()->toRoute('admin-nave');
         }

         return array(
             'id'    => $id,
             'nave' => $this->getNaveTable()->getNave($id),
             'template' => $this->layout('layout/layout2'),
         );
      
    }
     public function getNaveTable()
     {
         if (!$this->naveTable) {
             $sm = $this->getServiceLocator();
             $this->naveTable = $sm->get('Admin\Model\NaveTable');
         }
         return $this->naveTable;
     }
}
