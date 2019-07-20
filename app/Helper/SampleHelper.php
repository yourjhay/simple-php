<?php

namespace App\Helper;

class SampleHelper 
{

    /**
     * @param null $var - string to be uppercase
     * @return string
     */
    public static function uppercase($var = null)
    {
        return strtoupper($var);
    }

}