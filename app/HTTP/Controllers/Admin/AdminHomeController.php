<?php

namespace App\HTTP\Controllers\Admin;

use Lumin\Controller;

class AdminHomeController extends Controller
{
	public function index()
	{
		return $this->view('admin/overview', ['title' => 'Overview']);
	}
}
