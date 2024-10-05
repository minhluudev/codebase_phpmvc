<?php

namespace App\HTTP\Controllers\Api;

use App\HTTP\Controllers\Controller;

class CategoryApiController extends Controller
{
    public function index(): false|string
    {
        $data = ['category' => 'CategoryApiController@index'];
        return $this->sendResponse($data);
    }
}