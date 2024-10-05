<?php

namespace Core\Routing;

use Core\Request;

/**
 * Class Route
 *
 * This class is used to define routes in the application.
 *
 * @package Core\Routing
 */
class Route extends ResolveRoute implements RouteCollectionInterface
{
    /**
     * Define a GET route.
     *
     * This method registers a GET route with the specified path and action.
     * Optionally, middlewares can be applied to the route.
     *
     * @param string $path The route path.
     * @param mixed $action The action to be executed when the route is matched.
     * @param array $middlewares Optional middlewares to be applied to the route.
     */
    public static function get(string $path, mixed $action, array $middlewares = []): void
    {
        // Initialize the middlewares.
        if (isset(self::$middlewares[self::$prefix])) {
            $middlewares = array_merge(self::$middlewares[self::$prefix], $middlewares);
        }
        // Trim the path.
        $path = trim($path, '/');
        // Set the path.
        $path = self::$prefix . "/$path";
        // Save the route.
        self::$routes[Request::GET_METHOD][$path] = ['action' => $action, 'middlewares' => $middlewares];
    }

    /**
     * Define a POST route.
     *
     * This method registers a POST route with the specified path and action.
     * Optionally, middlewares can be applied to the route.
     *
     * @param string $path The route path.
     * @param mixed $action The action to be executed when the route is matched.
     * @param array $middlewares Optional middlewares to be applied to the route.
     *
     * @return void
     */
    public static function post(string $path, mixed $action, array $middlewares = []): void
    {
        // Initialize the middlewares.
        if (isset(self::$middlewares[self::$prefix])) {
            $middlewares = array_merge(self::$middlewares[self::$prefix], $middlewares);
        }
        // Trim the path.
        $path = trim($path, '/');
        // Set the path.
        $path = self::$prefix . "/$path";
        // Save the route.
        self::$routes[Request::POST_METHOD][$path] = ['action' => $action, 'middlewares' => $middlewares];
    }

    /**
     * Define a route group.
     *
     * This method registers a group of routes with the specified prefix and callback.
     * Optionally, middlewares can be applied to the group.
     *
     * @param string $prefix The prefix for the group of routes.
     * @param callable $callback The callback that defines the routes in the group.
     * @param array $middlewares Optional middlewares to be applied to the group.
     *
     * @return void
     */
    public static function group(string $prefix, mixed $callback, array $middlewares = []): void
    {
        // Initialize the middlewares.
        $middlewares = [];
        // Save the previous prefix.
        $previousPrefix = self::$prefix;
        // Merge the middlewares of the previous prefix with the current middlewares.
        if (self::$middlewares[$previousPrefix]) {
            $middlewares = array_merge(self::$middlewares[$previousPrefix], $middlewares);
        }
        // Trim the prefix.
        $prefix = trim($prefix, '/');
        // Set the new prefix.
        self::$prefix .= "/$prefix";
        // Save the middlewares for the current prefix.
        self::$middlewares[self::$prefix] = $middlewares;
        // Call the callback to define the routes in the group.
        call_user_func($callback);
        // Reset the prefix to the previous prefix.
        self::$prefix = $previousPrefix;
    }
}
