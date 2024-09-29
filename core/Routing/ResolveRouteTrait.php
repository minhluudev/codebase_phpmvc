<?php

namespace Core\Routing;

use Core\Application;
use Core\Helper;

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

		$dataMapped = self::mapRouteData($routes[$method], 	$path);

		if ($dataMapped) {
			$callback = $routes[$method][$dataMapped['path']];
			$args = $dataMapped['args'] ?? [];

			self::handleResolveWithNormalPath($callback, $args,);
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
		$params = Helper::getParametersTypeMethodOrFunction($callback[1], $callback[0]);
		$paramFirstType = $params[0];
		if (class_exists($paramFirstType)) {
			return new $paramFirstType();
		}

		return Application::$app->request;
	}

	private static function getRequestWithFunctionCallback($callback)
	{
		$params = Helper::getParametersTypeMethodOrFunction($callback);
		$paramFirstType = $params[0];
		if (class_exists($paramFirstType)) {
			return new $paramFirstType();
		}

		return Application::$app->request;
	}

	private static function mapRouteData($paths, $url): array|null
	{
		$args = false;
		$router = null;
		$arrUrlConverted = explode('/', $url);

		foreach ($paths as $path => $route) {
			$arrPathConverted = explode('/', $path);
			$args = self::getParams($arrUrlConverted, $arrPathConverted);
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

	private static function getParams($arrUrlConverted, $arrPathConverted)
	{
		if (count($arrUrlConverted) !== count($arrPathConverted)) return null;
		$params = [];
		$countSizePath = count($arrPathConverted);

		for ($i = 0; $i < $countSizePath; $i++) {
			if ($arrPathConverted[$i] === $arrUrlConverted[$i]) {
				continue;
			}

			if (self::hasColonVariableFormat($arrPathConverted[$i])) {
				$params[] = $arrUrlConverted[$i];
			} else {
				$params = [];
				break;
			}
		}

		return count($params) ? $params : null;
	}

	private static function hasColonVariableFormat($str)
	{
		return preg_match('/^:[a-zA-Z_][a-zA-Z0-9_]*$/', $str);
	}
}
