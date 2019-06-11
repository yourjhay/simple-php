<?php
/**
 * Base class for Request
 * 
 */

namespace Simple;

class Request {

    /**
     * Filters a request wether a POST, GET etc..
     * @param string Request Method: POST, GET, DELETE, PUT
     * @return bool 
     */
    public static function filterRequest($user_request) {
        $request = $_SERVER['REQUEST_METHOD'];
        if($request == $user_request) {
            return true;
        } else {
            throw new \Exception("$request Method not allowed");
            return false;
        }
    }

    /**
     * Get the dat from $_POST array
     * @return string
     */
    public static function inputdata($data) {
      
        $file = file_get_contents("php://input");
        $file = explode("&", $file);
        for ($i = 0; $i < count($file); $i++) {
          $sub = explode('=', $file[$i]);
          if ($sub[0] == $data) {
            return utf8_decode(urldecode($sub[1]));
          }
        }
    }

    /**
     * Return data from GET, POST $_COOKIES
     * @return array 
     */
    public static function input(){
        return $_REQUEST;
    } 

}