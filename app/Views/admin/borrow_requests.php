<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h2 class="mb-4"><i class="bi bi-arrow-left-right"></i> Borrow Requests</h2>

<?php if (empty($requests)): ?>
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> No borrow requests yet.
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Book</th>
                    <th>Request Date</th>
                    <th>Status</th>
                    <th>Return Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($requests as $index => $request): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td>
                            <?= esc($request['user_name']) ?><br>
                            <small class="text-muted"><?= esc($request['user_email']) ?></small>
                        </td>
                        <td><?= esc($request['book_title']) ?></td>
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
                        <td>
                            <form action="<?= base_url('admin/borrow-requests/update/' . $request['id']) ?>" method="POST" class="d-inline">
                                <?= csrf_field() ?>
                                <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                    <option value="">Change Status</option>
                                    <option value="pending" <?= $request['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="approved" <?= $request['status'] === 'approved' ? 'selected' : '' ?>>Approved</option>
                                    <option value="rejected" <?= $request['status'] === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                    <option value="returned" <?= $request['status'] === 'returned' ? 'selected' : '' ?>>Returned</option>
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
