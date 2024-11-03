<?php

namespace App\HTTP\Controllers\Api;

use App\HTTP\Controllers\Controller;

class UserApiController extends Controller
{
	public function index()
	{
		return $this->sendResponse(['user' => ['id' => 1]]);
	}
}
