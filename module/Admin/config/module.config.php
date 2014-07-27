<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
           // Rutas Admin.
            'admin-inicio' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/inicio[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Inicio',
                        'action'     => 'index',
                    ),
                ),
            ),
            'admin-login' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/login[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Login',
                        'action'     => 'login',
                    ),
                ),
            ),
            'admin-bodega' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/bodega[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Bodega',
                        'action'     => 'index',
                    ),
                ),
            ),
            'admin-cliente' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/cliente[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Cliente',
                        'action'     => 'index',
                    ),
                ),
            ),
             'admin-usuario' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/usuario[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Usuario',
                        'action'     => 'index',
                    ),
                ),
            ),
             'admin-administrador' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/administrador[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Administrador',
                        'action'     => 'index',
                    ),
                ),
            ),
             'admin-material' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/material[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Material',
                        'action'     => 'index',
                    ),
                ),
            ),
             'admin-nave' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/nave[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Nave',
                        'action'     => 'index',
                    ),
                ),
            ),
            'admin-lote' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/lote[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Lote',
                        'action'     => 'index',
                    ),
                ),
            ),
            'admin-contenedor' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/contenedor[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Contenedor',
                        'action'     => 'index',
                    ),
                ),
            ),
            'admin-reporte-consolidacion' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/reporte/consolidacion[/:action][/:id][/:reporte][/:fecha][/:turno][/:contenedor]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     =>  '[a-zA-Z0-9_-]+',
                        'reporte'     =>  '[a-zA-Z0-9_-]+',
                        'fecha'   => '[a-zA-Z0-9_-]+',
                        'turno'   => '[a-zA-Z0-9_-]+',
                        'contenedor' => '[a-zA-Z0-9_-]+',
                        
                        
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Consolidacion',
                        'action'     => 'index',
                    ),
                ),
            ),
            'admin-reporte-desconsolidacion' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/reporte/desconsolidacion[/:action][/:id][/:reporte][/:fecha][/:turno][/:contenedor]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     =>  '[a-zA-Z0-9_-]+',
                        'reporte'     =>  '[a-zA-Z0-9_-]+',
                        'fecha'   => '[a-zA-Z0-9_-]+',
                        'turno'   => '[a-zA-Z0-9_-]+',
                        'contenedor' => '[a-zA-Z0-9_-]+',
                        
                        
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Desconsolidacion',
                        'action'     => 'index',
                    ),
                ),
            ),
            'admin-reporte-detaildamage' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/reporte/detaildamage[/:action][/:id][/:reporte][/:fecha][/:turno][/:contenedor]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     =>  '[a-zA-Z0-9_-]+',
                        'reporte'     =>  '[a-zA-Z0-9_-]+',
                        'fecha'   => '[a-zA-Z0-9_-]+',
                        'turno'   => '[a-zA-Z0-9_-]+',
                        'contenedor' => '[a-zA-Z0-9_-]+',
                        
                        
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Detaildamage',
                        'action'     => 'index',
                    ),
                ),
            ),
            'admin-reporte-detaildiference' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/reporte/detaildiference[/:action][/:id][/:reporte][/:fecha][/:turno][/:contenedor]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     =>  '[a-zA-Z0-9_-]+',
                        'reporte'     =>  '[a-zA-Z0-9_-]+',
                        'fecha'   => '[a-zA-Z0-9_-]+',
                        'turno'   => '[a-zA-Z0-9_-]+',
                        'contenedor' => '[a-zA-Z0-9_-]+',
                        
                        
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Detaildiference',
                        'action'     => 'index',
                    ),
                ),
            ),
            'paginator' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/page[/:page]',
                    'constraints' => array(
                        'page'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'action'     => 'index',
                    ),
                ),
            ), 
            'admin-estadistica-global' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/estadistica/global[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Global',
                        'action'     => 'index',
                    ),
                ),
            ),
            
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Inicio' => 'Admin\Controller\InicioController',
            'Admin\Controller\Cliente' => 'Admin\Controller\ClienteController',
            'Admin\Controller\Usuario' => 'Admin\Controller\UsuarioController',
            'Admin\Controller\Administrador' => 'Admin\Controller\AdministradorController',
            'Admin\Controller\Material' => 'Admin\Controller\MaterialController',
            'Admin\Controller\Nave' => 'Admin\Controller\NaveController',
            'Admin\Controller\Consolidacion' => 'Admin\Controller\ConsolidacionController',
            'Admin\Controller\Desconsolidacion' => 'Admin\Controller\DesconsolidacionController',
            'Admin\Controller\Detaildamage' => 'Admin\Controller\DetaildamageController',
            'Admin\Controller\Detaildiference' => 'Admin\Controller\DetaildiferenceController',
            'Admin\Controller\Contenedor' => 'Admin\Controller\ContenedorController',
            'Admin\Controller\Lote' => 'Admin\Controller\LoteController',
            'Admin\Controller\Bodega' => 'Admin\Controller\BodegaController',
            'Admin\Controller\Login' => 'Admin\Controller\LoginController',
            'Admin\Controller\Global' => 'Admin\Controller\GlobalController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404'  ,
        'exception_template'       => 'error/index' ,
        'template_map' => array(
            'paginacion'           => __DIR__ . '/../view/partial/paginator.phtml',
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'pagina/error'            => __DIR__ . '/../view/pagina/error.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
