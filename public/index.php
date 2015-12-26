<?php

require_once "define.php";

include LIB_PATH . '/Zend/Loader/AutoloaderFactory.php';
Zend\Loader\AutoloaderFactory::factory(array(
    'Zend\Loader\StandardAutoloader' => array(
        'autoregister_zf' => true,
        "namespaces" => array(
        	"ZendVN" => LIB_PATH."ZendVN",
        ),
        "prefixes" => array(
        	"HTMLPurifier" => LIB_PATH."HTMLPurifier",
        )
    )
));
if (!class_exists('Zend\Loader\AutoloaderFactory')) {
    throw new RuntimeException('Unable to load ZF2. Run `php composer.phar install` or define a ZF2_PATH environment variable.');
}


// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
