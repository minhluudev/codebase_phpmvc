<?php

namespace Core\Routing;

use Core\Application;
use ReflectionFunction;
use ReflectionMethod;

trait ResolveRouteTrait
{
	public static function handleResolveRoute($routes)
	{
		$request = Application::$app->request;
		$method = $request->method();
		$path = $request->getPath();
		$callback = $routes[$method][$path];

		if (!$callback) {
			self::handleResolvePathWithParams($routes);
		} else {
			self::handleResolveWithNormalPath($callback);
		}
	}

	private static function handleResolvePathWithParams($routes)
	{
		$request = Application::$app->request;
		$method = $request->method();
		$path = $request->getPath();

		$dataMatched = self::matchRouteData($routes[$method], $path);
		if ($dataMatched) {
			$callback = $routes[$method][$dataMatched['path']];
			$args = $dataMatched['args'] ?? [];
			self::handleResolveWithNormalPath($callback, $args);
		} else {
			echo Application::$app->response->viewNotFound();
		}
	}

	private static function handleResolveWithNormalPath($callback, $args = [])
	{
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

		echo call_user_func($callback, $request, ...$args);
	}

	private static function getRequestWithMethodCallback($callback)
	{
		$params = self::getParametersTypeMethodOrFunction($callback[1], $callback[0]);
		$paramFirstType = isset($params[0]) ? $params[0] : null;
		if ($paramFirstType && class_exists($paramFirstType)) {
			return new $paramFirstType();
		}

		return Application::$app->request;
	}

	private static function getRequestWithFunctionCallback($callback)
	{
		$params = self::getParametersTypeMethodOrFunction($callback);
		$paramFirstType = isset($params[0]) ? $params[0] : null;
		if ($paramFirstType && class_exists($paramFirstType)) {
			return new $paramFirstType();
		}

		return Application::$app->request;
	}

	private static function matchRouteData($paths, $url): array|null
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

		return $args && $router ? [
			'path' => $router,
			'args' => $args
		] : null;
	}

	private static function argsMatched($url, $patch)
	{
		$args = null;
		$pattern = self::convertToPattern($patch);

		if (preg_match($pattern, $url, $matches)) {
			$args = $matches;
			array_shift($args);
		}

		return $args;
	}

	private static function convertToPattern($route)
	{
		$pattern = preg_replace('/(:\w+)/', '(\d+)', $route);
		$pattern = '/^' . str_replace('/', '\/', $pattern) . '\/?(\/)?$/';

		return $pattern;
	}

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
}
