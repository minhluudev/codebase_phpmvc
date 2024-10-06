<?php

namespace App\HTTP\Middlewares;

use Core\Middleware;

class AuthMiddleware extends Middleware
{
    /**
     * @return void
     */
    public function handle(): void
    {
        $user = $this->getSession('user');
        if (!$user['value']) {
            header('Location: /login');
            exit;
        }
    }
}