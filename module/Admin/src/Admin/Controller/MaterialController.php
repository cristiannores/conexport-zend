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
use Admin\Model\Material; 
use Admin\Form\MaterialForm; 

class MaterialController extends AbstractActionController
{
    protected $materialTable;
    
    public function indexAction()
    {
      $paginator = $this->getMaterialTable()->fetchAll(true);
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        $paginator->setItemCountPerPage(10);
        
        return new ViewModel(array(
         'paginator' => $paginator,
         'template' => $this->layout('layout/layout2'),   
     ));
    }
    public function agregarAction()
    {
        $form = new MaterialForm();
        $form->get('submit')->setValue('Agregar');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $material = new Material();
             $form->setInputFilter($material->getInputFilter($this->getServiceLocator()));
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $material->exchangeArray($form->getData());
                 $this->getMaterialTable()->saveMaterial($material);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('admin-material');
             }
         }
         $title = "Material";
         $subtitle = "Agregar Material";
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
             return $this->redirect()->toRoute('admin-material', array(
                 'action' => 'agregar'
             ));
         }

         // Get the Album with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $material = $this->getMaterialTable()->getMaterial($id);
             
             
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('admin-material', array(
                 'action' => 'index'
             ));
         }

         $form  = new MaterialForm();
         $form->bind($material);
        
         $form->get('submit')->setAttribute('value', 'Editar');
         
         $request = $this->getRequest();
         if ($request->isPost()) {
             
             $form->setInputFilter($material->getInputFilter($this->getServiceLocator()));
             
             $form->setData($request->getPost());

             if ($form->isValid()) {
                

                $this->getMaterialTable()->saveMaterial($material);
                
                 // Redirect to list of albums
                 return $this->redirect()->toRoute('admin-material');
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
             return $this->redirect()->toRoute('admin-material');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getMaterialTable()->deleteMaterial($id);
             }

             // Redirect to list of albums
             return $this->redirect()->toRoute('admin-material');
         }

         return array(
             'id'    => $id,
             'material' => $this->getMaterialTable()->getMaterial($id),
             'template' => $this->layout('layout/layout2'),
         );
      
    }
     public function getMaterialTable()
     {
         if (!$this->materialTable) {
             $sm = $this->getServiceLocator();
             $this->materialTable = $sm->get('Admin\Model\MaterialTable');
         }
         return $this->materialTable;
     }
}
