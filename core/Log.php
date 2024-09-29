<?php

namespace Core;

class Log
{
	private static function fileWrite($content)
	{
		$fileName = date('Y-m-d') . '.log';
		$filePath = Application::$ROOT_PATH . "/logs/$fileName";

		if (!file_exists($filePath)) {
			$file = fopen($filePath, 'w');
			if ($file) {
				fwrite($file, $content);
				fclose($file);
			}
		} else {
			$file = fopen($filePath, 'a');
			if ($file) {
				fwrite($file, $content);
				fclose($file);
			}
		}
	}

	public static function info($message)
	{
		$content = "[" . date('Y-m-d H:i:s') . "] INFO: " . json_encode($message) . PHP_EOL;
		self::fileWrite($content);
	}

	public static function warning($message)
	{
		$content = "[" . date('Y-m-d H:i:s') . "] WARNING: " . json_encode($message) . PHP_EOL;
		self::fileWrite($content);
	}

	public static function error($message)
	{
		$content = "[" . date('Y-m-d H:i:s') . "] ERROR: " . json_encode($message) . PHP_EOL;
		self::fileWrite($content);
	}
}
