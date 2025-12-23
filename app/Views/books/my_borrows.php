<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-arrow-left-right"></i> My Borrow Requests</h2>
    <a href="<?= base_url('books') ?>" class="btn btn-primary">
        <i class="bi bi-book"></i> Browse Books
    </a>
</div>

<?php if (empty($requests)): ?>
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> You haven't made any borrow requests yet.
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Request Date</th>
                    <th>Status</th>
                    <th>Return Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($requests as $index => $request): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($request['book_title']) ?></td>
                        <td><?= esc($request['book_author']) ?></td>
                        <td><?= date('M d, Y', strtotime($request['request_date'])) ?></td>
                        <td>
                            <?php
                            $statusClass = [
                                'pending' => 'warning',
                                'approved' => 'success',
                                'rejected' => 'danger',
                                'returned' => 'info',
                            ];
                            ?>
                            <span class="badge bg-<?= $statusClass[$request['status']] ?? 'secondary' ?>">
                                <?= ucfirst($request['status']) ?>
                            </span>
                        </td>
                        <td>
                            <?= $request['return_date'] ? date('M d, Y', strtotime($request['return_date'])) : '-' ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>
