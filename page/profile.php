<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">User Profile</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="dashboard.php"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <?php
                            $file_photo = 'myfiles/photo/' . $_SESSION['user']['photo'];
                            ?>
                            <?php if (file_exists($file_photo) && !is_null($_SESSION['user']['photo'])) : ?>
                                <img src="<?= $file_photo ?>" id="placeholder-image" alt="photo-profile" onclick="triggerClick(this)" class="rounded-circle p-1 bg-primary" width="110" height="110">
                            <?php else : ?>
                                <img src="assets/images/avatars/placeholder-image.png" id="placeholder-image" alt="photo-profile" onclick="triggerClick(this)" class="rounded-circle p-1 bg-primary" width="110" height="110">
                            <?php endif; ?>
                            <input type="file" class="form-control d-none" onchange="displayImage(this)" id="photo" name="photo">
                            <div class="mt-3">
                                <h4><?= ucwords($_SESSION['user']['nama_user']) ?></h4>
                                <p class="text-secondary mb-1"><?= ucwords($_SESSION['user']['nama_role']) ?></p>
                                <p class="text-muted font-size-sm"><?= $_SESSION['user']['username'] ?> | <?= $_SESSION['user']['email'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form id="form-account-user">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nama</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="nama" value="<?= ucwords($_SESSION['user']['nama_user']) ?>" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Username</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="username" value="<?= $_SESSION['user']['username'] ?>" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="email" value="<?= $_SESSION['user']['email'] ?>" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Password</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="password" name="real_password" class="form-control" placeholder="masukkan password lama ..." onchange="checkPasswordUser('<?= $_SESSION['user']['id_user'] ?>')" />
                                    <small id="notif-check-password" class="text-danger d-none">*password salah</small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Ganti Password</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="password" name="change_password" class="form-control" disabled />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Konfirm Password</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="password" name="change_password_konfirmasi" class="form-control" onkeyup="checkSamePassword()" disabled />
                                    <small id="notif-confirm-password" class="text-danger d-none">*password tidak sama</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="button" class="btn btn-primary px-4" onclick="changeAccountUser('<?= $_SESSION['user']['id_user'] ?>', '<?= $_SESSION['user']['id_role'] ?>')" value="Simpan Perubahan" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($_SESSION['user']['id_role'] == 3) : ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="d-flex align-items-center mb-3">Biodata <?= is_null($_SESSION['user']['status_karyawan']) ? 'Pelamar' : 'Karyawan' ?></h5>
                            <form id="form-biodata-karyawan">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">NIK</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="nik" value="<?= $_SESSION['user']['nik'] ?>" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Jenis Kelamin</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select id="jenkel" name="jenkel" class="form-select">
                                            <option value="">-</option>
                                            <option value="Laki-laki" <?= $_SESSION['user']['jenkel'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                            <option value="Perempuan" <?= $_SESSION['user']['jenkel'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tempat Lahir</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary">
                                        <input type="text" class="form-control" name="tempat_lahir" value="<?= $_SESSION['user']['tempat_lahir'] ?>" />
                                    </div>
                                    <div class="col-sm-2">
                                        <h6 class="mb-0">Tanggal Lahir</h6>
                                    </div>
                                    <div class="col-sm-3 text-secondary">
                                        <input type="date" class="form-control" name="tanggal_lahir" value="<?= $_SESSION['user']['tanggal_lahir'] ?>" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">No Hp</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="no_hp" class="form-control" value="<?= $_SESSION['user']['no_hp'] ?>" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Alamat</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= $_SESSION['user']['alamat'] ?></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="button" class="btn btn-success px-4" onclick="updateBioKaryawan()" value="Simpan Perubahan Biodata" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
    function triggerClick(e) {
        document.querySelector('#photo').click();
    }

    function displayImage(e) {
        if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('#placeholder-image').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(e.files[0]);
        }
    }

    function changeAccountUser(id_user, id_role) {
        let form = $('#form-account-user').serializeArray();
        let photo = $('#photo').prop('files')[0];
        let newForm = new FormData();
        // check size photo if > 1mb then return false
        if (photo != undefined) {
            if (photo.size > 1000000) {
                Lobibox.notify('warning', {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    rounded: true,
                    delayIndicator: false,
                    delay: 2500,
                    icon: 'bx bx-error',
                    continueDelayOnInactiveTab: false,
                    sound: false,
                    position: 'center top',
                    msg: 'Ukuran foto tidak boleh melebihi 1MB'
                });
                return false;
            }
            newForm.append('photo', photo);
        }
        newForm.append('action', 'updateAccountUser');
        newForm.append('id_user', id_user);
        newForm.append('id_role', id_role);
        form.forEach((item) => {
            newForm.append(item.name, item.value);
        });

        $.ajax({
            url: 'classes/Profile.php',
            type: 'POST',
            data: newForm,
            contentType: false,
            processData: false,
            success: function(response) {
                let result = JSON.parse(response);
                Lobibox.notify(`${result.status}`, {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    rounded: true,
                    delayIndicator: false,
                    delay: 2000,
                    icon: `${result.icon}`,
                    continueDelayOnInactiveTab: false,
                    sound: false,
                    position: 'center top',
                    msg: `${result.message}`
                });
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }
        });
    }

    function checkPasswordUser(id_user) {
        let password = $('input[name="real_password"]').val();
        $.ajax({
            url: 'classes/Profile.php',
            type: 'POST',
            data: {
                action: 'checkPasswordUser',
                id_user: id_user,
                password: password
            },
            success: function(response) {
                if (response) {
                    $('input[name="change_password"]').prop('disabled', false);
                    $('input[name="change_password"]').focus();
                    $('input[name="change_password_konfirmasi"]').prop('disabled', false);
                    $('#notif-check-password').addClass('d-none');
                } else {
                    $('input[name="change_password"]').prop('disabled', true);
                    $('input[name="change_password"]').val('');
                    $('input[name="change_password_konfirmasi"]').prop('disabled', true);
                    $('input[name="change_password_konfirmasi"]').val('');
                    $('#notif-check-password').removeClass('d-none');
                }
            }
        });
    }

    function checkSamePassword() {
        let password = $('input[name="change_password"]').val();
        let konfirmasi = $('input[name="change_password_konfirmasi"]').val();
        if (password != konfirmasi) {
            $('#notif-confirm-password').removeClass('d-none');
        } else {
            $('#notif-confirm-password').addClass('d-none');
        }
    }

    function updateBioKaryawan() {
        let form = $('#form-biodata-karyawan').serializeArray();
        let send = {};
        form.forEach((item) => {
            send[item.name] = item.value;
        });
        send['action'] = 'updateBioKaryawan';
        $.ajax({
            url: 'classes/Profile.php',
            type: 'POST',
            data: send,
            success: function(response) {
                let result = JSON.parse(response);
                Lobibox.notify(`${result.status}`, {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    rounded: true,
                    delayIndicator: false,
                    delay: 2000,
                    icon: `${result.icon}`,
                    continueDelayOnInactiveTab: false,
                    sound: false,
                    position: 'center top',
                    msg: `${result.message}`
                });
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }
        });
    }
</script>