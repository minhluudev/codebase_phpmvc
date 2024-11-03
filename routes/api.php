<?php

use App\HTTP\Controllers\Api\UserApiController;
use Lumin\Support\Facades\Route;

Route::get('user', [UserApiController::class, 'index']);
