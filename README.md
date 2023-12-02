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
$ php artisan migrate
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
## Installation on Docker with Nginx web server
1. Create your Environment file, copy .env.example and edit the parts listed below, after that save as .env
```python
...

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=todolist
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

...
```
2. Setting up Nginx configuration
To set up Nginx, we’ll share a todolist.conf file that will configure how the application is served. Create the docker-compose/nginx folder with:
```bash
$ mkdir -p docker-compose/nginx
```
Open a new file named todolist.conf within that directory:
```bash
$ nano docker-compose/nginx/todolist.conf
```
Copy the following Nginx configuration to that file:
```conf
server {
    listen 80;
    index index.php index.html;
    error_log  /var/log/nginx/error.log;
    access_log /var/log/nginx/access.log;
    root /var/www/public;
    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass app:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }
    location / {
        try_files $uri $uri/ /index.php?$query_string;
        gzip_static on;
    }
}
```
This file will configure Nginx to listen on port 80 and use index.php as default index page. It will set the document root to /var/www/public, and then configure Nginx to use the app service on port 9000 to process *.php files.

Save and close the file when you’re done editing.

3. Setting up Mysql configuration
To set up the MySQL database, we’ll share a database dump that will be imported when the container is initialized. This is a feature provided by the MySQL 5.7 image we’ll be using on that container.

Create a new folder for your MySQL initialization files inside the docker-compose folder:
```bash
$ mkdir docker-compose/mysql
```
Open a new .sql file:
```bash
$ nano docker-compose/mysql/init_db.sql
```
Add the following code to the file:
```bash
CREATE DATABASE `todolist`;
```
4. Creating a Multi-Container Environment with Docker Compose.
Create a new docker-compose.yml file at the root of the application folder:
```bash
$ nano docker-compose.yml
```
Add the following code to the file:
```yml
version: "3.7"
services:
  app:
    build:
      args:
        user: yourname
        uid: 1000
      context: ./
      dockerfile: Dockerfile
    image: todolist
    container_name: todolist-app
    environment:
      - DB_HOST=db
    restart: unless-stopped
    working_dir: /var/www/
    volumes:
      - ./:/var/www
    networks:
      - todolist-network

  db:
    image: mysql:8.0
    container_name: todolist-db
    command: --default-authentication-plugin=mysql_native_password
    restart: always
    environment:
      MYSQL_DATABASE: ${DB_DATABASE}
      MYSQL_ROOT_PASSWORD: ${DB_PASSWORD}
      SERVICE_TAGS: dev
      SERVICE_NAME: mysql
    volumes:
      - ./docker-compose/mysql:/docker-entrypoint-initdb.d
    networks:
      - todolist-network

  nginx:
    image: nginx:alpine
    container_name: todolist-nginx
    restart: unless-stopped
    ports:
      - 8000:80
    volumes:
      - ./:/var/www
      - ./docker-compose/nginx:/etc/nginx/conf.d/
    networks:
      - todolist-network

networks:
  todolist-network:
    driver: bridge
```
Make sure you save the file when you’re done.

5. Running the Application with Docker Compose
```bash
$ docker-compose build app
```
This command might take a few minutes to complete.

When the build is finished, you can run the environment in background mode with:
```bash
$ docker-compose up -d
```
This will run your containers in the background. To show information about the state of your active services, run:
```bash
$ docker-compose ps
```
You'll see output like this:
```bash
Output
Name                    Command              State                  Ports                
-----------------------------------------------------------------------------------------------
todolist-app     docker-php-entrypoint php-fpm   Up      9000/tcp                            
todolist-db      docker-entrypoint.sh mysqld     Up      3306/tcp, 33060/tcp                 
todolist-nginx   nginx -g daemon off;            Up      0.0.0.0:8000->80/tcp,:::8000->80/tcp
```
Your environment is now up and running, but we still need to execute a couple commands to finish setting up the application. You can use the docker-compose exec command to execute commands in the service containers, such as an ls -l to show detailed information about files in the application directory:
```bash
$ docker-compose exec app ls -l
Output
total 256
-rw-r--r-- 1 yourname yourname    737 Apr 18 14:21 Dockerfile
-rw-r--r-- 1 yourname yourname    101 Jan  7  2020 README.md
drwxr-xr-x 6 yourname yourname   4096 Jan  7  2020 app
-rwxr-xr-x 1 yourname yourname   1686 Jan  7  2020 artisan
drwxr-xr-x 3 yourname yourname   4096 Jan  7  2020 bootstrap
-rw-r--r-- 1 yourname yourname   1501 Jan  7  2020 composer.json
-rw-r--r-- 1 yourname yourname 179071 Jan  7  2020 composer.lock
drwxr-xr-x 2 yourname yourname   4096 Jan  7  2020 config
drwxr-xr-x 5 yourname yourname   4096 Jan  7  2020 database
drwxr-xr-x 4 yourname yourname   4096 Apr 18 14:22 docker-compose
-rw-r--r-- 1 yourname yourname   1017 Apr 18 14:29 docker-compose.yml
-rw-r--r-- 1 yourname yourname   1013 Jan  7  2020 package.json
-rw-r--r-- 1 yourname yourname   1405 Jan  7  2020 phpunit.xml
drwxr-xr-x 2 yourname yourname   4096 Jan  7  2020 public
-rw-r--r-- 1 yourname yourname    273 Jan  7  2020 readme.md
drwxr-xr-x 6 yourname yourname   4096 Jan  7  2020 resources
drwxr-xr-x 2 yourname yourname   4096 Jan  7  2020 routes
-rw-r--r-- 1 yourname yourname    563 Jan  7  2020 server.php
drwxr-xr-x 5 yourname yourname   4096 Jan  7  2020 storage
drwxr-xr-x 4 yourname yourname   4096 Jan  7  2020 tests
-rw-r--r-- 1 yourname yourname    538 Jan  7  2020 webpack.mix.js
```
We’ll now run composer install to install the application dependencies:
```bash
$ docker-compose exec app composer install
```
The last thing we need to do before testing the application is to generate a unique application key with the artisan Laravel command-line tool. This key is used to encrypt user sessions and other sensitive data:
```bash
$ docker-compose exec app php artisan key:generate
```
```bash
$ docker-compose exec app php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```
```bash
$ docker-compose exec app php artisan jwt:secret
```
```bash
$ docker-compose exec app php artisan migrate
```
```bash
$ docker-compose exec app php artisan db:seed
```
Now go to your browser and access your server’s domain name or IP address on port 8000:
```bash
http://server_domain_or_IP:8000
```
Note: In case you are running this demo on your local machine, use http://localhost:8000 to access the application from your browser.
