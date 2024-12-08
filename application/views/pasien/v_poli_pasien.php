<div class="col-4">
    <!-- Registrarion poli -->
    <div class="card">
        <h5 class="card-header bg-primary">Daftar Poli</h5>
        <div class="card-body">

            <form action="" method="POST">
                <input type="hidden" value="32" name="id_pasien">
                <div class="mb-3">
                    <label for="no_rm" class="form-label">Nomor Rekam Medis</label>
                    <input type="text " class="form-control" id="no_rm" placeholder="nomor rekam medis" name="no_rm"
                        value="<?= $detail_akun->no_rm ?>" disabled="">
                </div>

                <div class="mb-3">
                    <label for="inputPoli" class="form-label">Pilih Poli</label>
                    <select id="inputPoli" class="form-control">
                        <option value="1">Poli Umum</option>
                        <option value="4">Poli Gigi</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="inputJadwal" class="form-label">Pilih Jadwal</label>
                    <select id="inputJadwal" class="form-control" name="id_jadwal">
                        <option value="900">Open this select menu</option>
                        <option value="1">Selasa,07:00:00 - 09:00:00</option>
                        <option value="2">Rabu,08:30:00 - 10:20:00</option>
                        <option value="3">Kamis,10:00:00 - 14:00:00</option>
                        <option value="4">Sabtu,10:20:00 - 12:00:00</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="keluhan" class="form-label">Keluhan</label>
                    <textarea class="form-control" id="keluhan" rows="3" name="keluhan"></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Daftar</button>
            </form>

        </div>
    </div>
    <!-- End registrarion poli -->
</div>

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