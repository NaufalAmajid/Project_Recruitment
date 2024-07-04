<?php
require_once 'classes/Test_Skill.php';
$testSkill = new Test_Skill();
$lokerById = $lokers->getLokerById($_GET['id']);
$checkJawaban = $testSkill->getJawabanByKaryawanAndLoker(['karyawan_id' => $_SESSION['user']['id_karyawan'], 'loker_id' => $_GET['id']]);
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
                <?php
                $fileLamaran = 'myfiles/berkas/berkas_' . $_SESSION['user']['id_karyawan'] . '_' . $_GET['id'] . '.pdf';
                ?>
                <?php if (file_exists($fileLamaran)) : ?>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="alert alert-success" role="alert">
                                <p>Berkas Lamaran Anda sudah terupload.</p>
                                <p>Silahkan tunggu proses seleksi berikutnya dan cek sekala berkala email dan menu <i>Test dan Orientasi</i></p>
                                <p></p>
                                <a href="<?= $fileLamaran ?>" target="_blank" class="btn btn-sm btn-primary">Lihat Berkas Lamaran</a>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="row mb-3">
                        <div class="col-12">
                            <input type="hidden" name="id_loker" id="id_loker" value="<?= $_GET['id'] ?>">
                            <?php if ($checkJawaban['jawab'] > 0) : ?>
                                <div class="alert alert-success" role="alert">
                                    <p>Anda sudah menjawab soal test loker ini.
                                        Silahkan upload Berkas Lamaran untuk melanjutkan proses seleksi.
                                    </p>
                                    <span class="text-danger">*Disarankan untuk upload dalam 1 file PDF</span>
                                </div>
                            <?php else : ?>
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
                                            <form id="form-soal">
                                                <?php $no = 1; ?>
                                                <?php foreach ($testSkill->getAllTestByLoker($_GET['id']) as $soal) : ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $soal['soal'] ?></td>
                                                        <td><input type="text" name="soal_<?= $soal['id_soal'] ?>" data-idsoal="<?= $soal['id_soal'] ?>" class="input-border-bottom" size="<?= strlen($soal['soal']) ?>"></td>
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
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if ($checkJawaban['jawab'] > 0) : ?>
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <center>
                                        <img src="assets/images/image_placeholder.jpg" onclick="triggerClick(this)" alt="image-placeholder" id="image-placeholder" class="img-thumbnail" width="300" height="300">
                                    </center>
                                    <center>
                                        <label for="file_berkas" id="label-laporan">Upload Berkas Diatas</label>
                                    </center>
                                    <input type="file" class="form-control d-none" onchange="displayFile(this)" id="file_berkas" name="file_berkas">
                                </div>
                                <button class="btn btn-primary col-md-12" id="btn-upload-berkas" type="button" onclick="uploadBerkas()">Upload Berkas</button>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
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
        data.forEach((item) => {
            if (item.value === '') {
                empty.push(item.name);
            } else {
                jawaban[item.name] = item.value;
            }
        });
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
                            location.reload();
                        }
                    })
                }
            });
        }
    }

    function triggerClick(e) {
        document.querySelector('#file_berkas').click();
    }

    function displayFile(e) {
        //just file .pdf or .docx or .doc allowed
        if (e.files[0].type == 'application/pdf' || e.files[0].type == 'application/msword' || e.files[0].type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
            if (e.files[0].size > 10000000) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Ukuran file maksimal 10MB',
                    timer: 2000
                }).then((e) => {
                    document.querySelector('#file_berkas').value = '';
                    document.querySelector('#image-placeholder').src = 'assets/images/image_placeholder.jpg';
                });
            } else {
                //if file .pdf display pdf icon else display word icon
                if (e.files[0].type == 'application/pdf') {
                    document.querySelector('#image-placeholder').src = 'assets/images/pdf-icon.png';
                    document.querySelector('#label-laporan').innerHTML = e.files[0].name;
                } else {
                    document.querySelector('#image-placeholder').src = 'assets/images/word-icon.png';
                    document.querySelector('#label-laporan').innerHTML = e.files[0].name;
                }
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'File yang diupload harus berformat .pdf, .docx, atau .doc',
            }).then((e) => {
                document.querySelector('#file_berkas').value = '';
                document.querySelector('#image-placeholder').src = 'assets/images/image_placeholder.jpg';
            });
        }
    }

    function uploadBerkas() {
        let file = document.querySelector('#file_berkas').files[0];
        let idLoker = $('#id_loker').val();
        let formData = new FormData();
        formData.append('file_berkas', file);
        formData.append('loker_id', idLoker);
        formData.append('action', 'uploadBerkas');
        $.ajax({
            url: 'classes/Test_Skill.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                let res = JSON.parse(response);
                Swal.fire({
                    icon: `${res.status}`,
                    title: `${res.title}`,
                    text: `${res.msg}`,
                    showConfirmButton: false,
                    timer: 1500
                }).then((e) => {
                    if (e.dismiss === Swal.DismissReason.timer) {
                        location.reload();
                    }
                });
            }
        });
    }
</script>