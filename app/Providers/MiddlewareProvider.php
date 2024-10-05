<?php

namespace App\Providers;

use App\HTTP\Middlewares\AuthMiddleware;
use Core\ServiceProvider;

class MiddlewareProvider extends ServiceProvider
{
    protected array $services = [
        'middleware:auth' => AuthMiddleware::class,
    ];
}