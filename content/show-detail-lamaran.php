<?php
require_once 'classes/Lamaran.php';
$detailLamaran = new Lamaran();
$deLamaran = $detailLamaran->getLamaranById($_GET['id']);
$soals = $detailLamaran->getAllSoalByLokerAndPelamar(['loker_id' => $deLamaran['loker_id'], 'karyawan_id' => $deLamaran['karyawan_id']]);
?>
<div class="row mb-2">
    <div class="col-4">
        <div class="row">
            <div class="col-12">
                <div class="card radius-10">
                    <div class="card-header">
                        <h5 class="card-title">Detail Loker</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <h6 class="text-muted">Posisi</h6>
                                <p><?= ucwords($deLamaran['nama_posisi']) ?></p>
                            </li>
                            <li class="list-group-item">
                                <h6 class="text-muted">Divisi</h6>
                                <p><?= ucwords($deLamaran['nama_divisi']) ?></p>
                            </li>
                            <li class="list-group-item">
                                <h6 class="text-muted">Deskripsi</h6>
                                <p><?= nl2br(str_replace(' ', '  ', htmlspecialchars($deLamaran['deskripsi']))); ?></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="row">
            <div class="col-12">
                <div class="card radius-10">
                    <div class="card-header">
                        <h5 class="card-title">Biodata Pelamar</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="myfiles/photo/<?= $deLamaran['photo'] ?>" class="align-self-start rounded-circle p-1 border" width="90" height="90" alt="...">
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mt-0"><?= ucwords($deLamaran['nama']) ?></h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item bg-transparent"><i class='bx bx-envelope font-18 align-middle me-1'></i> <?= $deLamaran['email'] ?></li>
                                    <li class="list-group-item bg-transparent"><i class='bx bx-id-card font-18 align-middle me-1'></i> <?= $deLamaran['nik'] ?></li>
                                    <li class="list-group-item bg-transparent"><i class='bx bx-phone font-18 align-middle me-1'></i> <?= $deLamaran['no_hp'] ?></li>
                                    <li class="list-group-item bg-transparent"><i class='bx bx-map font-18 align-middle me-1'></i> <?= $deLamaran['alamat'] ?></li>
                                    <!-- file lamaran -->
                                    <li class="list-group-item bg-transparent"><i class='bx bx-file font-18 align-middle me-1'></i> <a href="myfiles/berkas/<?= $deLamaran['file_lamaran'] ?>" target="_blank">Lihat File Lamaran</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card radius-10">
                    <div class="card-header">
                        <h5 class="card-title">Test Dasar</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <th></th>
                                    <th>Soal</th>
                                    <th>Jawaban</th>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($soals as $soal) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $soal['soal'] ?></td>
                                            <td><?= nl2br($soal['jawaban']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>