<?php

namespace App\Helper\Twig;

use Twig\Extension\AbstractExtension;
use \Twig\Extension\GlobalsInterface;

class GlobalExtension extends AbstractExtension implements GlobalsInterface
{
    public function getGlobals(): array
    {
        return [
            'text' => 'sample text',
        ];
    }
}