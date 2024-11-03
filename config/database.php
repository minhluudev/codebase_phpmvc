<?php


use Lumin\Helper;

return [
	'default'     => Helper::env('DB_CONNECTION', 'mysql'),
	'connections' => [
		'mysql' => [
			'host'     => Helper::env('DB_HOST', 'localhost'),
			'db_name'  => Helper::env('DB_NAME', ''),
			'username' => Helper::env('DB_USERNAME', ''),
			'password' => Helper::env('DB_PASSWORD', ''),
			'port'     => Helper::env('DB_PORT', ''),
		]
	]
];
