<?php

namespace Core;

use Exception;

class ServiceContainer
{
	private $services = [];

	public function set($name, $closure)
	{
		$this->services[$name] = $closure;
	}

	public function get($name)
	{
		if (!isset($this->services[$name])) {
			throw new Exception("Service not found.");
		}

		return $this->services[$name]($this);
	}
}
