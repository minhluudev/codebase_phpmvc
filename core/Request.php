<?php

namespace Core;

class Request
{
	public function method(): string
	{
		return strtolower($_SERVER['REQUEST_METHOD']);
	}

	public function getPath()
	{
		if ($_SERVER['REQUEST_URI']  === '/')  return '';

		return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
	}

	public function all($args = []): array
	{
		$method = $this->method();
		$body = $method === 'get' ? $_GET : $_POST;

		if (!count($args)) return $body;

		$result = [];

		foreach ($args as $attribute) {
			if (isset($body[$attribute])) {
				$result[$attribute] = $body[$attribute];
			}
		}

		return $result;
	}
}