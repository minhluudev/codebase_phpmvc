<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Core\Application;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

$app = new Application(dirname(__DIR__));
try {
    $app->run();
} catch (ReflectionException $e) {
    echo $e->getMessage();
}
