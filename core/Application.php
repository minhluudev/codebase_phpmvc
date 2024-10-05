<?php

namespace Core;

use Core\Routing\Route;
use ReflectionException;

class Application
{
    public static string $ROOT_PATH;
    public static Application $app;
    public Route $route;
    public Response $response;
    public Request $request;
    public Controller $controller;
    public ServiceContainer $container;

    public function __construct($rootPath)
    {
        self::$app = $this;
        self::$ROOT_PATH = $rootPath;
        $this->response = new Response();
        $this->request = new Request();
        $this->route = new Route();
        $this->container = new ServiceContainer();
    }

    /**
     * @throws ReflectionException
     */
    public function run(): void
    {
        $this->registerServiceProviders();
        include_once self::$ROOT_PATH . "/routes/web.php";
        $this->route::resolve();
    }

    public function registerServiceProviders(): void
    {
        $config = include_once self::$ROOT_PATH . '/config/app.php';
        $providers = $config['providers'];

        foreach ($providers as $provider) {
            new $provider();
        }
    }
}