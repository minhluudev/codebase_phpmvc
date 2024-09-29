<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Core\Database;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

$database = new Database();
$database->rollbackMigrations();

