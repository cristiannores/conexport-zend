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
use Admin\Model\Contenedor; 
use Admin\Model\Inspeccioncontenedor; 
use Admin\Model\Lote; 
use Admin\Form\ContenedorForm; 
use Admin\Model\Cliente; 
use Admin\Model\Detalledano; 
use Admin\Model\Imagencontenedor;

class ContenedorController extends AbstractActionController
{
    protected $contenedorTable;
    protected $loteTable;
    protected $inspeccioncontenedorTable;
    protected $clienteTable; 
    protected $detalledanoTable;
    protected $imagencontenedorTable;
    
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
        $paginator = $this->getContenedorTable()->fetchAll(true,$iden->id_usuario);
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        $paginator->setItemCountPerPage(10);
        
        
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
                
                
        $material = $this->getServiceLocator()->get('admin-model-materialtable');
        $nave = $this->getServiceLocator()->get('admin-model-navetable');
        $cliente = $this->getServiceLocator()->get('admin-model-clientetable');
        $bodega = $this->getServiceLocator()->get('admin-model-bodegatable');
        
        if($this->identity()){
                            $iden = $this->identity();
                            
                    }
        $form = new ContenedorForm($material, $nave, $cliente, $bodega);
        $form->get('submit')->setValue('Agregar');

        
         $request = $this->getRequest();
         if ($request->isPost()) {
             //LLamando a los modelos
             $post = array_merge_recursive(
				$request->getPost()->toArray(),
				$request->getFiles()->toArray()
			);
             $contenedor = new Contenedor();
             $lote = new Lote();
             $inspeccion = new Inspeccioncontenedor();
             $detalle = new Detalledano();
             $imagen_bd = new Imagencontenedor();
             
             $form->setInputFilter($contenedor->getInputFilter($this->_dir));
             $form->setData($post);
               
            // CONTENEDOR
             if ($form->isValid()) {
                 
                date_default_timezone_set ('America/Santiago');
                
                
                 $contenedor->exchangeArray($form->getData());
                 $this->getContenedorTable()->saveContenedor($contenedor);

                 $lote->exchangeArray($form->getData());
                 $cl = $this->getClienteTable()->getCliente($lote->id_cliente);
                 $lote->rut_cliente = $cl->rut_cliente;
                 if ($contenedor->id_cont == 0){
                    $cont = $this->getContenedorTable()->getIDContenedor();
                    $lote->id_cont = $cont->id_cont;  
                    
                 }
                 
                 
                 $inspeccion->exchangeArray($form->getData());
                 $detalle->exchangeArray($form->getData());
                 if ($contenedor->id_cont == 0){
                    $cont = $this->getContenedorTable()->getIDContenedor();
                    $inspeccion->id_cont = $cont->id_cont;
                    
                 }
                 
                 $inspeccion->fecha = date('Y-m-d');
                 $inspeccion->hora = date('h:i:s'); 
                 $inspeccion->id_usuario = $iden->id_usuario;    //OBTENER DE LA SESION
                 $inspeccion->rut = $iden->rut; // OBTENER DE LA SESION
                 
                 if($lote->pieza_danada > 0){
                     $lote->estado = 'Dañada';
                 }  else {
                     $lote->estado = 'Sin daños';
                 }
                   
                   if ($contenedor->id_cont == 0){
                     $this->getLoteTable()->saveLote($lote);  
                   }else{
                    $this->getLoteTable()->saveLoteIC($lote);  
                   }
                   $ultimolote = $this->getLoteTable()->getIDLote();
                   $detalle->id_lote = $ultimolote->id_lote;
                   if($inspeccion->tipo  == 'desconsolidacion'){
                       $this->getDetalledanoTable()->saveDetalledano($detalle);
                   }
                   if ($contenedor->id_cont == 0){
                     $this->getInspeccioncontenedorTable()->saveInspeccioncontenedor($inspeccion); 
                   }else{
                    $this->getInspeccioncontenedorTable()->saveInspeccioncontenedorIC($inspeccion); 
                   }
                   
                     // IMAGEN
                   $data = $form->getData();
                   // var_dump($data['image-file']);
                   // Form is valid, save the form!
                   
                  $this->_dir = $this->_dir . DIRECTORY_SEPARATOR . $inspeccion->tipo . DIRECTORY_SEPARATOR .$inspeccion->fecha . DIRECTORY_SEPARATOR .$lote->id_cont ;
                  if (!is_dir($this->_dir)) {
                      $this->mkdir_recursivo($this->_dir, 0777);
                    }
                   
                   $this->setFileNames($data, $this->_dir);
                   
                  foreach ($data['image-file'] as $key => $file) {
                        $imagenBD = $this->_dir . DIRECTORY_SEPARATOR .  $file['name'];
                        var_dump($imagenBD);
                        $imagen_bd->codigo = $imagenBD;
                        $imagen_bd->id_cont = $inspeccion->id_cont;
                        
                        $this->getImagencontenedorTable()->saveImagencontenedor($imagen_bd);
                        
                        
        	   }
                   // The data can be saved in the DataBase
                   // FIN IMAGEN
                   return $this->redirect()->toRoute('admin-contenedor');
                 
                  
             }
         }
         if($this->identity()){
                            $iden = $this->identity();
                            
                    }
         $title = "Contenedor";
         $subtitle = "Agregar Contenedor";
         return array(
             'form' => $form,
             'template' => $this->layout('layout/layout2'),
             'title' => $title,
             'subtitle' => $subtitle,
             'contenedor' => $this->getContenedorTable()->fetchAll(false,$iden->id_usuario),
             );
      
    }
    
    public function editarAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
         if (!$id) {
             return $this->redirect()->toRoute('admin-contenedor', array(
                 'action' => 'agregar'
             ));
         }

         try {
             
             $lote = $this->getLoteTable()->getLoteIC($id);
             $contenedor = $this->getContenedorTable()->getContenedorIC($id);
             $inspeccion = $this->getInspeccioncontenedorTable()->getInspeccioncontenedorIC($id);
             if($inspeccion->tipo == 'desconsolidacion'){
             $detalle = $this->getDetalledanoTable()->getDetalledano($lote->id_lote);}
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('admin-contenedor', array(
                 'action' => 'index'
             ));
         }
         
         $material = $this->getServiceLocator()->get('admin-model-materialtable');
         $nave = $this->getServiceLocator()->get('admin-model-navetable');
         $cliente = $this->getServiceLocator()->get('admin-model-clientetable');
         $bodega = $this->getServiceLocator()->get('admin-model-bodegatable');
        
        
         $form = new ContenedorForm($material, $nave, $cliente, $bodega);
        
        
         $form->bind($contenedor);
         $form->bind($lote);
         $form->bind($inspeccion);
         if($inspeccion->tipo == 'desconsolidacion'){
         $form->bind($detalle);}
    
         $form->get('submit')->setAttribute('value', 'Editar');
         $form->get('id_cont')->setAttribute('value',$contenedor->id_cont);
       
         
         $request = $this->getRequest();
         if ($request->isPost()) {
             
             $form->setInputFilter($contenedor->getInputFilter());
             
             $form->setData($request->getPost());
             
             if ($form->isValid()) {
                

                $this->getContenedorTable()->saveContenedor($contenedor);
                
                 // Redirect to list of albums
                 return $this->redirect()->toRoute('admin-contenedor');
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
             return $this->redirect()->toRoute('admin-contenedor');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $imagenes = $this->getImagencontenedorTable()->buscar($id);
                 $inspeccion = $this->getInspeccioncontenedorTable()->getInspeccioncontenedorIC($id);
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
                 
                 
                 
                 if($this->getInspeccioncontenedorTable()->deleteInspeccioncontenedor($id)){
                 $this->getLoteTable()->deleteLoteIC($id);
                 
                 $this->getImagencontenedorTable()->deleteImagencontenedor($id);
                 $this->getContenedorTable()->deleteContenedor($id);
                 }
             }

             // Redirect to list of albums
             return $this->redirect()->toRoute('admin-contenedor');
         }

         return array(
             'id'    => $id,
             'contenedor' => $this->getContenedorTable()->getContenedor($id),
             'template' => $this->layout('layout/layout2'),
         );
      
    }
     public function getContenedorTable()
     {
         if (!$this->contenedorTable) {
             $sm = $this->getServiceLocator();
             $this->contenedorTable = $sm->get('Admin\Model\ContenedorTable');
         }
         return $this->contenedorTable;
     }
     
      public function getLoteTable()
     {
         if (!$this->loteTable) {
             $sm = $this->getServiceLocator();
             $this->loteTable = $sm->get('Admin\Model\LoteTable');
         }
         return $this->loteTable;
     }
     
      public function getInspeccioncontenedorTable()
     {
         if (!$this->inspeccioncontenedorTable) {
             $sm = $this->getServiceLocator();
             $this->inspeccioncontenedorTable = $sm->get('Admin\Model\InspeccioncontenedorTable');
         }
         return $this->inspeccioncontenedorTable;
     }
     
      public function getClienteTable()
     {
         if (!$this->clienteTable) {
             $sm = $this->getServiceLocator();
             $this->clienteTable = $sm->get('Admin\Model\ClienteTable');
         }
         return $this->clienteTable;
     }
     
      public function getDetalledanoTable()
     {
         if (!$this->detalledanoTable) {
             $sm = $this->getServiceLocator();
             $this->detalledanoTable = $sm->get('Admin\Model\DetalledanoTable');
         }
         return $this->detalledanoTable;
     }
     
      public function getImagencontenedorTable()
     {
         if (!$this->imagencontenedorTable) {
             $sm = $this->getServiceLocator();
             $this->imagencontenedorTable = $sm->get('Admin\Model\ImagencontenedorTable');
         }
         return $this->imagencontenedorTable;
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
