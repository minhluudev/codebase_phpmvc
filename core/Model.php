<?php

namespace Core;

use PDO;
use PDOException;

class Model extends Database
{
	/**
	 * The connection name for the model.
	 *
	 * @var string|null
	 */
	protected $connection;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table;

	/**
	 * The fillable will be insert to table
	 * @var array
	 */
	protected $fillable = [];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [];

	private function getTableName(): string
	{
		if ($this->table) {
			return $this->table;
		}

		$modelNames = explode('\\', get_class($this));
		$modelName = end($modelNames);
		return Helper::convertToSnakeCaseAndPlural($modelName);
	}

	public function insert($values)
	{
		try {
			$conn = $this->pdo;
			$table = $this->getTableName();
			$params = array_map(fn($attr) => ":$attr", $this->fillable);
			$sql = "INSERT INTO `$table` (`" . implode("`,`", array: $this->fillable) . "`) VALUES (" . implode(', ', $params) . ")";
			$stmt = $conn->prepare($sql);

			foreach ($this->fillable as $param) {
				$value = isset($values[$param]) ? $values[$param] : null;
				$stmt->bindValue(":$param", $value);
			}

			$stmt->execute();
			$lastId = $conn->lastInsertId();

			return $this->findById($lastId);
		} catch (PDOException $e) {
			echo $e->getMessage();
			return null;
		}
	}

	public function findById($id)
	{
		try {
			$conn = $this->pdo;
			$table = $this->getTableName();
			$sql = "SELECT * FROM `$table` WHERE id=:id";
			$stmt = $conn->prepare($sql);
			$stmt->bindValue(":id", $id);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			echo $e->getMessage();
			return null;
		}
	}
}
