<?php

namespace Core;

class Helper
{
	public static function env($name, $default = '')
	{
		return isset($_ENV[$name]) ? $_ENV[$name] : $default;
	}

	public static function config($name)
	{
		$config = [
			'db' => include_once __DIR__ . '/../config/database.php'
		];

		return isset($config[$name]) ? $config[$name] : null;
	}

	public static function convertToSnakeCaseAndPlural($input)
	{
		$snake_case = preg_replace('/(?<!^)[A-Z]/', '_$0', $input);
		$snake_case = strtolower($snake_case);

		if (substr($snake_case, -1) === 'y') {
			$snake_case = substr($snake_case, 0, -1) . 'ies';
		} elseif (substr($snake_case, -1) !== 's') {
			$snake_case .= 's';
		}

		return $snake_case;
	}
}
