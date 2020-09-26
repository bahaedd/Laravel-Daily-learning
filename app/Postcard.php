<?php

namespace App;

class Postcard
{

    protected static function resolveFacade($name)
    {
        return app()[$name];
    }

    public static function __callStatic($method, $arguments)
    {
        // dd(app()['Postcard']);

        // dd(app()->make('Postcard'));

        return (self::resolveFacade('Postcard'))->$method(...$arguments);
    }
}
