<?php

namespace Core;

abstract class Middleware
{
    public function __construct()
    {
        $this->handle();
    }

    /**
     * Handle the middleware for the route.
     *
     * @return void
     */
    abstract public function handle(): void;
}