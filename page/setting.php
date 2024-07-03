<?php
require_once 'classes/Setting.php';
$setting = new Setting();
$setting = $setting->getSetting();
?>
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Setting</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="dashboard.php"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Pengaturan Aplikasi</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="form-setting">
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <h6 class="mb-0">Nama Perusahaan</h6>
                                </div>
                                <div class="col-sm-10 text-secondary">
                                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" value="<?= $setting['nama_perusahaan'] ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <h6 class="mb-0">Alamat</h6>
                                </div>
                                <div class="col-sm-10 text-secondary">
                                    <input type="text" class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" value="<?= $setting['alamat_perusahaan'] ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-10 text-secondary">
                                    <input type="text" class="form-control" id="email_perusahaan" name="email_perusahaan" value="<?= $setting['email_perusahaan'] ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <h6 class="mb-0">Pesan Email</h6>
                                </div>
                                <div class="col-sm-10 text-secondary">
                                    <textarea class="form-control" rows="20" id="pesan_email_lolos" name="pesan_email_lolos"><?= $setting['pesan_email_lolos'] ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10 text-secondary">
                                    <input type="button" class="btn btn-primary px-4" onclick="changeSetting()" value="Simpan Perubahan" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function changeSetting() {
        let form = $('#form-setting').serializeArray();
        let send = {};
        form.forEach(function(item) {
            send[item.name] = item.value;
        });
        send['action'] = 'changeSetting';
        $.ajax({
            url: 'classes/Setting.php',
            type: 'POST',
            data: send,
            success: function(response) {
                var data = JSON.parse(response);
                Swal.fire({
                    icon: data.status,
                    title: data.title,
                    text: data.msg,
                    showConfirmButton: false,
                    timer: 1500
                }).then(function(e) {
                    if (e.dismiss === Swal.DismissReason.timer) {
                        location.reload();
                    }
                });
            }
        });
    }
</script>