<?php

namespace App\Controllers\Admin;

use Simple\Controller as SimpleController;

class Users extends SimpleController {

    /**
     * Before filter
     * @return void
     */
    protected function before(){
        //Authentication here
    }

    /**
     * Add 'Action' suffix to method if you want to call the filter before
     */
    public function indexAction(){
        echo 'hello from index of admin/user';
    }
}