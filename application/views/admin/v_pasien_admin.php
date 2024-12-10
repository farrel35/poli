<div class="col-12">
    <div class="card">
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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Pasien
            </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No KTP</th>
                        <th>No HP</th>
                        <th>No RM</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pasien as $index => $value): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $value->nama ?></td>
                            <td><?= $value->alamat ?></td>
                            <td><?= $value->no_ktp ?></td>
                            <td><?= $value->no_hp ?></td>
                            <td><?= $value->no_rm ?></td>
                            <td>
                                <!-- Action buttons (Edit, Delete) -->
                                <button data-toggle="modal" data-target="#edit<?= $value->id ?>"
                                    class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>Edit</button>
                                <button data-toggle="modal" data-target="#delete<?= $value->id ?>"
                                    class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- Modal for Add Pasien -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('admin/tambah_pasien') ?>

                <div class="form-group">
                    <label for="nama">Nama Pasien</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama pasien"
                        value="<?= set_value('nama') ?>">
                    <?= form_error('nama', '<div class="text-danger">', '</div>') ?>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat"
                        value="<?= set_value('alamat') ?>">
                    <?= form_error('alamat', '<div class="text-danger">', '</div>') ?>
                </div>

                <div class="form-group">
                    <label for="no_ktp">No KTP</label>
                    <input type="number" class="form-control" name="no_ktp" id="no_ktp" placeholder="No KTP"
                        value="<?= set_value('no_ktp') ?>">
                    <?= form_error('no_ktp', '<div class="text-danger">', '</div>') ?>
                </div>

                <div class="form-group">
                    <label for="no_hp">No HP</label>
                    <input type="number" class="form-control" name="no_hp" id="no_hp" placeholder="No HP"
                        value="<?= set_value('no_hp') ?>">
                    <?= form_error('no_hp', '<div class="text-danger">', '</div>') ?>
                </div>

                <div class="form-group">
                    <label for="no_rm">No RM</label>
                    <input type="text" class="form-control" name="no_rm" id="no_rm" placeholder="No RM"
                        value="<?= $no_rm ?>">
                    <?= form_error('no_rm', '<div class="text-danger">', '</div>') ?>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- Modal for Edit Pasien -->
<?php foreach ($pasien as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value->id ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit pasien <?= $value->nama ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('admin/edit_pasien/' . $value->id); ?>

                    <div class="form-group">
                        <label for="nama">Nama Pasien</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama pasien"
                            value="<?= $value->nama ?>">
                        <?= form_error('nama', '<div class="text-danger">', '</div>') ?>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat"
                            value="<?= $value->alamat ?>">
                        <?= form_error('alamat', '<div class="text-danger">', '</div>') ?>
                    </div>

                    <div class="form-group">
                        <label for="no_ktp">No KTP</label>
                        <input type="number" class="form-control" name="no_ktp" id="no_ktp" placeholder="No KTP"
                            value="<?= $value->no_ktp ?>">
                        <?= form_error('no_ktp', '<div class="text-danger">', '</div>') ?>
                    </div>

                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="number" class="form-control" name="no_hp" id="no_hp" placeholder="No HP"
                            value="<?= $value->no_hp ?>">
                        <?= form_error('no_hp', '<div class="text-danger">', '</div>') ?>
                    </div>

                    <div class="form-group">
                        <label for="no_rm">No RM</label>
                        <input type="text" class="form-control" name="no_rm" id="no_rm" placeholder="No RM"
                            value="<?= $value->no_rm ?>">
                        <?= form_error('no_rm', '<div class="text-danger">', '</div>') ?>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Modal for Delete Pasien -->
<?php foreach ($pasien as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value->id ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus pasien <?= $value->nama ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Apakah anda yakin ingin menghapus <?= $value->nama ?>?</h4>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('admin/delete_pasien/' . $value->id) ?>" class="btn btn-primary">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>