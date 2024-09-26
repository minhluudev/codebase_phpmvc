<?php

namespace app\core\Routing;

interface RouteCollectionInterface
{
	/**
	 * Get method in router
	 * @param mixed $path
	 * @param mixed $callback
	 * @return void
	 */
	public static function get($path, $callback);

	/**
	 * Post method in router
	 * @param mixed $path
	 * @param mixed $callback
	 * @return void
	 */
	public static function post($path, $callback);


	/**
	 * Group path url
	 * @param mixed $path
	 * @param mixed $callback
	 * @return void
	 */
	public static function group($path, $callback);

	/**
	 * Resolve request
	 * @return void
	 */
	public static function resolve();
}