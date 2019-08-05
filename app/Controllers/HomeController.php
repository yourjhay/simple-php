<?php
namespace App\Controllers;

class HomeController extends Controller
{

    public function index() 
    {
        /**
         * view::render uses twig template engine
         * Documentation: https://twig.symfony.com/doc/2.x/api.html
         * 
         * if you want to render view without template engine
         * return view('view.name',[var1=>'value1'],'normal')
         */
        return view('home.index',[
            'name'        => APP_NAME,
            'description' => APP_DESCRIPTION
        ]);

    }
}
