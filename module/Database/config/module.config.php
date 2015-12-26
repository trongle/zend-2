<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Database;

return array(
    'router' =>array(
        'routes' => array(
            "databaseRoute" => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/database',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Database\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Database\Controller',
                                'controller'    => 'Index',
                                'action'        => 'index',
                            ),
                        ),
                    ),
                    'paginator' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/paginator/index05/page[/:page][/]',
                            'constraints' => array(
                                'page' => '[\d]*'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Database\Controller',
                                'controller'    => 'paginator',
                                'action'        => 'index05',
                            ),
                        ),
                    ),
                ),
            ),
            "manageUser" => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/database/user',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Database\Controller',
                        'controller'    => 'User',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'action' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action][/:id]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'         => '[\d]*' 
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Database\Controller',
                                'controller'    => 'User',
                                'action'        => 'index',
                            ),
                        ),
                    ),
                    'paginator' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/index/page[/:page][/]',
                            'constraints' => array(
                                'page' => '[\d]*'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Database\Controller',
                                'controller'    => 'User',
                                'action'        => 'index',
                            ),
                        ),
                    ),
                ),
            )
        )
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
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
            'Database\Controller\Index'       => Controller\IndexController::class,
            'Database\Controller\Adapter'     => "Database\Controller\AdapterController",
            'Database\Controller\Sql'         => "Database\Controller\SqlController",
            'Database\Controller\ExerciseSql' => "Database\Controller\ExerciseSqlController",
            'Database\Controller\TableGateway'=> "Database\Controller\TableGatewayController",
            'Database\Controller\Find'        => "Database\Controller\FindController",
            'Database\Controller\Paginator'   => "Database\Controller\PaginatorController",
            'Database\Controller\User'        => "Database\Controller\UserController"
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
          //  'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
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
    'view_helper_config' =>array(
        'flashmessenger' => array(
            'message_open_format'      =>   '<div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>',
            'message_close_string'     =>   '</div>',
            'meesage_separator_string' =>   ''
        )
    )
);
