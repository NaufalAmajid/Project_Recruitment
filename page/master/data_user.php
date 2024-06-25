<?php
require_once 'classes/Roles.php';
require_once 'classes/User.php';
$roles = new Roles();
?>
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Daftar User</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="dashboard.php"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item" aria-current="page"><a href="?page=<?= $_GET['page'] ?>&sub=<?= $_GET['sub'] ?>" class="<?= !isset($_GET['menu']) ? 'active-breadcrumb' : '' ?>">List User <i>E - Recruitment</i></a></li>
                <?php if (isset($_GET['menu'])) : ?>
                    <?php
                    $simpleRole = $roles->getRoleBySimple($_GET['menu']);
                    if ($simpleRole) {
                        $nameRole = ucwords($simpleRole['nama_role']);
                    } else if ($_GET['menu'] == 'add') {
                        $nameRole = 'Tambah User';
                    }
                    ?>
                    <li class="breadcrumb-item active-breadcrumb" aria-current="page"><?= $nameRole ?></li>
                <?php endif; ?>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <button type="button" class="btn btn-primary" onclick="toMenu('?page=<?= $_GET['page'] ?>&sub=<?= $_GET['sub'] ?>&menu=add')">Tambah User</button>
            <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                <?php foreach ($roles->getAllRole() as $role) : ?>
                    <a class="dropdown-item" href="javascript:;" onclick="toMenu('?page=<?= $_GET['page'] ?>&sub=<?= $_GET['sub'] ?>&menu=<?= $role['simple_nama_role'] ?>')"><?= ucwords($role['nama_role']) ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!--end breadcrumb-->
<div class="row">
    <div class="card radius-10">
        <?php if (isset($_GET['menu'])) : ?>
            <?php include 'content/daftar_user/' . $_GET['menu'] . '.php'; ?>
        <?php else : ?>
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Daftar User Aktif dan Non-aktif</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-list-user" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <?php
                        $users = new User();
                        $no = 1;
                        ?>
                        <tbody>
                            <?php foreach ($users->getAllUserAccount() as $user) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $user['username'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['nama_user'] ?></td>
                                    <td><?= $user['nama_role'] ?></td>
                                    <td><?= $user['is_active'] == 1 ? 'Aktif' : 'Non-aktif' ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
    $(document).ready(function() {
        var table = $('#table-list-user').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#table-list-user_wrapper .col-md-6:eq(0)');
    });

    function toMenu(url) {
        window.location.href = url;
    }
</script>