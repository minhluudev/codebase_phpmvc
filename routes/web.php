<?php

use App\HTTP\Controllers\Admin\OverviewController;
use App\HTTP\Controllers\Web\AuthController;
use App\HTTP\Controllers\Web\HomeController;
use Framework\Support\Facades\Route;


//// Web routes
//Route::get('/', [HomeController::class, 'index']);
//Route::get('login', [AuthController::class, 'login']);
////Route::post('login', [AuthController::class, 'handleLogin']);
//Route::get('register', [AuthController::class, 'register']);
////Route::post('register', [AuthController::class, 'register']);
//
//// Admin routes


Route::get('/', [HomeController::class, 'index']);
Route::get('about', [HomeController::class, 'about']);
Route::get('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'register']);
Route::get('product/:id/detail', function ($id) {
    echo 'Product detail page: '.$id;
});

Route::prefix('admin', function () {
    Route::get('/', [OverviewController::class, 'index']);
}, ['auth']);

