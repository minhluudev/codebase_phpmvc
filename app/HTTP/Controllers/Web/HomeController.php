<?php

namespace App\HTTP\Controllers\Web;

use App\HTTP\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return $this->renderView('web/home', [
            'title' => 'Home'
        ]);
    }
}