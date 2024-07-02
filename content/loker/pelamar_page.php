<?php
require_once 'classes/User.php';
require_once 'classes/Loker.php';
require_once 'classes/Divisi.php';
require_once 'classes/Posisi.php';
$divisis = new Divisi();
$posisis = new Posisi();
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
                <li class="breadcrumb-item active" aria-current="page"><a href="?page=lowongan_kerja">Lowongan Kerja</a></li>
                <?php if (isset($_GET['menu'])) : ?>
                    <li class="breadcrumb-item active" aria-current="page"><a href="?page=lowongan_kerja&menu=<?= $_GET['menu'] ?>&id=<?= $_GET['id'] ?>">Test & Upload Berkas</a></li>
                <?php endif; ?>
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
<?php if (count($empty) > 0) : ?>
    <div class="row">
        <div class="col">
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
        </div>
    </div>
<?php endif; ?>

<?php if (isset($_GET['menu'])) : ?>
    <?php include 'content/loker/soal_loker_pelamar.php'; ?>
<?php else : ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-xl-12">
                            <div class="row row-cols-lg-2 row-cols-xl-auto g-2">
                                <input type="hidden" id="profile" value="<?= count($empty) ?>">
                                <div class="col">
                                    <div class="position-relative">
                                        <input type="text" id="desc" class="form-control ps-5" placeholder="Deskripsi..."> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                        <button type="button" class="btn btn-white" id="btn-posisi">Semua Posisi</button>
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class='bx bx-chevron-down'></i>
                                            </button>
                                            <input type="hidden" id="posisi_id" data-posisiname="">
                                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <li><a class="dropdown-item" href="javascript:;" onclick="views('posisi', '', this)">Semua Posisi</a></li>
                                                <?php foreach ($posisis->getAllPosisi() as $posisi) : ?>
                                                    <li><a class="dropdown-item" href="javascript:;" onclick="views('posisi', '<?= $posisi['id_posisi'] ?>', this)"><?= ucwords($posisi['nama_posisi']) ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                        <button type="button" class="btn btn-white" id="btn-divisi">Semua Divisi</button>
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class='bx bxs-category'></i>
                                            </button>
                                            <input type="hidden" id="divisi_id" data-divisiname="">
                                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <li><a class="dropdown-item" href="javascript:;" onclick="views('divisi', '', this)">Semua Divisi</a></li>
                                                <?php foreach ($divisis->getAllDivisi() as $divisi) : ?>
                                                    <li><a class="dropdown-item" href="javascript:;" onclick="views('divisi', '<?= $divisi['id_divisi'] ?>', this)"><?= ucwords($divisi['nama_divisi']) ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-info text-white" id="btn-show-loker" onclick="showLoker()">Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 row-cols-xl-3" id="list-loker"></div>
<?php endif; ?>
<script>
    $(document).ready(function() {
        showLoker();
    });

    function showLoker() {
        let desc = $('#desc').val();
        let posisiId = $('#posisi_id').val();
        let posisiName = $('#posisi_id').attr('data-posisiname');
        let divisiId = $('#divisi_id').val();
        let divisiName = $('#divisi_id').attr('data-divisiname');
        let profile = $('#profile').val();
        $.ajax({
            url: 'content/show_loker_pelamar_page.php',
            type: 'POST',
            data: {
                desc: desc,
                posisiId: posisiId,
                posisiName: posisiName,
                divisiId: divisiId,
                divisiName: divisiName,
                profile: profile,
                action: 'showLoker'
            },
            success: function(response) {
                $('#list-loker').html(response);
            }
        });
    }

    function views(type, id, element) {
        $(`#${type}_id`).val(id);
        $(`#${type}_id`).attr('data-' + type + 'Name', $(element).text());
        $(`#btn-${type}`).text($(element).text());
    }
</script>