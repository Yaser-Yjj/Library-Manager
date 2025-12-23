<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('books') ?>">Books</a></li>
                <li class="breadcrumb-item active"><?= esc($book['title']) ?></li>
            </ol>
        </nav>
        
        <div class="card">
            <div class="card-header">
                <h3><?= esc($book['title']) ?></h3>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="150">Author:</th>
                        <td><?= esc($book['author']) ?></td>
                    </tr>
                    <tr>
                        <th>ISBN:</th>
                        <td><?= esc($book['isbn'] ?? 'N/A') ?></td>
                    </tr>
                    <tr>
                        <th>Price:</th>
                        <td><span class="badge bg-primary fs-5">$<?= number_format($book['price'], 2) ?></span></td>
                    </tr>
                    <tr>
                        <th>Availability:</th>
                        <td>
                            <span class="badge <?= $book['stock_quantity'] > 0 ? 'bg-success' : 'bg-danger' ?> fs-6">
                                <?= $book['stock_quantity'] > 0 ? 'In Stock: ' . $book['stock_quantity'] : 'Out of Stock' ?>
                            </span>
                        </td>
                    </tr>
                </table>
                
                <h5>Description</h5>
                <p><?= esc($book['description'] ?? 'No description available.') ?></p>
            </div>
            <div class="card-footer">
                <div class="d-flex gap-2">
                    <a href="<?= base_url('books') ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Books
                    </a>
                    <?php if (session()->get('isLoggedIn') && session()->get('role') === 'user'): ?>
                        <?php if ($book['stock_quantity'] > 0): ?>
                            <a href="<?= base_url('books/borrow/' . $book['id']) ?>" class="btn btn-success">
                                <i class="bi bi-arrow-left-right"></i> Request to Borrow
                            </a>
                            <a href="<?= base_url('books/purchase/' . $book['id']) ?>" class="btn btn-warning">
                                <i class="bi bi-cart"></i> Purchase
                            </a>
                        <?php endif; ?>
                    <?php elseif (!session()->get('isLoggedIn')): ?>
                        <a href="<?= base_url('auth/login') ?>" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right"></i> Login to Borrow/Buy
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
