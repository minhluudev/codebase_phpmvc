<?php

namespace Framework\Schemas;

use Core\Schema\Blueprint;
use Framework\Schemas\Interfaces\SchemaInterface;

class Schema implements SchemaInterface {
    public static array $sql;

    /**
     * Create a new table with the specified columns.
     *
     * @param  string  $tableName  The name of the table to create.
     * @param  mixed   $callback  A callback function that defines the columns of the table.
     *
     * @return void
     */
    public static function create(string $tableName, mixed $callback): void {
        $table = new Blueprint();
        call_user_func($callback, $table);
        self::$sql[] = "CREATE TABLE `$tableName` (".implode(',', $table->getColumns()).");";
    }

    /**
     * Update an existing table with the specified columns.
     *
     * @param  string  $tableName  The name of the table to update.
     * @param  mixed   $callback  A callback function that defines the columns to add to the table.
     *
     * @return void
     */
    public static function table(string $tableName, mixed $callback): void {
        $table = new Blueprint();
        call_user_func($callback, $table);
    }

    /**
     * Drop the specified table if it exists.
     *
     * @param  string  $table  The name of the table to drop.
     *
     * @return void
     */
    public static function dropIfExists(string $table): void {
        self::$sql[] = "DROP TABLE IF EXISTS `$table`;";
    }
}
