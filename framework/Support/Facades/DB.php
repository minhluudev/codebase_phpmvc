<?php

namespace Framework\Support\Facades;

/**
 * @method static void connectToDatabase()
 *
 * @see \Framework\Databases\DB
 */
class DB extends Facade {
    protected static function getFacadeAccessor(): string {
        return 'db';
    }
}