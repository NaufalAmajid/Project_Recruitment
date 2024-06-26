<?php
require_once 'classes/User.php';
?>
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Test & Orientasi</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="dashboard.php"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Jadwal Test & Orientasi</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <button type="button" class="btn btn-primary">Settings</button>
            <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item" href="javascript:;">Action</a>
                <a class="dropdown-item" href="javascript:;">Another action</a>
                <a class="dropdown-item" href="javascript:;">Something else here</a>
                <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
            </div>
        </div>
    </div>
</div>
<!--end breadcrumb-->
<div class="row">
    <div class="card radius-10">
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
                            <th></th>
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
                                <td>
                                    <?php if ($user['is_active'] == 1) : ?>
                                        <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Active</div>
                                    <?php else : ?>
                                        <div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Non-Active</div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($user['is_active'] == 1) : ?>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="detail user" onclick="detailUser('<?= $user['id_user'] ?>', '<?= $user['id_role'] ?>')"><i class="bx bx-info-circle"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="non-aktifkan" onclick="userActivation('<?= $user['id_user'] ?>', 0)"><i class="bx bx-user-x"></i>
                                            </button>
                                        </div>
                                    <?php else : ?>
                                        <a href="javascript:;" class="text-primary fs-4" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="aktifkan" onclick="userActivation('<?= $user['id_user'] ?>', 1)"><i class="bx bx-rotate-left"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>