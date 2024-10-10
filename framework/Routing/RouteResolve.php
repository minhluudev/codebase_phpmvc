<?php

namespace Framework\Routing;

use Exception;
use Framework\App;
use Framework\Routing\Interfaces\RouteResolveInterface;

class RouteResolve implements RouteResolveInterface
{
    public const GET = 'GET';
    public const POST = 'POST';
    public const PUT = 'PUT';
    public const DELETE = 'DELETE';
    protected static string $prefix = '';
    protected static array $routes = [];
    protected static array $middlewares = [];

    /**
     * Map the path and middleware.
     *
     * This method takes a request method, a path, an action, and an array of
     * middlewares, and maps them to the routes array.
     *
     * @param string $method The request method.
     * @param string $path The path to map.
     * @param mixed $action The action to map.
     * @param array $middlewares The middlewares to map.
     *
     * @return void
     */
    public static function mapPathAndMiddleware(string $method, string $path, mixed $action, array $middlewares = []): void
    {
        $path = trim($path, '/');
        $path = self::$prefix . "/$path";
        $path = $path === '/' ? $path : trim($path, '/');
        $middlewares = array_merge(self::$middlewares[self::$prefix] ?? [], $middlewares);
        self::$routes[$method][$path] = ['action' => $action, 'middlewares' => $middlewares];
    }

    /**
     * Resolve the route.
     *
     * This method resolves the route by checking the request method and the
     * routes defined in the application. It then calls the appropriate method
     * to resolve the route.
     *
     * @return void
     * @throws Exception
     */
    public function resolve(): void
    {
        $method = App::$app->request->method();
        $routes = self::$routes[$method];
        if (!$routes) {
            throw new Exception('Route not found');
        }

        $this->resolveRoute($routes);
    }

    /**
     * Resolve the route.
     *
     * This method takes an array of routes and resolves the route. It checks
     * if the route is a normal path or a regex path and calls the appropriate
     * method to resolve the route.
     *
     * @param array $routes The routes to resolve.
     *
     * @return void
     */
    private function resolveRoute(array $routes): void
    {
        $uri = App::$app->request->uri();

        if (isset($routes[$uri])) {
            $this->resolveWithNormalPath($routes[$uri]);
        } else {
            $this->resolveWithRegexPath($routes);
        }
    }

    /**
     * Resolve the route with a normal path.
     *
     * This method takes a route and resolves it with a normal path. It calls
     * the action of the route and passes the arguments to it.
     *
     * @param array $route The route to resolve.
     * @param array $args The arguments to pass to the action.
     *
     * @return void
     */
    private function resolveWithNormalPath(array $route, array $args = []): void
    {
        $action = $route['action'];
        $middlewares = $route['middlewares'];
        // TODO: handle middlewares
        if (is_array($action)) {
            $action[0] = new $action[0];
        }

        call_user_func($action, ...$args);
    }

    /**
     * Resolve the route with a regex path.
     *
     * This method takes an array of routes and resolves the route with a regex
     * path. It matches the URL against the route patterns and extracts the
     * arguments from the URL.
     *
     * @param array $routes The routes to resolve.
     *
     * @return void
     */
    private function resolveWithRegexPath(array $routes): void
    {
        $uri = App::$app->request->uri();

        $dataMatched = $this->matchRouteData($routes, $uri);

        if ($dataMatched) {
            $action = $routes[$dataMatched['path']];
            $args = $dataMatched['args'] ?? [];
            $this->resolveWithNormalPath($action, $args);
        } else {
            echo '404';
        }
    }

    /**
     * Match the URL against the route patterns.
     *
     * This method takes a URL and an array of route patterns, and matches the
     * URL against these patterns. If the URL matches a pattern, it extracts
     * the arguments from the URL.
     *
     * @param array $paths The route patterns to match against.
     * @param string $url The URL to match.
     *
     * @return array|null The matched route data if the URL matches a pattern, null otherwise.
     */
    private function matchRouteData(array $paths, string $url): array|null
    {
        $args = false;
        $router = null;

        foreach ($paths as $path => $route) {
            $args = $this->argsMatched($url, $path);
            if ($args) {
                $router = $path;
                break;
            }
        }

        return $args && $router ? ['path' => $router, 'args' => $args] : null;
    }

    /**
     * Match the URL against the route pattern and extract arguments.
     *
     * This method takes a URL and a route pattern, converts the route pattern
     * to a regex pattern, and matches the URL against this pattern. If the URL
     * matches the pattern, it extracts the arguments from the URL.
     *
     * @param string $url The URL to match.
     * @param string $patch The route pattern to match against.
     *
     * @return array|null The extracted arguments if the URL matches the pattern, null otherwise.
     */
    private function argsMatched(string $url, string $patch): ?array
    {
        $args = null;
        $pattern = $this->convertPathToPattern($patch);

        if (preg_match($pattern, $url, $matches)) {
            $args = $matches;
            array_shift($args);
        }

        return $args;
    }

    /**
     * Convert a route path to a regex pattern.
     *
     * This method takes a route path and converts it into a regex pattern
     * that can be used to match URLs. It replaces any route parameters
     * (denoted by a colon followed by a word, e.g., `:id`) with a regex
     * pattern that matches any word character.
     *
     * @param string $route The route path to convert.
     *
     * @return string The regex pattern.
     */
    private function convertPathToPattern(string $route): string
    {
        $pattern = preg_replace('/(:\w+)/', '(\w+)', $route);

        return '/^' . str_replace('/', '\/', $pattern) . '\/?(\/)?$/';
    }
}