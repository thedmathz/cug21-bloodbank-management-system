<?php 
$icon       = 'home';
$module 		= 'blood';
$sub_module = 'stocks';
require_once '../../includes/modules/blood/list.php'; 
require_once '../../includes/check_session.php'; 
require_once '../../header.php'; 
?>

<!-- content code start here -->

<h5 class="d-flex" style="margin-bottom: 15px;">
  <i class="<?php echo $icon; ?>" style="margin-right: 8px;"></i> <?php echo ucfirst($module); ?><?php if ($sub_module) echo ' <i class="bx bx-right-arrow-alt"></i> '.ucfirst(implode(' ', explode('_', $sub_module))); ?>
  <div style="flex: 1;"></div>
</h5>

<div class="d-flex row row-cols-1 row-cols-lg-2 row-cols-xl-3">

  <div class="col col-md-3">
    <div class="card radius-10">
      <div class="card-body" style="position: relative;">
        <div class="d-flex align-items-center">
          <div>
            <h3 class="my-1">A+</h3>
            <p class="mb-0 text-secondary"><?php echo $a_plus; ?></p>
          </div>
          <div class="widgets-icons bg-light-danger text-danger ms-auto">
            <i class="bx bxs-droplet"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col col-md-3">
    <div class="card radius-10">
      <div class="card-body" style="position: relative;">
        <div class="d-flex align-items-center">
          <div>
            <h3 class="my-1">B+</h3>
            <p class="mb-0 text-secondary"><?php echo $b_plus; ?></p>
          </div>
          <div class="widgets-icons bg-light-danger text-danger ms-auto">
            <i class="bx bxs-droplet"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col col-md-3">
    <div class="card radius-10">
      <div class="card-body" style="position: relative;">
        <div class="d-flex align-items-center">
          <div>
            <h3 class="my-1">AB+</h3>
            <p class="mb-0 text-secondary"><?php echo $ab_plus; ?></p>
          </div>
          <div class="widgets-icons bg-light-danger text-danger ms-auto">
            <i class="bx bxs-droplet"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col col-md-3">
    <div class="card radius-10">
      <div class="card-body" style="position: relative;">
        <div class="d-flex align-items-center">
          <div>
            <h3 class="my-1">O+</h3>
            <p class="mb-0 text-secondary"><?php echo $o_plus; ?></p>
          </div>
          <div class="widgets-icons bg-light-danger text-danger ms-auto">
            <i class="bx bxs-droplet"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col col-md-3">
    <div class="card radius-10">
      <div class="card-body" style="position: relative;">
        <div class="d-flex align-items-center">
          <div>
            <h3 class="my-1">A-</h3>
            <p class="mb-0 text-secondary"><?php echo $a_minus; ?></p>
          </div>
          <div class="widgets-icons bg-light-danger text-danger ms-auto">
            <i class="bx bxs-droplet"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col col-md-3">
    <div class="card radius-10">
      <div class="card-body" style="position: relative;">
        <div class="d-flex align-items-center">
          <div>
            <h3 class="my-1">B-</h3>
            <p class="mb-0 text-secondary"><?php echo $b_minus; ?></p>
          </div>
          <div class="widgets-icons bg-light-danger text-danger ms-auto">
            <i class="bx bxs-droplet"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col col-md-3">
    <div class="card radius-10">
      <div class="card-body" style="position: relative;">
        <div class="d-flex align-items-center">
          <div>
            <h3 class="my-1">AB-</h3>
            <p class="mb-0 text-secondary"><?php echo $ab_minus; ?></p>
          </div>
          <div class="widgets-icons bg-light-danger text-danger ms-auto">
            <i class="bx bxs-droplet"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col col-md-3">
    <div class="card radius-10">
      <div class="card-body" style="position: relative;">
        <div class="d-flex align-items-center">
          <div>
            <h3 class="my-1">O-</h3>
            <p class="mb-0 text-secondary"><?php echo $o_minus; ?></p>
          </div>
          <div class="widgets-icons bg-light-danger text-danger ms-auto">
            <i class="bx bxs-droplet"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<form id="d_form" action="list.php" method="post">

<h5 class="d-flex" style="align-items: end;">
  Stock Logs
  <div style="flex: 1;"></div>
  <button type="button" class="btn btn-warning text-white btn-raised btn-sm" onclick="list_print()" >
    <i class="bx bx-printer" style="margin-left: auto; margin-right: auto;"></i>
  </button>
  <button type="submit" id="d_submit" name="d_submit" class="btn btn-info text-white btn-raised btn-sm ms-2" >
    <i class="bx bx-filter-alt" style="margin-left: auto; margin-right: auto;"></i>
  </button>
  <button type="button" class="btn btn-primary btn-raised btn-sm ms-2" onclick="list_add()" >Add Stock</button>
</h5>

<div class="card radius-10">
	<div class="card-body">
		<div class="table-responsive">
      <table class="table align-middle mb-0">

        <thead class="table-light">

          <tr>
            <th class="text-center">Blood Type</th>
            <th class="text-start">Prospect</th>
            <th class="text-center">Log Type</th>
            <th class="text-center">Quantity (ml)</th>
            <th class="text-center">Inserted By</th>
            <th class="text-center">Date Inserted</th>
          </tr>

          <tr>
            <th class="text-center">
              <select name="d_blood_type_id" id="d_blood_type_id" class="form-control" onchange="$('#d_submit').click()" >
                <option value="">&nbsp;</option>
                <?php
                foreach ($blood_types as $bt) {
                  ?>
                  <option value="<?php echo $bt['blood_type_id'] ?>" <?php if ($d_blood_type_id == $bt['blood_type_id']) echo 'selected'; ?> ><?php echo $bt['name'] ?></option>
                  <?php
                }
                ?>
              </select>
            </th>
            <th class="text-start">
              <input name="d_lname" type="text" class="form-control" value="<?php echo $d_lname; ?>" placeholder="Lastname" >
            </th>
            <th class="text-center">
              <select name="d_type" id="d_type" class="form-control" onchange="$('#d_submit').click()" >
                <option value="">&nbsp;</option>
                <option value="0" <?php if ($d_type == '0') echo 'selected'; ?> >Get</option>
                <option value="1" <?php if ($d_type == '1') echo 'selected'; ?> >Donate</option>
                <option value="2" <?php if ($d_type == '2') echo 'selected'; ?> >Update</option>
              </select>
            </th>
            <th class="text-center">
              <input type="number" name="d_quantity" id="d_quantity" placeholder="0" value="<?php echo $d_quantity; ?>" class="form-control text-end">
            </th>
            <th class="text-center">
              <select name="d_user_id" id="d_user_id" class="form-control" onchange="$('#d_submit').click()">
                <option value="">&nbsp;</option>
                <?php
                foreach ($users as $user) {
                  ?>
                  <option value="<?php echo $user['user_id'] ?>" <?php if ($d_user_id == $user['user_id']) echo 'selected'; ?> ><?php echo $user['name'] ?></option>
                  <?php
                }
                ?>
              </select>
            </th>
            <th class="text-center">
              <input type="text" class="form-control" name="d_date_inserted" >
            </th>
          </tr>

        </thead>

        <tbody>

          <?php 
          if ($stock_logs) {
            foreach ($stock_logs as $sl) {
              ?>

              <tr class="text-center">
                <td class="text-center"><?php echo $sl['blood_type']; ?></td>
                <td class="text-start"><?php echo $sl['prospect']; ?></td>
                <td class="text-center"><?php echo $sl['log_type']; ?></td>
                <td class="text-center"><?php echo $sl['quantity']; ?></td>
                <td class="text-center"><?php echo $sl['inserted_by']; ?></td>
                <td class="text-center"><?php echo $sl['date_inserted']; ?></td>
              </tr>

              <?php
            }
          } else {
            ?>

            <tr class="text-center">
              <td class="text-center text-danger" colspan="6">No Record Found</td>
            </tr>

            <?php
          }
          ?>

        </tbody>

      </table>
		</div>
	</div>
</div>

</form>

<!-- modal -->
<div class="modal fade" id="list_add_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- username, lname, fname, gender, phone, user_type_id -->
  
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Add Blood Stock</h3>
        <button type="button" class="close d_cancel" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="d_form_insert">
        <div class="modal-body mx-4">

          <div class="md-form mb-2">
            <label data-error="wrong" data-success="right">Prospect Name <span class="text-danger" >*</span></label>
            <select class='form-control' id="add_prospect_id" onchange="change_prospect()" >
              <option value="" selected hidden>- Select Prospect Name</option>
              <option value="1">Male</option>
              <option value="0">Female</option>
            </select>
          </div>

          <div class="md-form mb-2">
            <label data-error="wrong" data-success="right">Address</label>
            <input type="text" class="form-control" id="add_address" value="" readonly >
          </div>

          <div class="md-form mb-2">
            <label data-error="wrong" data-success="right">Blood Type <span class="text-danger" >*</span></label>
            <select class='form-control' id="add_blood_type_id">
              <option value="" selected hidden>- Select Blood Type</option>
              <option value="1">Male</option>
              <option value="0">Female</option>
            </select>
          </div>

          <div class="md-form mb-2">
            <label data-error="wrong" data-success="right">Quantity (in ml) <span class="text-danger" >*</span></label>
            <input type="number" class="form-control" id="add_quantity">
          </div>
          
          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a">SUBMIT</button>
          </div>

        </div> 
      </form>

    </div>
  </div> 
</div>

<script>

  function list_print()
  {

    let blood_type_id = '<?php echo $d_blood_type_id ?>';
    let lname         = '<?php echo $d_lname ?>';
    let type          = '<?php echo $d_type ?>';
    let quantity      = '<?php echo $d_quantity ?>';
    let user_id       = '<?php echo $d_user_id ?>';
    let date_inserted = '<?php echo $d_date_inserted ?>';
    let data          = '';

    data += 'blood_type_id=' + blood_type_id;
    data += '&lname=' + lname;
    data += '&type=' + type;
    data += '&quantity=' + quantity;
    data += '&user_id=' + user_id;
    data += '&date_inserted=' + date_inserted;

    // return false;

    popupCenter({url: '../../includes/modules/blood/list_stock_logs_print.php?'+data, title: 'BBDMS Stock Logs', w: 900, h: 500});  

  }

  function list_add()
  {

    $.ajax({
      url         : '../../includes/modules/blood/list_add.php', 
      type        : 'POST',
      data        : {},
      dataType    : 'JSON',
      beforeSend  : function() {

      }
    }).done(function(res) {

      let html = '';

      html = '<option value="">&nbsp;</option>';
      if (res.prospects.length > 0) {
        html = '<option value="" selected hidden>- Select Prospect Name</option>';
        $.each(res.prospects, function(key, value) {
          html += '<option value="' + value.prospect_id + '" data-address="' + value.address + '" data-blood_type_id="' + value.blood_type_id + '" >' + value.prospect + '</option>';
        });
      }
      $('#add_prospect_id').html(html);

      html = '<option value="">&nbsp;</option>';
      if (res.blood_types.length > 0) {
        html = '<option value="" selected hidden>- Select Blood Type</option>';
        $.each(res.blood_types, function(key, value) {
          html += '<option value="' + value.blood_type_id + '">' + value.name + '</option>';
        });
      }
      $('#add_blood_type_id').html(html);

      $('#list_add_modal').modal('show');

    }).fail(function() {
      console.log('Fail!');
    });

  }

  function change_prospect()
  {

    let address       = $('#add_prospect_id').find(':selected').data('address');
    let blood_type_id = $('#add_prospect_id').find(':selected').data('blood_type_id');

    $.ajax({
      url         : '../../includes/modules/blood/change_prospect.php', 
      type        : 'POST',
      data        : { 
        blood_type_id : blood_type_id
      },
      dataType    : 'JSON',
      beforeSend  : function() {
        $('#add_address').val(address);
      }
    }).done(function(res) {
      
      let html = '<option value="" selected hidden>- Select Blood Type</option>';
      $.each(res.blood_types, function(key, value) {
        if (res.blood_type_id > 0 && res.blood_type_id == value.blood_type_id) {
          html += '<option value="' + value.blood_type_id + '" selected >' + value.name + '</option>';
        } else {
          html += '<option value="' + value.blood_type_id + '">' + value.name + '</option>';
        }
      });
      $('#add_blood_type_id').html(html);

    }).fail(function() {
      console.log('Fail!');
    });

  }

  // $(document).on('submit', '#d_form', function(e) {
  //   alert('dsa');
  // });

  $(document).ready(function() {

    $('input[name="d_date_inserted"]').daterangepicker({ 
      startDate	: '<?php echo date('m/d/Y', strtotime($date_inserted_from)); ?>', 
      endDate		: '<?php echo date('m/d/Y', strtotime($date_inserted_to)); ?>' 
    });

    $('#d_form_insert').submit(function(e) {
      e.preventDefault();

      let prospect_id   = $('#add_prospect_id').val();
      let blood_type_id = $('#add_blood_type_id').val();
      let quantity      = $('#add_quantity').val();

      let errors = new Array();

      if (prospect_id == '') {
        errors.push('Prospect Name');
      }
      if (blood_type_id == '') {
        errors.push('Blood Type');
      }
      if (quantity == '') {
        errors.push('Blood Quantity');
      }

      if (errors.length > 0) {
        error = '';
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
          url         : '../../includes/modules/blood/list_insert.php', 
          type        : 'POST',
          data        : {
            prospect_id   : prospect_id, 
            blood_type_id : blood_type_id, 
            quantity      : quantity
          },
          dataType    : 'JSON',
          beforeSend  : function() {
            
          }
        }).done(function(res) {
          window.location.reload();
        }).fail(function() {
          console.log('Fail!');
        });
      }

    });

  });

</script>
<!-- content code end here -->

<?php 
require_once '../../footer.php'; 
?>