<div class="card-body p-4">
    <h5 class="mb-4">Form Tambah User (Admin / HRD)</h5>
    <form id="form-add-user">
        <div class="row mb-3">
            <label for="name" class="col-sm-3 col-form-label">Masukkan Nama</label>
            <div class="col-sm-9">
                <div class="position-relative input-icon">
                    <input type="text" class="form-control" id="name" placeholder="Masukkan Nama ..." name="nama" autofocus>
                    <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="username" class="col-sm-3 col-form-label">Masukkan Username</label>
            <div class="col-sm-9">
                <div class="position-relative input-icon">
                    <input type="text" class="form-control" id="username" placeholder="Masukkan Username ..." name="username">
                    <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user-circle'></i></span>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="email" class="col-sm-3 col-form-label">Email Address</label>
            <div class="col-sm-9">
                <div class="position-relative input-icon">
                    <input type="text" class="form-control" id="email" placeholder="Masukkan Email ..." name="email">
                    <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-envelope'></i></span>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="password" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
                <div class="position-relative input-icon">
                    <input type="password" class="form-control" id="password" value="123" name="password">
                    <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-lock'></i></span>
                </div>
                <small class="text-danger">*password default : 123</small>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Role User</label>
            <div class="col-sm-9">
                <div class="form-check form-check-success">
                    <input class="form-check-input" type="radio" name="role_user" id="hrd" value="2" checked>
                    <label class="form-check-label" for="hrd">Human Resource Development (HRD)</label>
                </div>
                <div class="form-check form-check-success">
                    <input class="form-check-input" type="radio" name="role_user" id="admin" value="1">
                    <label class="form-check-label" for="admin">Admin Recruitment</label>
                </div>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-3 col-form-label"></label>
            <div class="col-sm-9">
                <div class="d-md-flex d-grid align-items-center gap-3">
                    <button type="button" class="btn btn-primary px-4" onclick="addUser()">Tambah</button>
                    <button type="reset" class="btn btn-light px-4">Reset</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    function addUser() {
        let form = $('#form-add-user').serializeArray();
        let data = [];
        let send = {};
        form.forEach((item) => {
            if (item.value) {
                send[item.name] = item.value;
            } else {
                data.push(item.name);
            }
        });
        if (data.length > 0) {
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
                msg: `Field ${data.join(', ')} harus diisi!`
            });
            return;
        } else {
            send['action'] = 'addUser';
            $.ajax({
                url: 'classes/User.php',
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
                    if (result.status == 'success') {
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        }
    }
</script>