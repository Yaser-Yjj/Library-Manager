<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<?php use App\Models\BookModel; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-book"></i> Manage Books</h2>
    <a href="<?= base_url('admin/books/add') ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Book
    </a>
</div>

<?php if (empty($books)): ?>
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> No books in the library yet.
    </div>
<?php else: ?>
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 80px;">Cover</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>ISBN</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th style="width: 120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $index => $book): ?>
                            <?php $coverUrl = BookModel::getCoverUrl($book['cover_image'] ?? null, $book['title']); ?>
                            <tr>
                                <td>
                                    <img src="<?= $coverUrl ?>" 
                                         alt="<?= esc($book['title']) ?>" 
                                         class="rounded"
                                         style="width: 50px; height: 70px; object-fit: cover; box-shadow: 0 2px 8px rgba(0,0,0,0.15);"
                                         onerror="this.src='https://placehold.co/50x70/667eea/ffffff?text=<?= urlencode(strtoupper(substr($book['title'], 0, 1))) ?>'">
                                </td>
                                <td>
                                    <strong><?= esc($book['title']) ?></strong>
                                </td>
                                <td><?= esc($book['author']) ?></td>
                                <td><code><?= esc($book['isbn'] ?? 'N/A') ?></code></td>
                                <td><span class="fw-semibold text-success">$<?= number_format($book['price'], 2) ?></span></td>
                                <td>
                                    <span class="badge <?= $book['stock_quantity'] > 0 ? 'bg-success' : 'bg-danger' ?> rounded-pill px-3">
                                        <?= $book['stock_quantity'] ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('books/' . $book['id']) ?>" class="btn btn-outline-info" title="View" target="_blank">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="<?= base_url('admin/books/edit/' . $book['id']) ?>" class="btn btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('admin/books/delete/' . $book['id']) ?>" 
                                           class="btn btn-outline-danger"
                                           title="Delete"
                                           onclick="return confirm('Are you sure you want to delete this book?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>
