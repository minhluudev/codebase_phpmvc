<?php

namespace App\Providers;

use Core\Routing\Route;
use Core\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Route::group('', function ($basePath) {
            include $basePath . "/routes/web.php";
        });

        Route::group('api', function ($basePath) {
            include $basePath . "/routes/api.php";
        });
    }
}