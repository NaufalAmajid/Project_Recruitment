<?php
require_once 'classes/Lamaran.php';
$lamaran = new Lamaran();
$lamarans = $lamaran->getAllLamaran('where lam.status_lamaran = 1 and dk.id_karyawan = ' . $_SESSION['user']['id_karyawan']);
?>
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Test & Orientasi</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="dashboard.php"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Jadwal Test & Orientasi</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
<?php if (count($lamarans) > 0) : ?>
    <div class="row">
        <div class="col">
            <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-light"><i class="bx bx-check-circle"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-light">Selamat Anda Lolos</h6>
                        <div class="text-light">Silahkan cek jadwal test dan orientasi.</div>
                        <div class="text-light">Ada <span class="badge bg-light text-dark"><?= count($lamarans) ?></span> jadwal test dan orientasi.</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="row">
        <div class="col">
            <div class="alert alert-info border-0 bg-info alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-dark"><i class="bx bx-info-circle"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-dark">Belum Ada Jadwal Interview dan Orientasi</h6>
                        <div class="text-dark">Terus pantau email dan aplikasi ini untuk mendapatkan informasi terbaru.</div>
                        <div class="text-dark">Good luck!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 row-cols-xl-3">
    <?php foreach ($lamarans as $lamar) : ?>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mt-2"><?= strtoupper($lamar['nama_posisi']) ?></h6>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <h6 class="text-muted">Divisi</h6>
                                    <p><?= ucwords($lamar['nama_divisi']) ?></p>
                                </li>
                                <li class="list-group-item">
                                    <h6 class="text-muted">Jadwal Interview</h6>
                                    <p><?= $func->dateIndonesia($lamar['tgl_interview']) ?> <?= $lamar['jam'] ?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>