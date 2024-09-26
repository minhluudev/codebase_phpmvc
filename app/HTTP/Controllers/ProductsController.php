<?php

namespace App\HTTP\Controllers;

class ProductsController
{
	public function index()
	{
		echo 'Product list';
	}

	public function show($id)
	{
		echo "Product detail: $id";
	}
}