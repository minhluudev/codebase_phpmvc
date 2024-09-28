<?php

namespace App\HTTP\Controllers;

use App\HTTP\Requests\RegisterRequest;
use Core\Controller;

class AuthController extends Controller
{
	public function __construct()
	{
		$this->setViewLayout('auth');
	}
	public function login()
	{
		return $this->renderView('login', [
			'title' => 'Login'
		]);
	}

	public function register(RegisterRequest $request)
	{
		var_dump($request->all(['email']));
		return $this->renderView('register', [
			'title' => 'Register'
		]);
	}
}