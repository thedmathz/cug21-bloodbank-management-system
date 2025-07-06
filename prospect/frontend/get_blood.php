<?php include('../includes/connection.php'); ?>
<?php include('../includes/session.php'); ?>
<?php include('../includes/get_blood.php'); ?>
<?php include('header.php'); ?>

<!-- content -->
<section>
    
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
      <div class="col">
        <div class="card radius-10">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-center">
    					<img src="../assets/images/bloods/a+.png" alt="">
    					<div style="position: absolute; bottom: 15px; left: 20px; font-size: 16px;"><?php echo $a_plus; ?> bags</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card radius-10">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-center">
    					<img src="../assets/images/bloods/b+.png" alt="">
    					<div style="position: absolute; bottom: 15px; left: 20px; font-size: 16px;"><?php echo $b_plus; ?> bags</div>
            </div>
          </div>
        </div>
      </div>
    	<div class="col">
        <div class="card radius-10">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-center">
    					<img src="../assets/images/bloods/ab+.png" alt="">
    					<div style="position: absolute; bottom: 15px; left: 20px; font-size: 16px;"><?php echo $ab_plus; ?> bags</div>
            </div>
          </div>
        </div>
      </div>
    	<div class="col">
        <div class="card radius-10">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-center">
    					<img src="../assets/images/bloods/o+.png" alt="">
    					<div style="position: absolute; bottom: 15px; left: 20px; font-size: 16px;"><?php echo $o_plus; ?> bags</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
      <div class="col">
        <div class="card radius-10">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-center">
    					<img src="../assets/images/bloods/a-.png" alt="">
    					<div style="position: absolute; bottom: 15px; left: 20px; font-size: 16px;"><?php echo $a_minus; ?> bags</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card radius-10">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-center">
    					<img src="../assets/images/bloods/b-.png" alt="">
    					<div style="position: absolute; bottom: 15px; left: 20px; font-size: 16px;"><?php echo $b_minus; ?> bags</div>
            </div>
          </div>
        </div>
      </div>
    	<div class="col">
        <div class="card radius-10">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-center">
    					<img src="../assets/images/bloods/ab-.png" alt="">
    					<div style="position: absolute; bottom: 15px; left: 20px; font-size: 16px;"><?php echo $ab_minus; ?> bags</div>
            </div>
          </div>
        </div>
      </div>
    	<div class="col">
        <div class="card radius-10">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-center">
    					<img src="../assets/images/bloods/o-.png" alt="">
    					<div style="position: absolute; bottom: 15px; left: 20px; font-size: 16px;"><?php echo $o_minus; ?> bags</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  <div class="row">
    <div class="p-0 m-0 d-flex">
      <h3>History Requests</h3>
      <div style="flex:1;"></div>
      <button class="btn btn-info text-white btn-raised btn-sm" onclick="search()" >Search Blood</button>
      <button class="btn btn-primary btn-raised btn-sm" onclick="request('<?php echo $has_request; ?>')" style="margin-left: 8px;" >Get Blood</button>
    </div>
    <div class="bg-white" style="margin-top: 10px; overflow-x: auto;">
      <table class="table">
        <thead>
          <tr>
              <th class="text-center" style="white-space: nowrap;">Date Appointment</th>
            <th class="text-center" style="white-space: nowrap;">Blood Type</th>
            <th class="text-center" style="white-space: nowrap;">Quantity</th>
            <th class="text-center" style="white-space: nowrap;">Date Requested</th>
            <th class="text-center" style="white-space: nowrap;">Date Approved</th>
            <th class="text-center" style="white-space: nowrap;">Date Done</th>
            <th class="text-center" style="white-space: nowrap;">Donated By</th>
            <th class="text-center" style="white-space: nowrap;">Status</th>
            <th class="text-center" style="white-space: nowrap;">Action</th>
          </tr>
        </thead>
        <tbody>

          <?php 
          if ($requests) {
            foreach ($requests as $request) {
              ?>

              <tr>
                  <td class="text-center" style="white-space: nowrap; font-size: 13px; vertical-align: middle;"><?php echo $request['date_appt']; ?></td>
                <td class="text-center" style="white-space: nowrap; font-size: 13px; vertical-align: middle;"><?php echo $request['blood_type']; ?></td>
                <td class="text-center" style="white-space: nowrap; font-size: 13px; vertical-align: middle;"><?php echo $request['quantity']; ?></td>
                 <td class="text-center" style="white-space: nowrap; font-size: 13px; vertical-align: middle;"><?php echo $request['date_requested']; ?></td>
                <td class="text-center" style="white-space: nowrap; font-size: 13px; vertical-align: middle;"><?php echo $request['date_approved']; ?></td>
                <td class="text-center" style="white-space: nowrap; font-size: 13px; vertical-align: middle;"><?php echo $request['date_done']; ?></td>
                <td class="text-center" style="white-space: nowrap; font-size: 13px; vertical-align: middle;">
                  <?php 
                  if ($request['donate_by']) {
                    echo $request['donate_by'];
                  } else {
                    ?>
                      <span class="text-white bg-danger me-2" style="padding: 5px 12px; font-size: 13px;">Unknown</span>
                    <?php
                  }
                  ?>
                  <?php 
                  if ($request['status'] == '3') { 
                    ?>
                    <button class="btn btn-sm btn-raised btn-info text-white" onclick="donate_blood_search('<?php echo $request['request_id']; ?>')" ><i class="bx bx-search me-0 ms-0"></i></button>
                    <?php 
                  } 
                  ?>
                </td>
                <td class="text-center" style="white-space: nowrap; font-size: 13px; vertical-align: middle;"><?php echo $request['status_html']; ?></td>
                <td class="text-center" style="white-space: nowrap; font-size: 13px; vertical-align: middle;">
                  <?php if ($request['status'] == '1') { ?>
                    <button class="btn btn-sm btn-raised btn-danger" onclick="donate_blood_delete('<?php echo $request['request_id']; ?>')" ><i class="bx bx-trash me-0 ms-0"></i></button>
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
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Search Donors</h3>
        <button type="button" class="close d_cancel" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <div class="modal-body mx-4">

        <div class="mb-4" style="overflow-y: auto;">
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
                  <input type="text" class="form-control" placeholder="Last Name" id="d_lname" >
                </th>
                <th class="text-center">
                  <select name="" id="d_barangay_id" class="form-control">
                    <option value="">- Select Barangay</option>
                  </select>
                </th>
                <th class="text-center">
                  <select name="" id="d_blood_type_id" class="form-control">
                    <option value="">- Select Blood Type</option>
                  </select>
                </th>
                <th class="text-center">
                  <button class="btn btn-primary btn-raised btn-sm" onclick="get_search()" >SEARCH</button>
                </th>
              </tr>
            </thead>
            <tbody id="tbl_body">
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
                  <div class=""><span class="bg-success text-white" style="padding: 3px 8px;">Requested</span></div>
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

  function get_blood_req(prospect_id)
  {

    $.ajax({
      url         : '../includes/get_blood_req.php',
      type        : 'POST',
      data        : {prospect_id:prospect_id},
      dataType    : 'JSON',
      beforeSend  : function() {}
    }).done(function(res) {
      get_search();
    });

  }

  function get_search()
  {

    $.ajax({
      url         : '../includes/get_search.php',
      type        : 'POST',
      data        : {
        lname         : $('#d_lname').val(), 
        barangay_id   : $('#d_barangay_id').val(), 
        blood_type_id : $('#d_blood_type_id').val()
      },
      dataType    : 'JSON',
      beforeSend  : function() {
        $('#tbl_body').html('<tr><td class="text-center" colspan="4">Loading Records...</td></tr>');
      }
    }).done(function(res) {

      html = '<tr><td class="text-center text-danger" colspan="4">No Record Found</td></tr>';

      if (res.searches.length > 0) {
        html = '';
        $.each(res.searches, function(key, value) {
          html += '<tr>';
          html +=   '<td class="text-start">' + value.name + '</td>';
          html +=   '<td class="text-start">' + value.barangay + '</td>';
          html +=   '<td class="text-center">' + value.blood_type + '</td>';
          html +=   '<td class="text-center">';
          html +=   (value.status == '1') ? '<div class=""><span class="bg-success text-white" style="padding: 3px 8px;">Requested</span></div>' : '<button class="btn btn-raised btn-primary btn-sm" onclick="get_blood_req(' + value.prospect_id + ')" >Request</button>';
          html +=   '</td>';
          html += '</tr>';
        });
      }

      $('#tbl_body').html(html);

    });

  }

  function search()
  {

    $.ajax({
      url         : '../includes/search.php',
      type        : 'POST',
      data        : {
        
      },
      dataType    : 'JSON',
      beforeSend  : function() {
        $('#tbl_body').html('<tr><td class="text-center" colspan="4">Loading Records...</td></tr>');
      }
    }).done(function(res) {

      html = '<option value="">- Select Barangay</option>';
      $.each(res.barangays, function(key, value) {
        html += '<option value="' + value.barangay_id + '">' + value.name + '</option>';
      });
      $('#d_barangay_id').html(html);

      html = '<option value="">- Select Blood Type</option>';
      $.each(res.blood_types, function(key, value) {
        html += '<option value="' + value.blood_type_id + '">' + value.name + '</option>';
      });
      $('#d_blood_type_id').html(html);

      get_search();
      $('#searchModal').modal('show');
    });

  }

  function request(has_request = 1)
  {

    if (has_request != 0) {
      Swal.fire(
        'Invalid!',
        'You still have unfinished transaction.',
        'warning'
      )
    } else {
      let html = '';

      $.ajax({
        url         : '../includes/get_blood_types.php',
        type        : 'POST',
        data        : {},
        dataType    : 'JSON',
        beforeSend  : function() {

        }
      }).done(function(res) {
          
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
        html += '<input type="date" id="d_app" min="' + today + '" class="form-control mb-2" />';
        html += '<div class="d-flex mb-2">';
        html +=   '<select class="form-control me-2" id="d_blood_type_id2" style="width: 150px;">';
        html +=     '<option value=""selected hidden>- Blood Type</option>';
        $.each(res.blood_types, function(key, value) {
          html += '<option value="' + value.blood_type_id + '" data-unit="' + value.per_bag + '">' + value.name + '</option>';
        });
        html +=   '</select>';
        html +=   '<select class="form-control" id="d_bags" >';
        html +=     '<option value="" selected hidden>- Select Bags</option>';
        html +=     '<option value="1">1 Bag</option>';
        html +=     '<option value="2">2 Bags</option>';
        html +=     '<option value="3">3 Bags</option>';
        html +=     '<option value="4">4 Bags</option>';
        html +=     '<option value="5">5 Bags</option>';
        html +=     '<option value="6">6 Bags</option>';
        html +=     '<option value="7">7 Bags</option>';
        html +=     '<option value="8">8 Bags</option>';
        html +=     '<option value="9">9 Bags</option>';
        html +=     '<option value="10">10 Bags</option>';
        html +=   '</select>';
        html += '</div>';
        html += '<textarea class="w-100 form-control"id="d_reason" placeholder="Type your reason.."></textarea>';
        // html += '<input type="file" class="w-100 form-control" style="margin-top: 8px;" >';

        Swal.fire({
          title: 'Request to Get Blood?',
          html: html,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Submit',
        }).then((result) => {
          if (result.isConfirmed) {
              
              let app = $('#d_app').val();

            let blood_type_id = $('#d_blood_type_id2').val();
            let bags          = $('#d_bags').val();
            let reason        = $('#d_reason').val();

            if (app == '') {
                alert('Please select Appointment Date!');
            } else if (blood_type_id == '') {
              alert('Please select blood type!');
            } else if (bags == '') {
              alert('Please select number of bags!');
            } else {

              let ml = bags * $('#d_blood_type_id2').find(':selected').data('unit'); 

              $.ajax({
                url         : '../includes/request.php',
                type        : 'POST',
                data        : {
                    app : app, 
                  blood_type_id : blood_type_id, 
                  bags          : bags, 
                  reason        : reason, 
                  ml            : ml
                },
                dataType    : 'JSON',
                beforeSend  : function() {}
              }).done(function(res) {
                window.location.reload();
              });

            }


          }
        });
      });

    }

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