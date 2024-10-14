<?php

use App\HTTP\Controllers\Web\HomeController;
use Framework\Routing\Route;


//// Web routes
//Route::get('/', [HomeController::class, 'index']);
//Route::get('login', [AuthController::class, 'login']);
////Route::post('login', [AuthController::class, 'handleLogin']);
//Route::get('register', [AuthController::class, 'register']);
////Route::post('register', [AuthController::class, 'register']);
//
//// Admin routes
//Route::prefix('admin', function () {
//    Route::get('/', [OverviewController::class, 'index']);
//}, ['auth']);

Route::get('/', [HomeController::class, 'index']);
Route::get('about', function () {
    echo 'About page';
});

Route::get('product/:id/detail', function ($id) {
    echo 'Product detail page: '. $id;
});