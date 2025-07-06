<!DOCTYPE html>
<html lang="en">
<head>

	<title>BB Admin | Login</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/png" href="assets/images/logo-icon.png"/>

	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-40 p-r-40 p-t-45 p-b-45" style="overflow: hidden;">
				<div style="position: absolute; z-index: 0; top: 0; left: 0; right: 0; background: #e10a1f; color: white; height: 110px;">
					&nbsp;
				</div>
				<form id="form" class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title p-b-32 text-center" style="z-index: 5; color: #fff; padding-bottom: 60px;">
						Admin Login
					</span>

					<span class="txt1 p-b-11">
						Username
					</span>
					<div class="wrap-input100 validate-input m-b-20" data-validate = "Username is required">
						<input class="input100" type="text" name="username" id="username" >
						<span class="focus-input100"></span>
					</div>
					
					<span class="txt1 p-b-11">
						Password
					</span>
					<div class="wrap-input100 validate-input m-b-32" data-validate = "Password is required">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input class="input100" type="password" name="password" id="password" autocomplete="off" >
						<span class="focus-input100"></span>
					</div>
					
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn w-100" >Login</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>

	<script>

		function authenticate() 
		{

			let username = $('#username').val();
			let password = $('#password').val();

			if (username == '') {
				alert('Enter Username!');
			} else if (password == '') {
				alert('Enter Password!');
			} else {
				$.ajax({
					url 				: 'includes/login.php',
					type 				: 'POST',
					data 				: {
						username 	: username, 
						password 	: password
					},
					dataType 		: 'JSON',
					beforeSend 	: function() {

					}
				}).done(function(res) {
					console.log(res);

					if (res.res_success == 1) {
						window.location.href = 'modules/dashboard/list.php';
					} else {
						alert(res.res_message)
					}

				}).fail(function() {
					console.log('Fail!');
				});
			}

		}

		$(document).ready(function() {

			// auto run
			$('#username').focus();

			// form submit
			$('#form').submit(function(e) {
				e.preventDefault();
				authenticate()
			});

		});

	</script>

</body>
</html>