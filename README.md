# Lumin Framework

## I. Introduction
### 1. What is Lumin?
Lumin is a PHP framework that helps you build web applications quickly and easily. It is based on the MVC pattern and is designed to be simple, lightweight, and easy to use.

### 2. Features
- MVC pattern
- ORM (Object Relational Mapping)
- Routing
- Middleware
- Request and Response
- Database
- Migrations
- Validation
- Error handling
- Logging
- Command line interface
- Composer support

### 3. Requirements
- PHP 8.3.6
- Composer
- MySQL

### 4. Installation
``` bash
composer create-project minhluu/lumin example-app
```

### 5. Run
``` bash
php lumin start
```

### 5. Documentation
- [Lumin Documentation](https://github.com/minhluudev/php-mvc-lite/wiki)

### 6. License
Lumin is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## II. Getting Started
### 1. Configuration
- Database configuration: `config/database.php`
- Application configuration: `config/app.php`
- Environment configuration: `.env`

### 2. Routing
- Define routes in `routes/web.php` and `routes/api.php`
- Route parameters: `:id`, `:slug`, `:name`, etc.
- Updating

### 3. Controllers
- Create controllers in `app/HTTP/Controllers` directory

### 4. Models
- Create models in `app/Models` directory
- Define relationships in models

### 5. Views
- Create views in `resources/views` directory
- Use .php extension for views

