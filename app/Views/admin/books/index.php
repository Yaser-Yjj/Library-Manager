<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-book"></i> Manage Books</h2>
    <a href="<?= base_url('admin/books/add') ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Book
    </a>
</div><?php if (empty($books)): ?>
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> No books in the library yet.
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $index => $book): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($book['title']) ?></td>
                        <td><?= esc($book['author']) ?></td>
                        <td><?= esc($book['isbn'] ?? 'N/A') ?></td>
                        <td>$<?= number_format($book['price'], 2) ?></td>
                        <td>
                            <span class="badge <?= $book['stock_quantity'] > 0 ? 'bg-success' : 'bg-danger' ?>">
                                <?= $book['stock_quantity'] ?>
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="<?= base_url('admin/books/edit/' . $book['id']) ?>" class="btn btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?= base_url('admin/books/delete/' . $book['id']) ?>" 
                                   class="btn btn-outline-danger"
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
<?php endif; ?>
<?= $this->endSection() ?>
