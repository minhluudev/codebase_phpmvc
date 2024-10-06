<?php

namespace Core;

class Request
{
	public const GET_METHOD = 'get';
	public const POST_METHOD = 'post';
    public const PUT_METHOD = 'put';
    public const PATCH_METHOD = 'patch';
    public const DELETE_METHOD = 'delete';

	public function method(): string
	{
		return strtolower($_SERVER['REQUEST_METHOD']);
	}

	public function getPath(): string
    {
		if ($_SERVER['REQUEST_URI']  === '/')  return '/';
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        
		return "/$uri";
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

	public function isGet(): bool
	{
		return $this->method() === self::GET_METHOD;
	}

	public function isPost(): bool
	{
		return $this->method() === self::POST_METHOD;
	}
}