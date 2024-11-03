<?php

namespace App\HTTP\Controllers\Web;

use Lumin\Controller;

class HomeController extends Controller
{
	public function index()
	{
		return $this->view('web/home', ['title' => 'Welcome to Lumin']);
	}
}
