<?php
/*----------------------------------------------------------------
|
| The Simple PHP Framework v1.2
| @reyjhonbaquirin - June 09 2019
| License MIT
| docs: https://simply-docs.herokuapp.com
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

$url = url_init();

/**
 * Error Reporting
 */
error_reporting(E_ALL);
if(ERROR_HANDLER === 'simply') {
    set_error_handler('Simple\Error::errorHandler');
    set_exception_handler('Simple\Error::exceptionHandler');
} elseif (ERROR_HANDLER === 'whoops' && SHOW_ERRORS == true) {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
} else {
    set_error_handler('Simple\Error::errorHandler');
    set_exception_handler('Simple\Error::exceptionHandler');
}

/**
 * Application routes
 */
require '../app/Routes.php';

Simple\Routing\Router::dispatch($url);
