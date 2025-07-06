<?php include('../includes/connection.php'); ?>
<?php include('index_header.php'); ?>

<style>
  .head {
    margin-top: 80px;
    font-weight: bold;
  }
  .head_button {
    border-radius: 50px; 
    font-weight: bold; 
    font-size: 25px; 
    padding-left: 30px; 
    padding-right: 30px; 
    margin-top: 50px; 
    margin-bottom: 30px;
  }
  .head2 {
    font-size: 28px;
  }
  @media only screen and (max-width: 600px) {
     .carousel-inner {
         height: 155px;
     }
    .head {
      margin-top: 20px;
    }
    .head2 {
      font-size: 20px;
    }
    .head_button {
      margin-top: 20px; 
      margin-bottom: 30px;
    }
    .aahem {
      margin-top: 0;
    }
    .d_button {
      flex-direction: column;
    }
    .d_button div {
      display: none;
    }
    .d_button button {
      margin: 0 0 10px !important;
    }
  }
</style>

<!-- content -->
<section>

  <h1 class="text-center" style="font-weight: bold; font-family: Montserrat Bold; font-size: 50px;">WELCOME</h1>

  <h5 class="text-center">Blood banking is the process that takes place in the lab to make sure that donated blood, or blood products, are safe before they are used in blood transfusions and other medical procedures.</h5>

  <div id="carouselExampleIndicators" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../assets/images/01.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="../assets/images/12.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="../assets/images/123.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <h6 class="text-center mt-3"><i>"The Blood you donate gives someone another chance at life."</i></h6>

  <div class="mt-3 d-flex d_button">
    <button class="btn btn-sm btn-raised btn-primary mb-2" onclick="open_login('donate')" style="white-space: nowrap; border-radius: 50px; padding: 4px 16px; font-size: 20px; margin-left: auto;">Donate Blood</button>
    <div>&nbsp;&nbsp;&nbsp;&nbsp;</div>
    <button class="btn btn-sm btn-raised btn-secondary mb-2" onclick="open_login('get')" style="white-space: nowrap; border-radius: 50px; padding: 4px 16px; font-size: 20px; margin-right: auto;">Search Blood</button>
  </div>

  <div class="row mt-3">
    <div class="mb-3 col-12 col-sm-9 mt-2">
      <h5>ABOUT US</h5>
      <p class="m-0 p-0"><b>Blood Bank and Donor Management System</b> is a web-based system that can collect blood and managing blood stocks, approving blood requests, updating donations and updating available blood types.</p>
    </div>
    <div class="mb-3 col-12 col-sm-3 mt-2">
      <h5>CONTACT US</h5>
      <p class="m-0 p-0"><b>BBDMS Admin</b></p>
      <p class="m-0 p-0">San Francisco, Agusan del Sur</p>
      <p class="m-0 p-0">+639516806621</p>
      <p class="m-0 p-0">bbdmssupport@gmail.com</p>
    </div>
  </div> 

</section>
<!-- /content -->

<!-- modals -->
<div class="modal fade" id="signinPage">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Sign In Your Account</h3>
        <button type="button" class="close d_cancel" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="d_login">
          <div class="modal-body mx-4">

            <div class="md-form mb-2">
              <span id="error1" style= "color: red;"></span>
            </div>
    
            <div class="md-form mb-2">
              <label data-error="wrong" data-success="right">Username/Phone</label>
              <input type="text" class="form-control" id="username">
            </div>
    
            <div class="md-form mb-4">
              <label data-error="wrong" data-success="right">Password</label>					
              <input type="password" class="form-control" id="password">
            </div>
                        
            <div class="text-center mb-3">
              <button type="submit" class="btn btn-secondary btn-block z-depth-1a" id="signinbtn">Sign In</button>
            </div>
    
          </div>
      </form>
      
    </div>
  </div> 
</div>

<?php

  $sql      = "SELECT DISTINCT province_id, name FROM provinces WHERE province_id = '22'";
  $result   = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

  $opt 	    = "";
  $opt      .= "<select class='form-control' name='reg_province_id' id='reg_province_id'>";
  $opt      .= 	"<option value = ''>Select Province</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $opt .= "<option value='".$row['province_id']."'>".$row['name']."</option>";
  }
  $opt      .= "</select>";

?>

<div class="modal fade" id="signupPage">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Register</h3>
        <button type="button" class="close d_cancel" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>
      
      <form id="d_register">
        <div class="modal-body mx-4">	
            <div class="md-form mb-2">
              <span id="error" style= "color: red;"></span>
            </div>		
            <div class="md-form mb-2">
              <label data-error="wrong" data-success="right">Username</label>
              <input type="text" class="form-control validate" name="reg_username" id= "reg_username">
            </div>
            <div class="md-form mb-2">
              <label data-error="wrong" data-success="right">Phone Number</label>
              <input type="number" class="form-control validate" name="reg_phone" id="reg_phone" >
            </div>
            <div class="md-form mb-2">
              <label data-error="wrong" data-success="right">Password</label>					
              <input type="password" class="form-control validate" name="reg_password" id= "reg_password" > 
            </div>	
            <div class="md-form mb-2">
              <label data-error="wrong" data-success="right">Retype Password</label>			
              <input type="password" class="form-control validate" name="reg_r_password" id="reg_r_password" >
            </div>
            <div class="md-form mb-2">
              <label data-error="wrong" data-success="right">First name</label>
              <input type="text" class="form-control validate" name="reg_fname"  id="reg_fname" >
            </div>
            <div class="md-form mb-2">
              <label data-error="wrong" data-success="right">Middle name</label>
              <input type="text" class="form-control validate" name="reg_mname"  id="reg_mname" >
            </div>
            <div class="md-form mb-2">
              <label data-error="wrong" data-success="right">Last name</label>
              <input type="text" class="form-control validate" name="reg_lname"  id="reg_lname" >
            </div>
            <div class="md-form mb-2">
              <label data-error="wrong" data-success="right">Gender</label>
              <select class="form-control" name="reg_gender" id="reg_gender"  >
                <option value="" disabled selected hidden>Select Gender</option>
                <option value="1">Male</option>
                <option value="2">Female</option>
              </select>
            </div>
            <div class="md-form mb-2">
              <label data-error="wrong" data-success="right">Birthdate</label>
              <input type="date" name="reg_bday" id="reg_bday" class="form-control"  >
            </div>
            <div class="md-form mb-2">
              <label data-error="wrong" data-success="right">Province</label>
              <?php echo $opt;?>
            </div>
            <div class="md-form mb-2">
              <label data-error="wrong" data-success="right" >City</label>
              <select class="form-control" id="reg_city_id" placeholder="City" name="reg_city_id" >
                <option value="">&nbsp;</option>
              </select>
            </div>
            <div class="md-form mb-3">
              <label data-error="wrong" data-success="right">Barangay</label>
              <select class="form-control" id="reg_barangay_id" placeholder="Branagay" name="reg_barangay_id" >
                <option value="">&nbsp;</option>
              </select>
            </div>
    
            <div class="text-center mb-3">
              <button class="btn btn-secondary btn-block z-depth-1a" type="submit" id= "signupbtn">Sign Up</button>
            </div>    
    
          </div> 
      </form>

      
      
    </div>
  </div> 
</div>

<!-- /modals -->

<script>

    let d_path = '';

    $(document).on('submit', '#d_login', function(e) {
        e.preventDefault();
        login(); 
    });
    
    $(document).on('submit', '#d_register', function(e) {
        e.preventDefault();
        register(); 
    });

  function open_login(path = '')
  {

    if (path == 'donate') {
        d_path = 'donate';
    } else if (path == 'get') {
        d_path = 'get';
    } else {
        d_path = '';
    }

    $('#signinPage').modal('show');
    $('#signinPage').on('shown.bs.modal', function (e) {
      $('#username').focus();
    })

  }

  function login()
  {

    let n_path    = d_path;
    let username = $('#username').val();
    let password = $('#password').val();

    if (username == '') {
      alert('Username required!');
    } else if (password =='') {
      alert('Password required!');
    } else {
      $.ajax({
        url         : '../includes/login.php',
        type        : 'POST',
        data        : {
          username  : username, 
          password  : password
        },
        dataType    : 'JSON',
        beforeSend  : function() {

        }
      }).done(function(res) {
        if (res.res_success == '1') {
            if (n_path == 'donate') {
                window.location.href = 'donate_blood.php';
            } else if (n_path == 'get') {
                window.location.href = 'get_blood.php';
            } else {
                window.location.href = 'home.php';   
            }
        } else {
          alert(res.res_message);
        }
      });
    }

  }

  function open_register()
  {

    $('#signupPage').modal('show');
    $('#signupPage').on('shown.bs.modal', function (e) {
      $('#user2').focus();
    })

  }

  function register()
  {

    let username      = $('#reg_username').val();
    let phone         = $('#reg_phone').val();
    let password      = $('#reg_password').val();
    let r_password    = $('#reg_r_password').val();
    let fname         = $('#reg_fname').val();
    let mname         = $('#reg_mname').val();
    let lname         = $('#reg_lname').val();
    let gender        = $('#reg_gender').val();
    let bday          = $('#reg_bday').val();
    let province_id   = $('#reg_province_id').val();
    let city_id       = $('#reg_city_id').val();
    let barangay_id   = $('#reg_barangay_id').val();

    let errors  = new Array();
    let error   = '';

    if (username == '') {
      errors.push('Username');
    }
    if (phone == '') {
      errors.push('Phone');
    }
    if (password == '') {
      errors.push('Password');
    }
    if (fname == '') {
      errors.push('First Name');
    }
    if (mname == '') {
      errors.push('Middle Name');
    }
    if (lname == '') {
      errors.push('Last Name');
    }
    if (gender == '') {
      errors.push('Gender');
    }
    if (bday == '') {
      errors.push('Birthday');
    }
    if (province_id == '') {
      errors.push('Province');
    }
    if (city_id == '') {
      errors.push('City');
    }
    if (barangay_id == '') {
      errors.push('Barangay');
    }

    if (errors.length > 0) {
      $.each(errors, function(key, value) {
        if (error == '') {
          error += 'Required Fields: \n\n- '+value;
        } else {
          error += '\n- '+value;
        }
      });
    }

    if (error != '') {
      alert(error);
    } else if (phone.length != 11) {
      alert('Phone needs to be 11 digit!');
    } else if (password != r_password) {
      alert('Password does not match!');
    } else {
      $.ajax({
        url         : '../includes/register.php',
        type        : 'POST',
        data        : {
          username  : username, 
          phone  : phone, 
          password  : password, 
          r_password  : r_password, 
          fname  : fname, 
          mname  : mname, 
          lname  : lname, 
          gender  : gender, 
          bday  : bday, 
          province_id  : province_id, 
          city_id  : city_id, 
          barangay_id  : barangay_id
        },
        dataType    : 'JSON',
        beforeSend  : function() {

        }
      }).done(function(res) {
        if (res.res_success == '1') {
          window.location.href = 'home.php';
        } else {
          alert(res.res_message);
        }
      });
    }

  }

  $(document).ready(function(){

    $('#reg_province_id').on('change', function(){
      let selectedProvince = $("#reg_province_id option:selected").val();
      $.ajax({
        type			: "POST",
        url				: "../includes/city.php",	
        dataType	: 'html',
        data			: { province_id : selectedProvince }
      }).done(function(data){
        $('#reg_city_id').html(data);
      });
    });

    $('#reg_city_id').on('change', function(){
      let selectedCity = $("#reg_city_id option:selected").val();
      $.ajax({
        type			: "POST",
        url				: "../includes/barangay.php",	
        dataType	: 'html',
        data			: { city_id: selectedCity }
      }).done(function(response){
        $('#reg_barangay_id').html(response);
      });
    });

  });

</script>

<?php include('index_footer.php'); ?>