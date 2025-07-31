# Library Manament System  

This is a Library Management System built with Laravel. It allows the admin to manage members, books, categories, and donors efficiently. The system also supports book issuing and return tracking with automated reporting.

## Features
#### Admin can:

- Create and manage library members

- Add and categorize books

- Manage book categories

- Register book donors

- Issue books to members

- Track returns and calculate overdue durations

- Generate reports based on book return status and dates


## Project Setup

##### 1. Configure the Database
To run the project, first open the .env file and update the database configuration. The default database name is set to softvence — replace it with your own if needed.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT= 3306 
DB_DATABASE=laravel_library
DB_USERNAME=root
DB_PASSWORD= 

```
##### 2. Import the Database
Import the provided SQL file into your local database using tools like phpMyAdmin
```
laravel_library.sql
```
##### 3. Start the Laravel Server
Open the project folder in VS Code (or any IDE) and run the following command:

```
php artisan serve
```
##### 4. Login Credentials
Use the following credentials to log in:
```
Email: admin@gmail.com
Password: 123456
```

