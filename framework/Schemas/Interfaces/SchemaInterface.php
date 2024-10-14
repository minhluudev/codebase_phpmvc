<?php

namespace Framework\Schemas\Interfaces;

interface SchemaInterface {
    public static function create(string $tableName, mixed $callback): void;

    public static function table(string $tableName, mixed $callback): void;

    public static function dropIfExists(string $table): void;
}