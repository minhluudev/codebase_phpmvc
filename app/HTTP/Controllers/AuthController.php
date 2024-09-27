<?php

namespace App\HTTP\Controllers;

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

	public function register()
	{
		return $this->renderView('register', [
			'title' => 'Register'
		]);
	}
}