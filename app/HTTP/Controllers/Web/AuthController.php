<?php

namespace App\HTTP\Controllers\Web;

use App\HTTP\Controllers\Controller;

class AuthController extends Controller {
    public function login() {
        return $this->view('login');
    }

    public function register() {
        return $this->view('register');
    }
}
