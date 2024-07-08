<?php
session_start();
if (!isset($_SESSION['is_login'])) {
	header('location: index.php');
	exit;
}

date_default_timezone_set('Asia/Jakarta');

require_once 'config/connection.php';
require_once 'config/functions.php';
require_once 'classes/DB.php';
require_once 'classes/Menu.php';

$func = new Functions();
?>
<!doctype html>
<html lang="en" class="color-header headercolor1">

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
	<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="assets/plugins/notifications/css/lobibox.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="assets/css/dark-theme.css" />
	<link rel="stylesheet" href="assets/css/semi-dark.css" />
	<link rel="stylesheet" href="assets/css/header-colors.css" />

	<!-- plugin javascript -->
	<script src="assets/js/jquery.min.js"></script>

	<title>E - Recruitment</title>

	<style>
		.active-breadcrumb {
			color: black !important;
		}

		.input-border-bottom {
			border: none;
			border-bottom: 1px solid #000;
			border-radius: 0;
			-webkit-appearance: none;
			-moz-appearance: none;
			text-indent: 1px;
			text-overflow: '';
		}
	</style>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">E-Recruitment</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<?php
				$menu = new Menu();
				$menus = $menu->read($_SESSION['user']['id_role']);
				?>
				<li class="<?= !isset($_GET['page']) ? 'mm-active' : '' ?>">
					<a href="dashboard.php">
						<div class="parent-icon"><i class='bx bx-layout'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li class="menu-label">Page</li>
				<?php foreach ($menus as $men) : ?>
					<?php if (isset($men['submenu'])) : ?>
						<li class="<?= isset($_GET['sub']) && $_GET['page'] == $men['direktori_head'] ? 'mm-active' : '' ?>">
							<a href="javascript:;" class="has-arrow">
								<div class="parent-icon"><i class="<?= $men['icon'] ?>"></i></div>
								<div class="menu-title"><?= ucwords($men['nama_menu']) ?></div>
							</a>
							<ul>
								<?php foreach ($men['submenu'] as $submenu) : ?>
									<li class="<?= isset($_GET['sub']) && $_GET['sub'] == $submenu['direktori'] && $_GET['page'] == $men['direktori_head'] ? 'mm-active' : '' ?>">
										<a href="?page=<?= $men['direktori_head'] ?>&sub=<?= $submenu['direktori'] ?>"><i class="bx bx-radio-circle"></i><?= ucwords($submenu['nama_submenu']) ?></a>
									</li>
								<?php endforeach; ?>
							</ul>
						</li>
					<?php else : ?>
						<li class="<?= isset($_GET['page']) && $_GET['page'] == $men['direktori'] ? 'mm-active' : '' ?>">
							<a href="?page=<?= $men['direktori'] ?>">
								<div class="parent-icon"><i class="<?= $men['icon'] ?>"></i>
								</div>
								<div class="menu-title"><?= ucwords($men['nama_menu']) ?></div>
							</a>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
				<li class="menu-label">Autentikasi</li>
				<li>
					<a href="javascript:;" onclick="logout()">
						<div class="parent-icon"><i class='bx bx-log-out-circle'></i>
						</div>
						<div class="menu-title">Log Out</div>
					</a>
				</li>
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand gap-3">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>

					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center gap-1">
							<li class="nav-item dropdown dropdown-app">
								<div class="dropdown-menu dropdown-menu-end p-0">
									<div class="app-container p-2 my-2"></div>
								</div>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<div class="dropdown-menu dropdown-menu-end">
									<div class="header-notifications-list">
									</div>
								</div>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<div class="dropdown-menu dropdown-menu-end">
									<div class="header-message-list"></div>
								</div>
							</li>
						</ul>
					</div>

					<div class="user-box dropdown px-3">
						<a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<?php if (is_null($_SESSION['user']['photo'])) : ?>
								<img src="assets/images/avatars/placeholder-image.png" class="user-img" alt="user avatar">
							<?php else : ?>
								<img src="myfiles/photo/<?= $_SESSION['user']['photo'] ?>" class="user-img" alt="user avatar">
							<?php endif; ?>
							<div class="user-info">
								<p class="user-name mb-0"><?= ucwords($_SESSION['user']['nama_user']) ?></p>
								<p class="designattion mb-0"><?= ucwords($_SESSION['user']['nama_role']) ?></p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;" onclick="logout()"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<?php
				$page = isset($_GET['page']) ? $_GET['page'] : '';
				$sub = isset($_GET['sub']) ? $_GET['sub'] : '';
				if ($page == '') {
					$main = 'page/main.php';
					if (!is_file($main)) {
						echo 'File not found!';
					} else {
						include $main;
					}
				} else {
					if ($sub == '') {
						$page = 'page/' . $page . '.php';
						if (!is_file($page)) {
							file_put_contents($page, 'File ' . $_GET['page']);
						} else {
							include $page;
						}
					} else {
						$folder = 'page/' . $page . '/';
						if (!is_dir($folder)) {
							mkdir($folder);
						}
						$sub = $folder . $sub . '.php';
						if (!is_file($sub)) {
							file_put_contents($sub, 'File ' . $_GET['sub']);
						} else {
							include $sub;
						}
					}
				}
				?>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" aria-hidden="true"></div>
		<!-- End Modal -->
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button-->
		<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright &copy; <?= date('Y') ?>. By Dita Mahameru.</p>
		</footer>
	</div>
	<!--end wrapper-->

	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!-- dataTable -->
	<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<!--notification js -->
	<script src="assets/plugins/notifications/js/sweetalert2@11.js"></script>
	<script src="assets/plugins/notifications/js/lobibox.min.js"></script>
	<script src="assets/plugins/notifications/js/notifications.min.js"></script>
	<!-- select2 -->
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
	<script>
		$(function() {
			$('[data-bs-toggle="tooltip"]').tooltip();
		})

		function logout() {
			Swal.fire({
				title: "Apakah Anda yakin?",
				text: "Anda akan keluar dari sistem!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Ya, Keluar!",
				cancelButtonText: "Batal"
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: 'classes/Authentication.php',
						type: 'POST',
						data: {
							action: 'logout'
						},
						success: function(response) {
							Swal.fire({
								title: "Berhasil!",
								text: "Anda berhasil keluar dari sistem!",
								icon: "success",
								showConfirmButton: false,
								timer: 1500
							}).then((e) => {
								if (e.dismiss === Swal.DismissReason.timer) {
									window.location.href = 'index.php';
								}
							})
						}
					});
				}
			});
		}
	</script>
</body>

</html>
