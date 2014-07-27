<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\ModuleManager;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Shared\CustomListener\TemplateMapListener;

// ADMIN
use Admin\Model\Material;
use Admin\Model\MaterialTable;
use Admin\Model\Bodega;
use Admin\Model\BodegaTable;
use Admin\Model\Usuario;
use Admin\Model\UsuarioTable;
use Admin\Model\Cliente;
use Admin\Model\ClienteTable;
use Admin\Model\Nave;
use Admin\Model\NaveTable;
use Admin\Model\Lote;
use Admin\Model\LoteTable;
use Admin\Model\Contenedor;
use Admin\Model\ContenedorTable;
use Admin\Model\Detalledano;
use Admin\Model\DetalledanoTable;


// Inspecciones
use Admin\Model\Inspeccioncontenedor;
use Admin\Model\InspeccioncontenedorTable;
use Admin\Model\Inspeccionlote;
use Admin\Model\InspeccionloteTable;
use Admin\Model\Imagencontenedor;
use Admin\Model\ImagencontenedorTable;
use Admin\Model\Imagenlote;
use Admin\Model\ImagenloteTable;

//Reportes
use Admin\Model\Consolidacion;
use Admin\Model\ConsolidacionTable;
use Admin\Model\Desconsolidacion;
use Admin\Model\DesconsolidacionTable;
use Admin\Model\Damage;
use Admin\Model\DamageTable;
use Admin\Model\Diferencias;
use Admin\Model\DiferenciasTable;

//Graficos
use Admin\Model\Graficos;
use Admin\Model\GraficosTable;




class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
     
        
         //Iniciamos la lista de control de acceso
        $this->initAcl($e);
         
        //Comprobamos la lista de control de acceso
        $e->getApplication()->getEventManager()->attach('route', array($this, 'checkAcl'));
          
        
    }
      public function initAcl(MvcEvent $e){
        //Creamos el objeto ACL
        $acl = new \Zend\Permissions\Acl\Acl();
         
        //Incluimos la lista de roles y permisos, nos devuelve un array
        $roles= require_once 'config/autoload/acl.roles.php';

         
        foreach($roles as $role => $resources){
           
            //Indicamos que el rol será genérico
            $role = new \Zend\Permissions\Acl\Role\GenericRole($role);
             
            //Añadimos el rol al ACL
            $acl->addRole($role);
            
            //Recorremos los recursos o rutas permitidas
            foreach($resources["allow"] as $resource){
             
                //Si el recurso no existe lo añadimos
                 if(!$acl->hasResource($resource)){
                    $acl->addResource(new \Zend\Permissions\Acl\Resource\GenericResource($resource));
                 }
                  
                 //Permitimos a ese rol ese recurso
                 $acl->allow($role, $resource);
            }
             
            foreach ($resources["deny"] as $resource) {
                  
                 //Si el recurso no existe lo añadimos
                 if(!$acl->hasResource($resource)){
                    $acl->addResource(new \Zend\Permissions\Acl\Resource\GenericResource($resource));
                 }
                  
                 //Denegamos a ese rol ese recurso
                 $acl->deny($role, $resource);
            }
  
        }
         
        //Establecemos la lista de control de acceso
        $e->getViewModel()->acl=$acl;
    }

    public function checkAcl(MvcEvent $e){
        //guardamos el nombre de la ruta o recurso a permitir o denegar
        $route=$e->getRouteMatch()->getMatchedRouteName();
         
        //Instanciamos el servicio de autenticacion
        $auth=new \Zend\Authentication\AuthenticationService();
        $identi=$auth->getStorage()->read();
         
        // Establecemos nuestro rol
        // $userRole = 'admin';
         
        // Si el usuario esta identificado le asignaremos el rol admin y si no el rol visitante.
        if($identi!=false && $identi!=null){
           $userRole=$identi->tipo;
        }else{
           $userRole="visitante";
        }
        /*
        Esto se puede mejorar fácilmente, si tenemos un campo rol en la BD cuando el usuario
        se identifique en la sesión se guardarán todos los datos del mismo, de modo que
        $userRole=$identi->role;
        */
         
        //Comprobamos si no está permitido para ese rol esa ruta
        if(!$e->getViewModel()->acl->isAllowed($userRole, $route)) {
         
        //Devolvemos un error 404
            $response = $e->getResponse();
            
            $response->getHeaders()->addHeaderLine('Location', $e->getRequest()->getBaseUrl() . '/admin/login');
            
            $response->setStatusCode(302);
        }
       }  

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    'Admin' => __DIR__ . '/src/' . 'Admin',
                    'Shared' => __DIR__ . '/src/' . 'Shared',
                ),
            ),
        );
    }
   
    
    

    
   
    public function getServiceConfig()
     {
         return array(
             'factories' => array(
                
                 // Material
                 'Admin\Model\MaterialTable' =>  function($sm) {
                     $tableGateway = $sm->get('MaterialTableGateway');
                     $table = new MaterialTable($tableGateway);
                     return $table;
                 },
                         
                 'MaterialTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Material());
                     return new TableGateway('material', $dbAdapter, null, $resultSetPrototype);
                 },
                 // Usuario
                 'Admin\Model\UsuarioTable' =>  function($sm) {
                     $tableGateway = $sm->get('UsuarioTableGateway');
                     $table = new UsuarioTable($tableGateway);
                     return $table;
                 },
                         
                 'UsuarioTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Usuario());
                     return new TableGateway('usuario', $dbAdapter, null, $resultSetPrototype);
                 },
                 // Cliente
                 'Admin\Model\ClienteTable' =>  function($sm) {
                     $tableGateway = $sm->get('ClienteTableGateway');
                     $table = new ClienteTable($tableGateway);
                     return $table;
                 },
                         
                 'ClienteTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Cliente());
                     return new TableGateway('cliente', $dbAdapter, null, $resultSetPrototype);
                 },
                 // Nave
                 'Admin\Model\NaveTable' =>  function($sm) {
                     $tableGateway = $sm->get('NaveTableGateway');
                     $table = new NaveTable($tableGateway);
                     return $table;
                 },
                         
                 'NaveTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Nave());
                     return new TableGateway('nave', $dbAdapter, null, $resultSetPrototype);
                 },
                 // Lote
                 'Admin\Model\LoteTable' =>  function($sm) {
                     $tableGateway = $sm->get('LoteTableGateway');
                     $table = new LoteTable($tableGateway);
                     return $table;
                 },
                         
                 'LoteTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Lote());
                     return new TableGateway('lote', $dbAdapter, null, $resultSetPrototype);
                 },
                'Admin\Model\ContenedorTable' =>  function($sm) {
                     $tableGateway = $sm->get('ContenedorTableGateway');
                     $table = new ContenedorTable($tableGateway);
                     return $table;
                 },
                         
                 'ContenedorTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Contenedor());
                     return new TableGateway('contenedor', $dbAdapter, null, $resultSetPrototype);
                 },
                 'Admin\Model\DetalledanoTable' =>  function($sm) {
                     $tableGateway = $sm->get('DetalledanoTableGateway');
                     $table = new DetalledanoTable($tableGateway);
                     return $table;
                 },
                         
                 'DetalledanoTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Detalledano());
                     return new TableGateway('detalle_dano', $dbAdapter, null, $resultSetPrototype);
                 },
                 'Admin\Model\InspeccionloteTable' =>  function($sm) {
                     $tableGateway = $sm->get('InspeccionloteTableGateway');
                     $table = new InspeccionloteTable($tableGateway);
                     return $table;
                 },
                         
                 'InspeccionloteTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Inspeccionlote());
                     return new TableGateway('inspeccion_lote', $dbAdapter, null, $resultSetPrototype);
                 },
                 'Admin\Model\InspeccioncontenedorTable' =>  function($sm) {
                     $tableGateway = $sm->get('InspeccioncontenedorTableGateway');
                     $table = new InspeccioncontenedorTable($tableGateway);
                     return $table;
                 },
                         
                 'InspeccioncontenedorTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Inspeccioncontenedor());
                     return new TableGateway('inspeccion_contenedor', $dbAdapter, null, $resultSetPrototype);
                 },
                 'Admin\Model\BodegaTable' =>  function($sm) {
                     $tableGateway = $sm->get('BodegaTableGateway');
                     $table = new BodegaTable($tableGateway);
                     return $table;
                 },
                         
                 'BodegaTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Bodega());
                     return new TableGateway('bodega', $dbAdapter, null, $resultSetPrototype);
                 },
                 'Admin\Model\ConsolidacionTable' =>  function($sm) {
                     $tableGateway = $sm->get('ConsolidacionTableGateway');
                     $table = new ConsolidacionTable($tableGateway);
                     return $table;
                 },
                         
                 'ConsolidacionTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Consolidacion());
                     return new TableGateway('consolidacion', $dbAdapter, null, $resultSetPrototype);
                 },
                 'Admin\Model\DesconsolidacionTable' =>  function($sm) {
                     $tableGateway = $sm->get('DesconsolidacionTableGateway');
                     $table = new DesconsolidacionTable($tableGateway);
                     return $table;
                 },
                         
                 'DesconsolidacionTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Desconsolidacion());
                     return new TableGateway('desconsolidacion', $dbAdapter, null, $resultSetPrototype);
                 },        
                 'Admin\Model\DamageTable' =>  function($sm) {
                     $tableGateway = $sm->get('DamageTableGateway');
                     $table = new DamageTable($tableGateway);
                     return $table;
                 },
                         
                 'DamageTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Damage());
                     return new TableGateway('damage', $dbAdapter, null, $resultSetPrototype);
                 },        
                 'Admin\Model\DiferenciasTable' =>  function($sm) {
                     $tableGateway = $sm->get('DesconsolidacionTableGateway');
                     $table = new DiferenciasTable($tableGateway);
                     return $table;
                 },
                         
                 'DiferenciasTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new DiferenciasTable());
                     return new TableGateway('diferencias', $dbAdapter, null, $resultSetPrototype);
                 },
                 // Imagen contenedor
                 'Admin\Model\ImagencontenedorTable' =>  function($sm) {
                     $tableGateway = $sm->get('ImagencontenedorTableGateway');
                     $table = new ImagencontenedorTable($tableGateway);
                     return $table;
                 },
                         
                 'ImagencontenedorTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Imagencontenedor());
                     return new TableGateway('imagen_contenedor', $dbAdapter, null, $resultSetPrototype);
                 },       
                 // Imagen lote
                 'Admin\Model\ImagenloteTable' =>  function($sm) {
                     $tableGateway = $sm->get('ImagenloteTableGateway');
                     $table = new ImagenloteTable($tableGateway);
                     return $table;
                 },
                         
                 'ImagenloteTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Imagenlote());
                     return new TableGateway('imagen_lote', $dbAdapter, null, $resultSetPrototype);
                 }, 
                  // Graficos
                 'Admin\Model\GraficosTable' =>  function($sm) {
                     $tableGateway = $sm->get('GraficosTableGateway');
                     $table = new GraficosTable($tableGateway);
                     return $table;
                 },
                         
                 'GraficosTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Imagenlote());
                     return new TableGateway('lote', $dbAdapter, null, $resultSetPrototype);
                 },        

                       
             ),
         );
                 
          
     }
    
    
    
}
