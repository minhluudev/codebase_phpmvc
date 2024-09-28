<?php

namespace Core;

use ReflectionFunction;
use ReflectionMethod;

class Helper
{
	public static function getParametersTypeMethodOrFunction($method, $className = null): array
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