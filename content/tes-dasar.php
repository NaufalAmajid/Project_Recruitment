<?php
require_once 'classes/Loker.php';
$lokers = new Loker();
$lokerById = $lokers->getLokerById($_GET['id']);
?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mt-2"><?= strtoupper($lokerById['nama_posisi']) ?></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Soal</th>
                                <th>Jawab</th>
                            </tr>
                        </thead>
                        <tbody>
                            <input type="hidden" name="id_loker" id="id_loker" value="<?= $_GET['id'] ?>">
                            <form id="form-soal">
                                <?php $no = 1; ?>
                                <?php foreach ($testSkill->getAllTestByLoker($_GET['id']) as $soal) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $soal['soal'] ?></td>
                                        <td>
                                            <textarea name="soal_<?= $soal['id_soal'] ?>" data-idsoal="<?= $soal['id_soal'] ?>" class="form-control" rows="3" cols="50"></textarea>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="3" align="center">
                                        <button type="button" class="btn btn-sm btn-success" onclick="saveJawaban()">Simpan</button>
                                        <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                                    </td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function saveJawaban() {
        let idLoker = $('#id_loker').val();
        let data = $('#form-soal').serializeArray();
        let jawaban = {};
        let empty = [];
        let limitAnswer = [];
        data.forEach((item) => {
            if (item.value === '') {
                empty.push(item.name);
            } else if (item.value.length > 150) {
                limitAnswer.push(item.name);
            } else {
                jawaban[item.name] = item.value;
            }
        });

        if (limitAnswer.length > 0) {
            Lobibox.notify('error', {
                size: 'mini',
                rounded: true,
                sound: false,
                delay: 2000,
                delayIndicator: true,
                position: 'top right',
                icon: 'bx bx-error',
                msg: 'Jawaban maksimal 150 karakter'
            });
            return;
        }

        if (empty.length > 0) {
            Lobibox.notify('error', {
                size: 'mini',
                rounded: true,
                sound: false,
                delay: 2000,
                delayIndicator: true,
                position: 'top right',
                icon: 'bx bx-error',
                msg: 'Masih ada jawaban yang kosong'
            });
            return;
        } else {
            $.ajax({
                url: 'classes/Test_Skill.php',
                type: 'post',
                data: {
                    action: 'saveJawaban',
                    id_loker: idLoker,
                    jawaban: jawaban
                },
                success: function(response) {
                    let res = JSON.parse(response);
                    Swal.fire({
                        icon: `${res.status}`,
                        title: `${res.title}`,
                        html: `${res.msg}`,
                        showConfirmButton: false,
                        timer: 1500
                    }).then((e) => {
                        if (e.dismiss === Swal.DismissReason.timer) {
                            window.location.href = 'dashboard.php?page=tes_orientasi';
                        }
                    })
                }
            });
        }
    }
</script>