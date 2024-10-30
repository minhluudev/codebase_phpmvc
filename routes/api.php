<?php

use App\HTTP\Controllers\Api\CategoryApiController;
use Framework\Support\Facades\Route;

Route::get('category', [CategoryApiController::class, 'index']);
