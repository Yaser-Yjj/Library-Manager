<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <span class="badge bg-primary mb-2">Library Collection</span>
            <h2 class="fw-bold mb-0"><i class="bi bi-book"></i> Browse Books</h2>
        </div>
        <div class="d-flex gap-2">
            <div class="input-group" style="width: 300px;">
                <input type="text" class="form-control" id="searchBooks" placeholder="Search books...">
                <button class="btn btn-primary"><i class="bi bi-search"></i></button>
            </div>
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
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4" id="booksGrid">
            <?php foreach ($books as $index => $book): ?>
                <div class="col book-item" data-title="<?= strtolower(esc($book['title'])) ?>" data-author="<?= strtolower(esc($book['author'])) ?>">
                    <div class="book-card animate-on-scroll h-100" style="animation-delay: <?= $index * 0.05 ?>s;">
                        <div class="book-cover" style="background: <?= ['var(--primary-gradient)', 'var(--secondary-gradient)', 'var(--success-gradient)', 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)', 'linear-gradient(135deg, #5ee7df 0%, #b490ca 100%)'][$index % 5] ?>;">
                            <div class="book-cover-inner">
                                <i class="bi bi-book-half"></i>
                            </div>
                            <?php if ($book['stock_quantity'] > 0): ?>
                                <span class="badge bg-success position-absolute top-0 end-0 m-2">
                                    <i class="bi bi-check-circle me-1"></i>In Stock
                                </span>
                            <?php else: ?>
                                <span class="badge bg-danger position-absolute top-0 end-0 m-2">
                                    <i class="bi bi-x-circle me-1"></i>Out of Stock
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="book-info p-3">
                            <h6 class="fw-bold mb-1 text-truncate" title="<?= esc($book['title']) ?>"><?= esc($book['title']) ?></h6>
                            <p class="text-muted small mb-2">
                                <i class="bi bi-person me-1"></i><?= esc($book['author']) ?>
                            </p>
                            <p class="small text-muted mb-3" style="height: 40px; overflow: hidden;">
                                <?= esc(substr($book['description'] ?? 'No description available.', 0, 60)) ?>...
                            </p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="h5 fw-bold text-primary mb-0">$<?= number_format($book['price'], 2) ?></span>
                                <span class="badge bg-light text-dark">
                                    <i class="bi bi-box me-1"></i><?= $book['stock_quantity'] ?> left
                                </span>
                            </div>
                            <div class="d-grid gap-2">
                                <a href="<?= base_url('books/' . $book['id']) ?>" class="btn btn-outline-primary btn-sm rounded-pill">
                                    <i class="bi bi-eye me-1"></i>View Details
                                </a>
                                <?php if (session()->get('isLoggedIn') && session()->get('role') === 'user'): ?>
                                    <?php if ($book['stock_quantity'] > 0): ?>
                                        <div class="btn-group" role="group">
                                            <a href="<?= base_url('books/borrow/' . $book['id']) ?>" class="btn btn-success btn-sm">
                                                <i class="bi bi-arrow-left-right"></i> Borrow
                                            </a>
                                            <a href="<?= base_url('books/purchase/' . $book['id']) ?>" class="btn btn-warning btn-sm">
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
