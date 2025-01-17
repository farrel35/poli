<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poliklinik | Register Pasien</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>template/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url() ?>template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?= base_url() ?>template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>template/dist/css/adminlte.min.css">

    <script src="<?= base_url() ?>template/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>template/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="<?= base_url() ?>template/dist/js/demo.js"></script> -->
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1><b>Register Pasien</b></h1>
            </div>
            <div class="card-body">

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= $this->session->flashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>

                <?= form_open('auth/register_pasien') ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="nama" placeholder="Fullname"
                        value="<?= set_value('nama') ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('nama', '<div class="text-danger">', '</div>') ?>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="alamat" placeholder="Alamat"
                        value="<?= set_value('alamat') ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-home"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('alamat', '<div class="text-danger">', '</div>') ?>

                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="no_ktp" placeholder="No KTP"
                        value="<?= set_value('no_ktp') ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-id-card"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('no_ktp', '<div class="text-danger">', '</div>') ?>

                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="no_hp" placeholder="No HP"
                        value="<?= set_value('no_hp') ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('no_hp', '<div class="text-danger">', '</div>') ?>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
                <?= form_close() ?>

                <p class="mb-0">
                    <a href="<?= base_url() ?>auth/login_pasien" class="text-center">Login account</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>