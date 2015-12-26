<?php

//=============Zend\Mvc\Router\Http\Hostname================
//skeleton.trongle.dev
$hostnameRoute = array(
        'type'    => 'hostname',
        'options' => array(
            'route'         => 'skeleton.trongle.dev',
            'defaults'      => array(
                '__NAMESPACE__' => 'Mvc\Controller',
                'controller'    => 'index',
                'action'        => 'index'
            )
    ),
      
);

//=============Zend\Mvc\Router\Http\Literal================
//skeleton.trongle.dev/contact
$literal = array(
        'type'    => 'literal',
        'options' => array(
            'route'         => '/login.html',
            'defaults'      => array(
                '__NAMESPACE__' => 'Mvc\Controller',
                'controller'    => 'Plugin',
                'action'        => 'login'
            )
    ),   

);

//=============Zend\Mvc\Router\Http\Scheme================
//skeleton.trongle.dev/contact
$scheme = array(
        'type'    => 'scheme',
        'options' => array(
            'route'    => '/login',
            'scheme'   => 'http',
            'defaults' => array(
                '__NAMESPACE__' => 'Mvc\Controller',
                'controller'    => 'Router',
                'action'        => 'login'
            )
        ),
         
);
//=============Zend\Mvc\Router\Http\Segment================
///:module[/]
///:mvc/router/list/status/1/page/4/perpage/5/sortby/asc
///course/zend-framwork2/10
$segmentRoute = array(
    'type'    => 'Segment',
    'options' => array(
        //'route' => '/:module[/:controller[/:action]][/]',
        //'route' => '/:module/:controller/:action[/status/:status][/page/:page]',
        'route'       => '/course/:name{-}-:id',
        'constraints' => array(
             'module'     => '[a-zA-Z]+',
             'controller' => '[a-zA-Z]+',
             'action'     => '[a-zA-Z]+[\d]{2}',
             'name'       => '[a-zA-Z_-]+',
             'id'         => '[\d]+',
         ),
        'defaults' => array(
            '__NAMESPACE__' => 'Mvc\Controller',
            'controller'    => 'router',
            'action'        => 'course',
            'name'          => 'zf2',
            'id'            => '5'
        ),
    ),
);

//==============Zend\Mvc\Router\Http\Regex===============
// /course/zend-framework-2x/10
// /course/zend-framework-2x-10
// /course/zend-framework-2x-10.html
// /course/zend-framework-2x-10.php
// /course/zend-framework-2x-10.asp
$regexRoute = array(
    'type' => 'Regex',
    'options' => array(
        'regex' => '/course/((?<name>[a-zA-Z0-9_-]+)/(?<id>[0-9]+).(?<extension>html|php|asp))?',
        'defaults' => array(
            '__NAMESPACE__' => 'Mvc\Controller',
            'controller'    => 'Router',
            'action'        => 'course',
            'name'          => 'zf2',
            'id'            => '12',
            'extension'     => 'phtml'
        ),
        'spec' => '/course/%name%/%id%.%extension%',
    ),
);

//skeleton.trongle.dev
//skeleton.trongle.dev/login.html
//skeleton.trongle.dev/admin/user/index
//skeleton.trongle.dev/admin/user/edit/2
//skeleton.trongle.dev/admin/user/add/2
$treeRouter =  array(
        'type'    => 'literal',
        'options' => array(
            'route'         => '/',
            'defaults'      => array(
                '__NAMESPACE__' => 'Mvc\Controller',
                'controller'    => 'Router',
                'action'        => 'index01'
            )
        ),  
        'may_terminate' => true,
        'child_routes'  => array(
            'login' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'         => 'login.html',
                    'defaults'      => array(
                        '__NAMESPACE__' => 'Mvc\Controller',
                        'controller'    => 'Router',
                        'action'        => 'login'
                    )
                )
            ),
            'manager_user' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'       => 'admin/user/:action[/:id]',
                    'constraints' => array(
                         'action'     => '[a-zA-Z]+[\d]*',
                         'id'         => '[\d]+',
                     ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Mvc\Controller',
                        'controller'    => 'Router',
                        'action'        => 'index01',
                        'id'            => '5'
                    ),
                ),
            )
        ) 
);

$treeRouterForm =  array(
        'type'    => 'literal',
        'options' => array(
            'route'         => '/form',
            'defaults'      => array(
                '__NAMESPACE__' => 'Form\Controller',
                'controller'    => 'Validator',
                'action'        => 'index01'
            )
        ),  
        'may_terminate' => true,
        'child_routes'  => array(
            'manager_user' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'       => '/[:controller][/:action]',
                    'constraints' => array(
                       'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',    
                       'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                     ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Form\Controller',
                        'controller'    => 'Validator',
                        'action'        => 'index01',
                    ),
                ),
)
        ) 
);

$home =  array(
    'type' => 'Literal',
    'options' => array(
        'route'    => '/',
        'defaults' => array(
            'controller' => 'Application\Controller\Index',
            'action'     => 'index',
        ),
    ),
);

$trainingModule = array(
    'type'    => 'Literal',
    'options' => array(
        'route'    => '/training',
        'defaults' => array(
            '__NAMESPACE__' => 'Training\Controller',
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
                    '__NAMESPACE__' => 'Training\Controller',
                    'controller'    => 'Index',
                    'action'        => 'index',
                ),
            ),
        ),
    ),
);

$mvc  = array(
    'type'    => 'Literal',
    'options' => array(
        'route'    => '/mvc',
        'defaults' => array(
            '__NAMESPACE__' => 'Mvc\Controller',
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
                    '__NAMESPACE__' => 'Mvc\Controller',
                    'controller'    => 'Index',
                    'action'        => 'index',
                ),
            ),
        ),
    ),
);



return array(
	'router' => array(
        'routes' => array(   
            // 'hostnameType' => $hostnameRoute,
            // 'schemeType'   => $scheme,
            // 'segmentType'  => $segmentRoute,
            
            'regexType'   => $regexRoute,
            "treeRouter"  => $treeRouter,
            'literalType' => $literal,
            'home'        => $home,
            'application' => $trainingModule,
            'mvc'         => $mvc,
            'treeRouterForm' => $treeRouterForm
        ),
    ),
);
?>