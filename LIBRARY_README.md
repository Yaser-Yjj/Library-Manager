# Library Management System - Phase 1

A simple library management system built with CodeIgniter 4, Bootstrap 5, and MySQL.

## Features (Phase 1)

### User Features
- Register / Login
- Browse books
- Request to borrow books
- Purchase books (request only, no payment gateway)
- View borrow history
- View purchase history

### Admin Features
- Dashboard with statistics
- Add, edit, delete books
- Manage stock quantity
- Approve/reject borrow requests
- Manage purchase requests
- View registered users

## Tech Stack
- **Frontend**: HTML, CSS, Bootstrap 5, Vanilla JavaScript
- **Backend**: PHP 8+
- **Framework**: CodeIgniter 4
- **Database**: MySQL

## Installation

### Prerequisites
- XAMPP (or any PHP/MySQL environment)
- Composer

### Steps

1. **Navigate to project folder**
   ```bash
   cd c:\xampp\htdocs\php\library-magement
   ```

2. **Install dependencies** (already done)
   ```bash
   composer install --ignore-platform-req=ext-intl
   ```

3. **Create the database**
   - Open phpMyAdmin: http://localhost/phpmyadmin
   - Import the `database_setup.sql` file
   - OR run the SQL commands manually

4. **Configure environment**
   - Edit `.env` file if needed
   - Update database credentials if different from default

5. **Access the application**
   - Frontend: http://localhost/php/library-magement/public/
   - Or use `php spark serve` and access http://localhost:8080

## Default Credentials

### Admin
- **Email**: admin@library.com
- **Password**: admin123

### Test User
- Register a new account via the registration page

## Project Structure

```
library-magement/
├── app/
│   ├── Controllers/
│   │   ├── Auth.php         # Authentication (login/register)
│   │   ├── Books.php        # User book operations
│   │   └── Admin.php        # Admin dashboard & management
│   ├── Models/
│   │   ├── UserModel.php
│   │   ├── BookModel.php
│   │   ├── BorrowRequestModel.php
│   │   └── PurchaseModel.php
│   ├── Views/
│   │   ├── layouts/         # Main templates
│   │   ├── auth/            # Login/Register pages
│   │   ├── books/           # User book views
│   │   └── admin/           # Admin panel views
│   ├── Filters/
│   │   ├── AuthFilter.php   # Authentication check
│   │   └── GuestFilter.php  # Guest-only pages
│   ├── Database/
│   │   ├── Migrations/      # Database schema
│   │   └── Seeds/           # Sample data
│   └── Config/
│       ├── Routes.php       # URL routing
│       └── Filters.php      # Filter configuration
├── public/                   # Web root
├── .env                      # Environment config
└── database_setup.sql        # Quick DB setup
```

## Routes Overview

### Public Routes
- `GET /` - Book listing (home)
- `GET /books` - All books
- `GET /books/{id}` - Single book details

### Auth Routes
- `GET /auth/login` - Login page
- `POST /auth/login` - Process login
- `GET /auth/register` - Register page
- `POST /auth/register` - Process registration
- `GET /auth/logout` - Logout

### User Routes (requires login)
- `GET /books/borrow/{id}` - Borrow a book
- `GET /books/purchase/{id}` - Purchase a book
- `GET /books/my-borrows` - My borrow history
- `GET /books/my-purchases` - My purchase history

### Admin Routes (requires admin role)
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/books` - Manage books
- `GET /admin/books/add` - Add book form
- `POST /admin/books/store` - Save new book
- `GET /admin/books/edit/{id}` - Edit book form
- `POST /admin/books/update/{id}` - Update book
- `GET /admin/books/delete/{id}` - Delete book
- `GET /admin/borrow-requests` - Manage borrows
- `POST /admin/borrow-requests/update/{id}` - Update borrow status
- `GET /admin/purchases` - Manage purchases
- `POST /admin/purchases/update/{id}` - Update purchase status
- `GET /admin/users` - View users

## Database Schema

### users
| Field | Type | Description |
|-------|------|-------------|
| id | INT | Primary key |
| name | VARCHAR(100) | Full name |
| email | VARCHAR(100) | Unique email |
| password | VARCHAR(255) | Hashed password |
| role | ENUM | 'user' or 'admin' |
| created_at | DATETIME | Created timestamp |
| updated_at | DATETIME | Updated timestamp |

### books
| Field | Type | Description |
|-------|------|-------------|
| id | INT | Primary key |
| title | VARCHAR(255) | Book title |
| author | VARCHAR(100) | Author name |
| description | TEXT | Book description |
| isbn | VARCHAR(20) | ISBN number |
| price | DECIMAL(10,2) | Book price |
| stock_quantity | INT | Available stock |
| created_at | DATETIME | Created timestamp |
| updated_at | DATETIME | Updated timestamp |

### borrow_requests
| Field | Type | Description |
|-------|------|-------------|
| id | INT | Primary key |
| user_id | INT | FK to users |
| book_id | INT | FK to books |
| status | ENUM | pending/approved/rejected/returned |
| request_date | DATETIME | When requested |
| return_date | DATETIME | When returned |
| created_at | DATETIME | Created timestamp |
| updated_at | DATETIME | Updated timestamp |

### purchases
| Field | Type | Description |
|-------|------|-------------|
| id | INT | Primary key |
| user_id | INT | FK to users |
| book_id | INT | FK to books |
| quantity | INT | Number of books |
| total_price | DECIMAL(10,2) | Total amount |
| status | ENUM | pending/completed/cancelled |
| created_at | DATETIME | Created timestamp |
| updated_at | DATETIME | Updated timestamp |

## Phase 1 Complete ✅

This completes Phase 1 of the Library Management System with:
- [x] Project architecture (MVC)
- [x] Database schema
- [x] Base CodeIgniter setup
- [x] Controllers with logic
- [x] Models with structure
- [x] Views with Bootstrap layout
- [x] Simple login & register
- [x] Role-based access (admin vs user)
- [x] Admin can add books with stock
- [x] Users can view book list

## Future Phases (Not Implemented)
- Payment gateway integration
- Advanced form validation
- Email notifications
- Book images upload
- Search and filtering
- Pagination
- User profile management
- Book categories
- Reviews and ratings
