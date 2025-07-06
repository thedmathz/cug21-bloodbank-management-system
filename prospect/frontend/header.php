<!doctype html>
<html lang="en" >

	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
		<link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
		<link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
		<link href="../assets/css/pace.min.css" rel="stylesheet" />
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../assets/css/bootstrap-extended.css" rel="stylesheet" />
		<link href="../assets/css/app.css" rel="stylesheet" />
		<link href="../assets/css/icons.css" rel="stylesheet" />
		<link href="../assets/css/dark-theme.css" rel="stylesheet" />
		<link href="../assets/css/semi-dark.css" rel="stylesheet" />
		<link href="../assets/css/header-colors.css" rel="stylesheet" />
		<link href="../assets/css/modern-business.css" rel="stylesheet" />
		<link href="../assets/plugins/swal/sweetalert2.min.css" rel="stylesheet" />

		<title>Blood Bank | Prospects</title>
    <link rel="icon" href="../assets/images/logo-icon.png" type="image/png" />

		<script src="../assets/js/bootstrap.bundle.min.js"></script>
		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/js/pace.min.js"></script>

		<style>

			@font-face {
				font-family: 'Montserrat Bold';
  			src: url('../assets/fonts/montserrat/Montserrat-Bold.ttf');
			}

			@font-face {
				font-family: 'Montserrat SemiBold';
  			src: url('../assets/fonts/montserrat/Montserrat-SemiBold.ttf');
			}

			@font-face {
				font-family: 'Montserrat Normal';
  			src: url('../assets/fonts/montserrat/Montserrat-Regular.ttf');
			}

			body {
				font-family: Montserrat Normal;
			}

			.d_cancel {
				border: none;
				font-weight: bold;
				font-size: 35px;
				padding: 0;
				background: transparent;
				color: #f41127!important;
			}

			.d_mobile {
				margin-left: 3rem!important;
			}

			.d_mobile a {
				color: #fff;
				font-weight: bold;
			}

			.d_mobile ul a {
				color: #000;
			}

			.d_mobile a:hover {
				color: yellow;
			}

			.d_mobile ul a:hover {
				color: red;
			}

			@media screen and (max-width: 1280px) {
				.d_mobile {
					margin-left: 1rem!important;
				}
			}
				.navbar-toggler {
				z-index: 1;
			}
			
			@media (max-width: 576px) {
				nav > .container {
					width: 100%;
				}
			}

			.carousel-item.active, .carousel-item-next, .carousel-item-prev {
				display: block;
			}

			.active a {
				color: yellow;
			}

		</style>

	</head>

	<body>

		<div class="wrapper">

			<header>
				<div class="topbar d-flex align-items-center" style="background: red;">
					<nav class="navbar navbar-expand" style="font-size: 12px;">
						<div class="topbar-logo-header">
							<div class="">
								<img src="../assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
							</div>
							<div class="">
								<h4 class="logo-text text-white">Blood Bank</h4>
							</div>
						</div>
						<div style="flex: 1;"></div>
						<div class="d-flex align-items-center">
							<ul class="d-flex m-auto" style="text-decoration: none; list-style-type: none; padding: 0;">
								<li class="d_mobile <?php if ($module == 'home') echo 'active'; ?>" style="display: flex; align-items: center; white-space: nowrap;">
									<a href="home.php">Home</a>
								</li>
								<li class="d_mobile <?php if ($module == 'donate') echo 'active'; ?>" style="display: flex; align-items: center; white-space: nowrap;">
									<a href="donate_blood.php">Donate Blood</a>
								</li>
								<li class="d_mobile <?php if ($module == 'get') echo 'active'; ?>" style="display: flex; align-items: center; white-space: nowrap;">
									<a href="get_blood.php">Get Blood</a>
								</li>
								<li class="d_mobile" style="display: flex; align-items: center; white-space: nowrap;">

									<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret p-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>

									<ul class="dropdown-menu dropdown-menu-end">
										<li>
											<a class="dropdown-item" href="javascript:;" onclick="profile()"><i class="bx bx-user"></i><span>Profile</span></a>
										</li>
										<li>
											<a class="dropdown-item" href="javascript:;" onclick="qr_code()"><i class="bx bx-scan"></i><span>QR Code</span></a>
										</li>
										<li>
											<a class="dropdown-item" href="javascript:;" onclick="change_password()" ><i class="bx bx-lock"></i><span>Change Password</span></a>
										</li>
										<li>
											<a class="dropdown-item" href="javascript:;" onclick="feedback()"><i class="bx bx-message"></i><span>Feedback</span></a>
										</li>
										<li>
											<div class="dropdown-divider mb-0"></div>
										</li>
										<li><a class="dropdown-item" href="../includes/logout.php"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</header>

			<?php
			
			// header note
			$note 	= '';
			$query 	= "SELECT prospects.fname, prospects.lname FROM searches LEFT JOIN prospects ON searches.requested_by = prospects.prospect_id WHERE requested_to = '".$_SESSION['user']['prospect_id']."' AND searches.status = '0'";
			$result = mysqli_query($db, $query);
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					if ($note == '') {
						$note .= ucfirst($row['fname']).' '.$row['lname'];
					} else {
						$note .= ', '.ucfirst($row['fname']).' '.$row['lname'];
					}
				}
			}
			
			?>

			<div class="page-wrapper" style="margin-top: 0;">
        <div class="container">

					<div class="w-100" style="padding: 0 12px; margin-top: 10px;">

						<?php if ($note != '') { ?>
						<div class="w-100 text-black" style="padding: 3px 15px; background: #ffb0b0; border: 1px solid #ff8080;">
							<div><?php echo $note; ?> has <b>requested you to donate</b> them blood.</div>
						</div>
						<?php } ?>
					
						<?php if ($module == 'donate') { ?>
						<div class="w-100 text-black" style="padding: 3px 15px; margin-top: 8px; background: #37deff; border: 1px solid #0dcaf0;">
							<div>Note: You can select where to donate your blood after laboratory test.</div>
						</div>
						<?php } ?>

					</div>

          <div class="page-content">	
						