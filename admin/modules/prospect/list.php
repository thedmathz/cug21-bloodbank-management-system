<?php 
$icon       = 'face';
$module 		= 'prospect';
$sub_module = '';
require_once '../../includes/modules/prospect/list.php'; 
require_once '../../includes/check_session.php'; 
require_once '../../header.php'; 
?>

<!-- content code start here -->

<h5 class="d-flex align-items-end" style="margin-bottom: 15px;">
  <i class="<?php echo $icon; ?>" style="margin-right: 8px;"></i> <?php echo ucfirst($module); ?>s<?php if ($sub_module) echo ' <i class="bx bx-right-arrow-alt"></i> '.ucfirst(implode(' ', explode('_', $sub_module))); ?>
  <div style="flex: 1;"></div>
  <button class="btn btn-primary btn-raised btn-sm" onclick="list_add()" >Add Prospect</button>
</h5>

<div class="card radius-10">
	<div class="card-body">
		<div class="table-responsive">
      <form action="list.php" method="post">
        <table class="table align-middle mb-0">

          <thead class="table-light">

            <tr>
              <th class="text-center"></th>
              <th class="text-start">Username</th>
              <th class="text-start">Last Name</th>
              <th class="text-start">First Name</th>
              <th class="text-start">Middle Name</th>
              <th class="text-center">Phone</th>
              <th class="text-center">Province</th>
              <th class="text-center">City</th>
              <th class="text-center">Barangay</th>
              <th class="text-center">Gender</th>
              <th class="text-center">Birthday</th>
              <th class="text-center">Action</th>
            </tr>

          </thead>

          <tbody>

            <?php 
            if ($prospects) {
              foreach ($prospects as $pros) {
                ?>

                <tr class="text-center">
                  <td class="text-center">
                    <div style="background: #ccc; width: 25px; height: 25px;">
                      <img src="<?php echo $pros['avatar']; ?>" alt="Profile Picture" onclick="view_pp('<?php echo $pros['avatar']; ?>')" style="height: 100%; width: 100%; cursor: pointer; background: #ccc;" >
                    </div>
                  </td>
                  <td class="text-center"><?php echo $pros['username']; ?></td>
                  <td class="text-start"><?php echo $pros['lname']; ?></td>
                  <td class="text-start"><?php echo $pros['fname']; ?></td>
                  <td class="text-start"><?php echo $pros['mname']; ?></td>
                  <td class="text-center"><?php echo $pros['phone']; ?></td>
                  <td class="text-center"><?php echo $pros['province']; ?></td>
                  <td class="text-center"><?php echo $pros['city']; ?></td>
                  <td class="text-center"><?php echo $pros['barangay']; ?></td>
                  <td class="text-center"><?php echo $pros['gender']; ?></td>
                  <td class="text-center"><?php echo $pros['bday']; ?></td>
                  <td class="text-center">
                    <div class="d-flex justify-content-center order-actions">	
                      <a href="javascript:;" title="Edit Prospect" onclick="list_edit('<?php echo $pros['prospect_id']; ?>')" class="text-white bg-info">
                        <i class="bx bx-edit"></i>
                      </a>
                    </div>
                  </td>
                </tr>

                <?php
              }
            } else {
              ?>

              <tr class="text-center">
                <td class="text-center text-danger" colspan="10" >No Record Found</td>
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

<!-- modals -->
<div class="modal fade" id="list_add_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Add New Prospect</h3>
        <button type="button" class="close d_cancel" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="d_form_insert">
        <div class="modal-body mx-4">

          <div class="md-form">
            <label data-error="wrong" data-success="right">Username <span class="text-danger" >*</span></label>
            <input type="text" class="form-control" id="add_username" >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Last Name <span class="text-danger" >*</span></label>
            <input type="text" class="form-control" id="add_lname" >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">First Name <span class="text-danger" >*</span></label>
            <input type="text" class="form-control" id="add_fname" >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Middle Name <span class="text-danger" >*</span></label>
            <input type="text" class="form-control" id="add_mname" >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Phone <span class="text-danger" >*</span></label>
            <input type="text" class="form-control" id="add_phone" placeholder="09XXXXXXXXX" >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Province <span class="text-danger" >*</span></label>
            <select class='form-control' id="add_province_id" onchange="get_add_cities()" >
              <option value="" selected hidden>- Select Province</option>
            </select>
          </div>
          
          <div class="md-form">
            <label data-error="wrong" data-success="right">City <span class="text-danger" >*</span></label>
            <select class='form-control' id="add_city_id" onchange="get_add_barangays()">
              <option value="">&nbsp;</option>
            </select>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Barangay <span class="text-danger" >*</span></label>
            <select class='form-control' id="add_barangay_id">
              <option value="">&nbsp;</option>
            </select>
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
            <label data-error="wrong" data-success="right">Birthday <span class="text-danger" >*</span></label>
            <input type="date" class="form-control" id="add_bday">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Blood Type <span class="text-danger" >*</span></label>
            <select class='form-control' id="add_blood_type_id">
              <option value="" selected hidden>- Select Blood Type</option>
            </select>
          </div>
          
          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_insert" >SUBMIT</button>
          </div>

        </div> 
      </form>

    </div>
  </div> 
</div>

<div class="modal fade" id="list_edit_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Edit New Prospect</h3>
        <button type="button" class="close d_cancel" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="d_form_update">
        <div class="modal-body mx-4">

          <input type="hidden" class="form-control" id="edit_prospect_id" value="" >    

          <div class="md-form">
            <label data-error="wrong" data-success="right">Username <span class="text-danger" >*</span></label>
            <input type="text" class="form-control" id="edit_username" readonly >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Last Name <span class="text-danger" >*</span></label>
            <input type="text" class="form-control" id="edit_lname" >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">First Name <span class="text-danger" >*</span></label>
            <input type="text" class="form-control" id="edit_fname" >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Middle Name <span class="text-danger" >*</span></label>
            <input type="text" class="form-control" id="edit_mname" >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Phone <span class="text-danger" >*</span></label>
            <input type="text" class="form-control" id="edit_phone" placeholder="09XXXXXXXXX" >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Province <span class="text-danger" >*</span></label>
            <select class='form-control' id="edit_province_id" onchange="get_edit_cities()" >
              <option value="" selected hidden>- Select Province</option>
            </select>
          </div>
          
          <div class="md-form">
            <label data-error="wrong" data-success="right">City <span class="text-danger" >*</span></label>
            <select class='form-control' id="edit_city_id" onchange="get_edit_barangays()">
              <option value="">&nbsp;</option>
            </select>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Barangay <span class="text-danger" >*</span></label>
            <select class='form-control' id="edit_barangay_id">
              <option value="">&nbsp;</option>
            </select>
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
            <label data-error="wrong" data-success="right">Birthday <span class="text-danger" >*</span></label>
            <input type="date" class="form-control" id="edit_bday">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Blood Type <span class="text-danger" >*</span></label>
            <select class='form-control' id="edit_blood_type_id">
              <option value="" selected hidden>- Select Blood Type</option>
            </select>
          </div>
          
          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_update" >SUBMIT</button>
          </div>

        </div> 
      </form>

    </div>
  </div> 
</div>

<script>

  function list_add()
  {

    $.ajax({
      url         : '../../includes/modules/prospect/list_add.php', 
      type        : 'POST',
      data        : {},
      dataType    : 'JSON',
      beforeSend  : function() {

      }
    }).done(function(res) {

      html = '<option value="" selected hidden>- Select Province</option>';
      $.each(res.provinces, function(key, value) {
        html += '<option value="' + value.province_id + '">' + value.name + '</option>';
      });
      $('#add_province_id').html(html);

      html = '<option value="" selected hidden>- Select Select Blood Type</option>';
      $.each(res.blood_types, function(key, value) {
        html += '<option value="' + value.blood_type_id + '">' + value.name + '</option>';
      });
      $('#add_blood_type_id').html(html);

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
    let mname         = $('#add_mname').val();
    let phone         = $('#add_phone').val();
    let province_id   = $('#add_province_id').val();
    let city_id       = $('#add_city_id').val();
    let barangay_id   = $('#add_barangay_id').val();
    let gender        = $('#add_gender').val();
    let bday          = $('#add_bday').val();
    let blood_type_id = $('#add_blood_type_id').val();

    let error   = '';
    let errors  = new Array();

    if (username == '') {
      errors.push('Username');
    }
    if (lname == '') {
      errors.push('Last Name');
    }
    if (fname == '') {
      errors.push('First Name');
    }
    if (mname == '') {
      errors.push('Middle Name');
    }
    if (phone == '') {
      errors.push('Phone');
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
    if (gender == '') {
      errors.push('Gender');
    }
    if (bday == '') {
      errors.push('Birthday');
    }
    if (blood_type_id == '') {
      errors.push('Blood Type');
    }

    if (errors.length > 0) {
      $.each(errors, function(key, value) {
        if (error == '') {
          error += '• ' + value;
        } else {
          error += '\n• ' + value;
        }
      }); 
      alert('Required Fields: \n\n' + error);
    } else {

      $.ajax({
        url         : '../../includes/modules/prospect/list_insert.php', 
        type        : 'POST',
        data        : {
          username      : username, 
          lname         : lname, 
          fname         : fname, 
          mname         : mname, 
          phone         : phone, 
          province_id   : province_id, 
          city_id       : city_id, 
          barangay_id   : barangay_id, 
          gender        : gender, 
          bday          : bday, 
          blood_type_id : blood_type_id
        },
        dataType    : 'JSON',
        beforeSend  : function() {
          $('#btn_insert').prop('disabled', true);
        }
      }).done(function(res) {

        if (res.res_success == 1) {
          window.location.reload();
        } else {
          alert(res.res_message)
          $('#btn_insert').prop('disabled', false);
        }

      }).fail(function() {
        console.log('Fail!');
      });

    }

  }

  function list_edit(prospect_id)
  {

    $.ajax({
      url         : '../../includes/modules/prospect/list_edit.php', 
      type        : 'POST',
      data        : {
        prospect_id : prospect_id
      },
      dataType    : 'JSON',
      beforeSend  : function() {
        $('#edit_prospect_id').val(prospect_id);
      }
    }).done(function(res) {

      $('#edit_username').val(res.username);
      $('#edit_lname').val(res.lname);
      $('#edit_fname').val(res.fname);
      $('#edit_mname').val(res.mname);
      $('#edit_phone').val(res.phone);
      $('#edit_bday').val(res.bday);

      html = '<option value="" selected hidden>- Select Province</option>';
      $.each(res.provinces, function(key, value) {
        if (value.province_id == res.province_id) {
          html += '<option value="' + value.province_id + '" selected >' + value.name + '</option>';
        } else {
          html += '<option value="' + value.province_id + '">' + value.name + '</option>';
        }
      });
      $('#edit_province_id').html(html);

      html = '<option value="" selected hidden>- Select City</option>';
      $.each(res.cities, function(key, value) {
        if (value.city_id == res.city_id) {
          html += '<option value="' + value.city_id + '" selected >' + value.name + '</option>';
        } else {
          html += '<option value="' + value.city_id + '">' + value.name + '</option>';
        }
      });
      $('#edit_city_id').html(html);

      html = '<option value="" selected hidden>- Select Barangay</option>';
      $.each(res.barangays, function(key, value) {
        if (value.barangay_id == res.barangay_id) {
          html += '<option value="' + value.barangay_id + '" selected >' + value.name + '</option>';
        } else {
          html += '<option value="' + value.barangay_id + '">' + value.name + '</option>';
        }
      });
      $('#edit_barangay_id').html(html);

      html = '<option value="" selected hidden>- Select Blood Type</option>';
      $.each(res.blood_types, function(key, value) {
        if (value.blood_type_id == res.blood_type_id) {
          html += '<option value="' + value.blood_type_id + '" selected >' + value.name + '</option>';
        } else {
          html += '<option value="' + value.blood_type_id + '">' + value.name + '</option>';
        }
      });
      $('#edit_blood_type_id').html(html);

      html = '<option value="" selected hidden>- Select Gender</option>';
      html += (res.gender == '1') ? '<option value="1" selected >Male</option>' : '<option value="1" >Male</option>';
      html += (res.gender == '0') ? '<option value="0" selected >Female</option>' : '<option value="0" >Female</option>';
      $('#edit_gender').html(html);

      $('#list_edit_modal').modal('show');

    }).fail(function() {
      console.log('Fail!');
    });

  }

  function list_update()
  {

    let prospect_id   = $('#edit_prospect_id').val();
    let username      = $('#edit_username').val();
    let lname         = $('#edit_lname').val();
    let fname         = $('#edit_fname').val();
    let mname         = $('#edit_mname').val();
    let phone         = $('#edit_phone').val();
    let province_id   = $('#edit_province_id').val();
    let city_id       = $('#edit_city_id').val();
    let barangay_id   = $('#edit_barangay_id').val();
    let gender        = $('#edit_gender').val();
    let bday          = $('#edit_bday').val();
    let blood_type_id = $('#edit_blood_type_id').val();

    let error   = '';
    let errors  = new Array();

    if (username == '') {
      errors.push('Username');
    }
    if (lname == '') {
      errors.push('Last Name');
    }
    if (fname == '') {
      errors.push('First Name');
    }
    if (mname == '') {
      errors.push('Middle Name');
    }
    if (phone == '') {
      errors.push('Phone');
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
    if (gender == '') {
      errors.push('Gender');
    }
    if (bday == '') {
      errors.push('Birthday');
    }
    if (blood_type_id == '') {
      errors.push('Blood Type');
    }

    if (errors.length > 0) {
      $.each(errors, function(key, value) {
        if (error == '') {
          error += '• ' + value;
        } else {
          error += '\n• ' + value;
        }
      }); 
      alert('Required Fields: \n\n' + error);
    } else {

      $.ajax({
        url         : '../../includes/modules/prospect/list_update.php', 
        type        : 'POST',
        data        : {
          prospect_id   : prospect_id, 
          username      : username, 
          lname         : lname, 
          fname         : fname, 
          mname         : mname, 
          phone         : phone, 
          province_id   : province_id, 
          city_id       : city_id, 
          barangay_id   : barangay_id, 
          gender        : gender, 
          bday          : bday, 
          blood_type_id : blood_type_id
        },
        dataType    : 'JSON',
        beforeSend  : function() {
          $('#btn_update').prop('disabled', true);
        }
      }).done(function(res) {

        if (res.res_success == 1) {
          window.location.reload();
        } else {
          alert(res.res_message)
          $('#btn_update').prop('disabled', false);
        }

      }).fail(function() {
        console.log('Fail!');
      });

    }

  }

  function get_add_cities()
  {

    let province_id = $('#add_province_id').val();

    $.ajax({
      url         : '../../includes/modules/prospect/get_cities.php', 
      type        : 'POST',
      data        : {
        province_id : province_id
      },
      dataType    : 'JSON',
      beforeSend  : function() {
        $('#add_barangay_id').html('<option value="">&nbsp;</option>');
      }
    }).done(function(res) {
      html = '<option value="">&nbsp;</option>';
      if (res.cities.length > 0) {
        html = '<option value="" selected hidden>- Select City</option>';
        $.each(res.cities, function(key, value) {
          html += '<option value="' + value.city_id + '">' + value.name + '</option>';
        });
      }
      $('#add_city_id').html(html);
    }).fail(function() {
      console.log('Fail!');
    });

  }

  function get_add_barangays()
  {

    let city_id = $('#add_city_id').val();

    $.ajax({
      url         : '../../includes/modules/prospect/get_barangays.php', 
      type        : 'POST',
      data        : {
        city_id : city_id
      },
      dataType    : 'JSON',
      beforeSend  : function() {}
    }).done(function(res) {
      html = '<option value="">&nbsp;</option>';
      if (res.barangays.length > 0) {
        html = '<option value="" selected hidden>- Select Barangay</option>';
        $.each(res.barangays, function(key, value) {
          html += '<option value="' + value.barangay_id + '">' + value.name + '</option>';
        });
      }
      $('#add_barangay_id').html(html);
    }).fail(function() {
      console.log('Fail!');
    });

  }

  function get_edit_cities()
  {

    let province_id = $('#edit_province_id').val();

    $.ajax({
      url         : '../../includes/modules/prospect/get_cities.php', 
      type        : 'POST',
      data        : {
        province_id : province_id
      },
      dataType    : 'JSON',
      beforeSend  : function() {
        $('#edit_barangay_id').html('<option value="">&nbsp;</option>');
      }
    }).done(function(res) {
      html = '<option value="">&nbsp;</option>';
      if (res.cities.length > 0) {
        html = '<option value="" selected hidden>- Select City</option>';
        $.each(res.cities, function(key, value) {
          html += '<option value="' + value.city_id + '">' + value.name + '</option>';
        });
      }
      $('#edit_city_id').html(html);
    }).fail(function() {
      console.log('Fail!');
    });

  }

  function get_edit_barangays()
  {

    let city_id = $('#edit_city_id').val();

    $.ajax({
      url         : '../../includes/modules/prospect/get_barangays.php', 
      type        : 'POST',
      data        : {
        city_id : city_id
      },
      dataType    : 'JSON',
      beforeSend  : function() {}
    }).done(function(res) {
      html = '<option value="">&nbsp;</option>';
      if (res.barangays.length > 0) {
        html = '<option value="" selected hidden>- Select Barangay</option>';
        $.each(res.barangays, function(key, value) {
          html += '<option value="' + value.barangay_id + '">' + value.name + '</option>';
        });
      }
      $('#edit_barangay_id').html(html);
    }).fail(function() {
      console.log('Fail!');
    });

  }

  $(document).ready(function() {

    $('#d_form_insert').submit(function(e) {
      e.preventDefault();
      list_insert();
    });

    $('#d_form_update').submit(function(e) {
      e.preventDefault();
      list_update();
    });

  });

</script>
<!-- content code end here -->

<?php 
require_once '../../footer.php'; 
?>