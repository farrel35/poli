<div class="col-12">
    <div class="card">
        <div class="card-header">
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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Jadwal
            </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Dokter</th>
                        <th>Hari</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jadwal_periksa as $index => $value): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $value->nama_dokter ?></td>
                        <td><?= $value->hari ?></td>
                        <td><?= $value->jam_mulai ?></td>
                        <td><?= $value->jam_selesai ?></td>
                        <td>
                            <!-- Check if isActive is 1 or 0 -->
                            <?php if ($value->isActive == 1): ?>
                            <span class="badge badge-success">Aktif</span>
                            <?php else: ?>
                            <span class="badge badge-secondary">Tidak Aktif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <!-- Action buttons (Edit, Delete) -->
                            <button data-toggle="modal" data-target="#edit<?= $value->id ?>"
                                class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                            <button data-toggle="modal" data-target="#delete<?= $value->id ?>"
                                class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal Periksa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('dokter/tambah_jadwal_periksa') ?>
                <div class="input-group mb-3">
                    <select name="hari" class="form-control">
                        <option value="Senin" <?= set_select('hari', 'Senin'); ?>>Senin</option>
                        <option value="Selasa" <?= set_select('hari', 'Selasa'); ?>>Selasa</option>
                        <option value="Rabu" <?= set_select('hari', 'Rabu'); ?>>Rabu</option>
                        <option value="Kamis" <?= set_select('hari', 'Kamis'); ?>>Kamis</option>
                        <option value="Jumat" <?= set_select('hari', 'Jumat'); ?>>Jumat</option>
                        <option value="Sabtu" <?= set_select('hari', 'Sabtu'); ?>>Sabtu</option>
                        <option value="Minggu" <?= set_select('hari', 'Minggu'); ?>>Minggu</option>
                    </select>
                </div>
                <?= form_error('hari', '<div class="text-danger">', '</div>') ?>
                <!-- Jam Mulai -->
                <div class="input-group mb-3">
                    <input type="time" class="form-control" name="jam_mulai" value="<?= set_value('jam_mulai') ?>">
                </div>
                <?= form_error('jam_mulai', '<div class="text-danger">', '</div>') ?>

                <!-- Jam Selesai -->
                <div class="input-group mb-3">
                    <input type="time" class="form-control" name="jam_selesai" value="<?= set_value('jam_selesai') ?>">
                </div>
                <?= form_error('jam_selesai', '<div class="text-danger">', '</div>') ?>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>


<?php foreach ($jadwal_periksa as $key => $value) { ?>
<div class="modal fade" id="edit<?= $value->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit jadwal <?= $value->hari ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('dokter/edit_jadwal_periksa/' . $value->id); ?>
                <div class="input-group mb-3">
                    <select name="hari" class="form-control" disabled>
                        <option value="Senin" <?= ($value->hari == 'Senin') ? 'selected' : ''; ?>>Senin</option>
                        <option value="Selasa" <?= ($value->hari == 'Selasa') ? 'selected' : ''; ?>>Selasa</option>
                        <option value="Rabu" <?= ($value->hari == 'Rabu') ? 'selected' : ''; ?>>Rabu</option>
                        <option value="Kamis" <?= ($value->hari == 'Kamis') ? 'selected' : ''; ?>>Kamis</option>
                        <option value="Jumat" <?= ($value->hari == 'Jumat') ? 'selected' : ''; ?>>Jumat</option>
                        <option value="Sabtu" <?= ($value->hari == 'Sabtu') ? 'selected' : ''; ?>>Sabtu</option>
                        <option value="Minggu" <?= ($value->hari == 'Minggu') ? 'selected' : ''; ?>>Minggu</option>
                    </select>
                </div>
                <?= form_error('hari', '<div class="text-danger">', '</div>') ?>

                <!-- Jam Mulai -->
                <div class="input-group mb-3">
                    <input type="time" class="form-control" name="jam_mulai"
                        value="<?= set_value('jam_mulai', $value->jam_mulai) ?>" disabled>
                </div>
                <?= form_error('jam_mulai', '<div class="text-danger">', '</div>') ?>

                <!-- Jam Selesai -->
                <div class="input-group mb-3">
                    <input type="time" class="form-control" name="jam_selesai"
                        value="<?= set_value('jam_selesai', $value->jam_selesai) ?>" disabled>
                </div>
                <?= form_error('jam_selesai', '<div class="text-danger">', '</div>') ?>
                <!-- isActive -->
                <div class="input-group mb-3">
                    <select name="isActive" class="form-control">
                        <option value="1" <?= ($value->isActive == 1) ? 'selected' : ''; ?>>Aktif</option>
                        <option value="0" <?= ($value->isActive == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                    </select>
                </div>
                <?= form_error('isActive', '<div class="text-danger">', '</div>') ?>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php } ?>

<?php foreach ($jadwal_periksa as $key => $value) { ?>
<div class="modal fade" id="delete<?= $value->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus jadwal <?= $value->hari ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Apakah anda yakin ingin menghapus jadwal <?= $value->hari ?>?</h1>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="<?= base_url('dokter/delete_jadwal_periksa/' . $value->id) ?>"
                    class="btn btn-primary">Hapus</a>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php } ?>