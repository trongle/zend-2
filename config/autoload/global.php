<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'controllers' => array(
        'invokables' => array(
            "Training\Controller\Test" => "Training\Controller\TestglobalController",
        )
    ),
    'service_manager' => array(
    	// "factories" => array(
    	// 	"Zend\Db\Adapter\Adapter" => "Zend\Db\Adapter\AdapterServiceFactory",
    	// ),
    	// "aliases" => array(
    	// 	"dbConfig" =>"Zend\Db\Adapter\Adapter",
    	// )
        "abstract_factories" => array(
                "Zend\db\adapter\adapterAbstractServiceFactory"
            ) 
    ),
    "db" => array(
        "adapters" => array(
            "db_books" => array(
                "driver"   => "Pdo_Mysql",
                "database" => "books",
                "username" => "root",
                "password" => "",
                "hostname" => "localhost",
                "charset"  => "utf8"
            ),
            "db_qlxd" => array(
                "driver"   => "Pdo_Mysql",
                "database" => "ql_ctxd",
                "username" => "root",
                "password" => "",
                "hostname" => "localhost",
                "charset"  => "utf8"
            )
        )
    	
    )

);
