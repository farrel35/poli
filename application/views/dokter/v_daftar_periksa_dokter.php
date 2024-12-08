<div class="col-12">
    <!-- Registration poli history -->
    <div class="card">
        <h5 class="card-header bg-primary">Daftar Periksa Pasien</h5>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Keluhan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($daftar_periksa as $index => $value): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $value->nama_pasien ?></td>
                        <td><?= $value->keluhan ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
    <!-- End registration poli history -->
</div>