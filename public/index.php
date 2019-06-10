<?php
/*----------------------------------------------------------------
|
| The Simple PHP Framework v1.0
| @reyjhonbaquirin - June 09 2019
|
|
| *** FRONT CONTROLLER ***
------------------------------------------------------------------*/

/**
 * Application Configs
 */
foreach (glob('../App/Config/*.php') as $filename)
{
    require $filename;
}

/**
 * COMPOSER Autoloader
 */
require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Error Reporting
 */
error_reporting(E_ALL);
set_error_handler('Simple\Error::errorHandler');
set_exception_handler('Simple\Error::exceptionHandler');

/**
 * Application routes
 */
require '../App/Routes.php';
$url = $_SERVER['QUERY_STRING'];
use Simple\Router;
Router::dispatch($url);