<!doctype html>
<html lang="en" class="semi-dark color-header headercolor3" >

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="../../assets/images/logo-icon.png" type="image/png" />
	<!--plugins-->
	<link href="../../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="../../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="../../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="../../assets/css/pace.min.css" rel="stylesheet" />
	<script src="../../assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="../../assets/css/app.css" rel="stylesheet">
	<link href="../../assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="../../assets/css/dark-theme.css" />
	<link rel="stylesheet" href="../../assets/css/semi-dark.css" />
	<link rel="stylesheet" href="../../assets/css/header-colors.css" />
	<!-- additionals -->
	<link rel="stylesheet" href="../../assets/css/daterangepicker.css" />

	<title>Blood Bank</title>

	<script src="../../assets/js/bootstrap.bundle.min.js"></script>
	<script src="../../assets/js/jquery.min.js"></script>
	<script src="../../assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
	<script src="../../assets/js/moment.min.js"></script>
	<script src="../../assets/js/daterangepicker.js"></script>

	<style>
		.d_cancel {
			border: none;
			font-weight: bold;
			font-size: 35px;
			padding: 0;
			background: transparent;
			color: #f41127!important;
		}
		#d_img {
			position: absolute; top: 0; bottom: 0; left: 0; right: 0; z-index: 999;
		}
		.d_img_bg {
			width: 100%; height: 100%; background: #000; opacity: 0.7;
		}
		.d_contain {
			position: absolute; top: 0; bottom: 0; left: 0; right: 0; z-index: 1000; color: #fff;
		}
		.d_contain .d_head {
			width: 100%;
			height: 50px;
			display: flex;
			align-items: center;
		}
		.d_contain .d_head div {
			margin-left: auto;
			margin-right: 16px;
			cursor: pointer;
			font-size: 35px;
		}
		.d_contain .d_body {
			height: calc(100% - 100px);
			display: flex; 
			justify-content: center; 
			align-items: center;
		}
		.d_contain .d_body img {
			max-width: 300px;
		}
		.d_contain .d_foot {
			height: 50px;
			display: flex; 
			justify-content: center; 
			align-items: center;
			font-size: 25px;
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
					<img src="../../assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Blood Bank</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li class="<?php if ($module == 'dashboard') echo 'mm-active'; ?>">
					<a href="../dashboard/list.php">
						<div class="parent-icon"><i class='bx bx-home'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li class="<?php if ($module == 'blood') echo 'mm-active'; ?>">
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-droplet'></i>
						</div>
						<div class="menu-title">Blood</div>
					</a>
					<ul>
						<li class="<?php if ($sub_module == 'stocks') echo 'mm-active'; ?>"> 
							<a href="../blood/list.php"><i class="bx bx-right-arrow-alt"></i>Stocks</a>
						</li>
						<li class="<?php if ($sub_module == 'requests') echo 'mm-active'; ?>">
							<a href="../blood/request.php"><i class="bx bx-right-arrow-alt"></i>Requests</a>
						</li>
					</ul>
				</li>
				<li class="<?php if ($module == 'prospect') echo 'mm-active'; ?>">
					<a href="../prospect/list.php">
						<div class="parent-icon"><i class='bx bx-face'></i>
						</div>
						<div class="menu-title">Prospects</div>
					</a>
				</li>
				<li class="<?php if ($module == 'feedback') echo 'mm-active'; ?>">
					<a href="../feedback/list.php">
						<div class="parent-icon"><i class='bx bx-comment-detail'></i>
						</div>
						<div class="menu-title">Feedbacks</div>
					</a>
				</li>
				<li class="<?php if ($module == 'user') echo 'mm-active'; ?>">
					<a href="../user/list.php">
						<div class="parent-icon"><i class='bx bx-user'></i>
						</div>
						<div class="menu-title">Users</div>
					</a>
				</li>
			</ul>

			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
					<div style="flex: 1;"></div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="../../assets/images/avatars/avatar.jpg" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0"><?php echo $_SESSION['user']['fname'].' '.$_SESSION['user']['lname']; ?></p>
								<p class="designattion mb-0"><?php echo $_SESSION['user']['ut_name']; ?></p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li>
								<a class="dropdown-item" href="javascript:;" onclick="change_password()" ><i class="bx bx-cog"></i><span>Change Password</span></a>
							</li>
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li>
								<a class="dropdown-item" href="../../includes/logout.php"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
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


						<!------Logout Modal ------->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"><?php echo  $_SESSION['fname']; ?> are you sure do you want to logout?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../../../prospect/includes/user_logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>


