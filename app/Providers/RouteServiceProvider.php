<?php

namespace App\Providers;

use Framework\Helper;
use Framework\ServiceProvider;
use Framework\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {
    public function register(): void {
        Route::group(function () {
            include Helper::basePath("/routes/web.php");
        });

        Route::prefix('api', function () {
            include Helper::basePath("/routes/api.php");
        });

    }
}