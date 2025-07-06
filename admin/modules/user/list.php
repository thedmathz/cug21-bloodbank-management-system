<?php 
$icon       = 'user';
$module 		= 'user';
$sub_module = '';
require_once '../../includes/modules/user/list.php'; 
require_once '../../includes/check_session.php'; 
require_once '../../header.php'; 
?>

<!-- content code start here -->

<h5 class="d-flex" style="margin-bottom: 15px;">
  <i class="<?php echo $icon; ?>" style="margin-right: 8px;"></i> <?php echo ucfirst($module); ?>s<?php if ($sub_module) echo ' <i class="bx bx-right-arrow-alt"></i> '.ucfirst(implode(' ', explode('_', $sub_module))); ?>
  <div style="flex: 1;"></div>
  <?php if ($_SESSION['user']['user_type_id'] == '1') { ?>
    <button class="btn btn-sm btn-rasied btn-primary" onclick="list_add()" >Add User</button>
  <?php } ?>
</h5>

<div class="card radius-10">
	<div class="card-body">
		<div class="table-responsive">
      <form action="list.php" method="post">
        <table class="table align-middle mb-0">

          <thead class="table-light">

            <tr>
              <th class="text-center">Username</th>
              <th class="text-start">Last Name</th>
              <th class="text-start">First Name</th>
              <th class="text-center">Gender</th>
              <th class="text-center">Phone</th>
              <th class="text-center">Type</th>
              <th class="text-center">Status</th>
              <th class="text-center">Action</th>
            </tr>

            <tr style="display: none;">
              <th>
                <input type="text" class="form-control" name="f_username" value="<?php echo $f_username; ?>" placeholder="Username">
              </th>
              <th>
                <input type="text" class="form-control" name="f_lname" value="<?php echo $f_lname; ?>" placeholder="Last Name">
              </th>
              <th>
                <input type="text" class="form-control" name="f_fname" value="<?php echo $f_fname; ?>" placeholder="First Name">
              </th>
              <th>
                <select name="f_gender" class="form-control" onchange="$('#submit').click()" >
                  <option value="">&nbsp;</option>
                  <option value="1" <?php if ($f_gender == '1') echo 'selected'; ?> >Male</option>
                  <option value="0" <?php if ($f_gender == '0') echo 'selected'; ?> >Female</option>
                </select>
              </th>
              <th>
                <input type="text" class="form-control" name="f_phone" value="<?php echo $f_phone; ?>" placeholder="Phone">
              </th>
              <th>
                <select name="f_user_type_id" class="form-control" onchange="$('#submit').click()" >
                  <option value="">&nbsp;</option>
                  <?php foreach ($user_types as $ut) { ?>
                    <option value="<?php echo $ut['user_type_id']; ?>" <?php if ($f_user_type_id == $ut['user_type_id']) echo 'selected'; ?> ><?php echo $ut['name']; ?></option>
                  <?php } ?>
                </select>
              </th>
              <th></th>
            </tr>

          </thead>

          <tbody>

            <?php
            if ($users) {
              foreach ($users as $user) {
                ?>

                <tr class="text-center">
                  <td class="text-center"><?php echo $user['username']; ?></td>
                  <td class="text-start"><?php echo $user['lname']; ?></td>
                  <td class="text-start"><?php echo $user['fname']; ?></td>
                  <td class="text-center"><?php echo $user['gender']; ?></td>
                  <td class="text-center"><?php echo $user['phone']; ?></td>
                  <td class="text-center"><?php echo $user['type']; ?></td>
                  <td class="text-center"><?php echo $user['is_active']; ?></td>
                  <td class="text-center">
                    <?php if ($_SESSION['user']['user_type_id'] == '1') { ?>
                      <div class="d-flex justify-content-center order-actions">	
                        <a href="javascript:;" title="Edit User" class="text-white bg-info" onclick="list_edit('<?php echo $user['user_id']; ?>')">
                          <i class="bx bx-edit"></i>
                        </a>
                        <a href="javascript:;" title="Change Password User" class="text-white bg-warning ms-2" onclick="list_changepassword('<?php echo $user['user_id']; ?>', '<?php echo $user['username']; ?>')" >
                          <i class="bx bx-key"></i>
                        </a>
                      </div>
                    <?php } else { ?>
                      -
                    <?php } ?>
                  </td>
                </tr>
                
                <?php
              }
            } else {
              ?>

              <tr class="text-center">
                <td class="text-center text-danger" colspan="8">No Record Found</td>
              </tr>

              <?php
            }
            ?>

          </tbody>

        </table>
      </form>
		</div>
	</div>
</div>

<!-- ============== MODALS ============== -->
<div class="modal fade" id="list_add_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- username, lname, fname, gender, phone, user_type_id -->
  
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Add New User</h3>
        <button type="button" class="close d_cancel" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="d_form_insert">
        <div class="modal-body mx-4">

          <div class="md-form">
            <label data-error="wrong" data-success="right">Username <span class="text-danger" >*</span></label>
            <input type="text" class="form-control validate" id="add_username" >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Last Name <span class="text-danger" >*</span></label>
            <input type="text" class="form-control validate" id="add_lname" >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">First Name <span class="text-danger" >*</span></label>
            <input type="text" class="form-control validate" id="add_fname" >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Gender <span class="text-danger" >*</span></label>
            <select class='form-control' id="add_gender">
              <option value="" selected hidden>- Select Gender</option>
              <option value="1">Male</option>
              <option value="0">Female</option>
            </select>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Phone</label>
            <input type="text" class="form-control validate" id="add_phone">
          </div>
          
          <div class="md-form">
            <label data-error="wrong" data-success="right">User Type <span class="text-danger" >*</span></label>
            <select class='form-control' id="add_user_type_id">
              <option value="" selected hidden>Select User Type</option>
            </select>
          </div>

          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_add">SUBMIT</button>
          </div>

        </div> 
      </form>

    </div>
  </div> 
</div>

<div class="modal fade" id="list_edit_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- username, lname, fname, gender, phone, user_type_id -->
  
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Edit User</h3>
        <button type="button" class="close d_cancel" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="d_form_update">
        <div class="modal-body mx-4">

          <input type="hidden" id="edit_user_id" value="" readonly >

          <div class="md-form">
            <label data-error="wrong" data-success="right">Username <span class="text-danger" >*</span></label>
            <input type="text" class="form-control validate" id="edit_username" readonly >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Last Name <span class="text-danger" >*</span></label>
            <input type="text" class="form-control validate" id="edit_lname" >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">First Name <span class="text-danger" >*</span></label>
            <input type="text" class="form-control validate" id="edit_fname" >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Gender <span class="text-danger" >*</span></label>
            <select class='form-control' id="edit_gender">
              <option value="" selected hidden>- Select Gender</option>
              <option value="1">Male</option>
              <option value="0">Female</option>
            </select>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Phone</label>
            <input type="text" class="form-control validate" id="edit_phone">
          </div>
          
          <div class="md-form">
            <label data-error="wrong" data-success="right">User Type <span class="text-danger" >*</span></label>
            <select class='form-control' id="edit_user_type_id">
              <option value="" selected hidden>- Select User Type</option>
            </select>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Status <span class="text-danger" >*</span></label>
            <select class='form-control' id="edit_status">
              <option value="" selected hidden>Select Status</option>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>

          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_edit">SUBMIT</button>
          </div>

        </div> 
      </form>

    </div>
  </div> 
</div>

<div class="modal fade" id="list_changepassword_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- username, lname, fname, gender, phone, user_type_id -->
  
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Change Password</h3>
        <button type="button" class="close d_cancel" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="d_form_cp">
        <div class="modal-body mx-4">

          <input type="hidden" id="cp_id" value="" >

          <div class="md-form">
            <label data-error="wrong" data-success="right">Username</label>
            <input type="text" class="form-control validate" id="cp_username" readonly >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Enter New Password</label>
            <input type="password" class="form-control validate" id="cp_new_password">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Re-enter New Password</label>
            <input type="password" class="form-control validate" id="cp_re_new_password">
          </div>

          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" name= "signupbtn">SUBMIT</button>
          </div>

        </div> 
      </form>

    </div>
  </div> 
</div>

<!-- content code end here -->

<script>

  function list_add()
  {

    $.ajax({
      url         : '../../includes/modules/user/list_add.php', 
      type        : 'POST',
      data        : {},
      dataType    : 'JSON',
      beforeSend  : function() {
        $('#btn_add').prop("disabled", true);
      }
    }).done(function(res) {

      let html = '<option value="">&nbsp;</option>';
      if (res.user_types.length > 0) {
        html = '<option value="" selected hidden>- Select User Type</option>';
        $.each(res.user_types, function(key, value) {
          html += '<option value="' + value.user_type_id + '">' + value.name + '</option>';
        });
      }
      $('#add_user_type_id').html(html);
      $('#btn_add').prop("disabled", false);
      $('#list_add_modal').modal('show');
      
    }).fail(function() {
      console.log('Fail!');
    });

  }

  function list_insert()
  {

    let username      = $('#add_username').val();
    let lname         = $('#add_lname').val();
    let fname         = $('#add_fname').val();
    let gender        = $('#add_gender').val();
    let phone         = $('#add_phone').val();
    let user_type_id  = $('#add_user_type_id').val();

    let errors = new Array();

    if (username == '') {
      errors.push('Username');
    }
    if (lname == '') {
      errors.push('Last Name');
    }
    if (fname == '') {
      errors.push('First Name');
    }
    if (gender == '') {
      errors.push('Gender');
    }
    if (user_type_id == '') {
      errors.push('User Type');
    }

    if (errors.length > 0) {
      let error = '';
      $.each(errors, function(key, value) {
        if (error == '') {
          error += '• ' + value;
        } else {
          error += '\n• ' + value;
        }
      });
      alert(error);
    } else {
      $.ajax({
        url         : '../../includes/modules/user/list_insert.php', 
        type        : 'POST', 
        data        : {
          username      : username, 
          lname         : lname, 
          fname         : fname, 
          gender        : gender, 
          phone         : phone, 
          user_type_id  : user_type_id
        }, 
        dataType    : 'JSON', 
        beforeSend  : function() {

        }
      }).done(function(res) {

        if (res.res_success == 1) {
          window.location.reload();
        } else {
          alert(res.res_message);
        }

      }).fail(function() {
        console.log('Fail!');
      });
    }

  }

  function list_edit(user_id)
  {

    $.ajax({
      url         : '../../includes/modules/user/list_edit.php', 
      type        : 'POST', 
      data        : {
        user_id : user_id
      }, 
      dataType    : 'JSON', 
      beforeSend  : function() {
        $('#btn_edit').prop("disabled", true);
      }
    }).done(function(res) {

      let html = '';
      
      html += (res.gender == '1') ? '<option value="1" selected >Male</option>' : '<option value="1">Male</option>';
      html += (res.gender == '0') ? '<option value="0" selected >Female</option>' : '<option value="0">Female</option>';
      $("#edit_gender").html(html);

      html = '';
      html += (res.is_active == '1') ? '<option value="1" selected >Activate</option>' : '<option value="1">Activate</option>';
      html += (res.is_active == '0') ? '<option value="0" selected >Deactivate</option>' : '<option value="0">Deactivate</option>';
      $("#edit_status").html(html);

      html = '<option value="">&nbsp;</option>';
      if (res.user_types.length > 0) {
        html = '<option value="" selected hidden>- Select User Type</option>';
        $.each(res.user_types, function(key, value) {
          if (value.user_type_id == res.user_type_id) {
            html += '<option value="' + value.user_type_id + '" selected >' + value.name + '</option>';
          } else {
            html += '<option value="' + value.user_type_id + '" >' + value.name + '</option>';
          }
        });
      }
      $("#edit_user_type_id").html(html);

      $("#edit_user_id").val(res.user_id);
      $("#edit_username").val(res.username);
      $("#edit_lname").val(res.lname);
      $("#edit_fname").val(res.fname);
      $("#edit_phone").val(res.phone);
      $('#btn_edit').prop("disabled", false);
      $('#list_edit_modal').modal('show');

    }).fail(function() {
      console.log('Fail!');
    });

  }

  function list_update()
  {

    let user_id       = $('#edit_user_id').val();
    let lname         = $('#edit_lname').val();
    let fname         = $('#edit_fname').val();
    let gender        = $('#edit_gender').val();
    let phone         = $('#edit_phone').val();
    let user_type_id  = $('#edit_user_type_id').val();
    let status        = $('#edit_status').val();

    let errors = new Array();

    if (lname == '') {
      errors.push('Last Name');
    }
    if (fname == '') {
      errors.push('First Name');
    }
    if (gender == '') {
      errors.push('Gender');
    }
    if (user_type_id == '') {
      errors.push('User Type');
    }

    if (errors.length > 0) {
      let error = '';
      $.each(errors, function(key, value) {
        if (error == '') {
          error += '• ' + value;
        } else {
          error += '\n• ' + value;
        }
      });
      alert(error);
    } else {
      $.ajax({
        url         : '../../includes/modules/user/list_update.php', 
        type        : 'POST', 
        data        : {
          user_id       : user_id, 
          lname         : lname, 
          fname         : fname, 
          gender        : gender, 
          phone         : phone, 
          user_type_id  : user_type_id, 
          status        : status
        }, 
        dataType    : 'JSON', 
        beforeSend  : function() {
          
        }
      }).done(function(res) {
        if (res.res_success == 1) {
          window.location.reload();
        } else {
          alert(res.res_message);
        }
      }).fail(function() {
        console.log('Fail!');
      });
    }

  }

  function list_changepassword(user_id, username)
  {

    $('#cp_id').val(user_id);
    $('#cp_username').val(username);
    $('#cp_new_password').val('');
    $('#cp_re_new_password').val('');
    $('#list_changepassword_modal').modal('show');

  }

  function list_changepassword_submit()
  {

    let user_id         = $('#cp_id').val();
    let new_password    = $('#cp_new_password').val();
    let re_new_password = $('#cp_re_new_password').val();

    if (new_password == re_new_password && new_password != '') { // if positive
      $.ajax({
        url         : '../../includes/modules/user/changepassword.php', 
        type        : 'POST', 
        data        : {
          user_id         : user_id, 
          new_password    : new_password, 
          re_new_password : re_new_password, 
        }, 
        dataType    : 'JSON', 
        beforeSend  : function() {

        }
      }).done(function(res) {
        if (res.res_success == 1) {
          alert('Password Changed!');
          $('#cp_new_password').css({'border':'1px solid #ced4da'});
          $('#cp_re_new_password').css({'border':'1px solid #ced4da'});
          $('#list_changepassword_modal').modal('hide');
        } else {
          alert('Invalid Password!');
          $('#cp_new_password').css({'border':'1px solid red'});
          $('#cp_re_new_password').css({'border':'1px solid red'});
        }
      }).done(function(res) {
        
      });
    } else {
      alert('Invalid Password!');
      $('#cp_new_password').css({'border':'1px solid red'});
      $('#cp_re_new_password').css({'border':'1px solid red'});
    }

  }

  $(document).ready(function() {

    $('#d_form_update').submit(function(e) {
      e.preventDefault();
      list_update();
    });

    $('#d_form_insert').submit(function(e) {
      e.preventDefault();
      list_insert();
    });

    $('#d_form_cp').submit(function(e) {
      e.preventDefault();
      list_changepassword_submit();
    });

  });

</script>

<?php 
require_once '../../footer.php'; 
?>