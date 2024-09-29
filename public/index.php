<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Core\Application;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

/**
 * Create a application
 * @var mixed
 */
$app = new Application(dirname(__DIR__));
$app->run();
