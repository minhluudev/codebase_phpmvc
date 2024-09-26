<?php

namespace Core;

class Request
{
	public function method()
	{
		return strtolower($_SERVER['REQUEST_METHOD']);
	}

	public function getPath()
	{
		return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
	}
}