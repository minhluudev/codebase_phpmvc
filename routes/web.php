<?php

use App\HTTP\Controllers\ProductsController;
use Core\Routing\Route;


Route::group('product', function () {
	Route::get('list', [ProductsController::class, 'index']);
	Route::get(':id/detail', [ProductsController::class, 'show']);
});