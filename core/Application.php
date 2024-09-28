<?php

namespace Core;

use Core\Routing\Route;

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
		$this->route = new Route($this->request);
		$this->container = new ServiceContainer();
	}

	public function run()
	{
		include_once self::$ROOT_PATH . "/routes/web.php";
		$this->route::resolve();
	}
}