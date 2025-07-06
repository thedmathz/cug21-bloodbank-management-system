<?php include('../includes/connection.php'); ?>
<?php include('../includes/session.php'); ?>
<?php include('../includes/donate_blood.php'); ?>
<?php include('header.php'); ?>

<style>
  .d_ahem:hover {
    color: red;
    cursor: pointer;
    font-weight: bold;
  }
</style>

<!-- content -->
<section>
    
  <div class="row">
    <div class="p-0 m-0 d-flex">
      <h3>My Donations</h3>
      <div style="flex:1;"></div>
      <button class="btn btn-primary btn-raised btn-sm" onclick="donate('<?php echo $has_pending; ?>')" >Donate</button>
    </div>
    <div class="bg-white" style="margin-top: 10px; overflow-x: auto;">
      <table class="table">
        <thead>
          <tr>
            <th class="text-center" style="white-space: nowrap;">Date Appointment</th>
            <th class="text-center" style="white-space: nowrap;">Date Requested</th>
            <th class="text-center" style="white-space: nowrap;">Date Approved</th>
            <th class="text-center" style="white-space: nowrap;">Date Checked</th>
            <th class="text-center" style="white-space: nowrap;">Blood Type</th>
            <th class="text-center" style="white-space: nowrap;">Blood Status</th>
            <th class="text-center" style="white-space: nowrap;">Quantity (in ml)</th>
            <th class="text-center" style="white-space: nowrap;">Date Done</th>
            <th class="text-center" style="white-space: nowrap;">Donate To</th>
            <th class="text-center" style="white-space: nowrap;">Status</th>
            <th class="text-center" style="white-space: nowrap;">Action</th>
          </tr>
        </thead>
        <tbody>

          <?php 
          if ($donations) {
            foreach ($donations as $donation) {
              ?>

              <tr>
                <td class="text-center" style="white-space: nowrap; font-size: 13px; vertical-align: middle;"><?php echo $donation['date_appt']; ?></td>
                <td class="text-center" style="white-space: nowrap; font-size: 13px; vertical-align: middle;"><?php echo $donation['date_requested']; ?></td>
                <td class="text-center" style="white-space: nowrap; font-size: 13px; vertical-align: middle;"><?php echo $donation['date_approved']; ?></td>
                <td class="text-center" style="white-space: nowrap; font-size: 13px; vertical-align: middle;"><?php echo $donation['date_checked']; ?></td>
                <td class="text-center" style="white-space: nowrap; font-size: 13px; vertical-align: middle;"><?php echo $donation['blood_type']; ?></td>
                <td class="text-center" style="white-space: nowrap; font-size: 13px; vertical-align: middle;"><?php echo $donation['blood_status']; ?></td>
                <td class="text-center" style="white-space: nowrap; font-size: 13px; vertical-align: middle;"><?php echo $donation['quantity']; ?></td>
                <td class="text-center" style="white-space: nowrap; font-size: 13px; vertical-align: middle;"><?php echo $donation['date_done']; ?></td>
                <td class="text-center" style="white-space: nowrap; font-size: 13px; vertical-align: middle;">
                  <?php 
                  if ($donation['donate_to']) {
                    ?>
                      <span class="text-white bg-success me-2" style="padding: 5px 12px; font-size: 13px;"><?php echo $donation['donate_to']; ?><?php if ($donation['status'] != '4' && $donation['status'] != '0') { ?>&nbsp;&nbsp;&nbsp;<span class="d_ahem" onclick="donate_blood_remove_donee('<?php echo $donation['request_id']; ?>')" style="font-size: 16px;">&times;</span><?php } ?></span>
                    <?php
                  } else {
                    ?>
                      <span class="text-white bg-danger me-2" style="padding: 5px 12px; font-size: 13px;">Unknown</span>
                    <?php
                  }
                  ?>
                  <?php 
                  if ($donation['status'] == '3') { 
                    ?>
                    <button class="btn btn-sm btn-raised btn-info text-white" onclick="donate_blood_search('<?php echo $donation['request_id']; ?>')" ><i class="bx bx-search me-0 ms-0"></i></button>
                    <?php 
                  } 
                  ?>
                </td>
                <td class="text-center" style="white-space: nowrap; font-size: 13px; vertical-align: middle;"><?php echo $donation['status_html']; ?></td>
                <td class="text-center" style="white-space: nowrap; font-size: 13px; vertical-align: middle;">
                  <?php if ($donation['status'] == '1') { ?>
                    <button class="btn btn-sm btn-raised btn-danger" onclick="donate_blood_delete('<?php echo $donation['request_id']; ?>')" ><i class="bx bx-trash me-0 ms-0"></i></button>
                  <?php } else { ?>
                    -
                  <?php } ?>
                </td>
              </tr>

              <?php
            }
          } else {
            ?>

            <tr>
              <td class="text-center text-center text-danger" colspan="10" >No Record Found</td>
            </tr>

            <?php
          }
          ?>

        </tbody>
      </table>
    </div>
  </div>
</section>
<!-- /content -->

<div class="modal fade" id="searchModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Search Donee</h3>
        <button type="button" class="close d_cancel" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <div class="modal-body mx-4">

        <div class="mb-4" style="overflow: auto;">
          <table class="table">
            <thead>
              <tr>
                <th style="white-space: nowrap;" class="text-start">Name</th>
                <th style="white-space: nowrap;" class="text-start">Barangay</th>
                <th style="white-space: nowrap;" class="text-center">Blood Type</th>
                <th style="white-space: nowrap;" class="text-center">Action</th>
              </tr>
              <tr>
                <th class="text-start">
                  <input type="text" class="form-control" id="search_lname" placeholder="Last name" >
                </th>
                <th class="text-center">
                  <select name="" id="search_barangay_id" class="form-control">
                    <option value="">- Select Barangay</option>
                  </select>
                </th>
                <th class="text-center">
                  <select name="" id="search_blood_type_id" class="form-control">
                    <option value="">- Select Blood Type</option>
                  </select>
                </th>
                <th class="text-center">
                  <button class="btn btn-primary btn-raised btn-sm"  >SEARCH</button>
                </th>
              </tr>
            </thead>
            <tbody id="d_body">
              <tr>
                <td class="text-start">Name</td>
                <td class="text-start">Barangay 1</td>
                <td class="text-center">A+</td>
                <td class="text-center">
                  <button class="btn btn-raised btn-primary btn-sm">Request</button>
                </td>
              </tr>
              <tr>
                <td class="text-start">Name</td>
                <td class="text-start">Barangay 1</td>
                <td class="text-center">A-</td>
                <td class="text-center">
                  <div class="">
                    <span class="bg-success text-white" style="padding: 3px 8px;">Requested</span>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
                    
      </div>
      
    </div>
  </div> 
</div>

<script>

  function donate(has_pending)
  {

    if (has_pending == '1') {
      Swal.fire(
        'Invalid!',
        'You still have unfinished transaction.',
        'warning'
      )
    } else {
        
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        
        if (dd < 10) {
           dd = '0' + dd;
        }
        
        if (mm < 10) {
           mm = '0' + mm;
        } 
            
        today = yyyy + '-' + mm + '-' + dd;
        
        html = '';
        html += '<label style="width: 100%; text-align: left;">Appointment Date:</label>';
        html += '<input type="date" id="d_app" min="' + today + '"  class="form-control mb-2" />';
        
        
      Swal.fire({
        title: 'Request to Donate Blood?',
        html : html,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm',
      }).then((result) => {
        if (result.isConfirmed) {
            
            let app = $('#d_app').val();
            
            if (app != '') {
                
                  $.ajax({
                    url         : '../includes/donate_blood_insert.php',
                    type        : 'POST',
                    data        : {app : app},
                    dataType    : 'JSON',
                    beforeSend  : function() {}
                  }).done(function(res) {
                    window.location.reload();
                  });
                
            } else {
                alert('Please select Appointment Date!');
            }
            
        }
      });

    }

  }

  function donate_blood_donee_list(request_id)
  {

    $.ajax({
      url         : '../includes/donate_blood_donee_list.php',
      type        : 'POST',
      data        : {
        request_id    : request_id,
        lname         : $('#search_lname').val(),
        barangay_id   : $('#search_barangay_id').val(),
        blood_type_id : $('#search_blood_type_id').val()
      },
      dataType    : 'JSON',
      beforeSend  : function() {
        html = '';
        html += '<tr>';
        html +=   '<td class="text-center text-danger" colspan="4" >Loading Records...</td>';
        html += '</tr>';
        $('#d_body').html(html);
      }
    }).done(function(res) {

      console.log(res);

      html = '';
      html += '<tr>';
      html +=   '<td class="text-center text-danger" colspan="4" >No Record Found</td>';
      html += '</tr>';
      if (res.donees.length > 0) {
        html = '';
        $.each(res.donees, function(key, value) {
          html += '<tr>';
          html +=   '<td style="white-space: nowrap;" class="text-start">' + value.name + '</td>';
          html +=   '<td style="white-space: nowrap;" class="text-start">' + value.barangay + '</td>';
          html +=   '<td style="white-space: nowrap;" class="text-center">' + value.blood_type + '</td>';
          html +=   '<td style="white-space: nowrap;" class="text-center">';
          if (value.selected) {
            html += '<span class="text-white bg-success" style="font-size: 13px; padding: 3px 8px;">SELECTED</span>';
          } else {
            html += '<button class="btn btn-raised btn-primary btn-sm" onclick="donate_blood_select(' + res.request_id + ', ' + value.request_id + ')">SELECT</button>';
          }
          html +=   '</td>';
          html += '</tr>';
        });
      } 
      $('#d_body').html(html);

    });

  }

  function donate_blood_select(d_request_id, request_id)
  {

    $.ajax({
      url         : '../includes/donate_blood_select.php',
      type        : 'POST',
      data        : {
        d_request_id  : d_request_id, 
        request_id    : request_id
      },
      dataType    : 'JSON',
      beforeSend  : function() {

      }
    }).done(function() {
      window.location.reload();
    });

  }

  function donate_blood_search(request_id)
  {

    $.ajax({
      url         : '../includes/donate_blood_search.php',
      type        : 'POST',
      data        : {
        request_id : request_id
      },
      dataType    : 'JSON',
      beforeSend  : function() {

      }
    }).done(function(res) {

      html = '<option value="">- Select Barangay</option>';
      $.each(res.barangays, function (key, value) {
        html += '<option value="' + value.barangay_id + '">' + value.name + '</option>';
      });
      $('#search_barangay_id').html(html);

      html = '<option value="">- Select Blood Type</option>';
      $.each(res.blood_types, function (key, value) {
        html += '<option value="' + value.blood_type_id + '">' + value.name + '</option>';
      });
      $('#search_blood_type_id').html(html);

      donate_blood_donee_list(request_id);
      $('#searchModal').modal('show');
    });

  }

  function donate_blood_remove_donee(request_id)
  {

    $.ajax({
      url         : '../includes/donate_blood_remove_donee.php',
      type        : 'POST',
      data        : {
        request_id : request_id
      },
      dataType    : 'JSON',
      beforeSend  : function() {

      }
    }).done(function(res) {
      window.location.reload();
    });

  }

  function donate_blood_delete(request_id)
  {

    $.ajax({
      url         : '../includes/donate_blood_delete.php',
      type        : 'POST',
      data        : {request_id:request_id},
      dataType    : 'JSON',
      beforeSend  : function() {

      }
    }).done(function() {
      window.location.reload();
    }); 

  }

</script>

<?php include('footer.php'); ?>