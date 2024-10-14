<?php

namespace Framework\Requests;

use Framework\Requests\Interfaces\RequestInterface;

class Request implements RequestInterface {
    /**
     * Get the HTTP request method.
     *
     * This method retrieves the HTTP request method used for the current request.
     * It returns the method in uppercase format.
     *
     * @return string The HTTP request method in uppercase.
     */
    public function method(): string {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Get the URI of the request.
     *
     * This method retrieves the URI of the current request. It returns the URI
     * in string format.
     *
     * @return string The URI of the request.
     */
    public function uri(): string {
        if ($_SERVER['REQUEST_URI'] === '/') {
            return '/';
        }

        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }
}