-- Library Management System Database Setup
-- Run this script in phpMyAdmin or MySQL CLI

-- Create database
CREATE DATABASE IF NOT EXISTS library_management;
USE library_management;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at DATETIME,
    updated_at DATETIME
);

-- Books table
CREATE TABLE IF NOT EXISTS books (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(100) NOT NULL,
    description TEXT,
    isbn VARCHAR(20),
    price DECIMAL(10,2) DEFAULT 0.00,
    stock_quantity INT DEFAULT 0,
    created_at DATETIME,
    updated_at DATETIME
);

-- Borrow requests table
CREATE TABLE IF NOT EXISTS borrow_requests (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    book_id INT UNSIGNED NOT NULL,
    status ENUM('pending', 'approved', 'rejected', 'returned') DEFAULT 'pending',
    request_date DATETIME,
    return_date DATETIME,
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Purchases table
CREATE TABLE IF NOT EXISTS purchases (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    book_id INT UNSIGNED NOT NULL,
    quantity INT DEFAULT 1,
    total_price DECIMAL(10,2) DEFAULT 0.00,
    status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Insert admin user (password: admin123)
INSERT INTO users (name, email, password, role, created_at, updated_at) VALUES
('Admin', 'admin@library.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NOW(), NOW());

-- Insert sample books
INSERT INTO books (title, author, description, isbn, price, stock_quantity, created_at, updated_at) VALUES
('The Great Gatsby', 'F. Scott Fitzgerald', 'A story of the mysteriously wealthy Jay Gatsby and his love for the beautiful Daisy Buchanan.', '978-0743273565', 12.99, 10, NOW(), NOW()),
('To Kill a Mockingbird', 'Harper Lee', 'The unforgettable novel of a childhood in a sleepy Southern town and the crisis of conscience that rocked it.', '978-0061120084', 14.99, 8, NOW(), NOW()),
('1984', 'George Orwell', 'A dystopian social science fiction novel and cautionary tale about the dangers of totalitarianism.', '978-0451524935', 11.99, 15, NOW(), NOW()),
('Pride and Prejudice', 'Jane Austen', 'A romantic novel of manners that follows the character development of Elizabeth Bennet.', '978-0141439518', 9.99, 12, NOW(), NOW()),
('The Catcher in the Rye', 'J.D. Salinger', 'The story of Holden Caulfield, a teenager alienated from society and disillusioned with the adult world.', '978-0316769488', 13.99, 6, NOW(), NOW());

-- Done!
SELECT 'Database setup complete!' AS Message;
