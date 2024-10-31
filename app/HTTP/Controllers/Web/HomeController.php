<?php

namespace App\HTTP\Controllers\Web;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Lumin\Controller;

class HomeController extends Controller {
    public function index() {
        echo "<pre>";
//        print_r($categories);
        echo "</pre>";
        return $this->view('home', ['title' => 'Home title']);
    }

    public function about() {
        return $this->view('about', ['title' => 'About title']);
    }
}