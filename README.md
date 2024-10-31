# Lumin Framework

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
## 1. Structure
Updating...
## 2. Routing
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
  - Other way to define route
    ```php
    Route::get('/', function () {
        return 'Home page';
    });
    // Add auth middleware
    Route::get('/', function () {
        return 'Home page';
    }, ['auth']);
    ```
  - Route with parameter
    ```php
    Route::get('/user/:id', function ($id) {
        return 'User id: ' . $id;
    });
    ```
## 3. View

- Define view in folder `resources/views`
- Extension file is `.php`
- Example:
  - Layout : `layouts/main.php`
    ```php
    <?php
    use Lumin\View;
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= View::setSection('title') ?></title>
    </head>
    <body>
    <?= View::setSection('content') ?>
    </body>
    </html>
    ```
  - Page: `home.php`
    ```php
    <?php
    use Lumin\View;
    
    View::layout('layouts/main');
    View::section('title', 'Home page');
    ?>
    
    <?php View::sectionStart('content'); ?>
        <h1>Home page</h1>
    <?= $title ?? '' ?>
    <?php View::sectionEnd(); ?>
    
    <?php View::layoutEnd(); ?>
    ```
## 4. Controller
- Define controller in folder `app/HTTP/Controllers`
- Render view in controller
  - Use `view` function to render view
  - Example:
    ```php
    namespace App\HTTP\Controllers;
    
    use Lumin\Controller;
  
    class HomeController extends Controller
    {
        public function index()
        {
            return $this->view('home', ['title' => 'Home page']);
        }
    }
    ```