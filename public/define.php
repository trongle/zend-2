<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */

chdir(dirname(__DIR__));
define("APPLICATION_ENV",getenv("APPLICATION_ENV")? getenv("APPLICATION_ENV"):"production");//thiết lập biến môi trường
define("APPLICATION_PATH",realpath(dirname(__DIR__))); //đường dẫn root(zendskeleton)
define("LIB_PATH",APPLICATION_PATH."/vendor/"); //đường dẫn library(vendor)
define("PUBLIC_PATH",APPLICATION_PATH."/public/"); //đường dẫn public
define("HTMLPURIFIER_PREFIX",APPLICATION_PATH."/vendor/"); //đường dẫn public
define("FILES_PATH",PUBLIC_PATH."files/"); //đường dẫn public
define("CAPTCHA_PATH",FILES_PATH."captcha/"); //đường dẫn captcha



define("APPLICATION_URL","http://skeleton.trongle.dev/"); //đường dẫn public
define("PUBLIC_URL",APPLICATION_URL."public/"); //đường dẫn public
define("FILES_URL",PUBLIC_URL."files/"); //đường dẫn public
define("CAPTCHA_URL",FILES_URL."captcha/"); //đường dẫn public
