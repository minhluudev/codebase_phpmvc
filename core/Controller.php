<?php

namespace Core;


class Controller
{
    public function renderView($path, $params = [])
    {
        return Application::$app->response->view($path, $params);
    }

    public function setViewLayout($layout): void
    {
        Application::$app->response->setLayout($layout);
    }

    public function renderJson($data, $code = Response::HTTP_OK): false|string
    {
        return Response::json($data, $code);
    }
}