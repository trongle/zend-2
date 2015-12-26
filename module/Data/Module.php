<?php

namespace Data;

use Zend\Filter\StaticFilter;
use Zend\ModuleManager\ModuleEvent;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module{
	public function onBootstrap(MvcEvent $e){
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        StaticFilter::getPluginManager()->setInvokableClass("CreateLinkFriendly","\ZendVN\Filter\CreateLinkFriendly");
	    StaticFilter::getPluginManager()->setInvokableClass("Purifier","\ZendVN\Filter\Purifier");
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
   
        return include __DIR__ . '/config/module.config.php';
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
}
?>