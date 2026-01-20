<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'BookHub - Library Management' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --dark-gradient: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            
            /* Light Mode Variables */
            --bg-primary: #fafbfc;
            --bg-secondary: #ffffff;
            --bg-tertiary: #f8f9fc;
            --text-primary: #1a1a2e;
            --text-secondary: #6b7280;
            --text-muted: #9ca3af;
            --border-color: #e5e7eb;
            --shadow-sm: 0 4px 20px rgba(0,0,0,0.05);
            --shadow-md: 0 10px 40px rgba(0,0,0,0.1);
            --shadow-lg: 0 20px 60px rgba(0,0,0,0.15);
        }
        
        [data-theme="dark"] {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #334155;
            --text-primary: #f1f5f9;
            --text-secondary: #cbd5e1;
            --text-muted: #94a3b8;
            --border-color: #334155;
            --shadow-sm: 0 4px 20px rgba(0,0,0,0.3);
            --shadow-md: 0 10px 40px rgba(0,0,0,0.5);
            --shadow-lg: 0 20px 60px rgba(0,0,0,0.7);
        }
        
        * { 
            font-family: 'Inter', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }
        body { 
            overflow-x: hidden; 
            background: var(--bg-primary); 
            color: var(--text-primary);
        }
        .navbar { background: var(--dark-gradient) !important; backdrop-filter: blur(10px); box-shadow: 0 4px 30px rgba(0,0,0,0.1); padding: 1rem 0; }
        .navbar-brand { font-weight: 700; font-size: 1.5rem; }
        
        /* Theme Toggle Button */
        .theme-toggle {
            background: rgba(255,255,255,0.1);
            border: none;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: white;
            font-size: 1.2rem;
            position: relative;
            overflow: hidden;
        }
        .theme-toggle:hover {
            background: rgba(255,255,255,0.2);
            transform: scale(1.1);
        }
        .theme-toggle i {
            position: absolute;
            transition: all 0.3s ease;
        }
        .theme-toggle .bi-sun-fill {
            opacity: 1;
            transform: rotate(0deg) scale(1);
        }
        .theme-toggle .bi-moon-stars-fill {
            opacity: 0;
            transform: rotate(180deg) scale(0);
        }
        [data-theme="dark"] .theme-toggle .bi-sun-fill {
            opacity: 0;
            transform: rotate(-180deg) scale(0);
        }
        [data-theme="dark"] .theme-toggle .bi-moon-stars-fill {
            opacity: 1;
            transform: rotate(0deg) scale(1);
        }
        .navbar { background: var(--dark-gradient) !important; backdrop-filter: blur(10px); box-shadow: 0 4px 30px rgba(0,0,0,0.1); padding: 1rem 0; }
        .navbar-brand { font-weight: 700; font-size: 1.5rem; }
        .nav-link { font-weight: 500; transition: all 0.3s ease; position: relative; border-radius: 8px; }
        .nav-link:hover { transform: translateY(-2px); background: rgba(255,255,255,0.1); }
        .nav-link.active { background: rgba(255,255,255,0.15); }
        .brand-icon { width: 40px; height: 40px; background: var(--primary-gradient); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
        .brand-text { font-weight: 700; font-size: 1.4rem; }
        .user-avatar { width: 32px; height: 32px; background: var(--primary-gradient); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; }
        .user-dropdown { background: rgba(255,255,255,0.1); border-radius: 50px; padding: 0.4rem 0.8rem !important; }
        .user-dropdown:hover { background: rgba(255,255,255,0.2); }
        .dropdown-menu { border: none; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); }
        .animate-dropdown { animation: dropdownFade 0.2s ease-out; }
        @keyframes dropdownFade { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        .dropdown-item { border-radius: 8px; margin: 2px 8px; padding: 8px 12px; transition: all 0.2s ease; }
        .dropdown-item:hover { background: rgba(255,255,255,0.1); transform: translateX(5px); }
        .min-vh-75 { min-height: 75vh; }
        .text-gradient { background: var(--primary-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
        .animate-fade-in { animation: fadeIn 0.8s ease-out forwards; }
        .animate-slide-up { animation: slideUp 0.8s ease-out forwards; }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .delay-1 { animation-delay: 0.2s; opacity: 0; animation-fill-mode: forwards; }
        .delay-2 { animation-delay: 0.4s; opacity: 0; animation-fill-mode: forwards; }
        .delay-3 { animation-delay: 0.6s; opacity: 0; animation-fill-mode: forwards; }
        .hero-section { padding: 2rem 0; position: relative; overflow: hidden; }
        .hero-section::before { content: ''; position: absolute; top: -50%; right: -20%; width: 80%; height: 150%; background: linear-gradient(135deg, rgba(102,126,234,0.1) 0%, rgba(118,75,162,0.1) 100%); border-radius: 50%; z-index: -1; }
        .books-showcase { position: relative; height: 400px; display: flex; justify-content: center; align-items: center; }
        .book-stack { position: relative; width: 200px; height: 280px; perspective: 1000px; }
        .book { position: absolute; width: 180px; height: 250px; border-radius: 8px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); transition: all 0.5s ease; }
        .book-1 { background: var(--primary-gradient); transform: rotate(-15deg) translateX(-40px); z-index: 1; }
        .book-2 { background: var(--secondary-gradient); transform: rotate(0deg); z-index: 2; }
        .book-3 { background: var(--success-gradient); transform: rotate(15deg) translateX(40px); z-index: 1; }
        .book-stack:hover .book-1 { transform: rotate(-25deg) translateX(-60px) translateY(-20px); }
        .book-stack:hover .book-2 { transform: rotate(0deg) translateY(-30px); }
        .book-stack:hover .book-3 { transform: rotate(25deg) translateX(60px) translateY(-20px); }
        .floating-elements { position: absolute; width: 100%; height: 100%; }
        .floating-icon { position: absolute; font-size: 2rem; animation: float 3s ease-in-out infinite; }
        .icon-1 { top: 10%; left: 10%; color: #ffd700; animation-delay: 0s; }
        .icon-2 { top: 20%; right: 15%; color: #ff6b6b; animation-delay: 1s; }
        .icon-3 { bottom: 20%; left: 20%; color: #667eea; animation-delay: 2s; }
        .stat-item { padding: 1rem; border-radius: 12px; background: var(--bg-secondary); box-shadow: var(--shadow-sm); text-align: center; transition: all 0.3s ease; }
        .stat-item:hover { transform: translateY(-5px); box-shadow: var(--shadow-md); }
        .feature-card { background: var(--bg-secondary); border-radius: 20px; padding: 2rem; height: 100%; box-shadow: var(--shadow-sm); transition: all 0.4s ease; border: 1px solid var(--border-color); }
        .feature-card:hover { transform: translateY(-10px); box-shadow: var(--shadow-md); }
        .feature-icon { width: 70px; height: 70px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; }
        .bg-primary-soft { background: rgba(102,126,234,0.15); color: #667eea; }
        .bg-success-soft { background: rgba(40,167,69,0.15); color: #28a745; }
        .bg-warning-soft { background: rgba(255,193,7,0.15); color: #ffc107; }
        .bg-info-soft { background: rgba(23,162,184,0.15); color: #17a2b8; }
        .book-card { background: var(--bg-secondary); border-radius: 16px; overflow: hidden; box-shadow: var(--shadow-md); transition: all 0.4s ease; }
        .book-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); }
        .book-cover { height: 180px; background: var(--primary-gradient); display: flex; align-items: center; justify-content: center; position: relative; }
        .book-cover-inner { width: 100px; height: 140px; background: var(--bg-secondary); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #667eea; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
        .step-card { padding: 2rem; position: relative; }
        .step-number { position: absolute; top: 0; right: 20px; font-size: 5rem; font-weight: 800; color: rgba(102,126,234,0.1); line-height: 1; }
        .step-icon { width: 80px; height: 80px; background: var(--primary-gradient); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: white; margin: 0 auto; box-shadow: 0 10px 30px rgba(102,126,234,0.4); }
        .steps-line { position: absolute; top: 60px; left: 20%; right: 20%; height: 3px; background: linear-gradient(90deg, #667eea 0%, #764ba2 50%, #667eea 100%); z-index: -1; }
        .testimonial-card { background: var(--bg-secondary); border-radius: 20px; padding: 2rem; box-shadow: var(--shadow-sm); transition: all 0.3s ease; height: 100%; }
        .testimonial-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-md); }
        .avatar { width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; }
        .cta-card { background: var(--primary-gradient); position: relative; overflow: hidden; }
        .cta-card::before { content: ''; position: absolute; top: -50%; right: -20%; width: 60%; height: 200%; background: rgba(255,255,255,0.1); border-radius: 50%; }
        .animate-on-scroll { opacity: 0; transform: translateY(30px); animation: slideUp 0.6s ease-out forwards; }
        .btn-primary { background: var(--primary-gradient); border: none; transition: all 0.3s ease; }
        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(102,126,234,0.4); background: var(--primary-gradient); }
        .btn-outline-primary { border: 2px solid #667eea; color: #667eea; }
        .btn-outline-primary:hover { background: var(--primary-gradient); border-color: transparent; transform: translateY(-3px); }
        footer { background: var(--dark-gradient) !important; }
        .footer-logo { width: 50px; height: 50px; background: var(--primary-gradient); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white; }
        .footer-heading { font-weight: 600; color: #fff; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px; position: relative; padding-bottom: 10px; }
        .footer-heading::after { content: ''; position: absolute; left: 0; bottom: 0; width: 30px; height: 2px; background: var(--primary-gradient); border-radius: 2px; }
        .footer-links { list-style: none; padding: 0; margin: 0; }
        .footer-links li { margin-bottom: 10px; }
        .footer-links a { color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.9rem; transition: all 0.3s ease; display: inline-flex; align-items: center; }
        .footer-links a i { font-size: 0.7rem; margin-right: 8px; transition: transform 0.3s ease; }
        .footer-links a:hover { color: #fff; transform: translateX(5px); }
        .footer-links a:hover i { transform: translateX(3px); }
        .social-icon { width: 38px; height: 38px; border-radius: 10px; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1rem; transition: all 0.3s ease; }
        .social-icon:hover { background: var(--primary-gradient); color: #fff; transform: translateY(-3px); }
        .newsletter-form .form-control { border-radius: 10px 0 0 10px; border: none; background: rgba(255,255,255,0.1); color: #fff; padding: 12px 16px; }
        .newsletter-form .form-control::placeholder { color: rgba(255,255,255,0.5); }
        .newsletter-form .form-control:focus { background: rgba(255,255,255,0.15); box-shadow: none; color: #fff; }
        .newsletter-form .btn { border-radius: 0 10px 10px 0; }
        .footer-divider { border-color: rgba(255,255,255,0.1); margin: 1.5rem 0; }
        .footer-bottom-links a { color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.85rem; transition: all 0.3s ease; }
        .footer-bottom-links a:hover { color: #fff; }
        .card { background: var(--bg-secondary); color: var(--text-primary); border: 1px solid var(--border-color); border-radius: 16px; box-shadow: var(--shadow-sm); transition: all 0.3s ease; }
        .card:hover { transform: translateY(-5px); box-shadow: var(--shadow-md); }
        .alert { border: none; border-radius: 12px; }
        @media (max-width: 768px) {
            .hero-section h1 { font-size: 2.5rem; }
            .books-showcase { height: 300px; margin-top: 2rem; }
            .book-stack { transform: scale(0.7); }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= base_url() ?>">
                <div class="brand-icon me-2">
                    <i class="bi bi-book-half"></i>
                </div>
                <span class="brand-text">BookHub</span>
            </a>
            
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                
                <ul class="navbar-nav mx-auto gap-1">
                    <li class="nav-item">
                        <a class="nav-link px-3 <?= uri_string() === '' ? 'active' : '' ?>" href="<?= base_url() ?>">
                            <i class="bi bi-house-door me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 <?= str_contains(uri_string(), 'books') && !str_contains(uri_string(), 'admin') ? 'active' : '' ?>" href="<?= base_url('books') ?>">
                            <i class="bi bi-collection me-1"></i>Browse Books
                        </a>
                    </li>
                    <?php if (session()->get('isLoggedIn')): ?>
                        <?php if (session()->get('role') === 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link px-3 <?= str_contains(uri_string(), 'admin') ? 'active' : '' ?>" href="<?= base_url('admin/dashboard') ?>">
                                    <i class="bi bi-speedometer2 me-1"></i>Dashboard
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle px-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-bookmark-star me-1"></i>My Library
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark animate-dropdown">
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url('books/my-borrows') ?>">
                                            <i class="bi bi-arrow-left-right me-2"></i>My Borrows
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url('books/my-purchases') ?>">
                                            <i class="bi bi-bag-check me-2"></i>My Purchases
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
                
                <ul class="navbar-nav align-items-lg-center gap-2">
                    
                    <li class="nav-item">
                        <button class="theme-toggle nav-link px-3 border-0 bg-transparent" id="themeToggle" aria-label="Toggle theme">
                            <i class="bi bi-sun-fill"></i>
                            <i class="bi bi-moon-stars-fill"></i>
                        </button>
                    </li>
                    
                    <?php if (session()->get('isLoggedIn')): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 user-dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <span class="d-none d-lg-inline"><?= esc(session()->get('userName')) ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark animate-dropdown">
                                <li class="dropdown-header">
                                    <small class="text-white-50">Signed in as</small>
                                    <div class="fw-semibold text-white"><?= esc(session()->get('userName')) ?></div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <?php if (session()->get('role') === 'admin'): ?>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url('admin/dashboard') ?>">
                                            <i class="bi bi-gear me-2"></i>Admin Panel
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                <?php endif; ?>
                                <li>
                                    <a class="dropdown-item text-danger" href="<?= base_url('auth/logout') ?>">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link px-3" href="<?= base_url('auth/login') ?>">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light btn-sm px-4 rounded-pill fw-semibold" href="<?= base_url('auth/register') ?>">
                                <i class="bi bi-person-plus me-1"></i>Get Started
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
    </div>

    <main class="container py-4">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="text-light pt-5 pb-4 mt-5">
        <div class="container">
            <div class="row g-4 pb-4">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand mb-3">
                        <div class="d-flex align-items-center mb-3">
                            <div class="footer-logo me-2">
                                <i class="bi bi-book-half fs-3"></i>
                            </div>
                            <h4 class="mb-0 fw-bold">BookHub</h4>
                        </div>
                        <p class="text-white-50 mb-4">Your ultimate destination for discovering, borrowing, and purchasing books. Join our growing community of book lovers today.</p>
                    </div>
                    
                    <div class="social-links">
                        <span class="text-white-50 small d-block mb-2">Connect with us</span>
                        <div class="d-flex gap-2">
                            <a href="#" class="social-icon" title="Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" class="social-icon" title="Twitter">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                            <a href="#" class="social-icon" title="Instagram">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="#" class="social-icon" title="LinkedIn">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="#" class="social-icon" title="YouTube">
                                <i class="bi bi-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-3 col-6">
                    <h6 class="footer-heading mb-3">Quick Links</h6>
                    <ul class="footer-links">
                        <li><a href="<?= base_url() ?>"><i class="bi bi-chevron-right"></i>Home</a></li>
                        <li><a href="<?= base_url('books') ?>"><i class="bi bi-chevron-right"></i>Browse Books</a></li>
                        <?php if (!session()->get('isLoggedIn')): ?>
                            <li><a href="<?= base_url('auth/login') ?>"><i class="bi bi-chevron-right"></i>Login</a></li>
                            <li><a href="<?= base_url('auth/register') ?>"><i class="bi bi-chevron-right"></i>Register</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-3 col-6">
                    <h6 class="footer-heading mb-3">Categories</h6>
                    <ul class="footer-links">
                        <li><a href="<?= base_url('books?category=fiction') ?>"><i class="bi bi-chevron-right"></i>Fiction</a></li>
                        <li><a href="<?= base_url('books?category=non-fiction') ?>"><i class="bi bi-chevron-right"></i>Non-Fiction</a></li>
                        <li><a href="<?= base_url('books?category=science') ?>"><i class="bi bi-chevron-right"></i>Science</a></li>
                        <li><a href="<?= base_url('books?category=technology') ?>"><i class="bi bi-chevron-right"></i>Technology</a></li>
                        <li><a href="<?= base_url('books?category=history') ?>"><i class="bi bi-chevron-right"></i>History</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <h6 class="footer-heading mb-3">Stay Updated</h6>
                    <p class="text-white-50 small mb-3">Subscribe to our newsletter for the latest book arrivals and special offers.</p>
                    
                    <form class="newsletter-form mb-4">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email address" aria-label="Email address">
                            <button class="btn btn-primary px-4" type="submit">
                                <i class="bi bi-send-fill"></i>
                            </button>
                        </div>
                    </form>
                    
                    <div class="contact-info">
                        <h6 class="footer-heading mb-3">Contact Us</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex align-items-center mb-2">
                                <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                                <span class="text-white-50 small">123 Library Street, Book City</span>
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="bi bi-envelope-fill text-primary me-2"></i>
                                <a href="mailto:info@bookhub.com" class="text-white-50 small text-decoration-none">info@bookhub.com</a>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="bi bi-telephone-fill text-primary me-2"></i>
                                <a href="tel:+1234567890" class="text-white-50 small text-decoration-none">+1 (234) 567-890</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <hr class="footer-divider">
            
            <div class="row align-items-center py-3">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 text-white-50 small">
                        &copy; <?= date('Y') ?> <strong class="text-white">BookHub</strong>. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                    <ul class="list-inline mb-0 footer-bottom-links">
                        <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                        <li class="list-inline-item"><span class="text-white-50">•</span></li>
                        <li class="list-inline-item"><a href="#">Terms of Service</a></li>
                        <li class="list-inline-item"><span class="text-white-50">•</span></li>
                        <li class="list-inline-item"><a href="#">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.counter');
            const animateCounter = (counter) => {
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;
                const updateCounter = () => {
                    current += step;
                    if (current < target) {
                        counter.textContent = Math.floor(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target + '+';
                    }
                };
                updateCounter();
            };
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (entry.target.classList.contains('counter')) {
                            animateCounter(entry.target);
                        }
                        entry.target.style.opacity = '1';
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            counters.forEach(counter => observer.observe(counter));
            document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
        });

        // Theme Toggle Functionality
        const themeToggle = document.getElementById('themeToggle');
        const html = document.documentElement;

        // Load saved theme or default to light
        const savedTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-theme', savedTheme);

        // Toggle theme on button click
        themeToggle.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        });
    </script>
</body>
</html>
