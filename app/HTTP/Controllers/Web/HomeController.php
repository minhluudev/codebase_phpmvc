<?php

namespace App\HTTP\Controllers\Web;

use Framework\Controller;
use Framework\Log\LogManager;
use Framework\Support\Facades\Log;

class HomeController extends Controller {
    public function index() {
        return $this->view('home', ['title' => 'Home title']);
    }

    public function about() {
        return $this->view('about', ['title' => 'About title']);
    }
}