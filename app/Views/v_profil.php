<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <!-- Asumsi menggunakan gambar default NiceAdmin -->
                <img src="<?= base_url() ?>NiceAdmin/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle mb-3" style="max-width: 120px;">
                <h2><?= ucfirst(session()->get('username')) ?></h2>
                <h3 class="text-muted"><?= ucfirst(session()->get('role')) ?></h3>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="card">
            <div class="card-body pt-3">
                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                    </li>
                </ul>
                <div class="tab-content pt-2">
                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                        <h5 class="card-title">Detail Profil Pengguna</h5>

                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 label text-muted">Username</div>
                            <div class="col-lg-9 col-md-8 fw-bold"><?= session()->get('username') ?></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 label text-muted">Role</div>
                            <div class="col-lg-9 col-md-8 fw-bold"><?= session()->get('role') ?></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 label text-muted">Email</div>
                            <div class="col-lg-9 col-md-8 fw-bold"><?= session()->get('email') ?></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 label text-muted">Waktu Login</div>
                            <div class="col-lg-9 col-md-8 fw-bold"><?= session()->get('waktu_login') ?></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 label text-muted">Status Login</div>
                            <div class="col-lg-9 col-md-8 fw-bold">
                                <?php if(session()->get('isLoggedIn')): ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div><!-- End Bordered Tabs -->
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
