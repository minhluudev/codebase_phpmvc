<?php

namespace Core;

use Core\Application;

class ViewResponse
{
	private string $layout = 'main';

	public function setLayout($path)
	{
		$this->layout = $path;
	}

	public function view($path, $params = [])
	{
		if (!$this->hasLayout()) {
			return include_once Application::$ROOT_PATH . "/app/Views/$path.php";
		}

		$layoutContent = $this->renderLayout($params);
		$viewContent = $this->renderViewOnly($path, $params);

		return str_replace('{{content}}', $viewContent, $layoutContent);
	}

	public function viewNotFound()
	{
		$this->setLayout('error');
		return $this->view('_404');
	}

	private function hasLayout()
	{
		return file_exists(Application::$ROOT_PATH . "/app/Views/layouts/" . $this->layout . ".php");
	}

	private function renderLayout($params)
	{
		foreach ($params as $key => $value) {
			$$key = $value;
		}

		ob_start();
		include_once Application::$ROOT_PATH . "/app/Views/layouts/" . $this->layout . ".php";
		return ob_get_clean();
	}

	private function renderViewOnly($pathName, $params)
	{
		foreach ($params as $key => $value) {
			$$key = $value;
		}

		ob_start();
		include_once Application::$ROOT_PATH . "/app/Views/$pathName.php";
		return ob_get_clean();
	}
}