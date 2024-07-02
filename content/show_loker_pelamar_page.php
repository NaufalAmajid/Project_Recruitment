<?php
require_once '../classes/Loker.php';
$where = "AND (lok.deskripsi LIKE '%$_POST[desc]%' AND pos.id_posisi LIKE '%$_POST[posisiId]%' AND divi.id_divisi LIKE '%$_POST[divisiId]%')";
?>
<?php foreach ($loker->getAllLoker($where) as $loker) : ?>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mt-2"><?= strtoupper($loker['nama_posisi']) ?></h6>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <h6 class="text-muted">Divisi</h6>
                                <p><?= ucwords($loker['nama_divisi']) ?></p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-cente">
                                <span class="text-muted">Kebutuhan</span> <span class="badge bg-primary rounded-pill"><?= $loker['jumlah_kebutuhan'] - $loker['jumlah_pelamar'] ?></span>
                            </li>
                            <li class="list-group-item">
                                <h6 class="text-muted">Deskripsi</h6>
                                <textarea class="form-control" rows="5" readonly><?= $loker['deskripsi'] ?></textarea>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <center>
                            <?php if ($_POST['profile'] == 0) : ?>
                                <?php if (($loker['jumlah_kebutuhan'] - $loker['jumlah_pelamar']) != 0) : ?>
                                    <a href="?page=lowongan_kerja&menu=soal_loker&id=<?= $loker['id_loker'] ?>" class="btn btn-primary btn-sm">Apply</a>
                                <?php else : ?>
                                    <span class="badge rounded-pill text-success bg-light-success">Lowongan Sudah Penuh.</span>
                                <?php endif; ?>
                            <?php else : ?>
                                <p class="text-danger">*Silahkan Lengkapi Profile Anda Terlebih Dahulu.</p>
                            <?php endif; ?>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>