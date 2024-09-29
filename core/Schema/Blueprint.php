<?php

namespace Core\Schema;

class Blueprint
{
	private array $columns;

	public function __construct()
	{
		$this->columns = [];
	}

	public function getColumns()
	{
		return $this->columns;
	}

	public function id($name = 'id')
	{
		$this->columns[] = "`$name` INT NOT NULL AUTO_INCREMENT PRIMARY KEY";
	}
	public function string($name, $size = 255)
	{
		$this->columns[] = "`$name` VARCHAR($size)";

		return $this;
	}

	public function nullable($status = true)
	{
		$lastItem = array_pop($this->columns);

		if ($status) {
			$lastItem .= " NULL";
		} else {
			$lastItem .= " NOT NULL";
		}

		$this->columns[] = $lastItem;
	}
}
