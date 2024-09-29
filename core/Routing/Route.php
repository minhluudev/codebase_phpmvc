<?php

namespace Core\Routing;

use Core\Request;

class Route implements RouteCollectionInterface
{
	use ResolveRouteTrait;

	public static array $routes = [];
	private static Request $request;
	private static string $groupName = '';
	public function __construct(Request $request)
	{
		self::$request = $request;
	}

	public static function get($path, $callback)
	{
		$pathConvert = trim(self::$groupName  . $path, '/');
		self::$routes[self::$request::GET_METHOD][$pathConvert] = $callback;
	}

	public static function post($path, $callback)
	{
		$pathConvert = trim(self::$groupName  . $path, '/');
		self::$routes[self::$request::POST_METHOD][$pathConvert] = $callback;
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
		self::handleResolveRoute(self::$routes);
	}
}
