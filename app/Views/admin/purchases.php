<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h2 class="mb-4"><i class="bi bi-cart"></i> Purchase Requests</h2>

<?php if (empty($purchases)): ?>
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> No purchase requests yet.
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Book</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($purchases as $index => $purchase): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td>
                            <?= esc($purchase['user_name']) ?><br>
                            <small class="text-muted"><?= esc($purchase['user_email']) ?></small>
                        </td>
                        <td><?= esc($purchase['book_title']) ?></td>
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
                        <td>
                            <form action="<?= base_url('admin/purchases/update/' . $purchase['id']) ?>" method="POST" class="d-inline">
                                <?= csrf_field() ?>
                                <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                    <option value="">Change Status</option>
                                    <option value="pending" <?= $purchase['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="completed" <?= $purchase['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                                    <option value="cancelled" <?= $purchase['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>
