<?php

namespace Framework\Support\Facades;

/**
 * @method static void create(string $tableName, mixed $callback)
 * @method static void table(string $tableName, mixed $callback)
 * @method static void dropIfExists(string $table)
 *
 * @see \Framework\Schemas\Schema
 */
class Schema extends Facade {
    protected static function getFacadeAccessor(): string {
        return 'schema';
    }

}