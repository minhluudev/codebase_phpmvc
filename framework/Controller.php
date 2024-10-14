<?php

namespace Framework;

class Controller {
    public function view($view, $params = []): string {
        return View::render($view, $params);
    }
}