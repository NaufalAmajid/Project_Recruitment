<?php
require_once 'classes/Lamaran.php';
$lamaran = new Lamaran();
?>
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Data Karyawan</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="dashboard.php"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><a href="?page=data_karyawan">Daftar Karyawan Lolos</a></li>
                <?php if (isset($_GET['menu'])) : ?>
                    <li class="breadcrumb-item active" aria-current="page"><a href="?page=data_karyawan&menu=detail_lamaran&id=<?= $_GET['id'] ?>">Detail Lamaran</a></li>
                <?php endif; ?>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
<?php if (isset($_GET['menu'])) : ?>
    <?php include 'content/show-detail-lamaran.php'; ?>
<?php else : ?>
    <div class="row">
        <div class="card radius-10">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-lamaran-lolos" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Posisi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php
                        $no = 1;
                        $lamarans = $lamaran->getAllLamaran('where lam.status_lamaran = 1');
                        ?>
                        <?php foreach ($lamarans as $lamar) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $lamar['email'] ?></td>
                                <td><?= $lamar['username'] ?></td>
                                <td><?= ucwords($lamar['nama']) ?></td>
                                <td><?= ucwords($lamar['nama_posisi']) ?></td>
                                <td>
                                    <a href="?page=data_karyawan&menu=detail_lamaran&id=<?= $lamar['id_lamaran'] ?>" class="btn btn-sm btn-primary">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<script>
    $(document).ready(function() {
        var table = $('#table-lamaran-lolos').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#table-lamaran-lolos_wrapper .col-md-6:eq(0)');
    });
</script>