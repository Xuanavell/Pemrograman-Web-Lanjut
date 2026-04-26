<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="card p-3">
        <h5 class="card-title">Profile Information</h5>

        <div class="row mb-2">
            <label class="col-sm-3 fw-bold text-primary">Username</label>
                <div class="col-sm-6">
                <?= $username ?>
                </div>
        </div>

        <div class="row mb-2">
            <label class="col-sm-3 fw-bold text-primary">Role</label>
                <div class="col-sm-6">
                    <span class="badge bg-danger"><?= $role ?></span>
                </div>
        </div>

        <div class="row mb-2">
            <label class="col-sm-3 fw-bold text-primary">Email</label>
                <div class="col-sm-6">
                    <span class="text-primary"><?= $email ?></span>
                </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 fw-bold text-primary">Login Time</label>
                <div class="col-sm-9">
                    <span><?= $login_time ?></span>
                </div>
        </div>

        <div class="row mb-2">
            <label class="col-sm-3 fw-bold text-primary">Status</label>
                <div class="col-sm-6">
                    <span class="badge bg-success">
                        <i class="bi bi-check-circle me-1"></i> Sudah Login
                    </span>
                </div>
        </div>

</div>
<?= $this->endSection() ?>