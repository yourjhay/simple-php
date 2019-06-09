<?php

namespace App\controllers\Pages;
use Simple\View as view;
use App\Helper\SampleHelper;
class About {

    public function index(){

        $name=SampleHelper::uppercase('reyjhon');
        
        view::render('about.index',[
            'name' => $name
        ]);
    }
}