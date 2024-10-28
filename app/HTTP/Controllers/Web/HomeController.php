<?php

namespace App\HTTP\Controllers\Web;

use App\Models\User;
use Framework\Controller;

class HomeController extends Controller {
    public function index() {
        return $this->view('home', ['title' => 'Home title']);
    }

    public function about() {
        return $this->view('about', ['title' => 'About title']);
    }
}