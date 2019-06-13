<?php
/*----------------------------------------------------------------
|
| The Simple PHP Framework v1.0
| @reyjhonbaquirin - June 09 2019
|
|
| *** FRONT CONTROLLER ***
------------------------------------------------------------------*/
$url = $_SERVER['SERVER_NAME']=="localhost" ? substr($_SERVER['REQUEST_URI'],1) : $_SERVER['QUERY_STRING'];

/**
 * Application Configs
 */
foreach (glob('../App/Config/*.php') as $filename)
{
    require $filename;
}

/**
 *  Initiate Session
 */
session_start();

/**
 * COMPOSER Autoloader
 */
require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Error Reporting
 */
error_reporting(E_ALL);
if(ERROR_HANDLER === 'simply') {
    set_error_handler('Simple\Error::errorHandler');
    set_exception_handler('Simple\Error::exceptionHandler');
} elseif (ERROR_HANDLER === 'whoops') {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}

/**
 * Application routes
 */
require '../App/Routes.php';
use Simple\Routing\Router;
Router::dispatch($url);