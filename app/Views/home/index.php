<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <div class="row align-items-center min-vh-75">
            <div class="col-lg-6 hero-text">
                <span class="badge bg-primary mb-3 animate-fade-in">Welcome to Our Library</span>
                <h1 class="display-3 fw-bold mb-4 animate-slide-up">
                    Discover Your Next 
                    <span class="text-gradient">Favorite Book</span>
                </h1>
                <p class="lead mb-4 text-muted animate-slide-up delay-1">
                    Explore thousands of books, borrow your favorites, or purchase to keep forever. 
                    Your reading journey starts here.
                </p>
                <div class="d-flex gap-3 flex-wrap animate-slide-up delay-2">
                    <a href="<?= base_url('books') ?>" class="btn btn-primary btn-lg px-4 py-3 rounded-pill">
                        <i class="bi bi-book me-2"></i>Browse Library
                    </a>
                    <?php if (!session()->get('isLoggedIn')): ?>
                        <a href="<?= base_url('auth/register') ?>" class="btn btn-outline-dark btn-lg px-4 py-3 rounded-pill">
                            <i class="bi bi-person-plus me-2"></i>Join Now
                        </a>
                    <?php endif; ?>
                </div>
                
                <!-- Stats -->
                <div class="row mt-5 pt-4 animate-fade-in delay-3">
                    <div class="col-4">
                        <div class="stat-item">
                            <h3 class="fw-bold text-primary mb-0 counter" data-target="<?= $totalBooks ?? 500 ?>">0</h3>
                            <p class="text-muted small mb-0">Books Available</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-item">
                            <h3 class="fw-bold text-success mb-0 counter" data-target="<?= $totalUsers ?? 200 ?>">0</h3>
                            <p class="text-muted small mb-0">Happy Readers</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-item">
                            <h3 class="fw-bold text-warning mb-0 counter" data-target="50">0</h3>
                            <p class="text-muted small mb-0">Categories</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 hero-image animate-float">
                <div class="books-showcase">
                    <div class="book-stack">
                        <div class="book book-1"></div>
                        <div class="book book-2"></div>
                        <div class="book book-3"></div>
                    </div>
                    <div class="floating-elements">
                        <i class="bi bi-star-fill floating-icon icon-1"></i>
                        <i class="bi bi-heart-fill floating-icon icon-2"></i>
                        <i class="bi bi-bookmark-fill floating-icon icon-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section py-5 my-5">
    <div class="text-center mb-5">
        <span class="badge bg-light text-primary mb-2">Why Choose Us</span>
        <h2 class="display-5 fw-bold">Everything You Need</h2>
        <p class="text-muted">Discover the features that make our library special</p>
    </div>
    
    <div class="row g-4">
        <div class="col-md-6 col-lg-3">
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon bg-primary-soft">
                    <i class="bi bi-book"></i>
                </div>
                <h5 class="mt-4 mb-3">Vast Collection</h5>
                <p class="text-muted">Access thousands of books across multiple genres and categories.</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="feature-card animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="feature-icon bg-success-soft">
                    <i class="bi bi-arrow-left-right"></i>
                </div>
                <h5 class="mt-4 mb-3">Easy Borrowing</h5>
                <p class="text-muted">Borrow books with just a click and return them when you're done.</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="feature-card animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="feature-icon bg-warning-soft">
                    <i class="bi bi-cart-check"></i>
                </div>
                <h5 class="mt-4 mb-3">Purchase Books</h5>
                <p class="text-muted">Buy your favorite books at competitive prices to keep forever.</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="feature-card animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="feature-icon bg-info-soft">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h5 class="mt-4 mb-3">Secure & Safe</h5>
                <p class="text-muted">Your data and transactions are protected with top security.</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Books Section -->
<?php if (!empty($featuredBooks)): ?>
<section class="featured-books-section py-5 bg-light rounded-4 my-5">
    <div class="px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <span class="badge bg-primary mb-2">Featured</span>
                <h3 class="fw-bold mb-0">Popular Books</h3>
            </div>
            <a href="<?= base_url('books') ?>" class="btn btn-outline-primary rounded-pill">
                View All <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        
        <div class="row g-4">
            <?php foreach (array_slice($featuredBooks, 0, 4) as $index => $book): ?>
                <div class="col-md-6 col-lg-3">
                    <div class="book-card animate-on-scroll" style="animation-delay: <?= $index * 0.1 ?>s;">
                        <div class="book-cover">
                            <div class="book-cover-inner">
                                <i class="bi bi-book-half"></i>
                            </div>
                            <?php if ($book['stock_quantity'] > 0): ?>
                                <span class="badge bg-success position-absolute top-0 end-0 m-2">Available</span>
                            <?php else: ?>
                                <span class="badge bg-danger position-absolute top-0 end-0 m-2">Out of Stock</span>
                            <?php endif; ?>
                        </div>
                        <div class="book-info p-3">
                            <h6 class="fw-bold mb-1 text-truncate"><?= esc($book['title']) ?></h6>
                            <p class="text-muted small mb-2">by <?= esc($book['author']) ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary">$<?= number_format($book['price'], 2) ?></span>
                                <a href="<?= base_url('books/' . $book['id']) ?>" class="btn btn-sm btn-primary rounded-pill">
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- How It Works Section -->
<section class="how-it-works-section py-5 my-5">
    <div class="text-center mb-5">
        <span class="badge bg-light text-primary mb-2">Simple Process</span>
        <h2 class="display-5 fw-bold">How It Works</h2>
        <p class="text-muted">Get started in just 3 easy steps</p>
    </div>
    
    <div class="row g-4 position-relative">
        <div class="steps-line d-none d-lg-block"></div>
        
        <div class="col-md-4">
            <div class="step-card text-center animate-on-scroll">
                <div class="step-number">1</div>
                <div class="step-icon">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <h5 class="mt-4 mb-3">Create Account</h5>
                <p class="text-muted">Sign up for free and join our community of book lovers.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="step-card text-center animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="step-number">2</div>
                <div class="step-icon">
                    <i class="bi bi-search"></i>
                </div>
                <h5 class="mt-4 mb-3">Browse Books</h5>
                <p class="text-muted">Explore our vast collection and find your perfect read.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="step-card text-center animate-on-scroll" style="animation-delay: 0.4s;">
                <div class="step-number">3</div>
                <div class="step-icon">
                    <i class="bi bi-emoji-smile"></i>
                </div>
                <h5 class="mt-4 mb-3">Enjoy Reading</h5>
                <p class="text-muted">Borrow or buy books and start your reading adventure.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section py-5 my-5">
    <div class="text-center mb-5">
        <span class="badge bg-light text-primary mb-2">Testimonials</span>
        <h2 class="display-5 fw-bold">What Readers Say</h2>
    </div>
    
    <div class="row g-4">
        <div class="col-md-4">
            <div class="testimonial-card animate-on-scroll">
                <div class="stars mb-3">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
                <p class="mb-4">"Amazing library with a great collection. The borrowing process is so smooth and easy!"</p>
                <div class="d-flex align-items-center">
                    <div class="avatar bg-primary text-white">JD</div>
                    <div class="ms-3">
                        <h6 class="mb-0">John Doe</h6>
                        <small class="text-muted">Book Enthusiast</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="testimonial-card animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="stars mb-3">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
                <p class="mb-4">"I love how I can both borrow and purchase books. Great prices and excellent service!"</p>
                <div class="d-flex align-items-center">
                    <div class="avatar bg-success text-white">SM</div>
                    <div class="ms-3">
                        <h6 class="mb-0">Sarah Miller</h6>
                        <small class="text-muted">Avid Reader</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="testimonial-card animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="stars mb-3">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-half text-warning"></i>
                </div>
                <p class="mb-4">"The best online library I've used. Clean interface and fantastic book selection!"</p>
                <div class="d-flex align-items-center">
                    <div class="avatar bg-warning text-white">MJ</div>
                    <div class="ms-3">
                        <h6 class="mb-0">Mike Johnson</h6>
                        <small class="text-muted">Student</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5 my-5">
    <div class="cta-card text-center text-white p-5 rounded-4">
        <h2 class="display-5 fw-bold mb-3">Ready to Start Reading?</h2>
        <p class="lead mb-4 opacity-75">Join thousands of readers and explore our vast collection today.</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <?php if (session()->get('isLoggedIn')): ?>
                <a href="<?= base_url('books') ?>" class="btn btn-light btn-lg px-5 py-3 rounded-pill">
                    <i class="bi bi-book me-2"></i>Explore Books
                </a>
            <?php else: ?>
                <a href="<?= base_url('auth/register') ?>" class="btn btn-light btn-lg px-5 py-3 rounded-pill">
                    <i class="bi bi-rocket-takeoff me-2"></i>Get Started Free
                </a>
                <a href="<?= base_url('auth/login') ?>" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
