            </div>
          </div>  
        </div>
				<div class="overlay toggle-icon"></div>
				<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
				<footer class="page-footer">
					<p class="mb-0">Blood Bank and Donor Management System &copy; 2021</p>
				</footer>
			</div>
			
		</div>

		<!-- Modals -->

		<div class="modal fade" id="profileModal">
			<div class="modal-dialog">
				<div class="modal-content">
				
					<div class="modal-header text-center">
						<h3 class="modal-title w-100 dark-grey-text font-weight-bold">Profile</h3>
						<button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
					</div>

					<div class="modal-body mx-4">

						<div class="md-form mb-2">
							<span id="error1" style= "color: red;"></span>
						</div>

						<form id="profile_form" action="post">

							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">Username</label>
								<input type="text" class="form-control" name="username" id="username" required readonly >
							</div>

							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">Phone</label>					
								<input type="text" class="form-control" name="phone" id="phone" required>
							</div>

							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">First Name</label>					
								<input type="text" class="form-control" name="fname" id="fname" required>
							</div>

							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">Middle Name</label>					
								<input type="text" class="form-control" name="mname" id="mname" required>
							</div>

							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">Last Name</label>					
								<input type="text" class="form-control" name="lname" id="lname" required>
							</div>

							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">Gender</label>					
								<select name="gender" id="gender" class="form-control" required>
									<option value="">Select Gender</option>
								</select>
							</div>

							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">Birthday</label>					
								<input type="date" class="form-control" name="bday" id="bday" required>
							</div>

							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">Province</label>					
								<select name="province_id" id="province_id" class="form-control" required >
									<option value="">Select Province</option>
								</select>
							</div>

							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">City</label>				
								<select name="city_id" id="city_id" class="form-control" required >
									<option value="">&nbsp;</option>
								</select>	
							</div>

							<div class="md-form mb-2">
								<label data-error="wrong" data-success="right">Barangay</label>					
								<select name="barangay_id" id="barangay_id" class="form-control" required >
									<option value="">&nbsp;</option>
								</select>	
							</div>

							<div class="md-form mb-4">
								<label data-error="wrong" data-success="right">Profile Picture</label>					
								<input type="file" class="form-control" name="file_ext" id="file_ext" accept="image/*" >
							</div>

							<div class="text-center mb-3">
								<button type="submit" class="btn btn-secondary btn-block z-depth-1a" id="signinbtn">Submit</button>
							</div>

						</form>
												
					</div>
					
				</div>
			</div> 
		</div>

		<div class="modal fade" id="change_passwordModal">
			<div class="modal-dialog">
				<div class="modal-content">
				
					<div class="modal-header text-center">
						<h3 class="modal-title w-100 dark-grey-text font-weight-bold">Change Password</h3>
						<button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
					</div>

					<div class="modal-body mx-4">

						<div class="md-form mb-2">
							<label data-error="wrong" data-success="right">Current Password</label>					
							<input type="password" class="form-control" id="cur_password">
						</div>

						<div class="md-form mb-2">
							<label data-error="wrong" data-success="right">New Password</label>					
							<input type="password" class="form-control" id="new_password">
						</div>

						<div class="md-form mb-4">
							<label data-error="wrong" data-success="right">Re-enter New Password</label>					
							<input type="password" class="form-control" id="r_new_password">
						</div>
												
						<div class="text-center mb-3">
							<button class="btn btn-secondary btn-block z-depth-1a" onclick= "submit_change_password()" id="signinbtn">Submit</button>
						</div>

					</div>
					
				</div>
			</div> 
		</div>

		<div class="modal fade" id="feedbackModal">
			<div class="modal-dialog">
				<div class="modal-content">
				
					<div class="modal-header text-center">
						<h3 class="modal-title w-100 dark-grey-text font-weight-bold">Feedback</h3>
						<button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
					</div>

					<div class="modal-body mx-4">

						<div class="md-form mb-2">
							<span id="error1" style= "color: red;"></span>
						</div>

						<div class="md-form mb-2">
							<label data-error="wrong" data-success="right"><b>Feedback Message: </b></label>
							<textarea class="w-100" id="feedback" cols="30" rows="10" placeholder="Message..." ></textarea>
						</div>

						<div class="text-center mb-3">
							<button class="btn btn-secondary btn-block z-depth-1a" onclick= "submit_feedback()" id="signinbtn">Submit</button>
						</div>

					</div>
					
				</div>
			</div> 
		</div>

		<!-- /Modals -->

		<script src="../assets/plugins/simplebar/js/simplebar.min.js"></script>
		<script src="../assets/plugins/metismenu/js/metisMenu.min.js"></script>
		<script src="../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
		<script src="../assets/js/app.js"></script>
		<script src="../assets/js/city.js"></script>
		<script src="../assets/plugins/swal/sweetalert2.min.js"></script>
		<script src="../assets/js/qrcode.min.js"></script>

		<script>

			function profile()
			{

				$('#profileModal').modal('show');

			}

			$(document).on('submit', '#profile_form', function(e) {
				e.preventDefault();
				alert('dsa');
			});

			function qr_code()
			{

				Swal.fire({
					title: 'Code',
					html: '<div class="w-100 d-flex justify-content-center align-items-center"><div id="qrcode"></div></div>',
					showConfirmButton: false,
					showCancelButton: true,
					didOpen: () => {
						var qrcode = new QRCode("qrcode", {
							text    : "",
							width   : 200,
							height  : 200
						});
						qrcode.clear(); // clear the code.
						qrcode.makeCode("http://localhost/projects/school_thesis/bloodbank_and_donor_management_system/appointment_checker/check.php?prospect_id="+'<?php echo $_SESSION['user']['prospect_id']; ?>'); // make another code.
					},
				});

			}

			function change_password()
			{

				$('#change_passwordModal').modal('show');

				setTimeout(() => {
					$('#cur_password').focus();
				}, 500);

			}

			function submit_change_password()
			{

				let cur_password 		= $('#cur_password').val();
				let new_password 		= $('#new_password').val();
				let r_new_password 	= $('#r_new_password').val();

				if (cur_password == '') {
					alert('Please enter current password!');
				} else if (new_password == '' || r_new_password == '') {
					alert('Please enter new password!');
				} else if (new_password != r_new_password) {
					alert('New password does not match!');
				} else {
					$.ajax({
						url 				: '../includes/change_password.php',
						type 				: 'POST',
						data 				: {
							cur_password : cur_password,
							new_password : new_password
						},
						dataType 		: 'JSON',
						beforeSend 	: function() {

						}
					}).done(function(res) {
						if (res.res_success == '1') {
							$('#cur_password').val('');
							$('#new_password').val('');
							$('#r_new_password').val('');
							$('#change_passwordModal').modal('hide');
							alert('Password changed!');
						} else {
							alert(res.res_message);
						}
					});
				}

			}

			function feedback()
			{

				$('#feedbackModal').modal('show');

			}

			function submit_feedback()
			{

				$.ajax({
					url 				: '../includes/feedback.php',
					type 				: 'POST',
					data 				: {feedback:$('#feedback').val()},
					dataType 		: 'JSON',
					beforeSend 	: function() {}
				}).done(function(res) {
					$('#feedback').val("");
					$('#feedbackModal').modal('hide');
					alert('Feedback Submitted!');
				});

			}

		</script>

	</body>

</html>