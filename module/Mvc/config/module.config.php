<?php 
namespace Mvc;
return array(
	
	"controllers"  => array(
		"invokables" => array(
            "Mvc\Controller\Index"       => "Mvc\Controller\IndexController",
            "Mvc\Controller\Event"       => "Mvc\Controller\EventController",   
            "Mvc\Controller\Service"     => "Mvc\Controller\ServiceController",
            "Mvc\Controller\ViewHelper"  => "Mvc\Controller\ViewHelperController",  
            "Mvc\Controller\ViewManager" => "Mvc\Controller\ViewManagerController",   
            "Mvc\Controller\Router"      => "Mvc\Controller\RouterController", 
            "Mvc\Controller\Plugin"      => "Mvc\Controller\PluginController", 
		),
	),
    "view_helpers" =>array(
        "invokables" => array(
            "sayhello" => "\ZendVN\View\Helper\SayHello",
        ),
    ),
	"view_manager" =>array(
        "base_path" => "/zendskeleton/vendor",
        
		"template_path_stack" => array(__DIR__."/../view"),
        'template_map' => array(
            'layout/mvc'    => __DIR__ .'/../view/layout/layout.phtml',
            'layout/layout' => __DIR__ .'/../view/layout/layout2.phtml',
            'error/404'     => __DIR__ . '/../view/error/404.phtml',
            'error/index'   => __DIR__ . '/../view/error/index.phtml',
            'error/myerror' => __DIR__ . '/../view/error/customError.phtml',
            'view/header'   => __DIR__ . '/../view/mvc/view-manager/header.phtml',
            'view/abc'      => __DIR__ . '/../view/mvc/abc.phtml',
        ),
       'layout'=>'layout/mvc'
        //"doctype"   => "XHTML11",
	),
    'service_manager' => array(
        "invokables"  => array(
            "Mvc\Service\User"     => "Mvc\Service\UserService",
            "Mvc\Service\FaceBook" => "Mvc\Service\FaceBookService",
            // "Mvc\Service\Social"   => "Mvc\Service\SocialService", -->could not call it
        ),
        "aliases" => array(
            "MSU" => "Mvc\Service\User",
        ),
        "shared"         => array(
            "Mvc\Service\User" => false,
        ),
        "allow_override" => true,
        "abstract_factories" => array(
            "Mvc\Service\MyAbstractFactories"
        ),
        "initializers" => array(
            "Mvc\Service\MyInitlizer",
        )    
    ),
    'view_helper_config' => array(
        "flashmessenger" => array(
            "message_open_format" => "<div><h4>",
            "message_separator_string" => "</h4><h4>",
            "message_close_string" => "</h4></div>"
        ),
    ),
    'controller_plugins' => array(
        "invokables" => array(
           // "myOwnPlugin" => "Mvc\Controller\plugin\myPlugin"
        )
       
    ),
);
?>