<?php

namespace App\HTTP\Middlewares;

use Lumin\Middleware;

class AuthMiddleware extends Middleware
{
	public function handle(): void
	{
		$user = $_SESSION['user'];

		if (!$user) {
			header('Location: /login?authentication=false');
			exit;
		}
	}
}
