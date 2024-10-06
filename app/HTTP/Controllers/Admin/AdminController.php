<?php

namespace App\HTTP\Controllers\Admin;

use App\HTTP\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->setViewLayout('admin');
    }
}