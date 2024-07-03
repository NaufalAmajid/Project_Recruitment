<?php
require_once 'classes/Lamaran.php'
?>
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Lamaran</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="dashboard.php"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item" aria-current="page">Daftar Lamaran Masuk</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
<div class="row">
    <div class="card radius-10">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">List Lamaran Masuk</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-list-lamaran" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Posisi</th>
                            <th>Divisi</th>
                            <th>Status</th>
                            <th>File Berkas</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php
                    $lamarans = new Lamaran();
                    $no = 1;
                    ?>
                    <tbody>
                        <?php foreach ($lamarans->getAllLamaran() as $lamar) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $lamar['email'] ?></td>
                                <td><?= ucwords($lamar['nama']) ?></td>
                                <td><?= ucwords($lamar['nama_posisi']) ?></td>
                                <td><?= ucwords($lamar['nama_divisi']) ?></td>
                                <td>
                                    <?php if ($lamar['status_lamaran'] == 0) : ?>
                                        <div class="badge rounded-pill text-primary bg-light-primary p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Proses</div>
                                    <?php else : ?>
                                        <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Lolos</div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="myfiles/berkas/<?= $lamar['file_lamaran'] ?>" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="bx bx-arrow-from-left"></i> Lihat</a>
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="detail lamaran" onclick="detailLamaran('<?= $lamar['id_lamaran'] ?>')"><i class="bx bx-file"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="kirim email" onclick="sendMail('<?= $lamar['id_lamaran'] ?>')"><i class="bx bx-mail-send"></i>
                                        </button>
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
        var table = $('#table-list-lamaran').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#table-list-lamaran_wrapper .col-md-6:eq(0)');
    });

    function detailLamaran(id, role) {
        window.location.href = `dashboard.php?page=detail_lamaran&id=${id}&role=${role}`;
    }

    function sendMail(id_lamaran) {
        Swal.fire({
            title: 'Kirim Email',
            text: 'Apakah lamaran ini lolos?, Lamaran yang lolos akan mendapatkan email pemberitahuan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#00c407',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lolos',
            cancelButtonText: 'Tidak Lolos'
        }).then((result) => {
            let status = result.isConfirmed ? 1 : 0;
            $.ajax({
                url: 'classes/Lamaran.php',
                type: 'POST',
                data: {
                    id_lamaran: id_lamaran,
                    status: status,
                    action: 'sendMail'
                },
                success: function(response) {
                    console.log(response);
                    // var data = JSON.parse(response);
                    // Swal.fire({
                    //     icon: data.status,
                    //     title: data.title,
                    //     text: data.msg,
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // });
                }
            });
        })
    }
</script>