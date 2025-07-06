      </div>
		</div>
		<!--end page wrapper -->

		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->

		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Blood Bank and Donor Management System &copy; 2021</p>
		</footer>
	</div>

	<!-- MODAL -->
	<div class="modal fade" id="change_password_modal">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- username, lname, fname, gender, phone, user_type_id -->
		
				<div class="modal-header text-center">
					<h3 class="modal-title w-100 dark-grey-text font-weight-bold">CHANGE PASSWORD</h3>
					<button type="button" class="close d_cancel" data-bs-dismiss="modal" aria-lable="close">&times;</button>
				</div>

				<form id="d_form_change_password">
					<div class="modal-body mx-4">

						<div class="md-form">
							<label data-error="wrong" data-success="right">Username</label>
							<input type="text" class="form-control" value="<?php echo $_SESSION['user']['username']; ?>" readonly >
						</div>

						<div class="md-form">
							<label data-error="wrong" data-success="right">Enter New Password <span class="text-danger" >*</span></label>
							<input type="password" class="form-control" id="new_password" autocomplete="off" >
						</div>

						<div class="md-form">
							<label data-error="wrong" data-success="right">Re-enter New Password <span class="text-danger" >*</span></label>
							<input type="password" class="form-control" id="re_new_password" autocomplete="off" >
						</div>

						<div class="text-center mt-3">
							<button type="submit" class="btn btn-primary btn-block z-depth-1a">SUBMIT</button>
						</div>

					</div> 
				</form>

			</div>
		</div> 
	</div>

	<div id="d_img" class="d-none">
		<div class="d_img_bg">&nbsp;</div>
		<div class="d_contain">
			<div class="d_head" style="">
				<div>&times;</div>
			</div>
			<div class="d_body">
				<img src="../../assets/images/avatars/avatar.jpg" alt="Profile Picture">
			</div>
			<dib class="d_foot">Profile Picture</dib>
		</div>
	</div>

	<!--end wrapper-->
	<script src="../../assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="../../assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="../../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--app JS-->
	<script src="../../assets/js/app.js"></script>

	<script>

		const popupCenter = ({url, title, w, h}) => {
			// Fixes dual-screen position                             Most browsers      Firefox
			const dualScreenLeft = window.screenLeft !==  undefined ? window.screenLeft : window.screenX;
			const dualScreenTop = window.screenTop !==  undefined   ? window.screenTop  : window.screenY;

			const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
			const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

			const systemZoom = width / window.screen.availWidth;
			const left = (width - w) / 2 / systemZoom + dualScreenLeft
			const top = (height - h) / 2 / systemZoom + dualScreenTop
			const newWindow = window.open(url, title, 
				`
				scrollbars=yes,
				width=${w / systemZoom}, 
				height=${h / systemZoom}, 
				top=${top}, 
				left=${left}
				`
			)

			if (window.focus) newWindow.focus();
		}


		function change_password()
		{

			$('#change_password_modal').modal('show');

		}

		function view_pp(avatar)
		{

			$('#d_img .d_body img').prop('src', avatar);
			$('#d_img').removeClass('d-none');

		}

		$(document).on('click', '.d_head div', function() {
			$('#d_img').addClass('d-none');
		});

		$(document).ready(function() {

			$('#d_form_change_password').submit(function(e) {
				e.preventDefault();

				let new_password 		= $('#new_password').val();
				let re_new_password = $('#re_new_password').val();

				if (new_password == re_new_password && new_password != '') {
					$.ajax({
						url         : '../../includes/change_password.php', 
						type        : 'POST', 
						data        : {
							password : new_password
						}, 
						dataType    : 'JSON', 
						beforeSend  : function() {
							
						}
					}).done(function(res) {
						console.log('Done!');
						$('#change_password_modal').modal('hide');
						alert('Password Changed!');
					}).fail(function() {
						console.log('Fail!');
					});
				} else {
					alert("Invalid password!");
				}

			});

		});

	</script>

</body>

</html>