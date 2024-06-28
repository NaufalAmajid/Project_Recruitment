<?php
require_once 'classes/User.php';
require_once 'classes/Loker.php';
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
<?php if (isset($_GET['menu'])) : ?>
    <?php
    require_once 'classes/Divisi.php';
    require_once 'classes/Posisi.php';
    ?>
    <div class="row">
        <div class="col-4">
            <div class="card radius-10">
                <div class="card-header">
                    <h5 class="card-title">Divisi</h5>
                </div>
                <div class="card-body">
                    <form id="form-divisi">
                        <div class="mb-3">
                            <label for="nama_divisi" class="form-label">Nama Divisi</label>
                            <input type="text" class="form-control" id="nama_divisi" name="nama_divisi" placeholder="Nama Divisi ..." required>
                        </div>
                        <div class="mb-3">
                            <button type="button" id="btn-divisi" class="btn btn-primary" onclick="save('add', 'divisi')">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card radius-10">
                <div class="card-header">
                    <h5 class="card-title">Daftar Divisi</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-list-divisi">
                            <?php
                            $divisis = new Divisi();
                            $noDivi = 1;
                            ?>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Divisi</th>
                                    <th>Jumlah Loker</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($divisis->getAllDivisiAndCountLoker() as $divisi) : ?>
                                    <tr>
                                        <td><?= $noDivi++ ?></td>
                                        <td><?= ucwords($divisi['nama_divisi']) ?></td>
                                        <td><?= $divisi['jumlah_loker'] ?></td>
                                        <td>
                                            <div class="d-flex order-actions">
                                                <a href="javascript:;" onclick="showData('<?= $divisi['id_divisi'] ?>', 'divisi')" class="text-primary bg-light-primary"><i class="bx bxs-edit"></i></a>
                                                <a href="javascript:;" onclick="deleteData('<?= $divisi['id_divisi'] ?>', 'divisi')" class="text-danger bg-light-danger ms-3"><i class="bx bxs-trash"></i></a>
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
    </div>
    <div class="row">
        <div class="col-4">
            <div class="card radius-10">
                <div class="card-header">
                    <h5 class="card-title">Posisi</h5>
                </div>
                <div class="card-body">
                    <form id="form-posisi">
                        <div class="mb-3">
                            <label for="nama_posisi" class="form-label">Nama Posisi</label>
                            <input type="text" class="form-control" id="nama_posisi" name="nama_posisi" placeholder="Nama Posisi ..." required>
                        </div>
                        <div class="mb-3">
                            <button type="button" id="btn-posisi" class="btn btn-primary" onclick="save('add', 'posisi')">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card radius-10">
                <div class="card-header">
                    <h5 class="card-title">Daftar Posisi</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-list-posisi">
                            <?php
                            $posisis = new Posisi();
                            $noPos = 1;
                            ?>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Posisi</th>
                                    <th>Jumlah Loker</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($posisis->getAllPosisiAndCountLoker() as $posisi) : ?>
                                    <tr>
                                        <td><?= $noPos++ ?></td>
                                        <td><?= ucwords($posisi['nama_posisi']) ?></td>
                                        <td><?= $posisi['jumlah_loker'] ?></td>
                                        <td>
                                            <div class="d-flex order-actions">
                                                <a href="javascript:;" onclick="showData('<?= $posisi['id_posisi'] ?>', 'posisi')" class="text-primary bg-light-primary"><i class="bx bxs-edit"></i></a>
                                                <a href="javascript:;" onclick="deleteData('<?= $posisi['id_posisi'] ?>', 'posisi')" class="text-danger bg-light-danger ms-3"><i class="bx bxs-trash"></i></a>
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
    </div>
    <script>
        $(document).ready(function() {
            var table = $('#table-list-divisi').DataTable({
                lengthChange: false,
                pageLength: 3,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#table-list-divisi_wrapper .col-md-6:eq(0)');

            var table = $('#table-list-posisi').DataTable({
                lengthChange: false,
                pageLength: 3,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#table-list-posisi_wrapper .col-md-6:eq(0)');
        })

        function save(act, rule, id = 0) {
            let form = $('#form-' + rule).serializeArray();
            let send = {};
            let data = [];
            form.forEach(function(item, index) {
                if (item.value == '') {
                    data.push(item.name);
                } else {
                    send[item.name] = item.value;
                }
            });
            var rule = rule.charAt(0).toUpperCase() + rule.slice(1);
            send['action'] = act + rule;
            send['id'] = id;
            if (data.length > 0) {
                Lobibox.notify(`warning`, {
                    size: 'mini',
                    rounded: true,
                    sound: false,
                    delay: 2000,
                    delayIndicator: false,
                    position: 'center top',
                    icon: `bx bx-error`,
                    msg: `Field ${data.join(', ')} tidak boleh kosong!`
                });
                return;
            }
            $.ajax({
                url: `classes/${rule}.php`,
                type: 'POST',
                data: send,
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
            })
        }

        function showData(id, rule) {
            var ruleUp = rule.charAt(0).toUpperCase() + rule.slice(1);
            $.ajax({
                url: `classes/${ruleUp}.php`,
                type: 'POST',
                data: {
                    id: id,
                    action: `show${ruleUp}`
                },
                success: function(response) {
                    let res = JSON.parse(response);
                    $(`#nama_${rule}`).val(res[`nama_${rule}`]);
                    $(`#btn-${rule}`).attr('onclick', `save('update', '${rule}', ${id})`);
                    $(`#btn-${rule}`).text('Update');
                    $(`#btn-${rule}`).removeClass('btn-primary').addClass('btn-success');
                }
            });
        }

        function deleteData(id, rule) {
            var ruleUp = rule.charAt(0).toUpperCase() + rule.slice(1);
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: `Data ${rule} yang dihapus tidak dapat dikembalikan!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `classes/${ruleUp}.php`,
                        type: 'POST',
                        data: {
                            id: id,
                            action: `delete${ruleUp}`
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
<?php else : ?>
    <div class="row">
        <div class="card radius-10">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-list-loker" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Posisi</th>
                                <th>Divisi</th>
                                <th>Deskripsi</th>
                                <th>Dibutuhkan</th>
                                <th>Terisi</th>
                                <th>Status</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <?php
                        $lokers = new Loker();
                        $no = 1;
                        ?>
                        <tbody>
                            <?php foreach ($lokers->getAllLoker() as $loker) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= ucwords($loker['nama_posisi']) ?></td>
                                    <td><?= ucwords($loker['nama_divisi']) ?></td>
                                    <td><?= $func->truncateString($loker['deskripsi']) ?></td>
                                    <td><?= $loker['jumlah_kebutuhan'] ?></td>
                                    <td><?= $loker['jumlah_pelamar'] ?></td>
                                    <td>
                                        <?php if ($loker['jumlah_kebutuhan'] == $loker['jumlah_pelamar']) : ?>
                                            <div class="badge rounded-pill text-danger bg-light-danger p-2 px-3"><i class="bx bxs-circle me-1"></i>Penuh</div>
                                        <?php else : ?>
                                            <div class="badge rounded-pill text-success bg-light-success p-2 px-3"><i class="bx bxs-circle me-1"></i>Masih Tersedia</div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="javascript:;" onclick="showFormLoker('<?= $loker['id_loker'] ?>')" class="text-primary bg-light-primary"><i class="bx bxs-edit"></i></a>
                                            <a href="javascript:;" onclick="deleteLoker('<?= $loker['id_loker'] ?>')" class="text-danger bg-light-danger ms-3"><i class="bx bxs-trash"></i></a>
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
<?php endif; ?>
<script>
    $(document).ready(function() {
        var table = $('#table-list-loker').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#table-list-loker_wrapper .col-md-6:eq(0)');
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