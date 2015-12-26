<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Permission;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Permissions\Acl\Acl;

class Module
{
    public function getFormElementConfig(){
        return array(
            "factories" => array(
                "loginForm" => function($sm){
                    $form = new \Permission\Form\LoginForm();
                    $form->setInputFilter(new \Permission\Form\LoginFormFilter());
                    return $form;
                }
            )
        );
    }
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        //thiết lập permission
        // một số sự kiện mặc định route,dispatch,render....
        $eventManager->attach("dispatch",array($this,"permission"),2);

        //config để dùng $adapter mọi nơi
        $adapter = $e->getApplication()->getServiceManager()->get("db_books");
        GlobalAdapterFeature::setStaticAdapter($adapter);
    }

    public function permission(MvcEvent $e){
            // $aclObj = new Acl();
            // $aclObj->addRole("admin");

            // $routeMatch    = $e->getRouteMatch();
            // $arrController = explode("\\",$routeMatch->getParam("controller"));
            
            // $module     = strtolower($arrController[0]);
            // $controller = strtolower($arrController[2]);
            // $action     = $routeMatch->getParam("action");

            // $aclObj->addResource("permission");
            // $aclObj->allow("admin","permission",array("index:index"));
            // $aclObj->allow("admin","permission",array("index:deny"));

            // $role = "admin";
            // $resource  = $module;
            // $privilege = $controller.":".$action;
            // if($aclObj->isAllowed($role,$resource,$privilege) == false){
            //     //thực hiện redirect
            //     $router = $e->getRouter();
            //     $url = $router->assemble(array("controller" => "index","action" => "deny"),array("name"=>"permissionRoute/default"));
            //     $reponse = $e->getResponse();
            //     $reponse->setStatusCode(302);
            //     $reponse->getHeaders()->addHeaderLine("location",$url);
            // }
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
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



    public function getServiceConfig(){
        return array(
            'factories' => array(
                "myAuthenticate" => function($sm){
                    $adapter = $sm->get("db_books");
                    $dbTableAdapter = new \Zend\Authentication\Adapter\DbTable($adapter,"user","email","password");
                    $select = $dbTableAdapter->getDbSelect();
                    $select->where->equalTo("status","1");
                
                    $authenticateObj = new \Zend\Authentication\AuthenticationService(null,$dbTableAdapter);
                    return $authenticateObj;
                },
                "authenticateLogin" => function($sm){
                    return new \ZendVN\System\Authenticate($sm->get("myAuthenticate"));
                }
            ),
        );
        
    }
}
