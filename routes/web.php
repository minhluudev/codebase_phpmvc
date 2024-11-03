<?php

use App\HTTP\Controllers\Admin\AdminHomeController;
use App\HTTP\Controllers\Web\AuthController;
use App\HTTP\Controllers\Web\HomeController;
use Lumin\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index']);
Route::get('login', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'register']);

Route::prefix('admin', function () {
	Route::get('/', [AdminHomeController::class, 'index']);
}, ['auth']);
