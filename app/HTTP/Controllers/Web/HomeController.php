<?php

namespace App\HTTP\Controllers\Web;

use App\Services\BlogCategoryService;
use App\Services\BlogPostService;
use App\Services\ProductService;

class HomeController
{

    public function index()
    {
        return view('home', ['title' => 'Home title']);
    }
}