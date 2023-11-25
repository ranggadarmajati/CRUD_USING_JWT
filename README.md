# Simple Todo List Rest API
This simple project is created using [laravel 10](https://laravel.com) framework

## Installation
Use CMD or Terminal and clone this repo:

1. Clone or Download This Repo:
```bash
$ git clone git@github.com:ranggadarmajati/CRUD_USING_JWT.git
```

2. After Cloning this Repo, you must to install package depencies use composer on terminal

```composer_install
$ composer install
```

3. Create Your Database on mysql or pgsql
4. Create your Environment file, copy .env.example and edit the parts listed below, after that save as .env
```env
...

DB_CONNECTION=mysql or pgsql
DB_HOST=127.0.0.1
DB_PORT=3306 for mysql or 5432 for pgsql
DB_DATABASE=your_database
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

...
```

5. Generate Laravel Key
```bash
$ php artisan key:generate
```
6. Publish the Config JWT-Auth:
```python
$ php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```
7. Generate JWT Key:
```bash
$ php artisan jwt:secret
```
8. Migrate Database Tables:
```bash
$ php artisan db:migrate
```
9. Create seed data:
```bash
$ php artisan db:seed
```
10. Run project:
```bash
$ php artisan serve
```
11. Check API route list
```bash
$ php artisan route:list
+--------+----------+---------------------+------+------------------------------------------------------------+---------------------------------------+
| Domain | Method   | URI                 | Name | Action                                                     | Middleware                            |
+--------+----------+---------------------+------+------------------------------------------------------------+---------------------------------------+
|        | GET|HEAD | /                   |      | Closure                                                    | web                                   |
|        | POST     | api/v1/auth/login   |      | App\Http\Controllers\api\v1\AuthController@store           | api                                   |
|        | GET|HEAD | api/v1/auth/logout  |      | App\Http\Controllers\api\v1\AuthController@logout          | api                                   |
|        |          |                     |      |                                                            | App\Http\Middleware\AuthJwtMiddleware |
|        | GET|HEAD | api/v1/auth/me      |      | App\Http\Controllers\api\v1\AuthController@me              | api                                   |
|        |          |                     |      |                                                            | App\Http\Middleware\AuthJwtMiddleware |
|        | GET|HEAD | api/v1/auth/refresh |      | App\Http\Controllers\api\v1\AuthController@refreshToken    | api                                   |
|        |          |                     |      |                                                            | App\Http\Middleware\AuthJwtMiddleware |
|        | GET|HEAD | api/v1/todo         |      | App\Http\Controllers\api\v1\TodoController@index           | api                                   |
|        |          |                     |      |                                                            | App\Http\Middleware\AuthJwtMiddleware |
|        | POST     | api/v1/todo         |      | App\Http\Controllers\api\v1\TodoController@store           | api                                   |
|        |          |                     |      |                                                            | App\Http\Middleware\AuthJwtMiddleware |
|        | GET|HEAD | api/v1/todo/{id}    |      | App\Http\Controllers\api\v1\TodoController@show            | api                                   |
|        |          |                     |      |                                                            | App\Http\Middleware\AuthJwtMiddleware |
|        | PUT      | api/v1/todo/{id}    |      | App\Http\Controllers\api\v1\TodoController@update          | api                                   |
|        |          |                     |      |                                                            | App\Http\Middleware\AuthJwtMiddleware |
|        | DELETE   | api/v1/todo/{id}    |      | App\Http\Controllers\api\v1\TodoController@destroy         | api                                   |
|        |          |                     |      |                                                            | App\Http\Middleware\AuthJwtMiddleware |
|        | GET|HEAD | sanctum/csrf-cookie |      | Laravel\Sanctum\Http\Controllers\CsrfCookieController@show | web                                   |
+--------+----------+---------------------+------+------------------------------------------------------------+---------------------------------------+
```

## Feature Test
You can run feature testing for this project with the command:
```bash
$ php artisan test --testsuite=Feature --stop-on-failure
   
   PASS  Tests\Feature\AuthTest
  ✓ api v1 auth login
  ✓ api v1 auth me
  ✓ api v1 auth refresh
  ✓ api v1 auth logout

   PASS  Tests\Feature\ExampleTest
  ✓ example

   PASS  Tests\Feature\TodoTest
  ✓ create todo
  ✓ list todo
  ✓ detail todo
  ✓ update todo
  ✓ delete todo

  Tests:  10 passed
  Time:   0.32s

```