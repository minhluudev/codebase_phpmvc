<?php

namespace App\HTTP\Controllers\Web;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Framework\Controller;

class HomeController extends Controller {
    public function index() {
//        $categories = Category::select(['categories.id','categories.name'])->with('articles', ['id','title'])->get();
//        $articles = Article::with('category', ['id', 'name'])->get();
        echo "<pre>";
//        print_r($categories);
        echo "</pre>";
        return $this->view('home', ['title' => 'Home title']);
    }

    public function about() {
        return $this->view('about', ['title' => 'About title']);
    }
}