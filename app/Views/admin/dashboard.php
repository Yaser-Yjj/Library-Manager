<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h2 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard</h2>

<div class="row g-4">
    <div class="col-md-6 col-lg-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Books</h6>
                        <h2 class="mb-0"><?= $totalBooks ?></h2>
                    </div>
                    <i class="bi bi-book fs-1"></i>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?= base_url('admin/books') ?>" class="text-white text-decoration-none">
                    View Details <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Users</h6>
                        <h2 class="mb-0"><?= $totalUsers ?></h2>
                    </div>
                    <i class="bi bi-people fs-1"></i>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?= base_url('admin/users') ?>" class="text-white text-decoration-none">
                    View Details <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Pending Borrows</h6>
                        <h2 class="mb-0"><?= $pendingBorrows ?></h2>
                    </div>
                    <i class="bi bi-arrow-left-right fs-1"></i>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?= base_url('admin/borrow-requests') ?>" class="text-dark text-decoration-none">
                    View Details <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Pending Purchases</h6>
                        <h2 class="mb-0"><?= $pendingPurchases ?></h2>
                    </div>
                    <i class="bi bi-cart fs-1"></i>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?= base_url('admin/purchases') ?>" class="text-white text-decoration-none">
                    View Details <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="bi bi-lightning"></i> Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-flex gap-2 flex-wrap">
                    <a href="<?= base_url('admin/books/add') ?>" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add New Book
                    </a>
                    <a href="<?= base_url('admin/borrow-requests') ?>" class="btn btn-warning">
                        <i class="bi bi-arrow-left-right"></i> Manage Borrows
                    </a>
                    <a href="<?= base_url('admin/purchases') ?>" class="btn btn-info">
                        <i class="bi bi-cart"></i> Manage Purchases
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
