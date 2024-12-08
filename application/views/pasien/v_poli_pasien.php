<div class="col-4">
    <!-- Registrarion poli -->
    <div class="card">
        <h5 class="card-header bg-primary">
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
                            <!-- Aksi untuk Edit atau Delete -->
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
    </div>
    <!-- End registration poli history -->
</div>