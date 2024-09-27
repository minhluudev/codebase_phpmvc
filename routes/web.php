<?php

use App\HTTP\Controllers\AuthController;
use App\HTTP\Controllers\HomeController;
use Core\Routing\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'register']);