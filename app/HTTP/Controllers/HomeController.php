<?php

namespace App\HTTP\Controllers;

use Lumin\Controller;

class HomeController extends Controller {
    public function index() {
        return $this->view('home', ['title' => 'Welcome to Lumin']);
    }
}