<?php

/*----------------------------------------------------------------
|
| The Simple PHP Framework
| @reyjhonbaquirin
| *** VIEW Class ***
------------------------------------------------------------------*/
namespace Simple;

class View {

    /**
     * Render A view 
     * @param string $view - The file my dear
     * @return void
     */
    public static function renderNormal($view, $args = []) {
        extract($args, EXTR_SKIP);
        $view = self::create($view);
        $file = "../App/Views/$view";
        if(is_readable($file)){
            require $file;
        } else {
            throw new \Exception("View [$file] not found!");
        }
    }

    private static function create($view, $html=false)
    {
        $name = str_replace('.','/',$view);
        $paths = explode('/',$name);
        $file=null;
        foreach($paths as $path){
            $file .= '/'.$path;
        }
      if($html==true){
        return $file.'.view.html';
      } else {
        return $file.'.view.php';
      }
    }

    public static function render($template, $args = []){
        static $twig = null;
        $view = self::create($template, true);
        if($twig===null){
            $loader = new \Twig\Loader\FilesystemLoader('../App/Views');
            if(twigcache == true){
                $twig = new \Twig\Environment($loader, [
                    'cache' => './Cache/Views',
                ]);
            } else {        
                $twig = new \Twig\Environment($loader);                        
            }
        }
        echo $twig->render($view, $args);
    }

}