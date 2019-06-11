<?php
/*----------------------------------------------------------------
|
| The Simple PHP Framework v1.0
| @reyjhonbaquirin
| *** BASE MODEL Class ***
------------------------------------------------------------------*/
namespace Simple;
use PDO;
use Latitude\QueryBuilder\Engine\MySqlEngine;
use Latitude\QueryBuilder\QueryFactory;

abstract class Model {

    /**
     * GET the PDO connection
     * @return mixed
     */
    protected static function DB() {
        
        static $db = null;
        if($db===null) {
 
            $db = new PDO("mysql:host=".DBSERVER.";dbname=".DBNAME.";charset=utf8",DBUSER, DBPASS);
            
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;

        }
    }

    /**
     * Instantiate Latitude query Builder. for more info
     * https://latitude.shadowhand.me/
     * 
     * For the meantime we're using a third-party library 
     * while developing simple-php's own query builder
     * @return object
     */
    public static function factory() {
        return new QueryFactory(new MySqlEngine());
    } 
    
}