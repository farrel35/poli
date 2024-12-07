<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>template/index3.html" class="brand-link">
        <img src="<?= base_url() ?>template/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
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
                <?php endif; ?>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php if ($this->session->userdata('role') == 'pasien'): ?>
                <li class="nav-item">
                    <a href="<?= base_url() ?>pasien" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url() ?>pasien/poli" class="nav-link">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>Poli</p>
                    </a>
                </li>
                <?php elseif ($this->session->userdata('role') == 'admin'): ?>
                <!-- Menu for Admin -->
                <li class="nav-item">
                    <a href="<?= base_url() ?>admin" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url() ?>admin/dokter" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Dokter</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url() ?>admin/manage_users" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Pasien</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url() ?>admin/poli" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Poli</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url() ?>admin/obat" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Obat</p>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

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
                        <li class="breadcrumb-item"><a href="#">Pasien</a></li>
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