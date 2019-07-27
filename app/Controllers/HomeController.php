<?php

namespace App\Controllers;

use function Simple\view;

class HomeController extends Controller
{

    public function index() 
    {
        /**
         * view::render uses twig template engine
         * Documentation: https://twig.symfony.com/doc/2.x/api.html
         * 
         * if you want to render view without template engine
         * use view::renderNormal('viewname',array()) or 
         * return view('view.name',$data,'normal')
         */
        return view('home.index',[
            'name'        => APP_NAME,
            'description' => APP_DESCRIPTION
        ]);

    }
}