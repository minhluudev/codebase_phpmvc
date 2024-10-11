<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Framework\App;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

try {
    $app = new App(dirname(__DIR__));
    $app->run();
} catch (Exception $e) {
    echo $e->getMessage();
}

