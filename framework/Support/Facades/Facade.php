<?php

namespace Framework\Support\Facades;

use Exception;
use Framework\App;

abstract class Facade {
    private static $instance;
    /**
     * @throws Exception
     */
    public static function __callStatic(string $method, array $args) {
        if(!self::$instance) {
            self::$instance = App::$app->container->get(static::getFacadeAccessor());
        }

        return self::$instance->$method(...$args);
    }

    abstract protected static function getFacadeAccessor(): string;
}