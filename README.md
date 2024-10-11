# PHP MVC Framework Lite

## I. Environment required

- PHP 8.3.6
- install make

## II. Run project
### Normal
```
php -S localhost:8080 -t public
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

# Document
## I. Structure
Updating...
## II. Routing
- Define route in file `routes/web.php`
  - Example:
    - GET method
      ```php
      Route::get('/', [HomeController::class, 'index']);
      // Add auth middleware
      Route::get('/', [HomeController::class, 'about'], ['auth']);
      ```
    - POST method
      ```php
      Route::post('/', [HomeController::class, 'store']);
      // Add auth middleware
      Route::post('/', [HomeController::class, 'store'], ['auth']);
      ```
    - PUT method
      ```php
      Route::put('/', [HomeController::class, 'update']);
      // Add auth middleware
      Rote::put('/', [HomeController::class, 'update'], ['auth']);
	  ```
    - DELETE method
      ```php
      Route::delete('/', [HomeController::class, 'delete']);
      // Add auth middleware
      Route::delete('/', [HomeController::class, 'delete'], ['auth']);
	  ```
    - Prefix route
      ```php
      Route::prefix('admin', function () {
          // Define route here
      });
      // Add auth middleware
      Route::prefix('admin', function () {
          // Define route here
      }, ['auth']);
      ```
    - Group route
      ```php
      Route::group(function () {
          // Define route here
      });
      // Add auth middleware
      Route::group(function () {
          // Define route here
      }, ['auth']);
	  ```
