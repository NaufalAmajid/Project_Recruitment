<div class="row">
    <div class="card radius-10">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">Data User</h6>
                </div>
                <div class="dropdown ms-auto">
                    <button type="button" class="btn btn-success px-3"><i class="bx bx-user-plus mr-2"></i>Tambah User</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-user" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once 'vendor/autoload.php';

                        $faker = Faker\Factory::create('id_ID');
                        $data  = 100;
                        $no    = 1;
                        ?>

                        <?php for ($i = 0; $i < $data; $i++) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $faker->nik() ?></td>
                                <td><?= $faker->name() ?></td>
                                <td><?= $faker->email() ?></td>
                                <td><?= $faker->userName() ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-outline-warning"><i class="bx bxs-show"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-primary"><i class="bx bxs-edit-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger"><i class="bx bxs-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#table-user").DataTable();
    })
</script>