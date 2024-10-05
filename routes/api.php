<?php

use App\HTTP\Controllers\Api\CategoryApiController;
use Core\Routing\Route;

Route::get('', [CategoryApiController::class, 'index'], ['auth']);
