
# Library Management System

This project is a simple Library Management System built with CodeIgniter 4, Bootstrap 5, and MySQL.

## Overview

- User registration and login
- Book browsing, borrowing, and purchase requests
- Admin dashboard for managing books, users, and requests
- Role-based access (admin/user)

## Quick Start

1. Clone or download this repository
2. Install dependencies with Composer
3. Import the database using `database_setup.sql`
4. Configure your `.env` file for database credentials
5. Access the app at `http://localhost/php/library-magement/public/` or use `php spark serve`

## Documentation

For full features, setup instructions, routes, database schema, and more, see [LIBRARY_README.md](LIBRARY_README.md).

---

This project uses CodeIgniter 4. For framework documentation, visit the [official site](https://codeigniter.com).

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
