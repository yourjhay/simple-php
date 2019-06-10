<?php
require '../simple/Router.php';
use Simple\Router;

Router::set('',[
  'controller' => 'home',
  'action'     => 'index'
]);