<?php
require_once 'classes/User.php';
require_once 'classes/Loker.php';
$lokers = new Loker();
?>
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Daftar Loker</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="dashboard.php"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Lowongan Kerja Tersedia</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
<?php
$bio = [
    'photo' => $_SESSION['user']['photo'],
    'nik' => $_SESSION['user']['nik'],
    'alamat' => $_SESSION['user']['alamat'],
    'tempat_lahir' => $_SESSION['user']['tempat_lahir'],
    'tanggal_lahir' => $_SESSION['user']['tanggal_lahir'],
    'jenkel' => $_SESSION['user']['jenkel'],
    'no_hp' => $_SESSION['user']['no_hp'],
];
$empty = [];
foreach ($bio as $key => $value) {
    if (is_null($value) || empty($value)) {
        $empty[] = $key;
    }
}
$join_empty = join(', ', $empty);
?>
<div class="row">
    <div class="col">
        <?php if (count($empty) > 0) : ?>
            <div class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-dark"><i class="bx bx-info-circle"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-dark">Lengkapi Biodata!</h6>
                        <div class="text-dark">Masuk ke <a href="?page=profile" class="text-primary">profile</a> untuk melengkapi biodata.</div>
                        <div class="text-dark">Data yang belum lengkap: <?= $join_empty ?></div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 row-cols-xl-3">
    <?php foreach ($lokers->getAllLoker() as $loker) : ?>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Card title</h5>
                </div>
                <div class="card-body">
                    <div>
                        <h5 class="card-title">Special title treatment</h5>
                    </div>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> <a href="javascript:;" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Card title</h5>
                </div>
                <div class="card-body">
                    <div>
                        <h5 class="card-title">Special title treatment</h5>
                    </div>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> <a href="javascript:;" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Card title</h5>
                </div>
                <div class="card-body">
                    <div>
                        <h5 class="card-title">Special title treatment</h5>
                    </div>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> <a href="javascript:;" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>