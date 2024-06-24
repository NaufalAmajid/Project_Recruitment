<div class="row">
    <div class="card radius-10">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">Data Jadwal Tes & Orientasi</h6>
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
                <table id="table-jadwal" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Posisi</th>
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
                                <td><?= $faker->jobTitle() ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-outline-success"><i class="bx bxs-calendar"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-info"><i class="bx bxs-edit"></i>
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
                            <th>Posisi</th>
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
        $("#table-jadwal").DataTable();
    })
</script>