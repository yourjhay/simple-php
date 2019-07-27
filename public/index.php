<?php
/*----------------------------------------------------------------
|
| The Simple PHP Framework v1.2
| @reyjhonbaquirin - June 09 2019
| License MIT
| 
| *** FRONT CONTROLLER ***
------------------------------------------------------------------*/

/**
 * Application Configs
 */
foreach (glob('../app/Config/*.php') as $filename)
{
    require $filename;
}

/**
 *  Initiate Session
 */
session_start();

/**
 * COMPOSER Autoloader
 * Initialize application URL
 */
require_once dirname(__DIR__) . '/vendor/autoload.php';
use function Simple\url_init;
$url = url_init();

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
require '../app/Routes.php';
Simple\Routing\Router::dispatch($url);