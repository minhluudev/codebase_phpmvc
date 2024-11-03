<?php

namespace App\Providers;

use App\HTTP\Middlewares\AuthMiddleware;
use Lumin\ServiceProvider;

class MiddlewareProvider extends ServiceProvider
{
	protected array $services = ['middleware:auth' => AuthMiddleware::class,];
}
