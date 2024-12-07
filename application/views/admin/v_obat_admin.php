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
                Tambah Obat
            </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Obat</th>
                        <th>Kemasan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($obat as $index => $value): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $value->nama_obat ?></td>
                        <td><?= $value->kemasan ?></td>
                        <td>Rp <?= $value->harga ?></td>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('admin/tambah_obat') ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="nama_obat" placeholder="Nama obat"
                        value="<?= set_value('nama_obat') ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('nama_obat', '<div class="text-danger">', '</div>') ?>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="kemasan" placeholder="Kemasan"
                        value="<?= set_value('kemasan') ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('kemasan', '<div class="text-danger">', '</div>') ?>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="harga" placeholder="Harga"
                        value="<?= set_value('harga') ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('harga', '<div class="text-danger">', '</div>') ?>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<?php foreach ($obat as $key => $value) { ?>
<div class="modal fade" id="edit<?= $value->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit <?= $value->nama_obat ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('admin/edit_obat/' . $value->id); ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="nama_obat" placeholder="Nama obat"
                        value="<?= $value->nama_obat ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('nama_obat', '<div class="text-danger">', '</div>') ?>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="kemasan" placeholder="Kemasan"
                        value="<?= $value->kemasan ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('kemasan', '<div class="text-danger">', '</div>') ?>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="harga" placeholder="Harga"
                        value="<?= $value->harga ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('harga', '<div class="text-danger">', '</div>') ?>

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

<?php foreach ($obat as $key => $value) { ?>
<div class="modal fade" id="delete<?= $value->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus <?= $value->nama_obat ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Apakah anda yakin ingin menghapus <?= $value->nama_obat ?>?</h1>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="<?= base_url('admin/delete_obat/' . $value->id) ?>" class="btn btn-primary">Hapus</a>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php } ?>