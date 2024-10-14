<?php

namespace App\Providers;

use Framework\Helper;
use Framework\Routing\Route;
use Framework\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Route::group(function () {
            include Helper::basePath("/routes/web.php");
        });
    }
}