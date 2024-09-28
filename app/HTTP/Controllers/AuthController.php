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
		if ($request->isPost()) {
			$isValid = $request->validate();

			if ($isValid) {
				return $this->renderView('login', [
					'title' => 'Login'
				]);
			}
		}

		return $this->renderView('register', [
			'title' => 'Register',
			'model' => [
				'errors' => $request->getErrors(),
				'user' => $request->all()
			]
		]);
	}
}
