<?php

namespace Mvc;

use Zend\EventManager\SharedEventManager;
use Zend\Filter\StaticFilter;
use Zend\ModuleManager\ModuleEvent;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceManager;


class Module{
    public function getServiceConfig(){
        return array(
            "invokables"         => array(),
            "aliases"            => array(),
            "shared"             => array(),
            "factories"          => array(
                // "socialservice"  => function($sm){
                //     $fbSer = new \Mvc\Service\FaceBookService();
                //     $mSer  = new \Mvc\Service\MailService();
                //     $socialService = new \Mvc\Service\SocialService($fbSer,$mSer);
                //     return $socialService; 
                // } 
            ),
            "abstract_factories" => array(),
            "initializers"       => array(
                function($instance,$sl){
                    if($instance instanceof \Mvc\Service\FaceBookService ){
                        $instance->trongle = "handsome";
                    }
            }),
            "services"           => array(
                "abc" => new \Mvc\Service\UserService(),
            )
        );
    }

	public function onBootstrap(MvcEvent $e){
        $eventManager   = $e->getApplication()->getEventManager();
        $serviceManager = $e->getApplication()->getServiceManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        StaticFilter::getPluginManager()->setInvokableClass("Callback","\ZendVN\Event\Callback");

        $eventManager->attach(new \ZendVN\Event\ShowInfoListener());
        //create Router
        $literal = \Zend\Mvc\Router\Http\Literal::factory(
            array(
                'route'         => '/new-way.html',
                'defaults'      => array(
                    '__NAMESPACE__' => 'Mvc\Controller',
                    'controller'    => 'Router',
                    'action'        => 'contact'
                )
            ));
        $route = $e->getRouter();
        $route->addRoute('newway',$literal);



        //set private template Error
        //$eventManager->attach("dispatch",array($this,"loadError"));

      

        //$eventManager->attach("render",array($this,"setTitle"));
        //$serviceManager->setInvokableClass("YourService","Mvc\Service\UserService");
        //set Service on Module.php
       
        //userService    = $serviceManager->get("socialservice");

        // $userService2   = $serviceManager->get("MSU");
        // echo "<pre style='font-weight:bold'>";
        // print_r($userService);
        // echo "</pre>";


        // if($serviceManager->has("Mvc\Service\FaceBook")){
        //     $facebookService = $serviceManager->get("Mvc\Service\FaceBook");
        //     echo "<pre style='font-weight:bold'>";
        //     print_r($facebookService);
        //     echo "</pre>";
        // }else{
        //     echo "Not exists this Service";
        // }

        // $showInfoListener = new \ZendVN\Event\ShowInfoListener();
        // $showInfoListener->attach($eventManager);
       


        //set sharedEventManager
        // $shareEventManager = $eventManager->getSharedManager();
        // $shareEventManager->attach("ZendVN\Event\Foo","showInfo",function($e){
        //     echo "<h3 style='color:red;font-weight:bold'>showInfo - do 1</h3>";
        //     echo "<pre style='font-weight:bold'>";
        //     print_r($e->getParams());
        //     echo "</pre>";
        // });
    }

    public function loadError($e){
        $controllerName = $e->getRouteMatch()->getParam("controller");
        if(stripos($controllerName,__NAMESPACE__,0) !== 0){
            return;
        }
        $serviceManager = $e->getApplication()->getServiceManager();
        $viewManager    = $serviceManager->get("viewmanager");
        $exceptionStrategy = $viewManager->getExceptionStrategy();
        $exceptionStrategy->setExceptionTemplate("error/myerror");
    }

    public function setTitle($e){
        $serviceManager = $e->getApplication()->getServiceManager();
        $moduleName = __NAMESPACE__;
        $controllerName = $e->getRouteMatch()->getParam("controller");
        $actionName = $e->getRouteMatch()->getParam("action");

        $viewHelper = $serviceManager->get("viewHelperManager");
        $headTitle  = $viewHelper->get("headTitle");
        $headTitle->append($moduleName);
        $headTitle->append($controllerName);
        $headTitle->append($actionName);
        $headTitle->setSeparator(" - ");


    }

    public function init(ModuleManager $moduleManager){
        $event = $moduleManager->getEventManager();
        $event->attach(ModuleEvent::EVENT_MERGE_CONFIG,array($this,'onMergeConfig'));
    }

    public function onMergeConfig(ModuleEvent $moduleEvent){
        $configListener = $moduleEvent->getConfigListener();
        $config = $configListener->getMergedConfig(false);
        // echo "<pre style='font-weight:bold'>";
        // print_r($config['controllers']);
        // echo "</pre>";
    }

	public function getConfig(){
        return array_merge(
            require_once  __DIR__ . '/config/module.config.php',
            require_once  __DIR__ . '/config/router.config.php'
        ); 
	}

    public function getControllerPluginConfig(){
        return array(
            "invokables" => array(
                "myOwnPlugin" => "Mvc\Controller\plugin\myPlugin"
            ) 
        );
    }

	public function getAutoloaderConfig(){
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    // đăng ký helper riêng
    // public function getViewHelperConfig(){
    //     return array(
    //         "invokables" =>array(
    //             "sayhello" => "\ZendVN\View\Helper\SayHello",
    //         ),
    //     );
    // }
}
?>