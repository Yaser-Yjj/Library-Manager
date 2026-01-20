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
        max-width: 950px;
        width: 100%;
    }
    .auth-illustration {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
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
    .floating-elements {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        pointer-events: none;
    }
    .floating-el {
        position: absolute;
        font-size: 1.5rem;
        opacity: 0.3;
        animation: floatEl 4s ease-in-out infinite;
    }
    .floating-el:nth-child(1) { top: 10%; left: 15%; animation-delay: 0s; }
    .floating-el:nth-child(2) { top: 20%; right: 10%; animation-delay: 0.8s; }
    .floating-el:nth-child(3) { bottom: 25%; left: 10%; animation-delay: 1.6s; }
    .floating-el:nth-child(4) { bottom: 15%; right: 20%; animation-delay: 0.4s; }
    .floating-el:nth-child(5) { top: 45%; left: 5%; animation-delay: 1.2s; }
    @keyframes floatEl {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-12px) rotate(8deg); }
    }
    .benefits-list {
        text-align: left;
        margin-top: 2rem;
        padding: 0;
        list-style: none;
    }
    .benefits-list li {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 1rem;
        font-size: 0.95rem;
        opacity: 0.9;
    }
    .benefits-list li i {
        width: 28px;
        height: 28px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
    }
    .auth-form-section {
        padding: 2.5rem 3rem;
    }
    .auth-header {
        text-align: center;
        margin-bottom: 1.5rem;
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
        height: 58px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    .form-floating .form-control:focus {
        border-color: #11998e;
        box-shadow: 0 0 0 4px rgba(17,153,142,0.1);
    }
    .form-floating .form-control.is-invalid {
        border-color: #dc3545;
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
        color: #11998e;
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
        color: #11998e;
    }
    .btn-auth {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        border: none;
        border-radius: 12px;
        padding: 1rem;
        font-size: 1.1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-auth:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(17,153,142,0.4);
    }
    .password-strength {
        height: 4px;
        background: #e5e7eb;
        border-radius: 2px;
        margin-top: 8px;
        overflow: hidden;
    }
    .password-strength-bar {
        height: 100%;
        width: 0%;
        border-radius: 2px;
        transition: all 0.3s ease;
    }
    .password-strength-bar.weak { width: 25%; background: #dc3545; }
    .password-strength-bar.fair { width: 50%; background: #ffc107; }
    .password-strength-bar.good { width: 75%; background: #17a2b8; }
    .password-strength-bar.strong { width: 100%; background: #28a745; }
    .password-hint {
        font-size: 0.8rem;
        color: #9ca3af;
        margin-top: 5px;
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
        margin-top: 1rem;
    }
    .auth-footer a {
        color: #11998e;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    .auth-footer a:hover {
        color: #0d7d74;
    }
    .form-check-input:checked {
        background-color: #11998e;
        border-color: #11998e;
    }
    .terms-text {
        font-size: 0.85rem;
        color: #6b7280;
    }
    .terms-text a {
        color: #11998e;
        text-decoration: none;
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
                <div class="floating-elements">
                    <i class="bi bi-person-plus floating-el"></i>
                    <i class="bi bi-star floating-el"></i>
                    <i class="bi bi-book floating-el"></i>
                    <i class="bi bi-heart floating-el"></i>
                    <i class="bi bi-bookmark floating-el"></i>
                </div>
                <div class="auth-illustration-content">
                    <div class="auth-icon-wrapper">
                        <i class="bi bi-person-plus"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Join BookHub</h3>
                    <p class="mb-0 opacity-75">Create your account and start your reading journey today.</p>
                    
                    <ul class="benefits-list">
                        <li>
                            <i class="bi bi-check-lg"></i>
                            <span>Access thousands of books</span>
                        </li>
                        <li>
                            <i class="bi bi-check-lg"></i>
                            <span>Borrow books for free</span>
                        </li>
                        <li>
                            <i class="bi bi-check-lg"></i>
                            <span>Track your reading progress</span>
                        </li>
                        <li>
                            <i class="bi bi-check-lg"></i>
                            <span>Get personalized recommendations</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Form Side -->
            <div class="col-lg-7">
                <div class="auth-form-section">
                    <div class="auth-header">
                        <h2>Create Account</h2>
                        <p>Fill in your details to get started</p>
                    </div>
                    
                    <form action="<?= base_url('auth/register') ?>" method="POST" id="registerForm">
                        <?= csrf_field() ?>
                        
                        <!-- Full Name Field -->
                        <div class="form-floating position-relative">
                            <i class="bi bi-person input-icon"></i>
                            <input type="text" class="form-control <?= session('errors.name') ? 'is-invalid' : '' ?>" 
                                   id="name" name="name" placeholder="Full Name" 
                                   value="<?= old('name') ?>" required>
                            <label for="name">Full Name</label>
                            <?php if (session('errors.name')): ?>
                                <div class="invalid-feedback"><?= session('errors.name') ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Email Field -->
                        <div class="form-floating position-relative">
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" 
                                   id="email" name="email" placeholder="Email address" 
                                   value="<?= old('email') ?>" required>
                            <label for="email">Email address</label>
                            <?php if (session('errors.email')): ?>
                                <div class="invalid-feedback"><?= session('errors.email') ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Password Field -->
                        <div class="form-floating position-relative">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" 
                                   id="password" name="password" placeholder="Password" required 
                                   onkeyup="checkPasswordStrength(this.value)">
                            <label for="password">Password</label>
                            <button type="button" class="password-toggle" onclick="togglePassword('password', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                            <?php if (session('errors.password')): ?>
                                <div class="invalid-feedback"><?= session('errors.password') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="password-strength">
                            <div class="password-strength-bar" id="strengthBar"></div>
                        </div>
                        <p class="password-hint" id="strengthText">Use 8+ characters with mix of letters & numbers</p>
                        
                        <!-- Confirm Password Field -->
                        <div class="form-floating position-relative mt-3">
                            <i class="bi bi-lock-fill input-icon"></i>
                            <input type="password" class="form-control <?= session('errors.password_confirm') ? 'is-invalid' : '' ?>" 
                                   id="password_confirm" name="password_confirm" placeholder="Confirm Password" required>
                            <label for="password_confirm">Confirm Password</label>
                            <button type="button" class="password-toggle" onclick="togglePassword('password_confirm', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                            <?php if (session('errors.password_confirm')): ?>
                                <div class="invalid-feedback"><?= session('errors.password_confirm') ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Terms Agreement -->
                        <div class="form-check mt-3 mb-4">
                            <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                            <label class="form-check-label terms-text" for="terms">
                                I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                            </label>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-auth">
                                <i class="bi bi-person-plus me-2"></i>Create Account
                            </button>
                        </div>
                    </form>
                    
                    <div class="auth-divider">
                        <span>Already a member?</span>
                    </div>
                    
                    <div class="auth-footer">
                        <p class="mb-0 text-muted">Have an account? <a href="<?= base_url('auth/login') ?>">Sign In</a></p>
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

function checkPasswordStrength(password) {
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');
    
    let strength = 0;
    if (password.length >= 8) strength++;
    if (password.match(/[a-z]+/)) strength++;
    if (password.match(/[A-Z]+/)) strength++;
    if (password.match(/[0-9]+/)) strength++;
    if (password.match(/[!@#$%^&*(),.?":{}|<>]+/)) strength++;
    
    strengthBar.className = 'password-strength-bar';
    
    if (password.length === 0) {
        strengthBar.style.width = '0%';
        strengthText.textContent = 'Use 8+ characters with mix of letters & numbers';
    } else if (strength <= 2) {
        strengthBar.classList.add('weak');
        strengthText.textContent = 'Weak password';
    } else if (strength === 3) {
        strengthBar.classList.add('fair');
        strengthText.textContent = 'Fair password';
    } else if (strength === 4) {
        strengthBar.classList.add('good');
        strengthText.textContent = 'Good password';
    } else {
        strengthBar.classList.add('strong');
        strengthText.textContent = 'Strong password!';
    }
}
</script>
<?= $this->endSection() ?>
