<div class="col-4">
    <!-- Registrarion poli -->
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
            <?php endif; ?>
            Daftar Poli
        </h5>
        <div class="card-body">

            <?= form_open('pasien/daftar_poli') ?>
            <div class="mb-3">
                <label for="no_rm" class="form-label">Nomor Rekam Medis</label>
                <input type="text " class="form-control" id="no_rm" placeholder="nomor rekam medis" name="no_rm"
                    value="<?= $detail_akun->no_rm ?>" disabled="">
            </div>
            <?= form_error('no_rm', '<div class="text-danger">', '</div>') ?>

            <div class="mb-3">
                <label class="form-label">Pilih Poli</label>
                <select id="inputPoli" class="form-control">
                    <option value="">Pilih Poli</option>
                    <?php foreach ($poli as $p): ?>
                        <option value="<?= $p->id ?>"><?= $p->nama_poli ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Pilih Jadwal</label>
                <select id="inputJadwal" class="form-control" name="id_jadwal">
                    <option value="">Pilih Jadwal</option>
                </select>
            </div>
            <?= form_error('id_jadwal', '<div class="text-danger">', '</div>') ?>

            <div class="mb-3">
                <label for="keluhan" class="form-label">Keluhan</label>
                <textarea class="form-control" id="keluhan" rows="3" name="keluhan"></textarea>
            </div>
            <?= form_error('keluhan', '<div class="text-danger">', '</div>') ?>

            <button type="submit" name="submit" class="btn btn-primary">Daftar</button>
            <?= form_close() ?>
        </div>
    </div>
    <!-- End registrarion poli -->
</div>
<script>
    document.getElementById('inputPoli').addEventListener('change', function() {
        var idPoli = this.value;

        fetch(`<?= base_url('pasien/get_jadwal_by_poli/') ?>${idPoli}`)
            .then(response => response.json())
            .then(data => {
                const jadwalSelect = document.getElementById('inputJadwal');
                jadwalSelect.innerHTML = '';
                data.forEach(jadwal => {
                    const option = document.createElement('option');
                    option.value = jadwal.id;
                    option.textContent =
                        `${jadwal.nama} | ${jadwal.hari} | ${jadwal.jam_mulai} - ${jadwal.jam_selesai}`;
                    jadwalSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching jadwal:', error));
    });
</script>
<div class="col-8">
    <!-- Registration poli history -->
    <div class="card">
        <h5 class="card-header bg-primary">Riwayat daftar poli</h5>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Poli</th>
                        <th>Dokter</th>
                        <th>Hari</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Antrian</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($riwayat_poli as $index => $value): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $value->nama_poli ?></td> <!-- Menampilkan Nama Poli -->
                            <td><?= $value->nama_dokter ?></td> <!-- Menampilkan Nama Dokter -->
                            <td><?= $value->hari ?></td> <!-- Menampilkan Hari -->
                            <td><?= $value->jam_mulai ?></td> <!-- Menampilkan Jam Mulai -->
                            <td><?= $value->jam_selesai ?></td> <!-- Menampilkan Jam Selesai -->
                            <td><?= $value->no_antrian ?></td> <!-- Menampilkan No Antrian -->
                            <td>
                                <?php if ($value->periksa_exists): ?>
                                    <span class="badge badge-success">Sudah Diperiksa</span><br>
                                    <span class="badge bg-default"><i><?= $value->tgl_periksa ?></i></span>
                                <?php else: ?>
                                    <span class="badge badge-warning">Belum Diperiksa</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($value->periksa_exists): ?>
                                    <button data-toggle="modal" data-target="#detail_periksa<?= $value->id ?>"
                                        class="btn btn-warning btn-sm"><i class="fas fa-info"></i></button>
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

<?php foreach ($riwayat_poli as $key => $value): ?>
    <div class="modal fade" id="detail_periksa<?= $value->id ?>" tabindex="-1" role="dialog"
        aria-labelledby="detail_periksaLabel<?= $value->id ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="detail_periksaLabel<?= $value->id ?>">Detail Periksa
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Nama Poli</th>
                                <td><?= $value->nama_poli ?></td>
                            </tr>
                            <tr>
                                <th>Nama Dokter</th>
                                <td><?= $value->nama_dokter ?></td>

                            </tr>
                            <tr>
                                <th>Hari</th>
                                <td><?= $value->hari ?></td>
                            </tr>
                            <tr>
                                <th>Mulai</th>
                                <td><?= $value->jam_mulai ?></td>
                            </tr>
                            <tr>
                                <th>Selesai</th>
                                <td><?= $value->jam_selesai ?></td>
                            </tr>
                            <tr>
                                <th>Nomor Antrian</th>
                                <td><?= $value->no_antrian ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Periksa</th>
                                <td><i><?= $value->tgl_periksa ?></i></td>
                            </tr>
                            <tr>
                                <th>Catatan</th>
                                <td><?= $value->catatan ?></td>
                            </tr>
                            <tr>
                                <th>Daftar Obat Diresepkan</th>
                                <td colspan="2">
                                    <ul>
                                        <?php
                                        // Fetch the prescribed medications based on the periksa ID
                                        $detail_periksa = $this->M_pasien->get_detail_periksa($value->periksa_exists->id);
                                        ?>
                                        <?php foreach ($detail_periksa as $detail): ?>
                                            <li><?= $detail->nama_obat ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th>Biaya Periksa</th>
                                <td>Rp <?= $value->biaya_periksa ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>