<?php

namespace Dizatech\Tag\Facades;

use Illuminate\Support\Facades\Facade;

abstract class BaseFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return static::class;
    }

    public static function shouldProxyTo($class)
    {
        app()->bind(self::getFacadeAccessor(), $class);
    }
}
