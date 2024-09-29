migrate:
	cd database && php migration.php && cd ..
migrate-rollback:
	cd database && php migration_rollback.php && cd ..