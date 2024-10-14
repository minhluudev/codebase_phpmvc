<?php

require_once __DIR__.'/../vendor/autoload.php';


use Dotenv\Dotenv;
use Framework\Databases\DB;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

$database = new DB();
$database->applyMigrations();

