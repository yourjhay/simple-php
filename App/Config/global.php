<?php
/**
 * Application Configuration Settings
 */
define('APP_NAME','SIMPLy-PHP',true);
define('APP_DESCRIPTION','The "Simply-PHP" Framework',true);
define('BASEURL','',true);
/**
 * Error handling behaviour
 * Set to false in production
 */
define('SHOW_ERRORS', true);

/**
 * Options: 
 *  simply - use the default error handling template.
 *  whoops - use "filp/whoops" error handling library.
 *  **IF you set whoops as default ERROR_HANDLER you need to install it.
 *    run: composer require filp/whoops
 */
define('ERROR_HANDLER','simply', true);

/**
 * Template Engine configuration
 */
define('CACHE_VIEWS', false , true);

/**
 * Database configuration settings
 */
define('DBSERVER', 'localhost',true);
define('DBUSER', 'root', true);
define('DBPASS', '', true);
define('DBNAME','simply', true);