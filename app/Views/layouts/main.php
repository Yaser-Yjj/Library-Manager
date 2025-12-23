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
        }
        * { font-family: 'Inter', sans-serif; }
        body { overflow-x: hidden; background: #fafbfc; }
        .navbar { background: var(--dark-gradient) !important; backdrop-filter: blur(10px); box-shadow: 0 4px 30px rgba(0,0,0,0.1); padding: 1rem 0; }
        .navbar-brand { font-weight: 700; font-size: 1.5rem; }
        .nav-link { font-weight: 500; transition: all 0.3s ease; position: relative; }
        .nav-link:hover { transform: translateY(-2px); }
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
        .stat-item { padding: 1rem; border-radius: 12px; background: white; box-shadow: 0 4px 20px rgba(0,0,0,0.05); text-align: center; transition: all 0.3s ease; }
        .stat-item:hover { transform: translateY(-5px); box-shadow: 0 8px 30px rgba(0,0,0,0.1); }
        .feature-card { background: white; border-radius: 20px; padding: 2rem; height: 100%; box-shadow: 0 4px 20px rgba(0,0,0,0.05); transition: all 0.4s ease; border: 1px solid rgba(0,0,0,0.05); }
        .feature-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .feature-icon { width: 70px; height: 70px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; }
        .bg-primary-soft { background: rgba(102,126,234,0.15); color: #667eea; }
        .bg-success-soft { background: rgba(40,167,69,0.15); color: #28a745; }
        .bg-warning-soft { background: rgba(255,193,7,0.15); color: #ffc107; }
        .bg-info-soft { background: rgba(23,162,184,0.15); color: #17a2b8; }
        .book-card { background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.4s ease; }
        .book-card:hover { transform: translateY(-8px); box-shadow: 0 15px 40px rgba(0,0,0,0.15); }
        .book-cover { height: 180px; background: var(--primary-gradient); display: flex; align-items: center; justify-content: center; position: relative; }
        .book-cover-inner { width: 100px; height: 140px; background: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #667eea; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
        .step-card { padding: 2rem; position: relative; }
        .step-number { position: absolute; top: 0; right: 20px; font-size: 5rem; font-weight: 800; color: rgba(102,126,234,0.1); line-height: 1; }
        .step-icon { width: 80px; height: 80px; background: var(--primary-gradient); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: white; margin: 0 auto; box-shadow: 0 10px 30px rgba(102,126,234,0.4); }
        .steps-line { position: absolute; top: 60px; left: 20%; right: 20%; height: 3px; background: linear-gradient(90deg, #667eea 0%, #764ba2 50%, #667eea 100%); z-index: -1; }
        .testimonial-card { background: white; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 20px rgba(0,0,0,0.05); transition: all 0.3s ease; height: 100%; }
        .testimonial-card:hover { transform: translateY(-5px); box-shadow: 0 15px 40px rgba(0,0,0,0.1); }
        .avatar { width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; }
        .cta-card { background: var(--primary-gradient); position: relative; overflow: hidden; }
        .cta-card::before { content: ''; position: absolute; top: -50%; right: -20%; width: 60%; height: 200%; background: rgba(255,255,255,0.1); border-radius: 50%; }
        .animate-on-scroll { opacity: 0; transform: translateY(30px); animation: slideUp 0.6s ease-out forwards; }
        .btn-primary { background: var(--primary-gradient); border: none; transition: all 0.3s ease; }
        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(102,126,234,0.4); background: var(--primary-gradient); }
        .btn-outline-primary { border: 2px solid #667eea; color: #667eea; }
        .btn-outline-primary:hover { background: var(--primary-gradient); border-color: transparent; transform: translateY(-3px); }
        footer { background: var(--dark-gradient) !important; }
        .card { border: none; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 15px 40px rgba(0,0,0,0.12); }
        .alert { border: none; border-radius: 12px; }
        @media (max-width: 768px) {
            .hero-section h1 { font-size: 2.5rem; }
            .books-showcase { height: 300px; margin-top: 2rem; }
            .book-stack { transform: scale(0.7); }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <i class="bi bi-book-half me-2"></i>BookHub
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>"><i class="bi bi-house me-1"></i>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('books') ?>"><i class="bi bi-book me-1"></i>Books</a>
                    </li>
                    <?php if (session()->get('isLoggedIn')): ?>
                        <?php if (session()->get('role') === 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('admin/dashboard') ?>"><i class="bi bi-speedometer2 me-1"></i>Dashboard</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('books/my-borrows') ?>"><i class="bi bi-arrow-left-right me-1"></i>My Borrows</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('books/my-purchases') ?>"><i class="bi bi-bag me-1"></i>My Purchases</a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav">
                    <?php if (session()->get('isLoggedIn')): ?>
                        <li class="nav-item">
                            <span class="nav-link"><i class="bi bi-person-circle me-1"></i><?= session()->get('userName') ?></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="<?= base_url('auth/logout') ?>"><i class="bi bi-box-arrow-right me-1"></i>Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('auth/login') ?>"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary btn-sm ms-2 px-3 rounded-pill" href="<?= base_url('auth/register') ?>"><i class="bi bi-person-plus me-1"></i>Register</a>
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

    <footer class="text-light py-5 mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-book-half me-2"></i>BookHub</h5>
                    <p class="text-white-50">Your ultimate destination for discovering, borrowing, and purchasing books. Join our community of book lovers today.</p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-white-50 fs-5"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white-50 fs-5"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white-50 fs-5"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h6 class="fw-bold mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?= base_url() ?>" class="text-white-50 text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="<?= base_url('books') ?>" class="text-white-50 text-decoration-none">Books</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h6 class="fw-bold mb-3">Categories</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Fiction</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Non-Fiction</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Science</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4">
                    <h6 class="fw-bold mb-3">Newsletter</h6>
                    <p class="text-white-50">Subscribe for updates on new books.</p>
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Enter your email">
                        <button class="btn btn-primary"><i class="bi bi-send"></i></button>
                    </div>
                </div>
            </div>
            <hr class="my-4 border-secondary">
            <div class="text-center text-white-50">
                <p class="mb-0">&copy; <?= date('Y') ?> BookHub Library Management System. All rights reserved.</p>
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
    </script>
</body>
</html>
