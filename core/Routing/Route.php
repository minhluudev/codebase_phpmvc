<?php

namespace app\core\Routing;

use app\core\Request;

class Route implements RouteCollectionInterface
{
	/**
	 * An array of routes
	 * @var array
	 */
	public static array $routes = [];
	private static Request $request;
	private static string $groupName = '';
	public function __construct()
	{
		self::$request = new Request();
	}

	public static function get($path, $callback)
	{
		$newPath = self::$groupName  . $path;
		self::$routes['get'][$newPath] = $callback;
	}

	public static function post($path, $callback)
	{
		$newPath = self::$groupName . $path;
		self::$routes['post'][$newPath] = $callback;
	}

	public static function group($path, $callback)
	{
		$groupName = self::$groupName;
		self::$groupName .=  $path . '/';
		call_user_func(callback: $callback);
		self::$groupName = $groupName;
	}

	public static function resolve()
	{
		$method = self::$request->method();
		$path = self::$request->getPath();
		$callback = self::$routes[$method][$path];
		if (!$callback) {
			echo 404;
			exit;
		}

		if (is_string($callback)) {
		}

		if (is_array($callback)) {
		}

		call_user_func($callback);
	}
}