<?php 

namespace Training;

use Zend\ModuleManager\ModuleEvent;
use Zend\ModuleManager\ModuleManager;

class Module{
	public function getBootstrap(){

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
        /*
        Read file config by xml
         */
        $reader = new \Zend\Config\Reader\Xml();
        // $reader->setNestSeparator(".");
        $configArr = $reader->fromFile(__DIR__."/config/module.config.xml");
        $configArr['view_manager']['template_path_stack'] = array(__DIR__."/view");
        foreach($configArr['controllers']['invokables'] as $key => $value){
            $newKey = preg_replace("#Controller$#","",$value);
            $configArr['controllers']['invokables'][$newKey] = $value;
            unset($configArr['controllers']['invokables'][$key]);
        }



        /*
        Read file config by ini
         */
        // $reader = new \Zend\Config\Reader\Ini();
        // $reader->setNestSeparator(".");
        // $configArr = $reader->fromFile(__DIR__."/config/module.config.ini");
        // $configArr['view_manager']['template_path_stack'] = array(__DIR__."/view");

        //return $configArr;
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