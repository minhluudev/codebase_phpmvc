<?php

use App\HTTP\Controllers\HomeController;
use App\HTTP\Controllers\ProductsController;
use Core\Routing\Route;

Route::get('/', [HomeController::class, 'index']);

Route::group('product', function () {
	Route::get('/', [ProductsController::class, 'index']);
	Route::get(':id/detail', [ProductsController::class, 'show']);
});