<?php

namespace Core\Routing;

use Core\Application;
use Exception;
use ReflectionException;
use ReflectionFunction;
use ReflectionMethod;

/**
 * Class ResolveRoute
 *
 * This class is responsible for resolving the route.
 *
 * @package Core\Routing
 */
class ResolveRoute
{
    /**
     * The routes defined in the application.
     *
     * @var array
     */
    protected static array $routes = [];
    /**
     * The route prefix.
     *
     * @var string
     */
    protected static string $prefix = '';
    /**
     * The middlewares defined in the application.
     *
     * @var array
     */
    protected static array $middlewares = [];
    /**
     * The request method.
     *
     * @var string
     */
    private static string $method = '';
    /**
     * The request path.
     *
     * @var string
     */
    private static string $path = '';

    public function __construct()
    {
        $request = Application::$app->request;
        self::$method = $request->method();
        self::$path = $request->getPath();
    }

    /**
     * Resolve the route.
     *
     * This method resolves the route based on the request method and path.
     * If the route is not found, a 404 view is returned.
     *
     * @return void
     * @throws ReflectionException
     */
    public static function resolve(): void
    {
        $routes = self::$routes;
        $route = $routes[self::$method][self::$path] ?? null;

        if (!$route) {
            self::handleResolvePathWithParams();
        } else {
            self::handleResolveWithNormalPath($route);
        }
    }

    /**
     * Example handle path: /posts/:id, /posts/:id/edit, /categories/:categoryId/posts/:postId
     * It will match the path with the params.
     * If the path is not found, a 404 view is returned.
     * If the path is found, the callback is executed.
     *
     * @throws ReflectionException
     */
    private static function handleResolvePathWithParams(): void
    {
        $routes = self::$routes;
        $method = self::$method;
        $path = self::$path;

        $dataMatched = self::matchRouteData($routes[$method], $path);
        if ($dataMatched) {
            $callback = $routes[$method][$dataMatched['path']];
            $args = $dataMatched['args'] ?? [];
            self::handleResolveWithNormalPath($callback, $args);
        } else {
            echo Application::$app->response->viewNotFound();
        }
    }

    /**
     * Match the route data with the path.
     *
     * This method matches the route data with the path.
     * If the route data is found, it returns the route data.
     *
     * @param array $paths The paths to match.
     * @param string $url The URL to match.
     *
     * @return array|null
     */
    private static function matchRouteData(array $paths, string $url): array|null
    {
        $args = false;
        $router = null;

        foreach ($paths as $path => $route) {
            $args = self::argsMatched($url, $path);
            if ($args) {
                $router = $path;
                break;
            }
        }

        return $args && $router ? ['path' => $router, 'args' => $args] : null;
    }

    /**
     * Match the args with the path.
     *
     * This method matches the args with the path.
     * If the args are found, it returns the args.
     *
     * @param string $url The URL to match.
     * @param string $patch The path to match.
     *
     * @return array|null
     */
    private static function argsMatched(string $url, string $patch): ?array
    {
        $args = null;
        $pattern = self::convertToPattern($patch);

        if (preg_match($pattern, $url, $matches)) {
            $args = $matches;
            array_shift($args);
        }

        return $args;
    }

    /**
     * Convert the route to a pattern.
     *
     * This method converts the route to a pattern.
     *
     * @param string $route The route to convert.
     *
     * @return string
     */
    private static function convertToPattern(string $route): string
    {
        $pattern = preg_replace('/(:\w+)/', '(\d+)', $route);

        return '/^' . str_replace('/', '\/', $pattern) . '\/?(\/)?$/';
    }

    /**
     * @throws ReflectionException
     */
    private static function handleResolveWithNormalPath($route, $args = []): void
    {
        $callback = $route['action'];

        if (is_string($callback)) {
            echo Application::$app->response->viewNotFound();
            exit;
        }

        if (is_array($callback)) {
            $request = self::getRequestWithMethodCallback($callback);
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        } else {
            $request = self::getRequestWithFunctionCallback($callback);
        }

        self::handleMiddleware($route['middlewares']);

        echo call_user_func($callback, $request, ...$args);
    }

    /**
     * @throws ReflectionException
     */
    private static function getRequestWithMethodCallback($callback)
    {
        $params = self::getParametersTypeMethodOrFunction($callback[1], $callback[0]);
        $paramFirstType = $params[0] ?? null;
        if ($paramFirstType && class_exists($paramFirstType)) {
            return new $paramFirstType();
        }

        return Application::$app->request;
    }

    /**
     * @throws ReflectionException
     */
    private static function getParametersTypeMethodOrFunction($method, $className = null): array
    {
        $paramTypes = [];

        if ($className) {
            $reflection = new ReflectionMethod($className, $method);
        } else {
            $reflection = new ReflectionFunction($method);
        }

        $params = $reflection->getParameters();
        foreach ($params as $param) {
            $type = $param->getType();

            if ($type !== null) {
                $paramTypes[] = $type->getName();
            }
        }

        return $paramTypes;
    }

    /**
     * @throws ReflectionException
     */
    private static function getRequestWithFunctionCallback($callback)
    {
        $params = self::getParametersTypeMethodOrFunction($callback);
        $paramFirstType = $params[0] ?? null;
        if ($paramFirstType && class_exists($paramFirstType)) {
            return new $paramFirstType();
        }

        return Application::$app->request;
    }

    /**
     * Handle the middleware.
     *
     * This method handles the middleware.
     *
     * @param array $middlewares The middlewares to handle.
     *
     * @return void
     */
    private static function handleMiddleware(array $middlewares): void
    {
        $serviceContainer = Application::$app->container;

        foreach ($middlewares as $middleware) {
            try {
                $serviceContainer->get("middleware:$middleware");
            } catch (Exception $e) {
                echo $e->getMessage();
                exit;
            }
        }
    }
}
