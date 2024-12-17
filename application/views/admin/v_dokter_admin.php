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
                Tambah Dokter
            </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="table-search" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama dokter</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Poli</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dokter as $index => $value): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $value->nama ?></td>
                            <td><?= $value->alamat ?></td>
                            <td><?= $value->no_hp ?></td>
                            <td><?= $value->nama_poli ?></td>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('admin/tambah_dokter') ?>

                <!-- Name Input Group -->
                <div class="form-group">
                    <label for="nama">Nama Dokter</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama dokter"
                            value="<?= set_value('nama') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('nama', '<div class="text-danger">', '</div>') ?>
                </div>

                <!-- Address Input Group -->
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat"
                            value="<?= set_value('alamat') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-home"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('alamat', '<div class="text-danger">', '</div>') ?>
                </div>

                <!-- Phone Number Input Group -->
                <div class="form-group">
                    <label for="no_hp">No HP</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No HP"
                            value="<?= set_value('no_hp') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('no_hp', '<div class="text-danger">', '</div>') ?>
                </div>

                <!-- Poli Selection -->
                <div class="form-group">
                    <label for="id_poli">Pilih Poli</label>
                    <select class="form-control" id="id_poli" name="id_poli">
                        <option value="">Pilih Poli</option>
                        <?php foreach ($poli as $value): ?>
                            <option value="<?= $value->id ?>" <?= set_select('id_poli', $value->id) ?>>
                                <?= $value->nama_poli ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('id_poli', '<div class="text-danger">', '</div>') ?>
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

<?php foreach ($dokter as $key => $dokters) { ?>
    <div class="modal fade" id="edit<?= $dokters->id ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit dokter <?= $dokters->nama ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('admin/edit_dokter/' . $dokters->id); ?>

                    <!-- Name Input -->
                    <div class="form-group">
                        <label for="nama">Nama Dokter</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama dokter"
                                value="<?= $dokters->nama ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <?= form_error('nama', '<div class="text-danger">', '</div>') ?>
                    </div>

                    <!-- Address Input -->
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat"
                                value="<?= $dokters->alamat ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-home"></span>
                                </div>
                            </div>
                        </div>
                        <?= form_error('alamat', '<div class="text-danger">', '</div>') ?>
                    </div>

                    <!-- Phone Number Input -->
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No HP"
                                value="<?= $dokters->no_hp ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </div>
                            </div>
                        </div>
                        <?= form_error('no_hp', '<div class="text-danger">', '</div>') ?>
                    </div>

                    <!-- Poli Selection -->
                    <div class="form-group">
                        <label for="id_poli">Pilih Poli</label>
                        <select class="form-control" name="id_poli" id="id_poli">
                            <?php foreach ($poli as $value): ?>
                                <option value="<?= $value->id ?>" <?= ($dokters->id_poli == $value->id) ? 'selected' : '' ?>>
                                    <?= $value->nama_poli ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('id_poli', '<div class="text-danger">', '</div>') ?>
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


<?php foreach ($dokter as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value->id ?>" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus dokter <?= $value->nama ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Apakah anda yakin ingin menghapus dokter <?= $value->nama ?>?</h4>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('admin/delete_dokter/' . $value->id) ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>