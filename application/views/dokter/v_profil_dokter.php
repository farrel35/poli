<div class="col-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <?php if ($this->session->flashdata('error')): ?>
                <script>
                    $(document).ready(function() {
                        toastr.options = {
                            "progressBar": true, // Enable the progress bar
                            "timeOut": "5000", // Set the time for the notification to stay
                            "extendedTimeOut": "1000" // Time to delay after mouseover
                        };
                        toastr.error('<?= $this->session->flashdata('error') ?>');
                    });
                </script>
            <?php endif; ?>

            <?php if ($this->session->flashdata('success')): ?>
                <script>
                    $(document).ready(function() {
                        toastr.options = {
                            "progressBar": true, // Enable the progress bar
                            "timeOut": "5000", // Set the time for the notification to stay
                            "extendedTimeOut": "1000" // Time to delay after mouseover
                        };
                        toastr.success('<?= $this->session->flashdata('success') ?>');
                    });
                </script>
            <?php endif; ?>
            <h3 class="card-title">Edit Profil</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <div class="card-body">
            <?= form_open('dokter/edit_profil/' . $detail_akun->id); ?>

            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" value="<?= $detail_akun->nama ?>">
            </div>
            <?= form_error('nama', '<div class="text-danger">', '</div>') ?>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control" name="alamat" value="<?= $detail_akun->alamat ?>">
            </div>
            <?= form_error('alamat', '<div class="text-danger">', '</div>') ?>
            <div class="form-group">
                <label>No HP</label>
                <input type="text" class="form-control" name="no_hp" value="<?= $detail_akun->no_hp ?>">
            </div>
            <?= form_error('no_hp', '<div class="text-danger">', '</div>') ?>
        </div>
        <!-- /.card-body -->

        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
        <?= form_close() ?>
    </div>
    <!-- /.card -->
</div>