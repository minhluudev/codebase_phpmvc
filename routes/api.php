<?php

use App\HTTP\Controllers\Api\CategoryApiController;
use Lumin\Support\Facades\Route;

Route::get('category', [CategoryApiController::class, 'index']);
