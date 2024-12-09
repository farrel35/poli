<div class="col-12">
    <!-- Registration poli history -->
    <div class="card">
        <h5 class="card-header bg-primary">
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
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Keluhan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($daftar_periksa as $index => $value): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $value->nama_pasien ?></td>
                            <td><?= $value->keluhan ?></td>
                            <td>
                                <!-- Show "Edit" button if a record exists in tbl_periksa -->
                                <?php if ($value->periksa_exists): ?>
                                    <button data-toggle="modal" data-target="#edit<?= $value->id ?>"
                                        class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                <?php else: ?>
                                    <!-- Show "Memeriksa" button if no record exists in tbl_periksa -->
                                    <button data-toggle="modal" data-target="#memeriksa<?= $value->id ?>"
                                        class="btn btn-success btn-sm"><i class="fas fa-check"></i> Memeriksa</button>
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
    <div class="modal fade" id="memeriksa<?= $value->id ?>" tabindex="-1" role="dialog"
        aria-labelledby="memeriksaLabel<?= $value->id ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
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
                        <label for="biaya_periksa">Total Biaya Pemeriksaan</label>
                        <input type="text" id="biaya_periksa<?= $value->id ?>" name="biaya_periksa" class="form-control"
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
            $('#biaya_periksa' + modalId).val(total);
        });
    });
</script>