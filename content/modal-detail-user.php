<?php
require_once '../classes/User.php';
$detail = $user->getAllUserAccount("where usr.id_user = $_POST[id_user]")[0];
?>
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row g-3" id="form-update-user">
                <div class="col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <div class="position-relative input-icon">
                        <input type="text" class="form-control" id="username" placeholder="username" value="<?= $detail['username'] ?>" name="username">
                        <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <div class="position-relative input-icon">
                        <input type="text" class="form-control" id="email" placeholder="email ..." value="<?= $detail['email'] ?>" name="email">
                        <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-envelope'></i></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="nama" class="form-label">Nama</label>
                    <div class="position-relative input-icon">
                        <input type="text" class="form-control" id="nama" placeholder="nama ..." value="<?= $detail['nama_user'] ?>" name="nama_user">
                        <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user-circle'></i></span>
                    </div>
                </div>
                <?php if ($_POST['id_role'] == 3) : ?>
                    <div class="col-md-12">
                        <label for="nik" class="form-label">NIK</label>
                        <div class="position-relative input-icon">
                            <input type="text" class="form-control" id="nik" placeholder="nik ..." value="<?= $detail['nik'] ?>" name="nik">
                            <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-code-block'></i></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="no_hp" class="form-label">No Hp</label>
                        <div class="position-relative input-icon">
                            <input type="text" class="form-control" id="no_hp" placeholder="no hp ..." value="<?= $detail['no_hp'] ?>" name="no_hp">
                            <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-phone'></i></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="jenkel" class="form-label">Jenis Kelamin</label>
                        <select id="jenkel" class="form-select">
                            <option value="Laki-laki" <?= $detail['jenkel'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan" <?= $detail['jenkel'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <div class="position-relative input-icon">
                            <input type="text" class="form-control" id="tempat_lahir" placeholder="tempat lahir ..." value="<?= $detail['tempat_lahir'] ?>" name="tempat_lahir">
                            <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-map-alt'></i></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <div class="position-relative input-icon">
                            <input type="date" class="form-control" id="tanggal_lahir" placeholder="tanggal lahir ..." value="<?= $detail['tanggal_lahir'] ?>" name="tanggal_lahir">
                            <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-calendar-plus'></i></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" placeholder="alamat ..." rows="3"><?= $detail['alamat'] ?></textarea>
                    </div>
                <?php else : ?>
                    <div class="col-sm-12">
                        <label class="form-label">Role</label>
                        <div class="form-check form-check-success">
                            <input class="form-check-input" type="radio" name="role_user" id="hrd" value="2" <?= $detail['id_role'] == 2 ? 'checked' : '' ?>>
                            <label class="form-check-label" for="hrd">Human Resource Development (HRD)</label>
                        </div>
                        <div class="form-check form-check-success">
                            <input class="form-check-input" type="radio" name="role_user" id="admin" value="1" <?= $detail['id_role'] == 1 ? 'checked' : '' ?>>
                            <label class="form-check-label" for="admin">Admin Recruitment</label>
                        </div>
                    </div>
                <?php endif; ?>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <?php if ($_POST['id_role'] != 3) : ?>
                <button type="button" class="btn btn-primary" onclick="updateUser('<?= $detail['id_user'] ?>', '<?= $detail['id_role'] ?>')">Simpan Perubahan</button>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
    function updateUser(id_user, id_role) {
        let form = $('#form-update-user').serializeArray();
        let data = {};
        let empty = [];
        form.forEach((item) => {
            if (item.value == '') {
                empty.push(item.name);
            } else {
                data[item.name] = item.value;
            }
        });
        data['id_user'] = id_user;
        data['id_role'] = id_role;
        data['action'] = 'updateUser';

        if (empty.length > 0) {
            Lobibox.notify('warning', {
                pauseDelayOnHover: true,
                size: 'mini',
                rounded: true,
                delayIndicator: false,
                delay: 2000,
                icon: 'bx bx-error',
                continueDelayOnInactiveTab: false,
                sound: false,
                position: 'center top',
                msg: `Field ${empty.join(', ')} harus diisi!`
            });
            return;
        } else {
            $.ajax({
                url: 'classes/User.php',
                type: 'POST',
                data: data,
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
    }
</script>