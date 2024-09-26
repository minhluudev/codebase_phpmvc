<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Core\Application;

/**
 * Create a application
 * @var mixed
 */
$app = new Application(dirname(__DIR__));
echo '<pre>';
$app->run();
echo '</pre>';