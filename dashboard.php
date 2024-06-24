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

	<title>E - Recruitment</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="assets/images/logo-icon.png" class="logo-icon" width="30" height="25" alt="logo icon">
				</div>
				<div>
					<small class="logo-text">E - Recruitment</small>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-alt'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
					<ul>
						<li> <a href="index.html"><i class='bx bx-radio-circle'></i>Default</a>
						</li>
						<li> <a href="index2.html"><i class='bx bx-radio-circle'></i>Alternate</a>
						</li>
						<li> <a href="index3.html"><i class='bx bx-radio-circle'></i>Graphical</a>
						</li>
					</ul>
				</li>
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
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-menu"></i>
						</div>
						<div class="menu-title">Menu Levels</div>
					</a>
					<ul class="mm-collapse">
						<li> <a class="has-arrow" href="javascript:;"><i class="bx bx-radio-circle"></i>Level One</a>
							<ul class="mm-collapse">
								<li> <a class="has-arrow" href="javascript:;"><i class="bx bx-radio-circle"></i>Level Two</a>
									<ul class="mm-collapse">
										<li> <a href="javascript:;"><i class="bx bx-radio-circle"></i>Level Three</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
				</li>
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
				<?php if (isset($_GET['page'])) : ?>
					<?php include 'page/' . $page . '.php' ?>
				<?php else : ?>
					<div class="row">
						<div class="card radius-10">
							<div class="card-header">
								<div class="d-flex align-items-center">
									<div>
										<h6 class="mb-0">DASHBOARD</h6>
									</div>
									<div class="dropdown ms-auto">
										<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
										</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="javascript:;">Action</a>
											</li>
											<li><a class="dropdown-item" href="javascript:;">Another action</a>
											</li>
											<li>
												<hr class="dropdown-divider">
											</li>
											<li><a class="dropdown-item" href="javascript:;">Something else here</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="card-body">
								<?php
								echo '<pre>';
								print_r($menus);
								echo '</pre>';
								?>
								<center>
									<h1>Selamat Datang <br> di <br> E - Recruitment</h1>
								</center>
							</div>
						</div>
					</div>
				<?php endif; ?>
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
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
</body>

</html>