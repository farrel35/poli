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
            <?php endif; ?>
            Riwayat Pasien
        </h5>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="table-search" class="table table-bordered table-hover">
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
                                <button data-toggle="modal" data-target="#riwayat<?= $value->id ?>"
                                    class="btn btn-warning btn-sm"><i class="fas fa-info"></i> Info</button>
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

<!-- Modal for Edit Pasien -->
<?php foreach ($pasien as $key => $value) { ?>
    <?php
    $riwayat_pasien = $this->M_dokter->get_riwayat_pasien($value->id);

    foreach ($riwayat_pasien as &$item) {
        $item->id_periksa = $this->M_dokter->get_periksa_by_daftar_poli($item->id);
        $item->periksa_exists = $this->M_dokter->get_periksa_by_daftar_poli($item->id) ? true : false;
    } ?>

    <div class="modal fade" id="riwayat<?= $value->id ?>">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Riwayat periksa <?= $value->nama ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (!empty($riwayat_pasien)): ?>
                        <table id="table-riwayat<?= $value->id ?>" class="table table-bordered table-hover table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Poli</th>
                                    <th>Dokter</th>
                                    <th>Keluhan</th>
                                    <th>Tanggal Periksa</th>
                                    <th>Catatan</th>
                                    <th>Obat</th>
                                    <th>Biaya Periksa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($riwayat_pasien as $key => $value): ?>
                                    <?php if ($value->id_periksa): ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $value->nama_poli ?></td> <!-- Menampilkan Nama Poli -->
                                            <td><?= $value->nama_dokter ?></td> <!-- Menampilkan Nama Dokter -->
                                            <td><?= $value->keluhan ?></td> <!-- Menampilkan Hari -->
                                            <td><?= $value->tgl_periksa ?></td> <!-- Menampilkan Nama Dokter -->
                                            <td><?= $value->catatan ?></td> <!-- Menampilkan Jam Mulai -->
                                            <td><?php
                                                // Fetch the prescribed medications based on the periksa ID
                                                $detail_periksa = $this->M_dokter->get_detail_periksa($value->id_periksa);
                                                ?>
                                                <?php foreach ($detail_periksa as $detail): ?>
                                                    <li><?= $detail->nama_obat ?></li>
                                                <?php endforeach; ?>
                                            </td>
                                            <td>Rp <?= $value->biaya_periksa ?></td> <!-- Menampilkan Jam Selesai -->

                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        Tidak ada riwayat periksa
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<script>
    $(function() {
        <?php foreach ($pasien as $key => $value) { ?>
            $('#table-riwayat<?= $value->id ?>').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        <?php } ?>
    });
</script>