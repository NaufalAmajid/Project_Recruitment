<?php
require_once 'classes/User.php';
$users = new User();
?>
<div class="card-header">
    <div class="d-flex align-items-center">
        <div>
            <h6 class="mb-0">Daftar User <?= strtoupper($_GET['menu']) ?></h6>
        </div>
        <div class="dropdown ms-auto">
            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="javascript:;">Action</a>
                </li>
                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table id="table-list-admin" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $admins = $users->getAllUserAccount('where ro.id_role = 1');
                $no = 1;
                ?>
                <?php foreach ($admins as $admin) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $admin['username'] ?></td>
                        <td><?= $admin['email'] ?></td>
                        <td><?= $admin['nama_user'] ?></td>
                        <td><?= $admin['is_active'] ?></td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        var table = $('#table-list-admin').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#table-list-admin_wrapper .col-md-6:eq(0)');
    });
</script>