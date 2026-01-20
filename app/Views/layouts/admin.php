<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin - Library Management' ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --dark-gradient: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            --sidebar-bg: #f8f9fc;
            --sidebar-hover: #e8e9ef;
            --sidebar-active: linear-gradient(135deg, rgba(102,126,234,0.15) 0%, rgba(118,75,162,0.15) 100%);
            
            /* Light Mode Colors */
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
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
        }
        
        * { 
            font-family: 'Inter', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }
        body { background: var(--bg-primary); color: var(--text-primary); }
        
        /* Navbar Styles */
        .admin-navbar { 
            background: var(--dark-gradient) !important; 
            padding: 0.75rem 1.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .navbar-brand { display: flex; align-items: center; gap: 12px; }
        .brand-icon { 
            width: 38px; height: 38px; 
            background: var(--primary-gradient); 
            border-radius: 10px; 
            display: flex; align-items: center; justify-content: center; 
            font-size: 1.1rem; 
        }
        .brand-text { font-weight: 700; font-size: 1.2rem; }
        .navbar-badge { 
            background: var(--primary-gradient); 
            font-size: 0.65rem; 
            padding: 3px 8px; 
            border-radius: 6px; 
            margin-left: 8px;
            font-weight: 600;
        }
        
        /* Nav Items */
        .admin-nav-link { 
            color: rgba(255,255,255,0.8) !important; 
            font-weight: 500; 
            padding: 8px 16px !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .admin-nav-link:hover { 
            background: rgba(255,255,255,0.1); 
            color: #fff !important; 
        }
        .admin-nav-link.view-site {
            background: rgba(40, 167, 69, 0.2);
            color: #4ade80 !important;
        }
        .admin-nav-link.view-site:hover {
            background: rgba(40, 167, 69, 0.3);
        }
        
        /* User Dropdown */
        .user-dropdown-toggle {
            background: rgba(255,255,255,0.1);
            border-radius: 50px;
            padding: 6px 16px 6px 6px !important;
        }
        .user-avatar { 
            width: 32px; height: 32px; 
            background: var(--primary-gradient); 
            border-radius: 50%; 
            display: flex; align-items: center; justify-content: center; 
            font-size: 0.9rem; 
        }
        .dropdown-menu { 
            border: none; 
            border-radius: 12px; 
            box-shadow: 0 10px 40px rgba(0,0,0,0.15); 
            padding: 8px;
        }
        .dropdown-item { 
            border-radius: 8px; 
            padding: 10px 16px; 
            transition: all 0.2s ease; 
        }
        .dropdown-item:hover { 
            background: #f0f0f0; 
        }
        .dropdown-item.text-danger:hover {
            background: rgba(220, 53, 69, 0.1);
        }
        
        /* Sidebar Styles */
        .sidebar {
            min-height: calc(100vh - 64px);
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            padding-top: 1.5rem;
        }
        .sidebar-header {
            padding: 0 1.25rem 1rem;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 1rem;
        }
        .sidebar-header h6 {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--text-muted);
            font-weight: 600;
            margin: 0;
        }
        .sidebar .nav-link {
            color: var(--text-secondary);
            font-weight: 500;
            padding: 12px 20px;
            margin: 4px 12px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link i {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }
        .sidebar .nav-link:hover {
            background: var(--sidebar-hover);
            color: var(--text-primary);
            transform: translateX(5px);
        }
        .sidebar .nav-link.active {
            background: var(--sidebar-active);
            color: #667eea;
            font-weight: 600;
        }
        .sidebar .nav-link.active i {
            color: #667eea;
        }
        
        /* Main Content */
        main {
            background: var(--bg-primary);
        }
        
        /* Cards & Alerts */
        .card { 
            background: var(--bg-secondary);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
            border-radius: 16px; 
            box-shadow: var(--shadow-sm); 
        }
        .alert { 
            border: none; 
            border-radius: 12px; 
        }
        
        /* Tables */
        .table {
            color: var(--text-primary);
        }
        .table-hover tbody tr:hover {
            background: var(--bg-tertiary);
        }
        
        /* Forms */
        .form-control, .form-select {
            background: var(--bg-primary);
            color: var(--text-primary);
            border-color: var(--border-color);
        }
        .form-control:focus, .form-select:focus {
            background: var(--bg-primary);
            color: var(--text-primary);
            border-color: #667eea;
        }
        
        /* Theme Toggle */
        .theme-toggle {
            cursor: pointer;
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 10px;
        }
        .theme-toggle i {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.3s ease;
        }
        .theme-toggle .bi-sun-fill {
            opacity: 1;
            transform: translate(-50%, -50%) rotate(0deg) scale(1);
        }
        .theme-toggle .bi-moon-stars-fill {
            opacity: 0;
            transform: translate(-50%, -50%) rotate(180deg) scale(0);
        }
        [data-theme="dark"] .theme-toggle .bi-sun-fill {
            opacity: 0;
            transform: translate(-50%, -50%) rotate(-180deg) scale(0);
        }
        [data-theme="dark"] .theme-toggle .bi-moon-stars-fill {
            opacity: 1;
            transform: translate(-50%, -50%) rotate(0deg) scale(1);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { min-height: auto; }
        }
    </style>
</head>
<body>
    <!-- Admin Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark admin-navbar sticky-top">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand text-white text-decoration-none" href="<?= base_url('admin/dashboard') ?>">
                <div class="brand-icon">
                    <i class="bi bi-book-half"></i>
                </div>
                <span class="brand-text">BookHub</span>
                <span class="navbar-badge">ADMIN</span>
            </a>
            
            <!-- Mobile Toggle -->
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                    <!-- Theme Toggle -->
                    <li class="nav-item">
                        <button class="theme-toggle admin-nav-link border-0 bg-transparent" id="adminThemeToggle" aria-label="Toggle theme">
                            <i class="bi bi-sun-fill"></i>
                            <i class="bi bi-moon-stars-fill"></i>
                        </button>
                    </li>
                    
                    <!-- View Site Link -->
                    <li class="nav-item">
                        <a class="admin-nav-link view-site" href="<?= base_url() ?>" target="_blank">
                            <i class="bi bi-box-arrow-up-right"></i>
                            <span>View Site</span>
                        </a>
                    </li>
                    
                    <!-- User Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="admin-nav-link user-dropdown-toggle dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-avatar">
                                <i class="bi bi-person-fill text-white"></i>
                            </div>
                            <span class="d-none d-lg-inline"><?= esc(session()->get('userName')) ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <div class="px-3 py-2 border-bottom mb-2">
                                    <small class="text-muted">Signed in as</small>
                                    <div class="fw-semibold"><?= esc(session()->get('userName')) ?></div>
                                    <span class="badge bg-primary mt-1">Administrator</span>
                                </div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= base_url('admin/dashboard') ?>">
                                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                </a>
                            </li>
                            <li><hr class="dropdown-divider my-2"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="<?= base_url('auth/logout') ?>">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Enhanced Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse" id="sidebarMenu">
                <div class="position-sticky pt-2">
                    <div class="sidebar-header">
                        <h6>Main Menu</h6>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?= str_contains(uri_string(), 'dashboard') ? 'active' : '' ?>" href="<?= base_url('admin/dashboard') ?>">
                                <i class="bi bi-speedometer2"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= str_contains(uri_string(), 'admin/books') ? 'active' : '' ?>" href="<?= base_url('admin/books') ?>">
                                <i class="bi bi-book"></i>
                                <span>Books</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= str_contains(uri_string(), 'borrow-requests') ? 'active' : '' ?>" href="<?= base_url('admin/borrow-requests') ?>">
                                <i class="bi bi-arrow-left-right"></i>
                                <span>Borrow Requests</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= str_contains(uri_string(), 'purchases') ? 'active' : '' ?>" href="<?= base_url('admin/purchases') ?>">
                                <i class="bi bi-cart3"></i>
                                <span>Purchases</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= str_contains(uri_string(), 'users') ? 'active' : '' ?>" href="<?= base_url('admin/users') ?>">
                                <i class="bi bi-people"></i>
                                <span>Users</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <!-- Flash Messages -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Theme Toggle Functionality
        const themeToggle = document.getElementById('adminThemeToggle');
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
