<?php

use App\HTTP\Controllers\HomeController;
use Lumin\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index']);

