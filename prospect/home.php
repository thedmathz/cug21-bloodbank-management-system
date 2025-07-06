<?php include('includes/connection.php'); ?>

<!doctype html>
<html lang="en" >

	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="icon" href="assets/images/logo-icon.png" type="image/png" />
		<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
		<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
		<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
		<link href="assets/css/pace.min.css" rel="stylesheet" />
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/bootstrap-extended.css" rel="stylesheet" />
		<link href="assets/css/app.css" rel="stylesheet" />
		<link href="assets/css/icons.css" rel="stylesheet" />
		<link href="assets/css/dark-theme.css" rel="stylesheet" />
		<link href="assets/css/semi-dark.css" rel="stylesheet" />
		<link href="assets/css/header-colors.css" rel="stylesheet" />
		<link href="assets/css/modern-business.css" rel="stylesheet" />

		<title>Blood Bank | Prospects</title>

		<script src="assets/js/pace.min.js"></script>

		<style>

			.d_mobile {
				margin-left: 3rem!important;
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

		</style>

	</head>

	<body>
		<div class="wrapper">

			<header>
				<div class="topbar d-flex align-items-center">
					<nav class="navbar navbar-expand">
						<div class="topbar-logo-header">
							<div class="">
								<img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
							</div>
							<div class="">
								<h4 class="logo-text">Blood Bank</h4>
							</div>
						</div>
						<div style="flex: 1;"></div>
						<div class="d-flex align-items-center">
							<ul class="d-flex m-auto" style="text-decoration: none; list-style-type: none;">
								<li class="d_mobile" style="display: flex; align-items: center; white-space: nowrap;">
									<a href="">Home</a>
								</li>
								<li class="d_mobile" style="display: flex; align-items: center; white-space: nowrap;">
									<a href="#signinPage" data-bs-toggle= "modal">Log In</a>
								</li>
								<li class="d_mobile" style="display: flex; align-items: center; white-space: nowrap;">
									<a href="#signupPage" data-bs-toggle= "modal">Create an Account</a>
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</header>

			<?php include('includes/slider.php');?>

			<div class="page-wrapper">
				<div class="page-content">			
					<div class="row">
						<?php include('includes/body_content.php');?>
					</div>
				</div>
				<div class="overlay toggle-icon"></div>
				<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
				<footer class="page-footer">
					<p class="mb-0">Blood Bank and Donor Management System &copy; 2021</p>
				</footer>
			</div>
			
		</div>

		<div class="modal fade" id="signinPage">
			<div class="modal-dialog">
				<div class="modal-content">
				
					<div class="modal-header text-center">
						<h3 class="modal-title w-100 dark-grey-text font-weight-bold">Sign In Your Account</h3>
						<button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
					</div>

					<form id="form1" method="post">
						<div class="modal-body mx-4">
							<div class="md-form mb-2">
								<span id="error1" style= "color: red;"></span>
							</div>				
							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">Username/Phone</label>
								<input type="text" class="form-control validate" name="user1" required>
							</div>

							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">Password</label>					
								<input type="password" class="form-control validate" name="pass1" required>
							</div>
													
							<div class="text-center mb-3">
								<button type="submit" class="btn btn-secondary btn-block z-depth-1a" name= "signinbtn" id="signinbtn">Sign In</button>
							</div>       
						</div>
					</form>
					
				</div>
			</div> 
		</div>
					
		<?php

			$sql 		= "SELECT DISTINCT province_id, name FROM provinces";
			$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

			$opt 	= "";
			$opt .= "<select class='form-control' name='province' id='province1'>";
			$opt .= 	"<option value = ''>Select Province</option>";
			while ($row = mysqli_fetch_assoc($result)) {
				$opt .= "<option value='".$row['province_id']."'>".$row['name']."</option>";
			}
			$opt .= "</select>";

		?>

		<div class="modal fade" id="signupPage">
			<div class="modal-dialog">
				<div class="modal-content">
				
					<div class="modal-header text-center">
						<h3 class="modal-title w-100 dark-grey-text font-weight-bold">Register</h3>
						<button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
					</div>

					<div class="modal-body mx-4">	
						<form id="form2" method="post">
							<div class="md-form mb-2">
								<span id="error" style= "color: red;"></span>
							</div>		
							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">Username</label>
								<input type="text" class="form-control validate" name="user2" id= "user2"required>
							</div>
							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">Phone Number</label>
								<input type="number" class="form-control validate" name="phone" id="phone" required>
							</div>
							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">Password</label>					
								<input type="password" class="form-control validate" name="pass2" id= "pass2" required> 
							</div>	
							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">Retype Password</label>			
								<input type="password" class="form-control validate" name="repass" id="repass" required>
							</div>
							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">First name</label>
								<input type="text" class="form-control validate" name="fname"  id="fname" required>
							</div>
							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">Middle name</label>
								<input type="text" class="form-control validate" name="mname"  id="mnane" required>
							</div>
							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">Last name</label>
								<input type="text" class="form-control validate" name="lname"  id="lname"  required>
							</div>
							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">Gender</label>
								<select class='form-control' name='gender' id="gender"  required>
									<option value="" disabled selected hidden>Select Gender</option>
									<option value="1">Male</option>
									<option value="2">Female</option>
								</select>
							</div>
							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">Birthdate</label>
								<input type="date" name="bday" id="bday" class="form-control"  required>
							</div>
							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">Province</label>
								<?php echo $opt;?>
							</div>
							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right" >City</label>
								<select class="form-control" id="city1" placeholder="City" name="city" required></select>
							</div>
							<div class="md-form mb-3">
								<label data-error="wrong" data-success="right">Barangay</label>
								<select class="form-control" id="barangay1" placeholder="Branagay" name="barangay" required></select>
							</div>

							<div class="text-center mb-3">
								<button type="submit" class="btn btn-secondary btn-block z-depth-1a" name= "signupbtn" id= "signupbtn">Sign Up</button>
							</div>    

						</form>
					</div> 
					
				</div>
			</div> 
		</div>

		<script src="assets/js/bootstrap.bundle.min.js"></script>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
		<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
		<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
		<script src="assets/js/app.js"></script>
		<script src="assets/js/city.js"></script>
		<script src="assets/js/sweetalert.min.js"></script>

		<script>

			$(document).ready(function(){

				$('#province1').on('change', function(){
					let selectedProvince = $("#province1 option:selected").val();
					$.ajax({
						type			: "POST",
						url				: "./includes/city.php",	
						dataType	: 'html',
						data			: { province_id : selectedProvince }
					}).done(function(data){
						$('#city1').html(data);
					});
				});

				$('#city1').on('change', function(){
					let selectedCity = $("#city1 option:selected").val();
					$.ajax({
						type			: "POST",
						url				: "./includes/barangay.php",	
						dataType	: 'html',
						data			: { city_id: selectedCity }
					}).done(function(response){
						$('#barangay1').html(response);
					});
				});

				$('#signupbtn').on("click", function(e){
					e.preventDefault();
					$.ajax({
						type: "POST",
						url: "includes/user_signup.php",
						dataType  : 'JSON',
						data: $('#form2').serialize(),
					}).done(function(response) {               
						if (response.res_success == 1) {
							swal('You account has been created succesfully!', '', 'success');
							window.location = 'home.php';
						} else {
							console.log(response.res_message);
							$('#error').text(response.res_message[0]);
						}            
					})	
				});

				$('#signinbtn').on("click", function(e){
					e.preventDefault();
					$.ajax({
						type: "POST",
						url: "includes/user_signin.php",
						dataType  : 'JSON',
						data: $('#form1').serialize(),
					}).done(function(response) {               
						if (response.res_success == 1) {
							window.location = '../admin/modules/dashboard/list.php';
						} else {
							console.log(response.res_message);
							$('#error1').text(response.res_message[0]);
						}            
					})	
				});

			});

		</script>

	</body>

</html>