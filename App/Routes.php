<?php
require '../simple/Router.php';
use Simple\Router;

Router::set('',[
  'controller' => 'home',
  'action'     => 'index'
]);

Router::set('users',[
  'controller' => 'users',
  'action' => 'index' 
]);

Router::set('about',[
  'controller' => 'about',
  'action' => 'index',
  'namespace' => 'Pages'
]);

Router::set('admin/{controller}/{action}',[
  'namespace' => 'Admin'
]);

Router::set('{controller:posts}/{action}/{id:\w+}');




/*

echo '<pre>';
    echo htmlspecialchars(print_r(Router::getRoutes(), true));
  echo '<pre>';

$url = $_SERVER['QUERY_STRING'];
echo '<br><br>';
if(Router::match($url)){
  echo '<pre>';
    var_dump(Router::getParams());
  echo '<pre>';
} else {
  
}  
*/