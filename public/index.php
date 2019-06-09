<?php
/*----------------------------------------------------------------
|
| The Simple PHP Framework
| @reyjhonbaquirin - June 06 2019
|
|
| *** FRONT CONTROLLER ***
------------------------------------------------------------------*/
/**
 * TWIG
 */
require '../App/Config/global.php';

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

require '../App/Routes.php';
$url = $_SERVER['QUERY_STRING'];

use Simple\Router;
Router::dispatch($url);