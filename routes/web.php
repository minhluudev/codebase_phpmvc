<?php

use App\HTTP\Controllers\ArticleController;
use App\HTTP\Controllers\AuthController;
use App\HTTP\Controllers\HomeController;
use Core\Request;
use Core\Routing\Route;

Route::get('/', [HomeController::class, 'index'], ['auth']);
Route::get('articles', [ArticleController::class, 'index']);
Route::get('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'register']);
Route::get('register/:id', function (Request $request, $id) {
    echo '<pre>';
    echo 'Register with id' . PHP_EOL;
    var_dump($request->all());
    echo $id;
    echo '</pre>';
});