<?php

namespace App\Helper\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FunctionExtension extends AbstractExtension
{

    /**
     * Extension for twig functions
     * Read Documentation at: https://twig.symfony.com/doc/2.x/advanced.html
     */
    public function getFunctions()
    {
        return [
            /**
             * List of registered functions. you can add your own to use
             * it the twig template.
             * new TwigFunction($function_name_to_be_called_in_template, [$callable, method_name])
             */
            new TwigFunction('phpinfo', [$this,'phpinfo']),        
            
        ];
    }
    

    /**
     * Methods for Twig Functions
     */
    public function phpinfo()
    {
        return phpinfo();
    }

}