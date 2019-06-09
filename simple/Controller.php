<?php

/*----------------------------------------------------------------
|
| The Simple PHP Framework
| @reyjhonbaquirin
| *** BASE CONTROLLER Class ***
------------------------------------------------------------------*/

namespace Simple;
/**
 * abstract class - call object only on class inhereting this class
 */
abstract class Controller {

    /**
     * Parameters from the matched routes
     */
    protected static $route_params = [];

    /**
     * @param array $route_params - Parameters from the route
     */
    public function __construct($route_params) {
        self::$route_params = $route_params;
    }

    /**
     * Magic method called when a non-existent or inaccessible method is
     * called on an object of this class. Used to execute before and after
     * filter methods on action methods. Action methods need to be named
     * with an "Action" suffix, e.g. indexAction, showAction etc.
     *
     * @param string $name  Method name
     * @param array $args Arguments passed to the method
     *
     * @return void
     */
    public function __call($name, $args)
    {
        $method = $name . 'Action';
        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            } 
        } else {
            throw new \Exception("Method [$method] not found in controller [" .
            get_class($this)."]");
        }
    }

     /**
     * Before filter - called before an action method.
     *
     * @return void
     */
    protected function before()
    {
    }

    /**
     * After filter - called after an action method.
     *
     * @return void
     */
    protected function after()
    {
    }

}