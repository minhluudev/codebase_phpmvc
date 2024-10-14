<?php

namespace App\HTTP\Controllers\Web;

use Framework\Controller;

class HomeController extends Controller {
    public function index() {
        return $this->view('home', ['title' => 'Home title']);
    }
}