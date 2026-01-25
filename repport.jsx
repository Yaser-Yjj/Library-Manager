import React, { useState } from 'react';
import { FileText, Download, BookOpen, Users, Code, Database, Shield, Zap } from 'lucide-react';

const LibraryReportGenerator = () => {
  const [activeTab, setActiveTab] = useState('overview');
  const [downloading, setDownloading] = useState(false);

  const generatePDF = () => {
    const printWindow = window.open('', '_blank');
    printWindow.document.write(`
      <!DOCTYPE html>
      <html>
      <head>
        <title>BookHub Library Management System - Technical Report</title>
        <style>
          @page { margin: 2cm; }
          body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 210mm;
            margin: 0 auto;
            padding: 20px;
          }
          .header {
            text-align: center;
            padding: 30px 0;
            border-bottom: 4px solid #667eea;
            margin-bottom: 30px;
          }
          .header h1 {
            color: #1a1a2e;
            font-size: 32px;
            margin: 0 0 10px 0;
          }
          .header .subtitle {
            color: #667eea;
            font-size: 18px;
            font-weight: 600;
          }
          .authors {
            text-align: center;
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fc;
            border-radius: 8px;
          }
          .section {
            margin: 30px 0;
            page-break-inside: avoid;
          }
          .section h2 {
            color: #667eea;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-size: 24px;
          }
          .section h3 {
            color: #1a1a2e;
            margin-top: 20px;
            font-size: 18px;
          }
          table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
          }
          th, td {
            border: 1px solid #e5e7eb;
            padding: 12px;
            text-align: left;
          }
          th {
            background: #667eea;
            color: white;
            font-weight: 600;
          }
          tr:nth-child(even) {
            background: #f8f9fc;
          }
          .feature-list {
            list-style: none;
            padding: 0;
          }
          .feature-list li {
            padding: 8px 0 8px 30px;
            position: relative;
          }
          .feature-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #667eea;
            font-weight: bold;
            font-size: 18px;
          }
          .code-block {
            background: #1a1a2e;
            color: #f8f9fc;
            padding: 15px;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            overflow-x: auto;
            margin: 15px 0;
          }
          .tech-badge {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 5px 12px;
            border-radius: 15px;
            margin: 5px;
            font-size: 14px;
          }
          .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 20px 0;
          }
          .stat-card {
            background: #f8f9fc;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #667eea;
          }
          .stat-card h4 {
            margin: 0 0 5px 0;
            color: #667eea;
            font-size: 14px;
          }
          .stat-card p {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            color: #1a1a2e;
          }
          .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
          }
          @media print {
            .section { page-break-inside: avoid; }
            .header { page-break-after: avoid; }
          }
        </style>
      </head>
      <body>
        <div class="header">
          <h1>📚 BookHub Library Management System</h1>
          <p class="subtitle">Complete Technical Documentation & Project Report</p>
        </div>

        <div class="authors">
          <h3 style="margin: 0 0 10px 0;">Project Developers</h3>
          <p style="margin: 5px 0; font-size: 16px;"><strong>Your Name</strong> & <strong>Achraf Benslimane</strong></p>
          <p style="margin: 5px 0; color: #6b7280;">Date: ${new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</p>
        </div>

        <div class="section">
          <h2>📋 Executive Summary</h2>
          <p>BookHub is a comprehensive library management system built with modern web technologies. The application facilitates book borrowing, purchasing, and inventory management through an intuitive interface with role-based access control.</p>
          
          <div class="stats-grid">
            <div class="stat-card">
              <h4>Total Files</h4>
              <p>130+</p>
            </div>
            <div class="stat-card">
              <h4>Database Tables</h4>
              <p>4</p>
            </div>
            <div class="stat-card">
              <h4>User Roles</h4>
              <p>2</p>
            </div>
            <div class="stat-card">
              <h4>Main Features</h4>
              <p>15+</p>
            </div>
          </div>
        </div>

        <div class="section">
          <h2>🛠️ Technology Stack</h2>
          <h3>Backend Technologies</h3>
          <div>
            <span class="tech-badge">PHP 8.1+</span>
            <span class="tech-badge">CodeIgniter 4</span>
            <span class="tech-badge">MySQL/MariaDB</span>
            <span class="tech-badge">MVC Architecture</span>
          </div>
          
          <h3>Frontend Technologies</h3>
          <div>
            <span class="tech-badge">HTML5</span>
            <span class="tech-badge">CSS3</span>
            <span class="tech-badge">Bootstrap 5.3</span>
            <span class="tech-badge">JavaScript (Vanilla)</span>
            <span class="tech-badge">Bootstrap Icons</span>
          </div>

          <h3>Additional Tools</h3>
          <div>
            <span class="tech-badge">Composer</span>
            <span class="tech-badge">PHPUnit</span>
            <span class="tech-badge">Git</span>
            <span class="tech-badge">XAMPP</span>
          </div>
        </div>

        <div class="section">
          <h2>✨ Key Features</h2>
          
          <h3>User Features</h3>
          <ul class="feature-list">
            <li>User Registration and Authentication</li>
            <li>Browse and Search Books</li>
            <li>Request to Borrow Books</li>
            <li>Purchase Books (Request System)</li>
            <li>View Borrow History</li>
            <li>View Purchase History</li>
            <li>Responsive Design for Mobile/Desktop</li>
            <li>Dark/Light Theme Toggle</li>
          </ul>

          <h3>Admin Features</h3>
          <ul class="feature-list">
            <li>Comprehensive Dashboard with Statistics</li>
            <li>Add, Edit, and Delete Books</li>
            <li>Manage Book Inventory and Stock</li>
            <li>Approve/Reject Borrow Requests</li>
            <li>Manage Purchase Orders</li>
            <li>View All Registered Users</li>
            <li>Book Cover Image Management</li>
            <li>Real-time Stock Updates</li>
          </ul>
        </div>

        <div class="section">
          <h2>🗄️ Database Architecture</h2>
          
          <h3>Database Schema</h3>
          <table>
            <tr>
              <th>Table Name</th>
              <th>Purpose</th>
              <th>Key Fields</th>
            </tr>
            <tr>
              <td><strong>users</strong></td>
              <td>Store user accounts and authentication</td>
              <td>id, name, email, password, role</td>
            </tr>
            <tr>
              <td><strong>books</strong></td>
              <td>Manage book inventory</td>
              <td>id, title, author, isbn, price, stock_quantity, cover_image</td>
            </tr>
            <tr>
              <td><strong>borrow_requests</strong></td>
              <td>Track book borrowing</td>
              <td>id, user_id, book_id, status, request_date, return_date</td>
            </tr>
            <tr>
              <td><strong>purchases</strong></td>
              <td>Manage book purchases</td>
              <td>id, user_id, book_id, quantity, total_price, status</td>
            </tr>
          </table>

          <h3>Relationships</h3>
          <ul class="feature-list">
            <li>Users → Borrow Requests (One-to-Many)</li>
            <li>Users → Purchases (One-to-Many)</li>
            <li>Books → Borrow Requests (One-to-Many)</li>
            <li>Books → Purchases (One-to-Many)</li>
          </ul>
        </div>

        <div class="section">
          <h2>🏗️ Project Structure</h2>
          <div class="code-block">
library-management/
├── app/
│   ├── Controllers/
│   │   ├── Auth.php          # Authentication logic
│   │   ├── Books.php         # User book operations
│   │   ├── Admin.php         # Admin panel
│   │   └── Home.php          # Homepage
│   ├── Models/
│   │   ├── UserModel.php
│   │   ├── BookModel.php
│   │   ├── BorrowRequestModel.php
│   │   └── PurchaseModel.php
│   ├── Views/
│   │   ├── layouts/          # Main & Admin layouts
│   │   ├── auth/             # Login/Register
│   │   ├── books/            # Book views
│   │   ├── admin/            # Admin panel
│   │   └── home/             # Homepage
│   ├── Filters/
│   │   ├── AuthFilter.php
│   │   └── GuestFilter.php
│   ├── Database/
│   │   ├── Migrations/       # Database migrations
│   │   └── Seeds/            # Sample data
│   └── Config/              # Configuration files
├── public/                   # Web root
└── writable/                # Logs & cache
          </div>
        </div>

        <div class="section">
          <h2>🔐 Security Features</h2>
          <ul class="feature-list">
            <li><strong>Password Hashing:</strong> BCrypt algorithm for secure password storage</li>
            <li><strong>CSRF Protection:</strong> Built-in CodeIgniter CSRF tokens</li>
            <li><strong>SQL Injection Prevention:</strong> Query Builder with parameter binding</li>
            <li><strong>XSS Protection:</strong> Output escaping in all views</li>
            <li><strong>Session Management:</strong> Secure session handling</li>
            <li><strong>Role-Based Access Control:</strong> Admin and User roles</li>
            <li><strong>Route Filtering:</strong> AuthFilter and GuestFilter middleware</li>
            <li><strong>Input Validation:</strong> Server-side validation rules</li>
          </ul>
        </div>

        <div class="section">
          <h2>📱 User Interface Highlights</h2>
          
          <h3>Design Principles</h3>
          <ul class="feature-list">
            <li>Modern gradient-based color scheme</li>
            <li>Responsive Bootstrap 5 grid system</li>
            <li>Smooth animations and transitions</li>
            <li>Intuitive navigation structure</li>
            <li>Dark/Light theme support</li>
            <li>Interactive 3D book visualization (Three.js)</li>
            <li>Professional typography (Inter font)</li>
          </ul>

          <h3>Key Pages</h3>
          <table>
            <tr>
              <th>Page</th>
              <th>Route</th>
              <th>Description</th>
            </tr>
            <tr>
              <td>Homepage</td>
              <td>/</td>
              <td>Landing page with 3D visualization and features</td>
            </tr>
            <tr>
              <td>Books Browse</td>
              <td>/books</td>
              <td>Grid view of all available books</td>
            </tr>
            <tr>
              <td>Book Details</td>
              <td>/books/{id}</td>
              <td>Individual book information and actions</td>
            </tr>
            <tr>
              <td>Admin Dashboard</td>
              <td>/admin/dashboard</td>
              <td>Statistics and quick actions</td>
            </tr>
            <tr>
              <td>Manage Books</td>
              <td>/admin/books</td>
              <td>CRUD operations for books</td>
            </tr>
          </table>
        </div>

        <div class="section">
          <h2>🚀 Installation Guide</h2>
          
          <h3>Prerequisites</h3>
          <ul class="feature-list">
            <li>XAMPP or similar (Apache, MySQL, PHP 8.1+)</li>
            <li>Composer dependency manager</li>
            <li>Web browser (Chrome, Firefox, Edge)</li>
          </ul>

          <h3>Installation Steps</h3>
          <div class="code-block">
# 1. Clone or extract project to htdocs
cd c:\\xampp\\htdocs\\php\\library-management

# 2. Install dependencies
composer install --ignore-platform-req=ext-intl

# 3. Configure database
- Import database_setup.sql in phpMyAdmin
- Or create database manually

# 4. Update .env file if needed
database.default.hostname = localhost
database.default.database = library_management
database.default.username = root
database.default.password = 
database.default.port = 3306

# 5. Access application
http://localhost/php/library-management/public/
          </div>

          <h3>Default Credentials</h3>
          <table>
            <tr>
              <th>Role</th>
              <th>Email</th>
              <th>Password</th>
            </tr>
            <tr>
              <td>Admin</td>
              <td>admin@library.com</td>
              <td>admin123</td>
            </tr>
            <tr>
              <td>User</td>
              <td colspan="2">Create via registration page</td>
            </tr>
          </table>
        </div>

        <div class="section">
          <h2>📊 System Workflow</h2>
          
          <h3>User Journey</h3>
          <ol>
            <li><strong>Registration:</strong> New users create an account</li>
            <li><strong>Login:</strong> Authentication with email and password</li>
            <li><strong>Browse:</strong> Search and filter available books</li>
            <li><strong>Request:</strong> Submit borrow or purchase requests</li>
            <li><strong>Track:</strong> Monitor request status in history</li>
          </ol>

          <h3>Admin Workflow</h3>
          <ol>
            <li><strong>Login:</strong> Access admin dashboard</li>
            <li><strong>Manage Books:</strong> Add, update, or remove books</li>
            <li><strong>Process Requests:</strong> Approve/reject borrow requests</li>
            <li><strong>Manage Orders:</strong> Handle purchase requests</li>
            <li><strong>Monitor:</strong> View statistics and user activity</li>
          </ol>
        </div>

        <div class="section">
          <h2>🎨 Advanced Features</h2>
          
          <h3>3D Visualization</h3>
          <p>The homepage features an interactive 3D library scene built with Three.js, including:</p>
          <ul class="feature-list">
            <li>Animated bookshelf with realistic books</li>
            <li>Character models reading books</li>
            <li>Dynamic lighting effects</li>
            <li>Mouse-responsive camera controls</li>
            <li>Floating book animations</li>
          </ul>

          <h3>Book Cover Management</h3>
          <ul class="feature-list">
            <li>Support for external image URLs (Open Library API)</li>
            <li>Local file upload capability</li>
            <li>Automatic placeholder generation</li>
            <li>Image preview before submission</li>
          </ul>

          <h3>Theme System</h3>
          <ul class="feature-list">
            <li>Light and Dark mode support</li>
            <li>Persistent theme preference (localStorage)</li>
            <li>Smooth transitions between themes</li>
            <li>Separate themes for user and admin areas</li>
          </ul>
        </div>

        <div class="section">
          <h2>🔧 Technical Implementation</h2>
          
          <h3>MVC Architecture</h3>
          <p><strong>Models:</strong> Handle database operations and business logic</p>
          <p><strong>Views:</strong> Render HTML templates with dynamic data</p>
          <p><strong>Controllers:</strong> Process requests and coordinate between Models and Views</p>

          <h3>Routing System</h3>
          <div class="code-block">
// Public routes
GET  /                          → Home::index
GET  /books                     → Books::index
GET  /books/{id}                → Books::show

// Auth routes (Guest only)
GET  /auth/login                → Auth::login
POST /auth/login                → Auth::attemptLogin
GET  /auth/register             → Auth::register
POST /auth/register             → Auth::attemptRegister

// User routes (Auth required)
GET  /books/borrow/{id}         → Books::borrow
GET  /books/my-borrows          → Books::myBorrows

// Admin routes (Admin only)
GET  /admin/dashboard           → Admin::dashboard
GET  /admin/books               → Admin::books
POST /admin/books/store         → Admin::storeBook
          </div>
        </div>

        <div class="section">
          <h2>📈 Future Enhancements</h2>
          <ul class="feature-list">
            <li>Payment gateway integration for purchases</li>
            <li>Email notification system</li>
            <li>Advanced search with filters</li>
            <li>Book categories and tags</li>
            <li>User reviews and ratings</li>
            <li>Reading list and favorites</li>
            <li>Book recommendations based on history</li>
            <li>Barcode scanning for ISBN</li>
            <li>Fine management for late returns</li>
            <li>Export reports (PDF/Excel)</li>
          </ul>
        </div>

        <div class="section">
          <h2>🐛 Testing & Quality Assurance</h2>
          
          <h3>Testing Framework</h3>
          <ul class="feature-list">
            <li>PHPUnit for unit testing</li>
            <li>Database testing with migrations</li>
            <li>Integration testing for workflows</li>
          </ul>

          <h3>Code Quality</h3>
          <ul class="feature-list">
            <li>PSR-4 autoloading standards</li>
            <li>CodeIgniter 4 best practices</li>
            <li>Consistent naming conventions</li>
            <li>Comprehensive error handling</li>
          </ul>
        </div>

        <div class="section">
          <h2>📝 Conclusion</h2>
          <p>BookHub represents a modern, full-featured library management solution built with industry-standard technologies. The system successfully implements core library operations including book cataloging, user management, borrowing workflows, and purchase processing.</p>
          
          <p>Key achievements include:</p>
          <ul class="feature-list">
            <li>Clean MVC architecture following CodeIgniter 4 conventions</li>
            <li>Secure authentication and authorization system</li>
            <li>Responsive, accessible user interface</li>
            <li>Comprehensive admin panel for operations</li>
            <li>Scalable database design with proper relationships</li>
            <li>Modern UI/UX with theme support</li>
          </ul>

          <p>The project demonstrates proficiency in full-stack web development, database design, security implementation, and modern frontend techniques.</p>
        </div>

        <div class="section">
          <h2>🙏 Acknowledgments</h2>
          <p>This project was developed as part of our web development coursework, demonstrating practical application of learned concepts in PHP, MySQL, and modern web technologies.</p>
          
          <p><strong>Technologies Used:</strong> CodeIgniter 4, Bootstrap 5, Three.js, MySQL, PHP 8.1+</p>
          <p><strong>License:</strong> MIT License</p>
        </div>

        <div class="footer">
          <p>© ${new Date().getFullYear()} BookHub Library Management System</p>
          <p>Developed by <strong>Your Name</strong> & <strong>Achraf Benslimane</strong></p>
          <p style="margin-top: 10px; font-size: 12px;">Generated on ${new Date().toLocaleString()}</p>
        </div>
      </body>
      </html>
    `);
    printWindow.document.close();
    setTimeout(() => {
      printWindow.print();
    }, 500);
  };

  const generateREADME = () => {
    const readmeContent = `# 📚 BookHub - Library Management System

![BookHub Banner](https://img.shields.io/badge/BookHub-Library%20Management-667eea?style=for-the-badge)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4-EF4223?style=for-the-badge&logo=codeigniter&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

A comprehensive library management system built with **CodeIgniter 4**, **Bootstrap 5**, and **MySQL**. Features include book cataloging, user management, borrowing workflows, and purchase processing with an intuitive interface and role-based access control.

**Developed by:** Your Name & Achraf Benslimane

---

## 🌟 Features

### 👤 User Features
- ✅ User Registration & Authentication
- 📖 Browse and Search Books
- 📋 Request to Borrow Books
- 🛒 Purchase Books (Request System)
- 📊 View Borrow History
- 💳 View Purchase History
- 📱 Responsive Mobile/Desktop Design
- 🌓 Dark/Light Theme Toggle

### 👨‍💼 Admin Features
- 📊 Dashboard with Statistics
- ➕ Add, Edit, Delete Books
- 📦 Manage Book Inventory & Stock
- ✔️ Approve/Reject Borrow Requests
- 🛍️ Manage Purchase Orders
- 👥 View All Registered Users
- 🖼️ Book Cover Image Management
- 🔄 Real-time Stock Updates

---

## 🛠️ Technology Stack

| Category | Technologies |
|----------|-------------|
| **Backend** | PHP 8.1+, CodeIgniter 4 |
| **Database** | MySQL / MariaDB |
| **Frontend** | HTML5, CSS3, Bootstrap 5.3, JavaScript |
| **Libraries** | Three.js (3D Visualization), Bootstrap Icons |
| **Tools** | Composer, Git, XAMPP |

---

## 📁 Project Structure

\`\`\`
library-management/
├── app/
│   ├── Controllers/
│   │   ├── Auth.php          # Authentication logic
│   │   ├── Books.php         # User book operations
│   │   ├── Admin.php         # Admin panel
│   │   └── Home.php          # Homepage controller
│   ├── Models/
│   │   ├── UserModel.php
│   │   ├── BookModel.php
│   │   ├── BorrowRequestModel.php
│   │   └── PurchaseModel.php
│   ├── Views/
│   │   ├── layouts/          # Main & Admin layouts
│   │   ├── auth/             # Login/Register pages
│   │   ├── books/            # Book browsing views
│   │   ├── admin/            # Admin panel views
│   │   └── home/             # Homepage
│   ├── Filters/
│   │   ├── AuthFilter.php    # Authentication middleware
│   │   └── GuestFilter.php   # Guest-only middleware
│   ├── Database/
│   │   ├── Migrations/       # Database schema
│   │   └── Seeds/            # Sample data
│   └── Config/              # Configuration files
├── public/                   # Web root directory
├── writable/                # Logs, cache, sessions
├── .env                     # Environment configuration
├── composer.json            # PHP dependencies
└── database_setup.sql       # Quick database setup
\`\`\`

---

## 🚀 Installation

### Prerequisites
- **XAMPP** (or similar: Apache, MySQL, PHP 8.1+)
- **Composer** (PHP dependency manager)
- Modern web browser

### Setup Steps

1. **Clone/Download the Project**
   \`\`\`bash
   cd c:\\xampp\\htdocs\\php
   # Extract or clone project to: library-management/
   \`\`\`

2. **Install Dependencies**
   \`\`\`bash
   cd library-management
   composer install --ignore-platform-req=ext-intl
   \`\`\`

3. **Create Database**
   - Open phpMyAdmin: \`http://localhost/phpmyadmin\`
   - Import \`database_setup.sql\`
   - Or create database manually named \`library_management\`

4. **Configure Environment**
   - Edit \`.env\` file and update database settings:
   \`\`\`env
   database.default.hostname = localhost
   database.default.database = library_management
   database.default.username = root
   database.default.password = 
   database.default.port = 3306
   \`\`\`

5. **Access Application**
   - URL: \`http://localhost/php/library-management/public/\`
   - Or use: \`php spark serve\` → \`http://localhost:8080\`

---

## 🔑 Default Credentials

| Role | Email | Password |
|------|-------|----------|
| **Admin** | admin@library.com | admin123 |
| **User** | _(Register new account)_ | - |

---

## 🗄️ Database Schema

### Tables Overview

#### 1. **users** - User accounts and authentication
- id, name, email, password (hashed), role (user/admin)
- created_at, updated_at

#### 2. **books** - Book inventory
- id, title, author, description, isbn
- price, stock_quantity, cover_image
- created_at, updated_at

#### 3. **borrow_requests** - Book borrowing tracking
- id, user_id (FK), book_id (FK)
- status (pending/approved/rejected/returned)
- request_date, return_date

#### 4. **purchases** - Book purchase orders
- id, user_id (FK), book_id (FK)
- quantity, total_price, status (pending/completed/cancelled)

---

## 🎨 Key Features

### 3D Interactive Homepage
- Built with **Three.js**
- Interactive 3D bookshelf with realistic books
- Animated character models reading
- Mouse-responsive camera controls
- Dynamic lighting and animations

### Theme System
- **Light & Dark Mode** support
- Persistent theme preference (localStorage)
- Smooth theme transitions
- Separate themes for user and admin areas

### Book Cover Management
- External image URLs (Open Library API)
- Local file upload capability
- Automatic placeholder generation
- Real-time image preview

---

## 🔐 Security Features

- ✅ **Password Hashing** - BCrypt algorithm
- ✅ **CSRF Protection** - Built-in CodeIgniter tokens
- ✅ **SQL Injection Prevention** - Query Builder with binding
- ✅ **XSS Protection** - Output escaping in views
- ✅ **Session Management** - Secure session handling
- ✅ **Role-Based Access** - Admin and User roles
- ✅ **Route Filtering** - Middleware authentication

---

## 📱 Routes Overview

### Public Routes
\`\`\`
GET  /                          → Homepage
GET  /books                     → Browse books
GET  /books/{id}                → Book details
\`\`\`

### Authentication Routes
\`\`\`
GET  /auth/login                → Login page
POST /auth/login                → Process login
GET  /auth/register             → Registration page
POST /auth/register             → Process registration
GET  /auth/logout               → Logout
\`\`\`

### User Routes (Requires Login)
\`\`\`
GET  /books/borrow/{id}         → Borrow request
GET  /books/purchase/{id}       → Purchase request
GET  /books/my-borrows          → Borrow history
GET  /books/my-purchases        → Purchase history
\`\`\`

### Admin Routes (Requires Admin Role)
\`\`\`
GET  /admin/dashboard           → Admin dashboard
GET  /admin/books               → Manage books
GET  /admin/borrow-requests     → Manage borrows
GET  /admin/purchases           → Manage purchases
GET  /admin/users               → View users
\`\`\`

---

## 🎯 Future Enhancements

- [ ] Payment gateway integration
- [ ] Email notification system
- [ ] Advanced search with filters
- [ ] Book categories and tags
- [ ] User reviews and ratings
- [ ] Reading list and favorites
- [ ] Book recommendations
- [ ] Barcode ISBN scanning
- [ ] Fine management for late returns
- [ ] Report generation (PDF/Excel)

---

## 🐛 Testing

### Run Tests
\`\`\`bash
./vendor/bin/phpunit
\`\`\`

### Test Coverage
- Unit tests for models
- Integration tests for workflows
- Database migrations testing

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

---

## 👥 Contributors

- **Yasser Yjjou** - Developer
- **Achraf Benslimane** - Developer

---

## 📞 Support

For issues, questions, or contributions:
- Create an issue in the repository
- Contact the development team

---

## 🙏 Acknowledgments

- CodeIgniter 4 Framework
- Bootstrap 5 Team
- Three.js Community
- Open Library API

---

**© ${new Date().getFullYear()} BookHub Library Management System**
`;