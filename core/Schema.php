<?php

namespace Core;

use Core\Schema\Blueprint;

class Schema
{
	public static array $sql;

	/**
	 * Use for create new table
	 * @param mixed $tableName
	 * @param mixed $callback
	 * @return void
	 */
	public static function create($tableName, $callback)
	{
		$table = new Blueprint();
		call_user_func($callback, $table);
		self::$sql[] = "CREATE TABLE $tableName (" . implode(',', $table->getColumns()) . ");";
	}

	/**
	 * Use for update table
	 * @param mixed $tableName
	 * @param mixed $callback
	 * @return void
	 */
	public static function table($tableName, $callback)
	{
		$table = new Blueprint();

		call_user_func($callback, $table);
	}

	/**
	 * Use for drop table
	 * @param mixed $table
	 * @return void
	 */
	public static function dropIfExists($table) {}
}
