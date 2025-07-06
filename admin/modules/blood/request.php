<?php 
$icon       = 'home';
$module 		= 'blood';
$sub_module = 'requests';
require_once '../../includes/modules/blood/request.php'; 
require_once '../../includes/check_session.php'; 
require_once '../../header.php'; 
?>

<!-- content code start here -->

<h5 class="d-flex" style="margin-bottom: 15px;">
  <i class="<?php echo $icon; ?>" style="margin-right: 8px;"></i> <?php echo ucfirst($module); ?><?php if ($sub_module) echo ' <i class="bx bx-right-arrow-alt"></i> '.ucfirst(implode(' ', explode('_', $sub_module))); ?>
  <div style="flex: 1;"></div>
</h5>

<div class="card radius-10">
	<div class="card-body">
		<div class="table-responsive">
      <form action="list.php" method="post">
        <table class="table align-middle mb-0">

          <thead class="table-light">

            <tr>
              <th class="text-start">Prospect</th>
              <th class="text-center">Request Type</th>
              <th class="text-center">Donate To</th>
              <th class="text-center">Quantity Get</th>
              <th class="text-center">Quantity Donated</th>
              <th class="text-center">Date Requested</th>
              <th class="text-center">Approved By</th>
              <th class="text-center">Date Approved</th>
              <th class="text-center">Date Appointment</th>
              <th class="text-center">Checked By</th>
              <th class="text-center">Date Checked</th>
              <th class="text-center">Blood Type</th>
              <th class="text-center">Blood Status</th>
              <th class="text-center">Status</th>
              <th class="text-center">Remarks</th>
              <th class="text-center">Action</th>
            </tr>

          </thead>

          <tbody>

            <?php
            if ($requests) {
              foreach ($requests as $req) {
                ?>

                <tr class="text-center">
                  <td class="text-start"><?php echo $req['prospect']; ?></td>
                  <td class="text-center"><?php echo $req['req_type']; ?></td>
                  <td class="text-center"><?php echo $req['donate_to']; ?></td>
                  <td class="text-center"><?php echo $req['quantity_donee']; ?></td>
                  <td class="text-center"><?php echo $req['quantity_donor']; ?></td>
                  <td class="text-center"><?php echo $req['date_requested']; ?></td>
                  <td class="text-center"><?php echo $req['approved_by']; ?></td>
                  <td class="text-center"><?php echo $req['date_approved']; ?></td>
                  <td class="text-center"><?php echo $req['date_appointment']; ?></td>
                  <td class="text-center"><?php echo $req['checked_by']; ?></td>
                  <td class="text-center"><?php echo $req['date_checked']; ?></td>
                  <td class="text-center"><?php echo $req['blood_type']; ?></td>
                  <td class="text-center"><?php echo $req['blood_status']; ?></td>
                  <td class="text-center"><?php echo $req['status']; ?></td>
                  <td class="text-center">
                    <?php 
                    echo $req['remarks']; 
                    ?>
                    <!-- <a href="" class="bg-success text-white" style="padding: 3px 8px;">Rogincel T. Demata [200ml]</a> -->
                  </td>
                  <td class="text-center">
                    <div class="d-flex justify-content-center order-actions">	
                      <a href="javascript:;" title="Edit Request" onclick="request_edit('<?php echo $req['request_id']; ?>', '<?php echo $req['d_req_type']; ?>', '<?php echo $req['d_status']; ?>')" class="text-white bg-info">
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
                <td class="text-center text-danger" colspan="11">No Record Found</td>
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

<!-- modal -->
<div class="modal fade" id="request_edit_modal_donor">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Update Request</h3>
        <button type="button" class="close d_cancel" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="d_form_insert_donor">
        <div class="modal-body mx-4">

          <div class="md-form">
            <label data-error="wrong" data-success="right">Prospect Name</label>
            <input type="text" class="form-control" id="edit_prospect_name" value="" readonly >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Request Type</label>
            <input type="text" class="form-control" id="edit_type" value="" readonly >
          </div>

          <div class="md-form donor_d_blood_type">
            <label data-error="wrong" data-success="right">Blood Type</label>
            <input type="text" class="form-control" id="edit_d_blood_type" value="" readonly >
          </div>

          <div class="md-form donor_quantity_donee">
            <label data-error="wrong" data-success="right">Get Blood Quantity (in ml)</label>
            <input type="number" class="form-control" id="edit_quantity_donee" value="" readonly >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Date Inserted</label>
            <input type="text" class="form-control" id="edit_date_inserted" value="" readonly >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Status</label>
            <select class="form-control" id="edit_status" >
              <option value="">&nbsp;</option>
            </select>
          </div>

          <hr class="donor_hr_1">

          <div class="md-form donor_appointed_by">
            <label data-error="wrong" data-success="right">Appointed By <span class="text-danger" >*</span></label>
            <input type="text" class="form-control" id="edit_appointed_by" value="" readonly >
          </div>

          <div class="md-form donor_date_appointed">
            <label data-error="wrong" data-success="right">Date Appointed <span class="text-danger" >*</span></label>
            <input type="text" class="form-control" id="edit_date_appointed" value="" readonly >
          </div>

          <hr class="donor_hr_2">

          <div class="md-form donor_checked_by">
            <label data-error="wrong" data-success="right">Checked By <span class="text-danger" >*</span></label>
            <input type="text" class="form-control" id="edit_checked_by" value="dsada" readonly >
          </div>

          <div class="md-form donor_date_checked">
            <label data-error="wrong" data-success="right">Date Checked <span class="text-danger" >*</span></label>
            <input type="text" class="form-control" id="edit_date_checked" value="2020-01-22" readonly >
          </div>

          <div class="md-form donor_blood_type">
            <label data-error="wrong" data-success="right">Blood Type <span class="text-danger" >*</span></label>
            <select class="form-control" name="" id="edit_blood_type_id">
              <option value="">- Select Blood Type</option>
            </select>
            <input type="text" class="form-control" id="edit_blood_type" value="" readonly >
          </div>

          <div class="md-form donor_blood_status">
            <label data-error="wrong" data-success="right">Blood Status <span class="text-danger" >*</span></label>
            <select class="form-control" name="" id="edit_blood_status">
              <option value="">- Select Blood Status</option>
            </select>
            <input type="text" class="form-control" id="edit_blood_stat" value="" readonly >
          </div>

          <hr class="donor_hr_3">

          <div class="md-form donor_blood_quantity donor_blood_quantity2">
            <label data-error="wrong" data-success="right">Donate To <span class="text-danger" >*</span></label>
            <input type="text" class="form-control" id="edit_donate_to" value="" readonly >
          </div>

          <div class="md-form donor_blood_quantity">
            <label data-error="wrong" data-success="right">Donate Blood Quantity (in ml) <span class="text-danger" >*</span></label>
            <input type="number" class="form-control" id="edit_quantity_donor" value="" >
          </div>

          <div class="md-form donor_remarks" style="display: none;">
            <label data-error="wrong" data-success="right">Remarks <span class="text-danger" >*</span></label>
            <textarea id="edit_remarks" rows="3" class="form-control" readonly ></textarea>
          </div>

          <div class="text-center mt-3 donor_submit">
            <button type="button" class="btn btn-primary btn-block z-depth-1a" onclick="request_update_donor()" id="btn_donor" data-request_id="" data-status="" data-type="" >SUBMIT</button>
          </div>

        </div> 
      </form>

    </div>
  </div> 
</div>

<div class="modal fade" id="request_edit_modal_donee">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- username, lname, fname, gender, phone, user_type_id -->
  
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Update Request</h3>
        <button type="button" class="close d_cancel" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="d_form_insert_donee">
        <div class="modal-body mx-4">

          <!-- for status 1 -->
          <div class="md-form">
            <label data-error="wrong" data-success="right">Appoinment Date <span class="text-danger" >*</span></label>
            <input type="date" class="form-control" id="username1" value="2020-01-22" >
          </div>

          <hr class="">

          <!-- for donor status 2 -->
          <div class="md-form">
            <label data-error="wrong" data-success="right">Blood Type <span class="text-danger" >*</span></label>
            <!-- <select class="form-control" name="" id="">
              <option value="">- Select Blood Type</option>
            </select> -->
            <input type="text" class="form-control" id="username2" value="A+" readonly >
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Blood Status <span class="text-danger" >*</span></label>
            <!-- <select class="form-control" name="" id="">
              <option value="">- Select Blood Status</option>
            </select> -->
            <input type="text" class="form-control" id="username3" value="GOOD" readonly >
          </div>

          <hr>

          <!-- for donee status 2 -->

          

          <div class="text-center mt-3">
            <button type="button" class="btn btn-primary btn-block z-depth-1a" id="btn_donee">SUBMIT</button>
          </div>

        </div> 
      </form>

    </div>
  </div> 
</div>

<script>

  function request_edit(request_id)
  {

    $.ajax({
      url         : '../../includes/modules/blood/request_edit.php', 
      type        : 'POST',
      data        : {
        request_id : request_id
      },
      dataType    : 'JSON',
      beforeSend  : function () {
        $('#btn_donor').data('request_id', request_id);
      }
    }).done(function(res) {

      $('.donor_submit').removeClass('d-none');
      $('.donor_blood_quantity2').removeClass('d-none');
      $('#edit_quantity_donor').prop('disabled', false);

      $('.donor_quantity_donee').removeClass('d-none d-block'); 

      $('.donor_d_blood_type').removeClass('d-none d-block').addClass('d-none');

      $('.donor_appointed_by').removeClass('d-none d-block').addClass('d-none');
      $('.donor_date_appointed').removeClass('d-none d-block').addClass('d-none');

      $('.donor_checked_by').removeClass('d-none d-block').addClass('d-none');
      $('.donor_date_checked').removeClass('d-none d-block').addClass('d-none');
      $('.donor_blood_type').removeClass('d-none d-block').addClass('d-none');
      $('.donor_blood_status').removeClass('d-none d-block').addClass('d-none');

      $('.donor_blood_quantity').removeClass('d-none d-block').addClass('d-none');
      $('.donor_remarks').removeClass('d-none d-block').addClass('d-none');

      $('.donor_hr_1').removeClass('d-none d-block').addClass('d-none');
      $('.donor_hr_2').removeClass('d-none d-block').addClass('d-none');
      $('.donor_hr_3').removeClass('d-none d-block').addClass('d-none');

      $('#btn_donor').data('type', res.request_type);
      $('#btn_donor').data('status', res.status);

      if (res.request_type == '1') {
        $('.donor_quantity_donee').addClass('d-none'); 
      }

      if (res.request_type == '0') {
        $('.donor_d_blood_type').removeClass('d-none'); 
      }

      if (res.status > 1) {
        $('.donor_hr_1').removeClass('d-none'); 
        $('.donor_appointed_by').removeClass('d-none');
        $('.donor_date_appointed').removeClass('d-none');

        $('#edit_blood_type').removeClass('d-none').addClass('d-none');
        $('#edit_blood_stat').removeClass('d-none').addClass('d-none');

        $('.donor_hr_2').removeClass('d-none'); 
        $('.donor_blood_type').removeClass('d-none');
        $('.donor_blood_status').removeClass('d-none');

        if (res.request_type == '0' && res.status == '2') {
        //   if (parseFloat(res.quantity_donor) >= parseFloat(res.quantity_donee)) {
            $('#btn_donor').prop('disabled', false);
        //   } else {
        //     $('#btn_donor').prop('disabled', true);
        //   }
        }

        if (res.request_type == '0') {
          $('.donor_blood_quantity').removeClass('d-none');
          $('.donor_blood_quantity2').addClass('d-none');
          // $('#edit_quantity_donor').prop('disabled', true);
        }
      }

      if (res.status > 2) {
        $('.donor_hr_3').removeClass('d-none'); 

        $('#edit_blood_type_id').addClass('d-none');
        $('#edit_blood_status').addClass('d-none');
        $('#edit_blood_type').removeClass('d-none');
        $('#edit_blood_stat').removeClass('d-none');

        $('.donor_checked_by').removeClass('d-none');
        $('.donor_date_checked').removeClass('d-none');
        $('.donor_blood_type').removeClass('d-none');
        $('.donor_blood_status').removeClass('d-none');

        $('.donor_blood_quantity').removeClass('d-none');
        $('.donor_remarks').removeClass('d-none');

        $('#edit_blood_quantity').prop('readonly', false);
        $('#edit_remarks').prop('readonly', false);

        if (res.request_type == '0') {
          $('.donor_hr_3').addClass('d-none');
        }
      }

      if (res.status > 3) {
        $('#edit_blood_quantity').prop('readonly', true);
        $('#edit_quantity_donor').prop('readonly', true);
        $('#edit_remarks').prop('readonly', true);
        $('.donor_submit').addClass('d-none');
        $('.donor_blood_quantity2').addClass('d-none');
      }

      if (res.status == 0) {
        $('.donor_hr_1').removeClass('d-none'); 
        $('.donor_hr_2').removeClass('d-none'); 
        $('.donor_hr_3').removeClass('d-none'); 
        
        $('#edit_blood_type_id').addClass('d-none');
        $('#edit_blood_status').addClass('d-none');

        $('.donor_appointed_by').removeClass('d-none d-block');
        $('.donor_date_appointed').removeClass('d-none d-block');

        $('.donor_checked_by').removeClass('d-none d-block');
        $('.donor_date_checked').removeClass('d-none d-block');
        $('.donor_blood_type').removeClass('d-none d-block');
        $('.donor_blood_status').removeClass('d-none d-block');

        $('.donor_blood_quantity').removeClass('d-none d-block');
        $('.donor_remarks').removeClass('d-none d-block');
        $('.donor_submit').addClass('d-none');
        $('#edit_quantity_donor').prop('readonly', true);
      }

      // data
      $('#edit_prospect_name').val(res.prospect_name);
      $('#edit_donate_to').val(res.donate_to);
      $('#edit_quantity_donor').val(res.quantity_donor);
      $('#edit_quantity_donee').val(res.quantity_donee);
      $('#edit_type').val(res.type);
      $('#edit_date_inserted').val(res.date_inserted);

      html  = '';
      max   = parseInt(res.status) + 1;
      if (parseInt(res.status) == '2' && res.request_type == '0') {
        html += '<option value="0" >DECLINED</option>';
        html += '<option value="2" selected >APPROVED</option>';
        html += '<option value="4" >DONE</option>';
      } else {
        $.each(res.statuses, function(key, value) {
          if ((res.status <= key || key == 0) && key <= max) {
            html += (key == res.status) ? '<option value="' + key + '" selected >' + value + '</option>' : '<option value="' + key + '">' + value + '</option>';
          }
        });
      }
      if (res.status == 4) {
        html = '<option value="4">DONE</option>';
      }

      $('#edit_status').html(html);

      $('#edit_appointed_by').val(res.appointed_by);
      $('#edit_date_appointed').val(res.date_appointed);

      $('#edit_checked_by').val(res.checked_by);
      $('#edit_date_checked').val(res.date_checked);

      html  = '';
      $.each(res.blood_types, function(key, value) {
        html += (value.blood_type_id == res.blood_type_id) ? '<option value="' + value.blood_type_id + '" selected >' + value.name + '</option>' : '<option value="' + value.blood_type_id + '">' + value.name + '</option>';
      });
      $('#edit_blood_type_id').html(html);
      $('#edit_blood_type').val(res.blood_type);
      $('#edit_d_blood_type').val(res.blood_type);

      html  = '';
      $.each(res.blood_statuses, function(key, value) {
        if (key == '1') {
          html += '<option value="' + key + '" selected >' + value + '</option>';
        } else {
          html += '<option value="' + key + '">' + value + '</option>';
        }
      });
      $('#edit_blood_status').html(html);
      $('#edit_blood_stat').val(res.blood_status);

      $('#edit_quantity_donor').val(res.quantity_donor);

      if (res.request_type == '0') {
        $('.donor_blood_type').addClass('d-none'); 
        $('.donor_blood_status').addClass('d-none'); 
      }

      $('#request_edit_modal_donor').modal('show');

    }).fail(function() {
      console.log('Fail!');
    });

  }

  function request_update_donor()
  {

    let d_type      = $('#btn_donor').data('type');
    let request_id  = $('#btn_donor').data('request_id');
    let status      = $('#btn_donor').data('status');
    let edit_status = $('#edit_status').val();

    let edit_blood_type_id  = $('#edit_blood_type_id').val();
    let edit_blood_status   = $('#edit_blood_status').val();

    let edit_quantity_donor = $('#edit_quantity_donor').val();

    if (status == '1') {
      edit_blood_type_id  = '';
      edit_blood_status   = '';
    }

    if (status == '3' && edit_quantity_donor == 0 && edit_status != '0') {
      alert('Invalid! Quantity is zero.');
      return false;
    }

    $.ajax({
      url         : '../../includes/modules/blood/request_update.php',
      type        : 'POST',
      data        : {
        d_type              : d_type, 
        request_id          : request_id, 
        status              : status, 
        edit_blood_type_id  : edit_blood_type_id, 
        edit_blood_status   : edit_blood_status, 
        edit_quantity_donor : edit_quantity_donor, 
        edit_status         : edit_status
      },
      dataType    : 'JSON',
      beforeSend  : function() {
        $('#btn_donor').prop('disabled', true);
      }
    }).done(function(res) {
        if (res.res_success == '1') {
            window.location.reload();   
        } else {
            alert(res.res_message);
            $('#btn_donor').prop('disabled', false);
        }
    });

  }

</script>

<!-- content code end here -->

<?php 
require_once '../../footer.php'; 
?>