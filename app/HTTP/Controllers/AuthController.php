<?php

namespace App\HTTP\Controllers;

use App\HTTP\Requests\RegisterRequest;
use App\Models\User;
use Core\Controller;
use Core\Database;

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
				$userModel = new User();
				$user = $userModel->insert($request->all(['full_name', 'email', 'password']));
				var_dump($user);
				return true;
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
