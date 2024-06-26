<?php
session_start();
if (isset($_SESSION['is_login'])) {
    header('location: dashboard.php');
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/plugins/notifications/css/lobibox.min.css" />
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <title>E - Recruitment</title>
</head>

<body class="">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-cover">
            <div class="">
                <div class="row g-0">
                    <div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
                            <div class="card-body">
                                <img src="assets/images/login-images/register-cover.svg" class="img-fluid auth-img-cover-login" width="550" alt="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right justify-content-center">
                        <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                            <div class="card-body p-sm-5">
                                <div class="">
                                    <div class="mb-3 text-center">
                                        <img src="assets/images/logo-icon.png" width="60" alt="">
                                    </div>
                                    <div class="text-center mb-4">
                                        <h5 class="">E - RECRUITMENT</h5>
                                        <p class="mb-0">Silahkan Buat Akun Terlebih Dahulu!</p>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" id="form-sign-up">
                                            <div class="col-6">
                                                <label for="username" class="form-label">Username</label>
                                                <div class="position-relative input-icon">
                                                    <input type="text" class="form-control" id="username" placeholder="username ..." name="username" autocomplete="off" autofocus>
                                                    <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label for="email" class="form-label">Email</label>
                                                <div class="position-relative input-icon">
                                                    <input type="text" class="form-control" id="email" placeholder="email ..." name="email" autocomplete="off">
                                                    <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-envelope'></i></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="nama" class="form-label">Nama</label>
                                                <div class="position-relative input-icon">
                                                    <input type="text" class="form-control" id="nama" placeholder="nama ..." name="nama" autocomplete="off">
                                                    <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user-circle'></i></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0" id="password" name="password" placeholder="password ..."> <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                                                <div class="input-group" id="show_hide_confirm_password">
                                                    <input type="password" class="form-control border-end-0" id="confirm_password" name="confirm_password" placeholder="ulangi password ..."> <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <p class="mb-0">Sudah punya akun? <a href="index.php"><u>Login disini.</u></a>
                                                </p>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Masuk</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--notification js -->
    <script src="assets/plugins/notifications/js/sweetalert2@11.js"></script>
    <script src="assets/plugins/notifications/js/lobibox.min.js"></script>
    <script src="assets/plugins/notifications/js/notifications.min.js"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });

            $("#show_hide_confirm_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_confirm_password input').attr("type") == "text") {
                    $('#show_hide_confirm_password input').attr('type', 'password');
                    $('#show_hide_confirm_password i').addClass("bx-hide");
                    $('#show_hide_confirm_password i').removeClass("bx-show");
                } else if ($('#show_hide_confirm_password input').attr("type") == "password") {
                    $('#show_hide_confirm_password input').attr('type', 'text');
                    $('#show_hide_confirm_password i').removeClass("bx-hide");
                    $('#show_hide_confirm_password i').addClass("bx-show");
                }
            });

            $("#form-sign-up").submit(function(e) {
                e.preventDefault();
                let form = $(this).serializeArray();
                let empty = [];
                let send = {};
                form.forEach(item => {
                    if (item.value == "") {
                        empty.push(item.name);
                    } else {
                        send[item.name] = item.value;
                    }
                });
                send['action'] = 'signup';

                // check empty field
                if (empty.length > 0) {
                    Lobibox.notify('error', {
                        pauseDelayOnHover: true,
                        size: 'mini',
                        rounded: true,
                        delayIndicator: false,
                        delay: 2000,
                        icon: 'bx bx-error',
                        continueDelayOnInactiveTab: false,
                        sound: false,
                        position: 'right top',
                        msg: `Field ${empty.join(', ')} harus diisi!`
                    });
                    return;
                }

                // check same password
                if (send.password != send.confirm_password) {
                    Lobibox.notify('error', {
                        pauseDelayOnHover: true,
                        size: 'mini',
                        rounded: true,
                        delayIndicator: false,
                        delay: 2000,
                        icon: 'bx bx-error',
                        continueDelayOnInactiveTab: false,
                        sound: false,
                        position: 'right top',
                        msg: `Password tidak sama!`
                    });
                    return;
                }

                $.ajax({
                    url: 'classes/Authentication.php',
                    type: 'POST',
                    data: send,
                    success: function(response) {
                        let result = JSON.parse(response);
                        Lobibox.notify(`${result.status}`, {
                            size: 'mini',
                            showClass: 'Lobibox-custom-class hide-close-icon',
                            hideClass: 'Lobibox-custom-class-show',
                            msg: `${result.message}`,
                            delay: 2000,
                            sound: false,
                            position: 'center top',
                            icon: `${result.icon}`
                        });
                        if (result.status == 'success') {
                            setTimeout(() => {
                                location.href = 'index.php';
                            }, 2000);
                        }
                    }
                });

            });
        });
    </script>
</body>

</html>