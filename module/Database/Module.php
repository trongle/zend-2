<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Database;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        //config để dùng $adapter mọi nơi
        $adapter = $e->getApplication()->getServiceManager()->get("db_books");
        GlobalAdapterFeature::setStaticAdapter($adapter);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getFormElementConfig(){
        return array(
            "factories" => array(
                "Database\Form\FindUserForm" => function($sm){
                    $form = new \Database\Form\FindUserForm();
                    $form->setInputFilter(new \Database\Form\FindUserFilter());
                    return $form;
                },
                "Database\Form\SaveUserForm" => function($sm){
                    $form = new \Database\Form\SaveUserForm();
                    $form->setInputFilter(new \Database\Form\SaveUserFilter());
                    return $form;
                }
            ),
            "aliases" => array(
                "FindForm" => "Database\Form\FindUserForm",
                "SaveForm" => "Database\Form\SaveUserForm"
            )
        );
    }

    public function getServiceConfig(){
        return array(
            "factories" => array(
                "TableGateway" => function($sm){
                    $adapter = $sm->get("db_books");

                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new \Database\Model\Entity\User());

                    return $tableGateway = new TableGateway("user",$adapter,null,$resultSetPrototype);
                },
                "Database\Model\User" => function($sm){
                    $tableGateway = $sm->get("TableGateway");
                    return  new \Database\Model\UserTable($tableGateway);
                }
            ),
            "aliases" => array(
                "UserTable" => "Database\Model\User"
            )
        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
