# Revise Authentication Server

This server handles the authentication for all Revise services.

## Requirements

- PHP >= 7.2.5
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Installation

**Warning: This software is not suitable for production use.**

Laravel utilizes (Composer)[https://getcomposer.org] to manage its dependencies. Consult with your operating system's manual for installing it.

1. Clone this repository into a folder of your choice.

2. Execute in a terminal open in the same folder,
	- `composer install`

3. Setup the environment variables
	- Copy the file .env.example into a new file .env
	- Make sure you have entered the correct database details.
	- Run `php artisan key:generate --ansi` to set up the application's keys.

4. Set up Database
	- `php artisan migrate --seed`

5. Set up Passport's encryption keys
	- `php artisan passport:keys --force`

6. Generate an OAuth client for using with the LMS
	- `php artisan passport:client --name revise-lms --redirect-uri HOST_URI/auth/callback`
	- **Warning: This application creates all clients as first party. This will be resolved in a future release.**

## Running

There are two ways to run the application

1. Web server

We recommend running the server under Nginx. More information can be found (here)[https://laravel.com/docs/7.x].

2. Local dev environment

This server can be run locally with the help of the following command:
`php artisan serve`

## Database design

The database includes 4 tables - Users, Admin, Teachers, Students.

### Users table:

```
UUID => Uniquely Identifiable ID: varchar, Primary
fname => First Name: varchar
lname => Last Name: varchar
email => Email address: varchar
password => Hashed and Salted password: varchar
role => Choice of admin, teacher, student: varchar
```

### Admin Table

```
UUID => Foreign Key from Users
Empno => Employee Number: varchar, Primary
```

### Teachers Table

```
UUID => Foreign Key from Users
empno => Employee number: varchar, Primary
cabinno => Cabin number: varchar
phone => Phone number: varchar
```

### Students Table

```
UUID => Foreign Key from Users
regno => Registration number: varchar, Primary
```

## Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling.

### Laravel Passport

Laravel Passport is an OAuth2 server and API authentication package that is simple and enjoyable to use.
