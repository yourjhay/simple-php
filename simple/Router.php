<?php

/*----------------------------------------------------------------
|
| The Simple PHP Framework v1.0
| @reyjhonbaquirin
| *** BASE ROUTER Class ***
------------------------------------------------------------------*/
namespace Simple;

class Router {

    /**
     * Associative array of register routes
     * @var array
     */
    protected static $routes = [];

    /**
     * Parameters from matched routes
     * @var array
     */
    protected static $params = [];

    /**
     * register routes
     * @param string $route - Route URL
     * @param array $params Parameters (controller, action, etc.)
     */
    public static function set($route, $params = []) {

        //convert the route to a regular exp. escape forward slashes
        $route = preg_replace('/\//','\\/',$route);
        
        //convert var like {controller}
        $route = preg_replace('/\{([a-z]+)\}/','(?P<\1>[a-z-]+)',$route);

        //convert variables with custom regex eg: {id: \d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        //add start and end delimeters, case insensitive flag
        $route = '/^' . $route . '$/i';
        self::$routes[$route] = $params;
    }

    /**
     * Return all available routes
     * @return array
     */
    public function getRoutes() {
        return self::$routes;
    }

    /**
     * Match the route to $routes setting $params property
     * if a route is found
     * @param string $url - The route URL
     * @return boolean true if match found else false 
     */
    public static function match($url){       
       foreach(self::$routes as $route => $params){
            if(preg_match($route, $url, $matches)){
                foreach($matches as $key => $match){
                    if(is_string($key)){
                        $params[$key] = $match;
                    }
                }
            self::$params = $params;
            return true;
        }
       }
       return false;
    }

    /**
     * Get matched parameters
     */
    public static function getParams(){
        return self::$params;
    }

    /**
     * Dispatch route parameter to URL
     * 
     */
    public static function dispatch($url) {
        $url = self::removeQueryString($url);
        if(self::match($url)) {
            $controller = self::$params['controller'];
            $controller = self::convertToStudlyCaps($controller);
            $controller = self::getNamespace(). $controller;
           if(class_exists($controller)){
               $controller_object = new $controller(self::$params);
               $action = self::$params['action'];
               $action = self::convertToCamelCase($action);
              
               if (preg_match('/action$/i', $action) == 0) {
                   $controller_object->$action();
               } else {
                  throw new \Exception("Method [$action] (in Controller [$controller] ) can't be called explicitly. Remove Action suffix instead");              
                }
           } else {
               throw new \Exception("Controller class [$controller] not found");
           }
        } else {
            throw new \Exception("INVALID ROUTE [$url]", 404);
        }
    }

    /**
     * convert string into Studly Case format 
     * @var string
     */
     private static function convertToStudlyCaps($string) {
        return str_replace(' ','',ucwords(str_replace('-',' ', $string)));
     }

     /**
     * convert string into Camel Case format 
     * @var string
     */
    private static function convertToCamelCase($string) {
        return lcfirst(self::convertToStudlyCaps($string));
     }

     /**
      * Remove query string from url like:
      * ?page=1&id=1...... etc.
      * @param string $url
      */
     protected static function removeQueryString($url) {
         if($url != ''){
             $parts = explode('&', $url, 2);
             if(strpos($parts[0], '=')===false){
                 $url = $parts[0];
             } else {
                 $url = '';
             }
         }
         return $url;
     }

     /**
      * Getnamespace in route params to specify where it has to be called 
      * @return string $namespace
      */
     protected static function getNamespace() {
        $namespace = 'App\Controllers\\';
        if(array_key_exists('namespace', self::$params)){
            $namespace .= self::$params['namespace'] . '\\';
        }
        return $namespace;
     }

}
