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
                Tambah pasien
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('admin/tambah_pasien') ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="nama" placeholder="Nama pasien"
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
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('alamat', '<div class="text-danger">', '</div>') ?>

                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="no_ktp" placeholder="No KTP"
                        value="<?= set_value('no_ktp') ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('no_ktp', '<div class="text-danger">', '</div>') ?>

                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="no_hp" placeholder="No HP"
                        value="<?= set_value('no_hp') ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('no_hp', '<div class="text-danger">', '</div>') ?>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="no_rm" placeholder="No RM" value="<?= $no_rm ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('no_rm', '<div class="text-danger">', '</div>') ?>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<?php foreach ($pasien as $key => $value) { ?>
<div class="modal fade" id="edit<?= $value->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit pasien <?= $value->nama ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('admin/edit_pasien/' . $value->id); ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="nama" placeholder="Nama pasien"
                        value="<?= $value->nama ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('nama', '<div class="text-danger">', '</div>') ?>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="alamat" placeholder="Alamat"
                        value="<?= $value->alamat ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('alamat', '<div class="text-danger">', '</div>') ?>

                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="no_ktp" placeholder="No KTP"
                        value="<?= $value->no_ktp ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('no_ktp', '<div class="text-danger">', '</div>') ?>

                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="no_hp" placeholder="No HP"
                        value="<?= $value->no_hp ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('no_hp', '<div class="text-danger">', '</div>') ?>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="no_rm" placeholder="No RM"
                        value="<?= $value->no_rm ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('no_rm', '<div class="text-danger">', '</div>') ?>

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

<?php foreach ($pasien as $key => $value) { ?>
<div class="modal fade" id="delete<?= $value->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus pasien <?= $value->nama ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Apakah anda yakin ingin menghapus <?= $value->nama ?>?</h1>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="<?= base_url('admin/delete_pasien/' . $value->id) ?>" class="btn btn-primary">Hapus</a>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php } ?>