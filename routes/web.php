<?php

use app\core\Routing\Route;


Route::group('product', function () {
	Route::get('list', function () {});

	Route::get(':id', function ($id) {
		echo "Product detail: " . $id;
	});
});