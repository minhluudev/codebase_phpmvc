<?php

namespace App\HTTP\Controllers\Web;

use App\HTTP\Requests\LoginRequest;
use App\HTTP\Requests\RegisterRequest;
use App\Models\User;
use Core\Controller;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->setViewLayout('auth');
    }

    public function login()
    {
        return $this->renderView('web/login', ['title' => 'Login']);
    }

    public function handleLogin(LoginRequest $request)
    {
        $isValid = $request->validate();
        if ($isValid) {
            $user = $request->all(['email', 'password']);

            $this->setSession('user', $user);
            header('Location: /admin');
            exit;
        }

        return $this->renderView('web/login', ['title' => 'Login']);
    }

    public function register(RegisterRequest $request)
    {
        if ($request->isPost()) {
            $isValid = $request->validate();

            if ($isValid) {
                $userModel = new User();
                $user = $request->all(['full_name', 'email', 'password']);
                $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
                $userModel->insert($user);

                return true;
            }
        }

        return $this->renderView('web/register', ['title' => 'Register', 'model' => ['errors' => $request->getErrors(), 'user' => $request->all()]]);
    }
}
