# Revise Authentication Server

This package handles the authentication for all of the services.

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

## Technologies

This server uses the [Laravel](https://laravel.com) framework, and also uses Laravel Passport for authorization.

## License

There is no license as of now.
