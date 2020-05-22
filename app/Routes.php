<?php
/**
 * Application Routes
 * docs: https://simply-docs.herokuapp.com/documentation/v1/routing
 */
use Simple\Routing\Router;

Router::get('',['controller' => 'home', 'action' => 'index']);
