<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
	protected PDO $pdo;

	public function __construct()
	{
		$this->connectToDatabase();
	}

	private function connectToDatabase()
	{
		$config = Helper::config('db');
		$drive = $config['default'];
		$connection = $config['connections'][$config['default']];
		$host = $connection['host'];
		$username = $connection['username'];
		$password = $connection['password'];
		$dbName = $connection['db_name'];
		$port = $connection['port'];

		try {
			$this->pdo = new PDO("$drive:host=$host;port=$port;dbname=$dbName", $username, $password);
			// set the PDO error mode to exception
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			// TODO: handle exception
		}
	}
}
