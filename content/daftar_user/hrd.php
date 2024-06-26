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
                <li><a class="dropdown-item" href="javascript:;" onclick="changeStatusUser(1)">Aktifkan User</a>
                </li>
                <li><a class="dropdown-item" href="javascript:;" onclick="changeStatusUser(0)">Non Aktifkan User</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table id="table-list-hrd" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
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
                $hrds = $users->getAllUserAccount('where ro.id_role = 2');
                $no = 1;
                ?>
                <?php foreach ($hrds as $hrd) : ?>
                    <tr>
                        <th align="center">
                            <div class="form-check form-check-<?= $hrd['is_active'] == 1 ? 'danger' : 'success' ?>">
                                <input class="form-check-input" type="checkbox" value="<?= $hrd['id_user'] ?>" id="group_action_<?= $hrd['id_user'] ?>" name="group_action[]">
                            </div>
                        </th>
                        <td><?= $no++ ?></td>
                        <td><?= $hrd['username'] ?></td>
                        <td><?= $hrd['email'] ?></td>
                        <td><?= $hrd['nama_user'] ?></td>
                        <td>
                            <?php if ($hrd['is_active'] == 1) : ?>
                                <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Active</div>
                            <?php else : ?>
                                <div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Non-Active</div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($hrd['is_active'] == 1) : ?>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="detail user" onclick="detailUser('<?= $hrd['id_user'] ?>', '<?= $hrd['id_role'] ?>')"><i class="bx bx-info-circle"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="non-aktifkan" onclick="userActivation('<?= $hrd['id_user'] ?>', 0)"><i class="bx bx-user-x"></i>
                                    </button>
                                </div>
                            <?php else : ?>
                                <a href="javascript:;" class="text-primary fs-4" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="aktifkan" onclick="userActivation('<?= $hrd['id_user'] ?>', 1)"><i class="bx bx-rotate-left"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        var table = $('#table-list-hrd').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#table-list-hrd_wrapper .col-md-6:eq(0)');
    });
</script>