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

			.d_mobile a:hover {
				color: yellow;
			}

			@media screen and (max-width: 1280px) {
				.d_mobile {
					margin-left: 1rem!important;
				}
			}
				.navbar-toggler {
				z-index: 1;
			}

			@media (max-width: 800px) {
				#carouselExampleIndicators {
					height: 360px;
				}
			}
			
			@media (max-width: 576px) {
				nav > .container {
					width: 100%;
				}
				#carouselExampleIndicators {
					height: 160px;
				}
			}

			.carousel-item.active, .carousel-item-next, .carousel-item-prev {
				display: block;
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
							<ul class="d-flex m-auto" style="text-decoration: none; list-style-type: none;">
								<li class="d_mobile" style="display: flex; align-items: center; white-space: nowrap;">
									<a href="">Home</a>
								</li>
								<li class="d_mobile" style="display: flex; align-items: center; white-space: nowrap;">
									<a href="#" onclick="open_login()">Log In</a>
								</li>
								<li class="d_mobile" style="display: flex; align-items: center; white-space: nowrap;">
									<a href="#" onclick= "open_register()">Sign Up</a>
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</header>

			<div class="page-wrapper" style="margin-top: 0;">
        <div class="container">
          <div class="page-content">		