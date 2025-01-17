<div class="col-12">
    <div class="card card-primary">
        <h5 class="card-header">
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
                <?php endif; ?>Daftar Periksa Pasien
        </h5>
        <div class="card-body">
            <table id="table-search" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>No RM</th>
                        <th>Keluhan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($daftar_periksa as $index => $value): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $value->nama_pasien ?></td>
                            <td><?= $value->no_rm ?></td>
                            <td><?= $value->keluhan ?></td>
                            <td>
                                <!-- Show "Edit" button if a record exists in tbl_periksa -->
                                <?php if ($value->id_periksa): ?>
                                    <button data-toggle="modal" data-target="#edit<?= $value->id ?>"
                                        class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>Edit</button>
                                <?php else: ?>
                                    <!-- Show "Memeriksa" button if no record exists in tbl_periksa -->
                                    <button data-toggle="modal" data-target="#memeriksa<?= $value->id ?>"
                                        class="btn btn-success btn-sm"><i class="fas fa-stethoscope"></i> Memeriksa</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- End registration poli history -->
</div>

<?php foreach ($daftar_periksa as $key => $value): ?>
    <?php if (!$value->id_periksa): ?>
        <div class="modal fade" id="memeriksa<?= $value->id ?>" tabindex="-1" role="dialog"
            aria-labelledby="memeriksaLabel<?= $value->id ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="memeriksaLabel<?= $value->id ?>">Periksa pasien <?= $value->nama_pasien ?>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= form_open('dokter/submit_periksa/' . $value->id); ?>

                        <!-- Tanggal Periksa -->
                        <div class="form-group">
                            <label for="tgl_periksa">Tanggal Periksa</label>
                            <input type="datetime-local" class="form-control" name="tgl_periksa"
                                value="<?= set_value('tgl_periksa'); ?>" required>
                            <?= form_error('tgl_periksa', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <!-- Catatan -->
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea class="form-control" name="catatan"><?= set_value('catatan'); ?></textarea>
                            <?= form_error('catatan', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <!-- Obat -->
                        <div class="form-group">
                            <label for="obat">Obat</label>
                            <select name="obat[]" id="obat<?= $value->id ?>" class="form-control obat-select"
                                multiple="multiple" style="width: 100%;" required>
                                <?php foreach ($obat as $obat_item): ?>
                                    <option value="<?php echo $obat_item->id; ?>" data-harga="<?php echo $obat_item->harga; ?>">
                                        <?php echo $obat_item->nama_obat; ?> - Rp
                                        <?php echo number_format($obat_item->harga, 0, ',', '.'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('obat[]', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <!-- Biaya Periksa -->
                        <div class="form-group">
                            <label for="biaya_periksa">Biaya Periksa</label>
                            <input type="text" class="form-control" value="150000" readonly>
                        </div>
                        <div class="form-group">
                            <label for="biaya_obat">Biaya Obat</label>
                            <input type="text" id="biaya_obat<?= $value->id ?>" class="form-control"
                                value="Rp 0" readonly>
                        </div>
                        <div class="form-group">
                            <label for="biaya_pemeriksaan">Total Biaya Pemeriksaan</label>
                            <input type="text" id="biaya_pemeriksaan<?= $value->id ?>" name="biaya_pemeriksaan" class="form-control"
                                value="Rp 0" readonly>
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
    <?php endif; ?>
<?php endforeach; ?>
<?php foreach ($daftar_periksa as $key => $value): ?>
    <?php if ($value->id_periksa): ?>
        <div class="modal fade" id="edit<?= $value->id ?>" tabindex="-1" role="dialog"
            aria-labelledby="editLabel<?= $value->id ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="editLabel<?= $value->id ?>">Periksa pasien <?= $value->nama_pasien ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= form_open('dokter/edit_periksa/' . $value->id_periksa); ?>

                        <!-- Tanggal Periksa -->
                        <div class="form-group">
                            <label for="tgl_periksa">Tanggal Periksa</label>
                            <input type="datetime-local" class="form-control" name="tgl_periksa"
                                value="<?= set_value('tgl_periksa', $value->tgl_periksa); ?>" required>
                            <?= form_error('tgl_periksa', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <!-- Catatan -->
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea class="form-control"
                                name="catatan"><?= set_value('catatan', $value->catatan); ?></textarea>
                            <?= form_error('catatan', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <!-- Obat (Prescribed medications list) -->
                        <?php
                        // Fetch the prescribed medications based on the periksa ID
                        $detail_periksa = $this->M_dokter->get_detail_periksa($value->id_periksa);
                        ?>
                        <div class="form-group">
                            <label for="obat">Obat</label>
                            <select name="obat2[]" id="obat2<?= $value->id ?>" class="form-control obat-select2"
                                multiple="multiple" style="width: 100%;" required>

                                <?php foreach ($obat as $obat_item): ?>
                                    <option value="<?= $obat_item->id; ?>" data-harga="<?= $obat_item->harga; ?>"
                                        <?= in_array($obat_item->id, array_column($detail_periksa, 'id_obat')) ? 'selected' : ''; ?>>
                                        <?= $obat_item->nama_obat; ?> - Rp <?= number_format($obat_item->harga, 0, ',', '.'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('obat[]', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <!-- Biaya Periksa -->
                        <div class="form-group">
                            <label for="biaya_periksa">Biaya Periksa</label>
                            <input type="text" class="form-control" value="150000" readonly>
                        </div>
                        <div class="form-group">
                            <label for="biaya_obat">Biaya Obat</label>
                            <input type="text" id="biaya_obat2<?= $value->id ?>" class="form-control"
                                value="<?= set_value('biaya_pemeriksaan2', $value->biaya_periksa - 150000); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="biaya_pemeriksaan">Total Biaya Pemeriksaan</label>
                            <input type="text" id="biaya_pemeriksaan<?= $value->id ?>" name="biaya_pemeriksaan" class="form-control"
                                value="<?= set_value('biaya_pemeriksaan2', $value->biaya_periksa); ?>" readonly>
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
    <?php endif; ?>

<?php endforeach; ?>


<script>
    $(document).ready(function() {
        // Inisialisasi Select2 untuk semua elemen dengan kelas 'obat-select'
        $('.obat-select').select2();

        // Tambahkan event listener untuk setiap elemen select dengan kelas 'obat-select'
        $('.obat-select').on('change', function() {
            let total = 0;

            // Ambil ID elemen select saat ini
            let modalId = $(this).attr('id').replace('obat', '');

            // Hitung total berdasarkan opsi yang dipilih
            $(this).find(':selected').each(function() {
                total += parseInt($(this).data('harga'));
            });

            // Tampilkan total biaya di input yang sesuai
            $('#biaya_obat' + modalId).val(total);
            $('#biaya_pemeriksaan' + modalId).val(total + 150000);
        });
        $('.obat-select2').select2();

        // Tambahkan event listener untuk setiap elemen select dengan kelas 'obat-select'
        $('.obat-select2').on('change', function() {
            let total = 0;

            // Ambil ID elemen select saat ini
            let modalId = $(this).attr('id').replace('obat2', '');

            // Hitung total berdasarkan opsi yang dipilih
            $(this).find(':selected').each(function() {
                total += parseInt($(this).data('harga'));
            });

            // Tampilkan total biaya di input yang sesuai
            $('#biaya_obat2' + modalId).val(total);
            $('#biaya_pemeriksaan' + modalId).val(total + 150000);
        });
    });
</script>