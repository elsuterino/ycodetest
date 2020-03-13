## Preparing the instalation

Setup a mysql database

Create a new .env file based on .env.example and set up your database information:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=databasename
DB_USERNAME=usersename
DB_PASSWORD=password
```

## Instalation

```
composer install
```

```
php artisan migrate
```

```
php artisan db:seed
```

## Run

```
php artisan serve
```

to run tests use new laravels helper `php artisan test` or standart phpunit command
