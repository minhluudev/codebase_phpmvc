<?php

namespace App\HTTP\Controllers;


class HomeController extends Controller
{
	public function index()
	{
		return $this->view('home', [
			'title' => 'Home',
			'content' => 'Home page 1'
		]);
	}
}