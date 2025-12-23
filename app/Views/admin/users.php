<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h2 class="mb-4"><i class="bi bi-people"></i> Users</h2>

<?php if (empty($users)): ?>
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> No registered users yet.
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $index => $user): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($user['name']) ?></td>
                        <td><?= esc($user['email']) ?></td>
                        <td><?= date('M d, Y', strtotime($user['created_at'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>
