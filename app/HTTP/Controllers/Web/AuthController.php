<?php

namespace App\HTTP\Controllers\Web;

use App\HTTP\Requests\LoginRequest;
use App\HTTP\Requests\RegisterRequest;
use App\Services\AuthService;
use Lumin\Controller;

class AuthController extends Controller
{
	private AuthService $authService;
	public function __construct(AuthService $authService)
	{
		$this->authService = $authService;
	}

	public function login(LoginRequest $request)
	{
		$error = null;

		if ($request->isPost()) {
			if ($request->validate()) {
				$data = $request->all();
				$result = $this->authService->handleLogin($data);
				if ($result) {
					header('Location: /admin');
				} else {
					$error = 'Username or password is invalid';
				}
			}
		}

		return $this->view('web/login', ['title' => 'Login', 'error' => $error]);
	}

	public function register(RegisterRequest $request)
	{
		$error = null;

		if ($request->isPost()) {
			if ($request->validate()) {
				$data = $request->all();
				$result = $this->authService->handleRegister($data);
				if ($result) {
					header('Location: /login?register=success');
				}
			} else {
				$error = $request->getErrors();
			}
		}

		return $this->view('web/register', ['title' => 'Register', 'error' => $error]);
	}
}
