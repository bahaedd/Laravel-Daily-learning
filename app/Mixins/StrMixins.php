<?php


namespace App\Mixins;

class StrMixins
{
    public function partNumber()
    {
        return function ($part){
            return 'AB-' .substr($part, 0, 3) .'-' .substr($part, 3);
        };
    }

    public function prefix()
    {
        return function ($string, $prefix = 'MAR-') {
            return $prefix . $string;
        };
    }
}
