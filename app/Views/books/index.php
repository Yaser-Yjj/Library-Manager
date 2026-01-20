<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php use App\Models\BookModel; ?>
<style>
    .book-card {
        background: var(--bg-secondary);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: all 0.4s ease;
    }
    .book-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }
    .book-cover {
        height: 280px;
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .book-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .book-card:hover .book-cover img {
        transform: scale(1.05);
    }
    .book-cover-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .book-cover-placeholder i {
        font-size: 4rem;
        color: rgba(255,255,255,0.8);
    }
    .book-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 2;
    }
    .book-info {
        padding: 1.25rem;
    }
    .book-title {
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 0.25rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.3;
        height: 2.6em;
        color: var(--text-primary);
    }
    .book-author {
        color: var(--text-secondary);
        font-size: 0.875rem;
        margin-bottom: 0.75rem;
    }
    .book-description {
        font-size: 0.8rem;
        color: var(--text-muted);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 1rem;
        height: 2.4em;
    }
    .book-price {
        font-size: 1.25rem;
        font-weight: 700;
        color: #667eea;
    }
    .book-stock {
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 20px;
    }
    .btn-view {
        border: 2px solid #667eea;
        color: #667eea;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-view:hover {
        background: #667eea;
        color: white;
    }
    .btn-borrow {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        border: none;
        color: white;
        border-radius: 10px;
        font-weight: 600;
    }
    .btn-buy {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border: none;
        color: white;
        border-radius: 10px;
        font-weight: 600;
    }
    .search-box {
        position: relative;
    }
    .search-box input {
        border-radius: 12px;
        padding: 12px 20px;
        padding-right: 50px;
        border: 2px solid #e5e7eb;
        transition: all 0.3s ease;
    }
    .search-box input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102,126,234,0.1);
    }
    .search-box .btn {
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
        border-radius: 10px;
    }
</style>

<div class="mb-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
        <div>
            <span class="badge bg-primary bg-opacity-10 text-primary mb-2 px-3 py-2 rounded-pill">
                <i class="bi bi-collection me-1"></i>Library Collection
            </span>
            <h2 class="fw-bold mb-0">Browse Our Books</h2>
            <p class="text-muted mb-0">Discover your next favorite read from our collection</p>
        </div>
        <div class="search-box" style="width: 320px;">
            <input type="text" class="form-control" id="searchBooks" placeholder="Search by title or author...">
            <button class="btn btn-primary btn-sm px-3"><i class="bi bi-search"></i></button>
        </div>
    </div>

    <?php if (empty($books)): ?>
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="bi bi-book display-1 text-muted"></i>
            </div>
            <h4 class="text-muted">No books available</h4>
            <p class="text-muted">Check back later for new additions to our library.</p>
            <a href="<?= base_url() ?>" class="btn btn-primary rounded-pill px-4">
                <i class="bi bi-house me-2"></i>Go Home
            </a>
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4" id="booksGrid">
            <?php foreach ($books as $index => $book): ?>
                <?php $coverUrl = BookModel::getCoverUrl($book['cover_image'] ?? null, $book['title']); ?>
                <div class="col book-item" data-title="<?= strtolower(esc($book['title'])) ?>" data-author="<?= strtolower(esc($book['author'])) ?>">
                    <div class="book-card h-100" style="animation-delay: <?= $index * 0.05 ?>s;">
                        <div class="book-cover">
                            <img src="<?= $coverUrl ?>" 
                                 alt="<?= esc($book['title']) ?>" 
                                 loading="lazy"
                                 onerror="this.onerror=null; this.src='https://placehold.co/300x450/667eea/ffffff?text=<?= urlencode(strtoupper(substr($book['title'], 0, 2))) ?>';">
                            <div class="book-badge">
                                <?php if ($book['stock_quantity'] > 0): ?>
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i>In Stock
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle me-1"></i>Out of Stock
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="book-info">
                            <h6 class="book-title" title="<?= esc($book['title']) ?>"><?= esc($book['title']) ?></h6>
                            <p class="book-author">
                                <i class="bi bi-person me-1"></i><?= esc($book['author']) ?>
                            </p>
                            <p class="book-description">
                                <?= esc($book['description'] ?? 'No description available.') ?>
                            </p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="book-price">$<?= number_format($book['price'], 2) ?></span>
                                <span class="book-stock bg-light text-dark">
                                    <i class="bi bi-box me-1"></i><?= $book['stock_quantity'] ?> left
                                </span>
                            </div>
                            <div class="d-grid gap-2">
                                <a href="<?= base_url('books/' . $book['id']) ?>" class="btn btn-view btn-sm">
                                    <i class="bi bi-eye me-1"></i>View Details
                                </a>
                                <?php if (session()->get('isLoggedIn') && session()->get('role') === 'user'): ?>
                                    <?php if ($book['stock_quantity'] > 0): ?>
                                        <div class="btn-group" role="group">
                                            <a href="<?= base_url('books/borrow/' . $book['id']) ?>" class="btn btn-borrow btn-sm">
                                                <i class="bi bi-arrow-left-right"></i> Borrow
                                            </a>
                                            <a href="<?= base_url('books/purchase/' . $book['id']) ?>" class="btn btn-buy btn-sm">
                                                <i class="bi bi-cart"></i> Buy
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div id="noResults" class="text-center py-5 d-none">
            <i class="bi bi-search display-4 text-muted"></i>
            <h5 class="mt-3 text-muted">No books found</h5>
            <p class="text-muted">Try a different search term.</p>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchBooks');
    const booksGrid = document.getElementById('booksGrid');
    const noResults = document.getElementById('noResults');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const bookItems = document.querySelectorAll('.book-item');
            let visibleCount = 0;
            
            bookItems.forEach(item => {
                const title = item.dataset.title;
                const author = item.dataset.author;
                
                if (title.includes(searchTerm) || author.includes(searchTerm)) {
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });
            
            if (noResults) {
                if (visibleCount === 0 && searchTerm) {
                    noResults.classList.remove('d-none');
                    booksGrid.classList.add('d-none');
                } else {
                    noResults.classList.add('d-none');
                    booksGrid.classList.remove('d-none');
                }
            }
        });
    }
});
</script>
<?= $this->endSection() ?>
