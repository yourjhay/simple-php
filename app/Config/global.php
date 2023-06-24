<?php
/**----------------------------------------------------------------------
 *  Application Configuration Settings
 *  docs: https://simply-docs.herokuapp.com/
 * -----------------------------------------------------------------------
 */
define('APP_NAME', 'Simply PHP');
define('APP_DESCRIPTION', 'The "Simply-PHP" Framework');
define('BASEURL', '');
define('APP_KEY', '');

/**
 * Error handling behaviour
 * NOTE: Set to false in production
 */
define('SHOW_ERRORS', true);

/**
 * Options: 
 *  simply - use the default error handling template.
 *  whoops - use "filp/whoops" error handling library.
 *  **IF you set whoops as default ERROR_HANDLER you need to install it.
 *    run: composer require filp/whoops
 */
define('ERROR_HANDLER', 'simply');

/**
 * Template Engine configuration
 */
define('CACHE_VIEWS', false);

/**------------------------------------------------------------------
 * Database configuration settings
 * -------------------------------------------------------------------
 */

 /**
  * DBENGINE - The database engine you're going to use
  * options: mysql or mysqli, postgres, sqlserver, common, basic, sqlite.
  */
define('DBENGINE', 'mysql');

define('DBSERVER', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME','simply');
define('DBTESTMODE',false);
