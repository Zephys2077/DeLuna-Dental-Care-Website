<div class="p-3 sidebar">
    <h4 class="text-center">DeLuna</h4>
    <div class="user-panel my-3 text-center">
        <i class="fas fa-user-circle fa-2x mb-2"></i>
        <p class="mb-0">Admin, <?= $this->session->userdata('username') ?></p>
        <small class="text-white-50"><?= $this->session->userdata('nama_lengkap') ?></small>
    </div>

    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="<?= base_url('dashboard') ?>" class="nav-link <?= $this->uri->segment(1) == 'dashboard' ? 'active' : '' ?>">
                <i class="fas fa-tachometer-alt me-2"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('pasien') ?>" class="nav-link <?= $this->uri->segment(1) == 'pasien' ? 'active' : '' ?>">
                <i class="fas fa-users me-2"></i>
                Pasien
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('layanan') ?>" class="nav-link <?= $this->uri->segment(1) == 'layanan' ? 'active' : '' ?>">
                <i class="fas fa-th me-2"></i>
                Layanan
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('reservasi') ?>" class="nav-link <?= $this->uri->segment(1) == 'reservasi' ? 'active' : '' ?>">
                <i class="fas fa-calendar me-2"></i>
                Reservasi
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('obat') ?>" class="nav-link <?= $this->uri->segment(1) == 'obat' ? 'active' : '' ?>">
                <i class="fas fa-pills me-2"></i>
                Obat
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('rekam_medis') ?>" class="nav-link <?= $this->uri->segment(1) == 'rekam_medis' ? 'active' : '' ?>">
                <i class="fas fa-notes-medical me-2"></i>
                Rekam Medis
            </a>
        </li>
        <!-- Remove this entire block -->
        <!--
        <li class="nav-item">
            <a href="<?= base_url('laporan') ?>" class="nav-link <?= $this->uri->segment(1) == 'laporan' ? 'active' : '' ?>">
                <i class="fas fa-chart-bar me-2"></i>
                Laporan
            </a>
        </li>
        -->
        <li class="nav-item">
            <a href="<?= base_url('user') ?>" class="nav-link <?= $this->uri->segment(1) == 'user' ? 'active' : '' ?>">
                <i class="fas fa-user me-2"></i>
                User
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('auth/login') ?>" class="nav-link">
                <i class="fas fa-sign-out-alt me-2"></i>
                Logout
            </a>
        </li>
    </ul>

    <!--<div class="mt-auto text-center pt-4 small text-muted">
        De Luna All Rights Reserved.
    </div>-->
</div>
</div>
<!-- Main Content -->
<div class="col-md-9 col-lg-10 px-0">
    <nav class="navbar navbar-expand-lg main-header">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Removed duplicate logout button -->
                </ul>
            </div>
        </div>
    </nav>