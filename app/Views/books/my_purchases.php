<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-cart"></i> My Purchases</h2>
    <a href="<?= base_url('books') ?>" class="btn btn-primary">
        <i class="bi bi-book"></i> Browse Books
    </a>
</div>

<?php if (empty($purchases)): ?>
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> You haven't made any purchases yet.
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($purchases as $index => $purchase): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($purchase['book_title']) ?></td>
                        <td><?= esc($purchase['book_author']) ?></td>
                        <td><?= $purchase['quantity'] ?></td>
                        <td>$<?= number_format($purchase['total_price'], 2) ?></td>
                        <td>
                            <?php
                            $statusClass = [
                                'pending' => 'warning',
                                'completed' => 'success',
                                'cancelled' => 'danger',
                            ];
                            ?>
                            <span class="badge bg-<?= $statusClass[$purchase['status']] ?? 'secondary' ?>">
                                <?= ucfirst($purchase['status']) ?>
                            </span>
                        </td>
                        <td><?= date('M d, Y', strtotime($purchase['created_at'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>
