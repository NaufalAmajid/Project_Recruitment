<?php
require_once 'classes/Test_Skill.php';
$testSkill = new Test_Skill();
$lokerById = $lokers->getLokerById($_GET['id']);
?>
<div class="row">
    <div class="col-4">
        <div class="card radius-10">
            <div class="card-header">
                <h5 class="card-title">Detail Loker</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <h6 class="text-muted">Posisi</h6>
                        <p><?= $lokerById['nama_posisi'] ?></p>
                    </li>
                    <li class="list-group-item">
                        <h6 class="text-muted">Divisi</h6>
                        <p><?= ucwords($lokerById['nama_divisi']) ?></p>
                    </li>
                    <li class="list-group-item">
                        <h6 class="text-muted">Jumlah Kebutuhan</h6>
                        <p><?= ucwords($lokerById['jumlah_kebutuhan']) ?></p>
                    </li>
                    <li class="list-group-item">
                        <h6 class="text-muted">Deskripsi</h6>
                        <textarea class="form-control" rows="<?= substr_count($lokerById['deskripsi'], "\n") + 5 ?>" readonly><?= $lokerById['deskripsi'] ?></textarea>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card radius-10">
            <div class="card-header">
                <h5 class="card-title">Soal Test Skill <?= ucwords($lokerById['nama_posisi']) ?></h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <input type="hidden" name="loker_id" id="loker_id" value="<?= $lokerById['id_loker'] ?>">
                            <input type="text" id="soal" class="form-control" placeholder="Masukkan Soal ...">
                            <button class="btn btn-outline-secondary" type="button" id="btn-add-soal" onclick="addSoal()">Tambah Soal</button>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Soal</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <?php foreach ($testSkill->getAllTestByLoker($_GET['id']) as $soal) : ?>
                                    <tr>
                                        <td><input type="text" id="soal_<?= $soal['id_soal'] ?>" value="<?= $soal['soal'] ?>" class="input-border-bottom" size="<?= strlen($soal['soal']) ?>"></td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="javascript:;" onclick="editSoal('<?= $soal['id_soal'] ?>')" class="text-primary"><i class="bx bxs-pencil fs-5"></i></a>
                                                <a href="javascript:;" onclick="deleteSoal('<?= $soal['id_soal'] ?>')" class="text-danger ms-2"><i class="bx bxs-trash-alt fs-5"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function addSoal() {
        let soal = $('#soal').val();
        let loker_id = $('#loker_id').val();
        if (soal == '') {
            Lobibox.notify('error', {
                size: 'mini',
                rounded: true,
                sound: false,
                delay: 2000,
                delayIndicator: true,
                position: 'top right',
                icon: 'bx bx-error',
                msg: 'Soal tidak boleh kosong'
            });
            return;
            return;
        }
        $.ajax({
            url: 'classes/Test_Skill.php',
            type: 'POST',
            data: {
                action: 'addSoal',
                soal: soal,
                loker_id: loker_id
            },
            success: function(response) {
                let res = JSON.parse(response);
                Lobibox.notify(`${res.status}`, {
                    size: 'mini',
                    rounded: true,
                    sound: false,
                    delay: 2000,
                    delayIndicator: true,
                    position: 'top right',
                    icon: `${res.icon}`,
                    msg: `${res.msg}`
                });
                if (res.status == 'success') {
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
            }
        });
    }

    function editSoal(id_soal) {
        let soal = $(`#soal_${id_soal}`).val();
        if (soal == '') {
            Lobibox.notify('error', {
                size: 'mini',
                rounded: true,
                sound: false,
                delay: 2000,
                delayIndicator: true,
                position: 'top right',
                icon: 'bx bx-error',
                msg: 'Soal tidak boleh kosong'
            });
            return;
            return;
        }
        $.ajax({
            url: 'classes/Test_Skill.php',
            type: 'POST',
            data: {
                action: 'editSoal',
                soal: soal,
                id_soal: id_soal
            },
            success: function(response) {
                let res = JSON.parse(response);
                Lobibox.notify(`${res.status}`, {
                    size: 'mini',
                    rounded: true,
                    sound: false,
                    delay: 2000,
                    delayIndicator: true,
                    position: 'top right',
                    icon: `${res.icon}`,
                    msg: `${res.msg}`
                });
                if (res.status == 'success') {
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
            }
        });
    }

    function deleteSoal(id_soal) {
        $.ajax({
            url: 'classes/Test_Skill.php',
            type: 'POST',
            data: {
                action: 'deleteSoal',
                id_soal: id_soal
            },
            success: function(response) {
                let res = JSON.parse(response);
                Lobibox.notify(`${res.status}`, {
                    size: 'mini',
                    rounded: true,
                    sound: false,
                    delay: 2000,
                    delayIndicator: true,
                    position: 'top right',
                    icon: `${res.icon}`,
                    msg: `${res.msg}`
                });
                if (res.status == 'success') {
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
            }
        });
    }
</script>