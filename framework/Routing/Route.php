<?php

namespace Framework\Routing;

use Framework\Routing\Interfaces\RouteInterface;

/**
 * Class Route
 *
 * This class is responsible for defining and managing routes in the application.
 * It extends the RouteResolve class and implements the RouteInterface.
 *
 * @package Framework\Routing
 */
class Route extends RouteResolve implements RouteInterface {
    /**
     * Define a route prefix and apply middlewares.
     *
     * This method sets a prefix for a group of routes and applies any provided middlewares.
     * It then executes the callback function to define the routes within the group.
     *
     * @param  string  $name  The prefix to be added to the routes.
     * @param  mixed   $callback  The callback function to define the routes.
     * @param  array   $middlewares  The middlewares to be applied to the routes.
     *
     * @return void
     */
    public static function prefix(string $name, mixed $callback, array $middlewares = []): void {
        $previousPrefix = self::$prefix;
        if ($name && $name !== '/') {
            $prefix       = trim($name, '/');
            self::$prefix .= "/$prefix";
        }

        self::$middlewares[self::$prefix] = array_merge(self::$middlewares[self::$prefix] ?? [], $middlewares);
        call_user_func($callback);
        self::$prefix = $previousPrefix;
    }

    /**
     * Define a group of routes and apply middlewares.
     *
     * This method defines a group of routes and applies any provided middlewares.
     * It then executes the callback function to define the routes within the group.
     *
     * @param  mixed  $callback  The callback function to define the routes.
     * @param  array  $middlewares  The middlewares to be applied to the routes.
     *
     * @return void
     */
    public static function group(mixed $callback, array $middlewares = []): void {
        self::$middlewares[self::$prefix] = array_merge(self::$middlewares[self::$prefix] ?? [], $middlewares);
        call_user_func($callback);
    }

    /**
     * Define a GET route.
     *
     * This method defines a GET route with the provided path, action, and middlewares.
     *
     * @param  string  $path  The path of the route.
     * @param  mixed   $action  The action to be executed when the route is accessed.
     * @param  array   $middlewares  The middlewares to be applied to the route.
     *
     * @return void
     */
    public static function get(string $path, mixed $action, array $middlewares = []): void {
        self::mapPathAndMiddleware(self::GET, $path, $action, $middlewares);
    }

    /**
     * Define a POST route.
     *
     * This method defines a POST route with the provided path, action, and middlewares.
     *
     * @param  string  $path  The path of the route.
     * @param  mixed   $action  The action to be executed when the route is accessed.
     * @param  array   $middlewares  The middlewares to be applied to the route.
     *
     * @return void
     */
    public static function post(string $path, mixed $action, array $middlewares = []): void {
        self::mapPathAndMiddleware(self::POST, $path, $action, $middlewares);
    }

    /**
     * Define a PUT route.
     *
     * This method defines a PUT route with the provided path, action, and middlewares.
     *
     * @param  string  $path  The path of the route.
     * @param  mixed   $action  The action to be executed when the route is accessed.
     * @param  array   $middlewares  The middlewares to be applied to the route.
     *
     * @return void
     */
    public static function put(string $path, mixed $action, array $middlewares = []): void {
        self::mapPathAndMiddleware(self::PUT, $path, $action, $middlewares);
    }

    /**
     * Define a DELETE route.
     *
     * This method defines a DELETE route with the provided path, action, and middlewares.
     *
     * @param  string  $path  The path of the route.
     * @param  mixed   $action  The action to be executed when the route is accessed.
     * @param  array   $middlewares  The middlewares to be applied to the route.
     *
     * @return void
     */
    public static function delete(string $path, mixed $action, array $middlewares = []): void {
        self::mapPathAndMiddleware(self::DELETE, $path, $action, $middlewares);
    }
}