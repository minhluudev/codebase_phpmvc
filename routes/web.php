<?php

use App\HTTP\Controllers\AuthController;
use App\HTTP\Controllers\HomeController;
use Core\Request;
use Core\Routing\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'register']);
Route::get('register/:id', function (Request $request, $id) {
	var_dump($request->all());
	echo '<br/>';
	echo $id;
});