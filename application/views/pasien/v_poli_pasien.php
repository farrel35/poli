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
                    <option value="">Open this select menu</option>
                    <?php foreach ($poli as $p): ?>
                    <option value="<?= $p->id ?>"><?= $p->nama_poli ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Pilih Jadwal</label>
                <select id="inputJadwal" class="form-control" name="id_jadwal">
                    <option value="">Open this select menu</option>
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
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Poli</th>
                        <th scope="col">Dokter</th>
                        <th scope="col">Hari</th>
                        <th scope="col">Mulai</th>
                        <th scope="col">Selesai</th>
                        <th scope="col">Antrian</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="9" align="center">Tidak ada data</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
    <!-- End registration poli history -->
</div>