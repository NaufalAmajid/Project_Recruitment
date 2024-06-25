<?php
date_default_timezone_set('Asia/Jakarta');

require_once 'config/connection.php';
require_once 'config/functions.php';
require_once 'classes/DB.php';
require_once 'classes/Menu.php';
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
				$menus = $menu->read(1);
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
					<a href="javascript:;">
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
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" data-bs-toggle="dropdown"><span class="alert-count">7</span>
									<i class="bx bx-bell"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a href="javascript:;">
										<div class="msg-header">
											<p class="msg-header-title">Notifications</p>
											<p class="msg-header-badge">8 New</p>
										</div>
									</a>
									<div class="header-notifications-list ps">
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-1.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Daisy Anderson<span class="msg-time float-end">5 sec
															ago</span></h6>
													<p class="msg-info">The standard chunk of lorem</p>
												</div>
											</div>
										</a>
										<div class="ps__rail-x" style="left: 0px; bottom: 0px;">
											<div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
										</div>
										<div class="ps__rail-y" style="top: 0px; right: 0px;">
											<div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
										</div>
									</div>
									<a href="javascript:;">
										<div class="text-center msg-footer">
											<button class="btn btn-primary w-100">View All Notifications</button>
										</div>
									</a>
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
							<img src="assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar">
							<div class="user-info">
								<p class="user-name mb-0">Dita Mahameru</p>
								<p class="designattion mb-0">Human Resource Development (HRD)</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
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
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button-->
		<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright &copy; <?= date('Y') ?>. By NaufalAmajid.</p>
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
	<script src="assets/plugins/notifications/js/lobibox.min.js"></script>
	<script src="assets/plugins/notifications/js/notifications.min.js"></script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
</body>

</html>