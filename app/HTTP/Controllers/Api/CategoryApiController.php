<?php

namespace App\HTTP\Controllers\Api;

class CategoryApiController extends ApiController {
    public function index() {
        $data = ['category' => 'CategoryApiController@index'];

        return $this->sendResponse($data);
    }
}