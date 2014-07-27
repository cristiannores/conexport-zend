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
use Admin\Model\Lote; 
use Admin\Form\LoteForm; 
use Admin\Model\Contenedor;
use Admin\Model\Inspeccionlote;
use Admin\Model\Cliente;
use Admin\Model\Imagenlote;

class LoteController extends AbstractActionController
{
    protected $loteTable;
    protected $inspeccionloteTable;
    protected $clienteTable; 
    protected $imagenloteTable;
    
    protected $_dir = null; // La direccion donde estan las 
    
    public function init()
    {
        
        $config = $this->getServiceLocator()->get('Config');
        $fileManagerDir = $config['file_manager']['dir'];
        if ($user = $this->identity()){
            
        }else{
            return $this->redirect()->toRoute('admin-inicio');
        }
        $this->_dir = realpath($fileManagerDir);
        
    }
    
    
    public function indexAction()
    {
        $this->init();
        if($this->identity()){
                            $iden = $this->identity();
                            
                    }
        $paginator = $this->getLoteTable()->fetchAll(true,$iden->id_usuario);
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        $paginator->setItemCountPerPage(10);
        
        //rmdir($dirname);
        return new ViewModel(array(
         'paginator' => $paginator,
         'template' => $this->layout('layout/layout2'),   
            ));
    }
    public function agregarAction()
    {
        
        $this->init();
		if (!is_dir($this->_dir)) {
			mkdir($this->_dir, 0777);
		}
          // Incluir material, naves, clientes.
        $material = $this->getServiceLocator()->get('admin-model-materialtable');
        $nave = $this->getServiceLocator()->get('admin-model-navetable');
        $bodega = $this->getServiceLocator()->get('admin-model-bodegatable');
        $cliente = $this->getServiceLocator()->get('admin-model-clientetable');
        
        $form = new LoteForm($material, $nave, $bodega, $cliente);
        $form->get('submit')->setValue('Agregar');
        if($this->identity()){
                            $iden = $this->identity();
                            
                    }

         $request = $this->getRequest();
         if ($request->isPost()) {
             
             
             $post = array_merge_recursive(
				$request->getPost()->toArray(),
				$request->getFiles()->toArray()
			);
             $lote = new Lote();
             $inspeccion = new Inspeccionlote();
             $imagen_bd = new Imagenlote();  
             
             $form->setInputFilter($lote->getInputFilter($this->_dir));
             $form->setData($post);
             
             if ($form->isValid()) {
                    
                            
                    date_default_timezone_set ('America/Santiago');
                 
                    $lote->exchangeArray($form->getData());
                    $inspeccion->exchangeArray($form->getData());
                    
                    $cl = $this->getClienteTable()->getCliente($lote->id_cliente);
                    $lote->rut_cliente = $cl->rut_cliente;
                    $this->getLoteTable()->saveLote($lote);
                    if ($lote->id_lote == 0){
                    $id_lote = $this->getLoteTable()->getIDLote();
                    $inspeccion->id_lote = $id_lote->id_lote;
                    }
                    
                    
                        
                        
                    $inspeccion->fecha = date('Y-m-d');
                    $inspeccion->hora = date('h:i:s'); 
                    $inspeccion->id_usuario = $iden->id_usuario;    //OBTENER DE LA SESION
                    $inspeccion->rut = $iden->rut; // OBTENER DE LA SESION
                    
                    if ($lote->id_lote == 0){
                     $this->getInspeccionloteTable()->saveInspeccionlote($inspeccion);
                   }else{
                    $this->getInspeccionloteTable()->saveInspeccionloteIL($inspeccion);
                   }
                    
                    
                   // IMAGEN
                   $data = $form->getData();
                   // var_dump($data);
                   // Form is valid, save the form!
                  
                  $this->_dir = $this->_dir . DIRECTORY_SEPARATOR . $inspeccion->tipo . DIRECTORY_SEPARATOR .$inspeccion->fecha . DIRECTORY_SEPARATOR .$inspeccion->id_lote ;
                  if (!is_dir($this->_dir)) {
                      $this->mkdir_recursivo($this->_dir, 0777);
                    }
                   
                   $this->setFileNames($data, $this->_dir);
                   
                  foreach ($data['image-file'] as $key => $file) {
                        $imagenBD = $this->_dir . DIRECTORY_SEPARATOR .  $file['name'];
                       // var_dump($imagenBD);
                        $imagen_bd->codigo = $imagenBD;
                        $imagen_bd->id_lote = $inspeccion->id_lote;
                        
                        $this->getImagenloteTable()->saveImagenlote($imagen_bd);
                        
                        
        	   }
                   // The data can be saved in the DataBase
                   // FIN IMAGEN

                   

                   return $this->redirect()->toRoute('admin-lote');
                     
                     
             }
         }
         if($this->identity()){
                            $iden = $this->identity();
                            
                    }
         $title = "Lote";
         $subtitle = "Agregar Lote";
         return array(
             'form' => $form,
             'template' => $this->layout('layout/layout2'),
             'title' => $title,
             'subtitle' => $subtitle,
             'lote' => $this->getLoteTable()->fetchAll(false,$iden->id_usuario),
             );
      
    }
    
    public function editarAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
         if (!$id) {
             return $this->redirect()->toRoute('admin-lote', array(
                 'action' => 'agregar'
             ));
         }

         // Get the Album with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $lote = $this->getLoteTable()->getLoteIL($id);
             $inspeccion = $this->getInspeccionloteTable()->getInspeccionloteIL($id);
             
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('admin-lote', array(
                 'action' => 'index'
             ));
         }

         $material = $this->getServiceLocator()->get('admin-model-materialtable');
         $nave = $this->getServiceLocator()->get('admin-model-navetable');
         $bodega = $this->getServiceLocator()->get('admin-model-bodegatable');
         $cliente = $this->getServiceLocator()->get('admin-model-clientetable');
        
         $form = new LoteForm($material, $nave, $bodega, $cliente);
         
         $form->bind($lote);
         $form->bind($inspeccion);
         $form->get('submit')->setAttribute('value', 'Editar');
         $form->get('id_lote')->setAttribute('value',$lote->id_lote);
         $request = $this->getRequest();
        
         
         if ($request->isPost()) {
             
             $form->setInputFilter($lote->getInputFilter());
             
             $form->setData($request->getPost());

             if ($form->isValid()) {
                
                    /*
                $this->getLoteTable()->saveLote($lote);
                $this->getInspeccionloteTable()->saveInspeccionlote($inspeccion);
                 // Redirect to list of albums
                 return $this->redirect()->toRoute('admin-lote');*/
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
        $this->init();
        
        $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('admin-lote');
         }
         
         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');
             
             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $imagenes = $this->getImagenloteTable()->buscar($id);
                 $inspeccion = $this->getInspeccionloteTable()->getInspeccionloteIL($id);
                 foreach ($imagenes as $img):
                       $filename = $img->codigo;
                       unlink($filename);
                 endforeach;
                 $directorio = $this->_dir.DIRECTORY_SEPARATOR.$inspeccion->tipo.DIRECTORY_SEPARATOR.$inspeccion->fecha.DIRECTORY_SEPARATOR.$id;
                 if(rmdir($directorio)){
                     echo "Direcorio eliminado";
                 }else{
                     echo "directorio no se elimino";
                  }
                 if($this->getInspeccionloteTable()->deleteInspeccionlote($id)){
                      $this->getImagenloteTable()->deleteImagenlote($id);
                      $this->getLoteTable()->deleteLote($id);
                     
                 }
                
             }
            
             // Redirect to list of albums
            return $this->redirect()->toRoute('admin-lote');
         }

         return array(
             'id'    => $id,
             'lote' => $this->getLoteTable()->getLote($id),
             'template' => $this->layout('layout/layout2'),
         );
      
    }
     public function getLoteTable()
     {
         if (!$this->loteTable) {
             $sm = $this->getServiceLocator();
             $this->loteTable = $sm->get('Admin\Model\LoteTable');
         }
         return $this->loteTable;
     }
     
     
     
      public function getInspeccionloteTable()
     {
         if (!$this->inspeccionloteTable) {
             $sm = $this->getServiceLocator();
             $this->inspeccionloteTable = $sm->get('Admin\Model\InspeccionloteTable');
         }
         return $this->inspeccionloteTable;
     }
     
      public function getClienteTable()
     {
         if (!$this->clienteTable) {
             $sm = $this->getServiceLocator();
             $this->clienteTable = $sm->get('Admin\Model\ClienteTable');
         }
         return $this->clienteTable;
     }
     
     public function getImagenloteTable()
     {
         if (!$this->imagenloteTable) {
             $sm = $this->getServiceLocator();
             $this->imagenloteTable = $sm->get('Admin\Model\ImagenloteTable');
         }
         return $this->imagenloteTable;
     }
     
     /**
	 * Change the names of the uploaded files to their original names. Since we don't keep anything in the DB
	 *
	 * @param array $data array of arrays
	 * @return void
	 */	
       public function mkdir_recursivo($pathname, $mode){
               umask(0);
               is_dir(dirname($pathname)) || $this->mkdir_recursivo(dirname($pathname), $mode);
               return is_dir($pathname) || mkdir($pathname, $mode);
       }
       
	protected function setFileNames($data, $dir)
	{
		unset($data['submit']);
		foreach ($data['image-file'] as $key => $file) {
                        $imagen = $this->_dir . DIRECTORY_SEPARATOR . $file['name'];
			rename($file['tmp_name'], $imagen);
                        move_uploaded_file($imagen, $dir .DIRECTORY_SEPARATOR . $file['name']);
		}	
                
	}
}
