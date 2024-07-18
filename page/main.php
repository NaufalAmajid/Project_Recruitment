<?php
require_once 'classes/Setting.php';
$settings = new Setting();
$setting  = $settings->getSetting();
?>
<div class="row">
    <div class="col">
        <div class="card radius-10">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">DASHBOARD</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <center>
                    <h1>Selamat Datang <br> di <br> E - Recruitment</h1>
                </center>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="assets/images/logo-company-detail.png" alt="logo-company-detail" class="card-img mt-2">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <h5 class="card-title">Visi</h5>
                                <p class="card-text"><?= nl2br($setting['visi']) ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title">Misi</h5>
                                <p class="card-text"><?= nl2br($setting['misi']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-2">
    <div class="col">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title text-white">Profil Perusahaan</h5>
                <p class="card-text"><?= nl2br($setting['profil_perusahaan']) ?></p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card bg-dark text-white">
            <div class="card-body">
                <h5 class="card-title text-white">Kontak</h5>
                <p class="card-text"><?= nl2br($setting['kontak']) ?></p>
            </div>
        </div>
    </div>
</div>