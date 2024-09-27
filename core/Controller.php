<?php

namespace Core;

class Controller
{
	public function renderView($path, $params = [])
	{
		return Application::$app->response->view($path, $params);
	}

	public function setViewLayout($layout)
	{
		Application::$app->response->setLayout($layout);
	}
}