<?php

namespace App\HTTP\Controllers\Web;

use App\HTTP\Controllers\Controller;
use App\HTTP\Requests\RegisterRequest;

class AuthController extends Controller {
    public function login() {
        return $this->view('login');
    }

    public function register(RegisterRequest $request) {
        if ($request->isPost()) {
            $request->validate();
            $errors = $request->getErrors();
            $data   = $request->all();

            return $this->view('register', ['errors' => $errors, 'data' => $data]);
        }

        return $this->view('register');
    }
}
