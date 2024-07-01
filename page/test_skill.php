<?php
require_once 'classes/Test_Skill.php';
?>
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Daftar Loker</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="dashboard.php"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><a href="?page=lowongan_kerja">Lowongan Kerja Tersedia</a></li>
                <?php if (isset($_GET['menu'])) : ?>
                    <li class="breadcrumb-item active" aria-current="page"><a href="?page=lowongan_kerja&menu=<?= $_GET['menu'] ?>">Divisi & Posisi</a></li>
                <?php endif; ?>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <button type="button" class="btn btn-primary" onclick="showFormLoker()">Tambah Loker</button>
            <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                <a class="dropdown-item" href="?page=lowongan_kerja&menu=divisi_posisi">Divisi & Posisi</a>
            </div>
        </div>
    </div>
</div>
<!--end breadcrumb-->
<div class="row">
    <div class="card radius-10">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-list-test-skill" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Posisi</th>
                            <th>Divisi</th>
                            <th>Deskripsi</th>
                            <th>Jumlah Soal</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <?php
                    $testSkill = new Test_Skill();
                    $no = 1;
                    ?>
                    <tbody>
                        <?php foreach ($testSkill->getAllTestByLoker() as $test) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= ucwords($test['nama_posisi']) ?></td>
                                <td><?= ucwords($test['nama_divisi']) ?></td>
                                <td><?= $func->truncateString($test['deskripsi']) ?></td>
                                <td><?= $test['jumlah_kebutuhan'] ?></td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="javascript:;" onclick="showFormLoker('<?= $test['id_loker'] ?>')" class="text-primary bg-light-primary"><i class="bx bxs-edit"></i></a>
                                        <a href="javascript:;" onclick="deleteLoker('<?= $test['id_loker'] ?>')" class="text-danger bg-light-danger ms-3"><i class="bx bxs-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var table = $('#table-list-test-skill').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#table-list-test-skill_wrapper .col-md-6:eq(0)');
    });

    function showFormLoker(id_loker = 0) {
        $.ajax({
            url: 'content/modal-form-loker.php',
            type: 'POST',
            data: {
                id_loker: id_loker,
                action: 'showFormLoker'
            },
            success: function(response) {
                $('#myModal').html(response);
                $('#myModal').modal('show');
            }
        });
    }

    function deleteLoker(id_loker) {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Loker yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'classes/Loker.php',
                    type: 'POST',
                    data: {
                        id_loker: id_loker,
                        action: 'deleteLoker'
                    },
                    success: function(response) {
                        let res = JSON.parse(response);
                        Lobibox.notify(`${res.status}`, {
                            size: 'mini',
                            rounded: true,
                            sound: false,
                            delay: 2000,
                            delayIndicator: true,
                            position: 'center top',
                            icon: `${res.icon}`,
                            msg: `${res.message}`
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }
                });
            }
        });
    }
</script>