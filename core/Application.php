<?php

namespace Core;

use Core\Routing\Route;

class Application
{
	public static string $ROOT_PATH;
	public Route $route;
	public Request $request;
	public function __construct($rootPath)
	{
		self::$ROOT_PATH = $rootPath;
		$this->request = new Request();
		$this->route = new Route($this->request);
	}

	public function run()
	{
		include_once self::$ROOT_PATH . "/routes/web.php";
		$this->route::resolve();
	}
}
