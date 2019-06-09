<?php
/**
 * The Posts controller
 * SimplePHP FrameWork v1
 */
namespace App\Controllers;

use Simple\Controller as SimpleController;
use Simple\View as view;
use App\Models\User;

class Users extends SimpleController {

    
    public function index() {
        $users = User::getAll();
        view::render('users.index',[
           'name' => 'List of users',
           'users' => $users
        ]);
    }

    private function showPost() {
        echo "hello from the show action of Post Controller";
    }

    public function editPost() {
        echo "hello from the editPost action of Post Controller<br><br>";
        echo 'Parameter from route: <pre>'.htmlspecialchars(print_r(self::$route_params, true)).'<pre>';
    }

}