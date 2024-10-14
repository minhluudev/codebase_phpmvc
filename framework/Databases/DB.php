<?php

namespace Framework\Databases;

use Framework\Databases\Interfaces\DBInterface;
use Framework\Databases\Traits\MigrationTrait;
use Framework\Helper;
use Framework\Log;
use PDO;
use PDOException;


class DB implements DBInterface {
    use MigrationTrait;

    protected PDO $pdo;

    public function applyMigrations(): void {
        $this->connectToDatabase();
        $this->handleApplyMigrations($this->pdo);
    }

    public function connectToDatabase(): void {
        $config     = Helper::config('db');
        $drive      = $config['default'];
        $connection = $config['connections'][$drive];
        $host       = $connection['host'];
        $username   = $connection['username'];
        $password   = $connection['password'];
        $dbName     = $connection['db_name'];
        $port       = $connection['port'];
        Log::info('Connecting to the database');
        try {
            $this->pdo = new PDO("$drive:host=$host;port=$port;dbname=$dbName", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            Log::info('Connected to the database');
        } catch ( PDOException $e ) {
            Log::error($e->getMessage());
        }
    }

    public function rollbackMigrations(): void {
        $this->connectToDatabase();
        $this->handleRollbackMigrations($this->pdo);
    }
}