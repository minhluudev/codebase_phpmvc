init:
	docker compose up --build -d
start:
	docker compose start
stop:
	docker compose stop
migrate:
	docker compose exec app sh -c "cd database && php migration.php"
migrate-rollback:
	docker compose exec app sh -c "cd database && php migration_rollback.php"