<?php

namespace Core\Database;

use Core\Log;
use Core\Schema;
use DirectoryIterator;
use PDO;
use PDOException;

trait MigrationTrait
{
	public function handleApplyMigrations(PDO $pdo)
	{
		echo "Migration start:" . PHP_EOL;
		$this->createMigrationTable($pdo);
		$migrationDirectory = __DIR__ . '/../../database/migrations';
		$oldMigrations = $this->getMigrations($pdo);
		$newMigrations = [];
		foreach (new DirectoryIterator($migrationDirectory) as $file) {
			if ($file->isDot()) continue;

			$fileName = $file->getFilename();
			if ($file->isFile() && !in_array($fileName, $oldMigrations)) {
				$filePath = $file->getPathname();
				$migrateClass = include $filePath;
				$migrateClass->up();
				echo $file->getFilename() . PHP_EOL;
				$newMigrations[] = $fileName;
			}
		}

		$this->insertMigration($pdo, $newMigrations);
		echo 'DONE!' . PHP_EOL;
	}

	private function createMigrationTable(PDO $pdo)
	{
		$pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
			id INT AUTO_INCREMENT PRIMARY KEY,
			migration VARCHAR(255),
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		)");
	}

	private function getMigrations(PDO $pdo)
	{
		try {
			$sql = "SELECT migration FROM migrations";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$results = array_map(fn($item)  => $item['migration'], $results);
			return $results;
		} catch (PDOException $e) {
			Log::error($e->getMessage());
		}
	}

	private function insertMigration(PDO $pdo, array $values)
	{
		try {
			if (!count($values)) return;

			$sql = "INSERT INTO migrations (migration) VALUES ('" . implode("'),('", $values) . "');";
			$sql .= implode(' ', Schema::$sql);
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
		} catch (PDOException $e) {
			Log::error($e->getMessage());
		}
	}
}
