# Build a PHP MVC Framework From Scratch

## I. Environment required

- PHP 8.3.6
- install make

## II. Run project
### Normal
```
cd public && php -S localhost:8080
```
### Docker
- Init project
	```
	make init
	```
- Start project
	```
	make start
	```
- Stop project
	```
	make stop
	```
## III. Run migration
### Migrate
```
make migrate
```

### Migrate rollback
```
make migrate-rollback
```
