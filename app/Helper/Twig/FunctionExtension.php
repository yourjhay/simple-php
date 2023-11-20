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
    public function getFunctions(): array
    {
        return [
            /**
             * List of registered functions. you can add your own to use
             * it the twig template.
             * new TwigFunction($function_name_to_be_called_in_template, [$callable, method_name])
             */
            new TwigFunction('phpinfo', [$this,'phpinfo']),
            new TwigFunction('alias', [$this,'alias']),
        ];
    }

    /**
     * Methods for Twig Functions
     */
    public function phpinfo()
    {
        return phpinfo();
    }

    /**
     * To call aliases in your views eg: alias('route.alias')
     * @throws \Exception Route with alias not found
     */
    public function alias($var, $param=null): string
    {
        return alias($var, $param);
    }

}
