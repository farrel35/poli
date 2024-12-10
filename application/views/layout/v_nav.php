<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= base_url() ?>template/dist/img/logo-udinus.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Poliklinik</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url() ?>template/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <?php if ($this->session->userdata('role') == 'admin'): ?>
                    <a href="#" class="d-block">Admin</a>
                <?php else: ?>
                    <a href="#" class="d-block"><?= $detail_akun->nama ?></a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Menu for Pasien -->
                <?php if ($this->session->userdata('role') == 'pasien'): ?>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>pasien" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>pasien/poli" class="nav-link">
                            <i class="nav-icon fas fa-hospital"></i>
                            <p>Poli</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#logoutModal">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                    </li>

                    <!-- Menu for Dokter -->
                <?php elseif ($this->session->userdata('role') == 'dokter'): ?>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>dokter" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>dokter/jadwal_periksa" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Jadwal Periksa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>dokter/daftar_periksa" class="nav-link">
                            <i class="nav-icon fas fa-stethoscope"></i>
                            <p>Memeriksa Pasien</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>dokter/riwayat_pasien" class="nav-link">
                            <i class="nav-icon fas fa-notes-medical"></i>
                            <p>Riwayat Pasien</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>dokter/profil" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Profil</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#logoutModal">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                    </li>

                    <!-- Menu for Admin -->
                <?php elseif ($this->session->userdata('role') == 'admin'): ?>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>admin" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>admin/dokter" class="nav-link">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Dokter</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>admin/pasien" class="nav-link">
                            <i class="nav-icon fas fa-user-injured"></i>
                            <p>Pasien</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>admin/poli" class="nav-link">
                            <i class="nav-icon fas fa-hospital"></i>
                            <p>Poli</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>admin/obat" class="nav-link">
                            <i class="nav-icon fas fa-pills"></i>
                            <p>Obat</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#logoutModal">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin keluar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a href="<?= base_url() ?>auth/logout" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="<?= base_url() . $this->uri->segment(1) ?>"><?= $menu ?></a></li>

                        </li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">