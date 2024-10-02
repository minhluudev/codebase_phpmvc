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

	public function timestamps()
	{
		$this->columns[] = "`created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP";
		$this->columns[] = "`updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP";

	}

	public function softDeletes() {
		$this->columns[] = "`deleted_at` TIMESTAMP NULL";
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

	public function unique()
	{
		$lastItem = array_pop($this->columns);
		$lastItem .= " UNIQUE";
		$this->columns[] = $lastItem;
		
		return $this;
	}
}
