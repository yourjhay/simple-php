<?php
/*----------------------------------------------------------------
|
| The Simple PHP Framework
| @reyjhonbaquirin
| *** BASE MODEL Class ***
------------------------------------------------------------------*/
namespace Simple;
use PDO;

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
    



}