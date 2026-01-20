<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php use App\Models\BookModel; ?>
<?php $coverUrl = BookModel::getCoverUrl($book['cover_image'] ?? null, $book['title']); ?>
<style>
    .book-detail-card {
        background: var(--bg-secondary);
        border-radius: 20px;
        box-shadow: var(--shadow-md);
        overflow: hidden;
    }
    .book-cover-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 400px;
    }
    .book-cover-wrapper {
        position: relative;
        width: 220px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.3);
        border-radius: 8px;
        overflow: hidden;
    }
    .book-cover-wrapper img {
        width: 100%;
        height: auto;
        display: block;
    }
    .book-details-section {
        padding: 2.5rem;
    }
    .breadcrumb {
        background: none;
        padding: 0;
        margin-bottom: 1.5rem;
    }
    .breadcrumb-item a {
        color: #667eea;
        text-decoration: none;
    }
    .book-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }
    .book-author {
        font-size: 1.1rem;
        color: var(--text-secondary);
        margin-bottom: 1.5rem;
    }
    .book-meta {
        display: grid;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    .meta-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        background: var(--bg-tertiary);
        border-radius: 12px;
    }
    .meta-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }
    .meta-label {
        font-size: 0.75rem;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .meta-value {
        font-weight: 600;
        color: var(--text-primary);
    }
    .book-price-tag {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .book-description {
        color: var(--text-secondary);
        line-height: 1.8;
        margin-bottom: 2rem;
    }
    .btn-action {
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-action:hover {
        transform: translateY(-2px);
    }
    .btn-borrow {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        border: none;
        color: white;
    }
    .btn-borrow:hover {
        box-shadow: 0 10px 30px rgba(17,153,142,0.4);
        color: white;
    }
    .btn-purchase {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border: none;
        color: white;
    }
    .btn-purchase:hover {
        box-shadow: 0 10px 30px rgba(245,87,108,0.4);
        color: white;
    }
    .stock-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 600;
    }
    .stock-badge.in-stock {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }
    .stock-badge.out-of-stock {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
</style>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="bi bi-house me-1"></i>Home</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('books') ?>">Books</a></li>
        <li class="breadcrumb-item active"><?= esc($book['title']) ?></li>
    </ol>
</nav>

<div class="book-detail-card">
    <div class="row g-0">
        <!-- Book Cover Section -->
        <div class="col-lg-4 book-cover-section">
            <div class="book-cover-wrapper">
                <img src="<?= $coverUrl ?>" 
                     alt="<?= esc($book['title']) ?>"
                     onerror="this.onerror=null; this.src='https://placehold.co/300x450/667eea/ffffff?text=<?= urlencode(strtoupper(substr($book['title'], 0, 2))) ?>';">
            </div>
        </div>
        
        <!-- Book Details Section -->
        <div class="col-lg-8">
            <div class="book-details-section">
                <h1 class="book-title"><?= esc($book['title']) ?></h1>
                <p class="book-author"><i class="bi bi-person me-2"></i>by <?= esc($book['author']) ?></p>
                
                <!-- Meta Information -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="book-meta">
                            <div class="meta-item">
                                <div class="meta-icon bg-primary bg-opacity-10 text-primary">
                                    <i class="bi bi-upc-scan"></i>
                                </div>
                                <div>
                                    <div class="meta-label">ISBN</div>
                                    <div class="meta-value"><?= esc($book['isbn'] ?? 'N/A') ?></div>
                                </div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-icon bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                                <div>
                                    <div class="meta-label">Availability</div>
                                    <div class="meta-value">
                                        <?php if ($book['stock_quantity'] > 0): ?>
                                            <span class="stock-badge in-stock">
                                                <i class="bi bi-check-circle"></i><?= $book['stock_quantity'] ?> in stock
                                            </span>
                                        <?php else: ?>
                                            <span class="stock-badge out-of-stock">
                                                <i class="bi bi-x-circle"></i>Out of Stock
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-end mt-3 mt-md-0">
                            <div class="meta-label mb-1">Price</div>
                            <div class="book-price-tag">$<?= number_format($book['price'], 2) ?></div>
                        </div>
                    </div>
                </div>
                
                <!-- Description -->
                <div class="mt-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-text-paragraph me-2"></i>Description</h5>
                    <p class="book-description"><?= esc($book['description'] ?? 'No description available for this book.') ?></p>
                </div>
                
                <!-- Action Buttons -->
                <div class="d-flex flex-wrap gap-3 mt-4 pt-3 border-top">
                    <a href="<?= base_url('books') ?>" class="btn btn-outline-secondary btn-action">
                        <i class="bi bi-arrow-left me-2"></i>Back to Books
                    </a>
                    <?php if (session()->get('isLoggedIn') && session()->get('role') === 'user'): ?>
                        <?php if ($book['stock_quantity'] > 0): ?>
                            <a href="<?= base_url('books/borrow/' . $book['id']) ?>" class="btn btn-borrow btn-action">
                                <i class="bi bi-arrow-left-right me-2"></i>Request to Borrow
                            </a>
                            <a href="<?= base_url('books/purchase/' . $book['id']) ?>" class="btn btn-purchase btn-action">
                                <i class="bi bi-cart me-2"></i>Purchase Book
                            </a>
                        <?php endif; ?>
                    <?php elseif (!session()->get('isLoggedIn')): ?>
                        <a href="<?= base_url('auth/login') ?>" class="btn btn-primary btn-action">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login to Borrow/Buy
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
