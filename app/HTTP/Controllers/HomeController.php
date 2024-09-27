<?php

namespace App\HTTP\Controllers;

use Core\Controller;


class HomeController extends Controller
{
	public function index()
	{
		return $this->renderView('home', [
			'title' => 'Home'
		]);
	}
}