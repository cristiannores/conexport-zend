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
           // Rutas Sitio.
            'sitio-inicio' => array (
                'type' => 'segment',
                'options' => array (
                    'route' => '/',
                    'defaults' => array (
                        'controller' => 'Sitio\Controller\Inicio',
                        'action' => 'index',
                    ),
                ),
            ),
            'sitio-acerca' => array (
                'type' => 'segment',
                'options' => array (
                    'route' => '/sitio/acerca[/:action][/]',
                    'defaults' => array (
                        'controller' => 'Sitio\Controller\Acerca',
                        'action' => 'index',
                    ),
                ),
            ),
            'sitio-servicios' => array (
                'type' => 'segment',
                'options' => array (
                    'route' => '/sitio/servicios[/:action][/]',
                    'defaults' => array (
                        'controller' => 'Sitio\Controller\Servicio',
                        'action' => 'index',
                    ),
                ),
            ),
            'sitio-contacto' => array (
                'type' => 'segment',
                'options' => array (
                    'route' => '/sitio/contacto[/:action][/]',
                    'defaults' => array (
                        'controller' => 'Sitio\Controller\Contacto',
                        'action' => 'index',
                    ),
                ),
            ),
              'sitio-ingreso' => array (
                'type' => 'segment',
                'options' => array (
                    'route' => '/sitio/ingreso[/:action][/]',
                    'defaults' => array (
                        'controller' => 'Sitio\Controller\Ingreso',
                        'action' => 'index',
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
            'Sitio\Controller\Inicio' => 'Sitio\Controller\InicioController',
            'Sitio\Controller\Acerca' => 'Sitio\Controller\AcercaController',
            'Sitio\Controller\Servicio' => 'Sitio\Controller\ServicioController',
            'Sitio\Controller\Contacto' => 'Sitio\Controller\ContactoController',
            'Sitio\Controller\Ingreso' => 'Sitio\Controller\IngresoController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'layout/layout',
        'exception_template'       => 'layout/layout',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
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
