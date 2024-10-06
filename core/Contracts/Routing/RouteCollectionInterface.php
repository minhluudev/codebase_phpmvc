<?php

namespace Core\Contracts\Routing;

interface RouteCollectionInterface
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
    public static function get(string $path, mixed $action, array $middlewares = []): void;

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
    public static function post(string $path, mixed $action, array $middlewares = []): void;

    /**
     * Define a PUT route.
     *
     * This method registers a PUT route with the specified path and action.
     * Optionally, middlewares can be applied to the route.
     *
     * @param string $path The route path.
     * @param mixed $action The action to be executed when the route is matched.
     * @param array $middlewares Optional middlewares to be applied to the route.
     *
     * @return void
     */
    public static function put(string $path, mixed $action, array $middlewares = []): void;

    /**
     * Define a PATCH route.
     *
     * This method registers a PATCH route with the specified path and action.
     * Optionally, middlewares can be applied to the route.
     *
     * @param string $path The route path.
     * @param mixed $action The action to be executed when the route is matched.
     * @param array $middlewares Optional middlewares to be applied to the route.
     *
     * @return void
     */
    public static function path(string $path, mixed $action, array $middlewares = []): void;

    /**
     * Define a DELETE route.
     *
     * This method registers a DELETE route with the specified path and action.
     * Optionally, middlewares can be applied to the route.
     *
     * @param string $path The route path.
     * @param mixed $action The action to be executed when the route is matched.
     * @param array $middlewares Optional middlewares to be applied to the route.
     *
     * @return void
     */
    public static function delete(string $path, mixed $action, array $middlewares = []): void;

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
    public static function group(string $prefix, mixed $callback, array $middlewares = []): void;
}
