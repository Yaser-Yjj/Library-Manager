<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .auth-container {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 0;
    }
    .auth-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        overflow: hidden;
        max-width: 900px;
        width: 100%;
    }
    .auth-illustration {
        background: var(--primary-gradient);
        padding: 3rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
        overflow: hidden;
    }
    .auth-illustration::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }
    .auth-illustration::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -30%;
        width: 80%;
        height: 80%;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }
    .auth-illustration-content {
        position: relative;
        z-index: 1;
        text-align: center;
        color: white;
    }
    .auth-icon-wrapper {
        width: 120px;
        height: 120px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        backdrop-filter: blur(10px);
    }
    .auth-icon-wrapper i {
        font-size: 3.5rem;
    }
    .floating-books {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        pointer-events: none;
    }
    .floating-book {
        position: absolute;
        font-size: 1.5rem;
        opacity: 0.3;
        animation: floatBook 4s ease-in-out infinite;
    }
    .floating-book:nth-child(1) { top: 15%; left: 10%; animation-delay: 0s; }
    .floating-book:nth-child(2) { top: 25%; right: 15%; animation-delay: 1s; }
    .floating-book:nth-child(3) { bottom: 20%; left: 20%; animation-delay: 2s; }
    .floating-book:nth-child(4) { bottom: 30%; right: 10%; animation-delay: 0.5s; }
    @keyframes floatBook {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(5deg); }
    }
    .auth-form-section {
        padding: 3rem;
    }
    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    .auth-header h2 {
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 0.5rem;
    }
    .auth-header p {
        color: #6b7280;
    }
    .form-floating {
        margin-bottom: 1rem;
    }
    .form-floating .form-control {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 1rem 1rem 1rem 3rem;
        height: 60px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    .form-floating .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102,126,234,0.1);
    }
    .form-floating label {
        padding-left: 3rem;
        color: #9ca3af;
    }
    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 1.2rem;
        z-index: 5;
        transition: color 0.3s ease;
    }
    .form-floating:focus-within .input-icon {
        color: #667eea;
    }
    .password-toggle {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        z-index: 5;
        padding: 0;
        transition: color 0.3s ease;
    }
    .password-toggle:hover {
        color: #667eea;
    }
    .btn-auth {
        background: var(--primary-gradient);
        border: none;
        border-radius: 12px;
        padding: 1rem;
        font-size: 1.1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-auth:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(102,126,234,0.4);
    }
    .auth-divider {
        display: flex;
        align-items: center;
        margin: 1.5rem 0;
    }
    .auth-divider::before,
    .auth-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e5e7eb;
    }
    .auth-divider span {
        padding: 0 1rem;
        color: #9ca3af;
        font-size: 0.9rem;
    }
    .auth-footer {
        text-align: center;
        margin-top: 1.5rem;
    }
    .auth-footer a {
        color: #667eea;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    .auth-footer a:hover {
        color: #764ba2;
    }
    .form-check {
        margin-bottom: 1.5rem;
    }
    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }
    @media (max-width: 768px) {
        .auth-illustration { display: none; }
        .auth-form-section { padding: 2rem; }
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="row g-0">
            <!-- Illustration Side -->
            <div class="col-lg-5 auth-illustration d-none d-lg-flex">
                <div class="floating-books">
                    <i class="bi bi-book floating-book"></i>
                    <i class="bi bi-journal-bookmark floating-book"></i>
                    <i class="bi bi-bookmark-star floating-book"></i>
                    <i class="bi bi-book-half floating-book"></i>
                </div>
                <div class="auth-illustration-content">
                    <div class="auth-icon-wrapper">
                        <i class="bi bi-door-open"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Welcome Back!</h3>
                    <p class="mb-0 opacity-75">Sign in to access your personal library, track your borrowed books, and discover new reads.</p>
                </div>
            </div>
            
            <!-- Form Side -->
            <div class="col-lg-7">
                <div class="auth-form-section">
                    <div class="auth-header">
                        <h2>Sign In</h2>
                        <p>Enter your credentials to access your account</p>
                    </div>
                    
                    <form action="<?= base_url('auth/login') ?>" method="POST">
                        <?= csrf_field() ?>
                        
                        <!-- Email Field -->
                        <div class="form-floating position-relative">
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
                            <label for="email">Email address</label>
                        </div>
                        
                        <!-- Password Field -->
                        <div class="form-floating position-relative">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            <label for="password">Password</label>
                            <button type="button" class="password-toggle" onclick="togglePassword('password', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        
                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label text-muted" for="remember">Remember me</label>
                            </div>
                            <a href="#" class="text-decoration-none" style="color: #667eea;">Forgot password?</a>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-auth">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                            </button>
                        </div>
                    </form>
                    
                    <div class="auth-divider">
                        <span>New to BookHub?</span>
                    </div>
                    
                    <div class="auth-footer">
                        <p class="mb-0 text-muted">Don't have an account? <a href="<?= base_url('auth/register') ?>">Create Account</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId, button) {
    const input = document.getElementById(inputId);
    const icon = button.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}
</script>
<?= $this->endSection() ?>
