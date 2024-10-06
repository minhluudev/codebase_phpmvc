<?php

namespace Core\Routing;

use Core\Application;
use Core\Contracts\Routing\RouteCollectionInterface;
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
        self::setRoute(Request::GET_METHOD, $path, $action, $middlewares);
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
        self::setRoute(Request::POST_METHOD, $path, $action, $middlewares);
    }

    /**
     * @param string $path
     * @param mixed $action
     * @param array $middlewares
     * @return void
     */
    public static function put(string $path, mixed $action, array $middlewares = []): void
    {
        self::setRoute(Request::PUT_METHOD, $path, $action, $middlewares);
    }

    /**
     * @param string $path
     * @param mixed $action
     * @param array $middlewares
     * @return void
     */
    public static function path(string $path, mixed $action, array $middlewares = []): void
    {
        self::setRoute(Request::PATCH_METHOD, $path, $action, $middlewares);
    }

    /**
     * @param string $path
     * @param mixed $action
     * @param array $middlewares
     * @return void
     */
    public static function delete(string $path, mixed $action, array $middlewares = []): void
    {
        self::setRoute(Request::DELETE_METHOD, $path, $action, $middlewares);
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
        $basePath = Application::$ROOT_PATH;
        // Save the previous prefix.
        $previousPrefix = self::$prefix;
        // Merge the middlewares of the previous prefix with the current middlewares.
        if (isset(self::$middlewares[$previousPrefix])) {
            $middlewares = array_merge(self::$middlewares[$previousPrefix], $middlewares);
        }

        // Trim the prefix.
        $prefix = trim($prefix, '/');
        // Set the new prefix.
        self::$prefix .= "/$prefix";
        // Save the middlewares for the current prefix.
        self::$middlewares[self::$prefix] = $middlewares;
        // Call the callback to define the routes in the group.
        call_user_func($callback, $basePath);
        // Reset the prefix to the previous prefix.
        self::$prefix = $previousPrefix;
    }
}
