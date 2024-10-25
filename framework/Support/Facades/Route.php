<?php

namespace Framework\Support\Facades;

use Framework\Routing\Router;

/**
 * @method static Router prefix(string $name, mixed $callback, array $middlewares = []): void
 * @method static Router group(mixed $callback, array $middlewares = []): void
 * @method static Router get(string $path, mixed $action, array $middlewares = []): void
 * @method static Router post(string $path, mixed $action, array $middlewares = []): void
 * @method static Router put(string $path, mixed $action, array $middlewares = []): void
 * @method static Router delete(string $path, mixed $action, array $middlewares = []): void
 *
 * @see Router
 */
class Route extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string {
        return 'router';
    }
}