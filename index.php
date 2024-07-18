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
	<link rel="icon" href="assets/images/logo-company.png" type="image/png" />
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
								<img src="assets/images/login-images/login-cover.svg" class="auth-img-cover-login" width="650" height="600" alt="" />
							</div>
						</div>
					</div>
					<div class="col-12 col-xl-5 col-xxl-4 auth-cover-right justify-content-center">
						<div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
							<div class="card-body p-sm-5">
								<div class="">
									<div class="mb-3 text-center">
										<img src="assets/images/logo-company.png" width="160" alt="">
									</div>
									<div class="text-center mb-4">
										<h5 class="">E - RECRUITMENT</h5>
										<p class="mb-0">Silahkan Login Sebelah Sini!</p>
									</div>
									<div class="form-body">
										<form class="row g-3" id="form-login">
											<div class="col-12">
												<label for="username_email" class="form-label">Username / Email</label>
												<input type="text" class="form-control" id="username_email" placeholder="Masukkan Username / Email ..." name="username_email" autofocus autocomplete="off" required>
											</div>
											<div class="col-12">
												<label for="password" class="form-label">Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" class="form-control border-end-0" id="password" name="password" required placeholder="Masukkan Password ..."> <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
												</div>
											</div>
											<div class="col-md-12">
												<p class="mb-0">Belum punya akun? <a href="sign_up.php"><u>Daftar sekarang</u></a>
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

			$("#form-login").submit(function(e) {
				e.preventDefault();
				let form = $(this).serializeArray();
				let data = [];
				let send = {};
				form.forEach((item) => {
					if (item.value) {
						send[item.name] = item.value;
					} else {
						data.push(item.name);
					}
				});
				send['action'] = 'login';

				// check if data is empty
				if (data.length > 0) {
					Lobibox.notify('error', {
						size: 'mini',
						showClass: 'Lobibox-custom-class hide-close-icon',
						hideClass: 'Lobibox-custom-class-show',
						msg: 'Data ' + data.join(', ') + ' tidak boleh kosong',
						delay: 2000,
						sound: false,
						position: 'top right'
					});
					return;
				}

				$.ajax({
					url: 'classes/Authentication.php',
					type: 'POST',
					data: send,
					success: function(data) {
						let response = JSON.parse(data);
						Lobibox.notify(`${response.status}`, {
							size: 'mini',
							showClass: 'Lobibox-custom-class hide-close-icon',
							hideClass: 'Lobibox-custom-class-show',
							msg: `${response.message}`,
							delay: 1500,
							sound: false,
							position: 'center top',
							icon: `${response.icon}`
						});
						if (response.status == 'success') {
							setTimeout(() => {
								location.href = 'dashboard.php';
							}, 1500);
						} else {
							setTimeout(() => {
								$('#form-login')[0].reset();
								$('#username_email').focus();
							}, 1500);
						}
					}
				});
			});
		});
	</script>
</body>

</html>