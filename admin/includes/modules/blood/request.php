<?php 

require_once '../../includes/connection.php'; 

$requests = array();

$query = "
  SELECT 
    req.*, 
    pros.lname, pros.fname, pros.mname, 
    pros2.lname as p_lname, pros2.fname as p_fname, pros2.mname as p_mname, 
    bt.name AS bt_name
  FROM requests AS req
  LEFT JOIN prospects as pros ON req.prospect_id = pros.prospect_id
  LEFT JOIN blood_types as bt ON req.blood_type_id = bt.blood_type_id
  LEFT JOIN requests as req2 ON req.donate_to = req2.request_id
  LEFT JOIN prospects as pros2 ON req2.prospect_id = pros2.prospect_id
  ORDER BY req.date_inserted DESC 
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    // request type
    $req_type = '';
    if ($row['type']) {
      $req_type = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">DONATE</span>';
    } else {
      $req_type = '<span class="bg-danger text-white" style="padding: 3px 8px; border-radius: 5px;">GET</span>';
    }

    $approved_by = '-';
    if ($row['appointed_by']) {
      $result_2 = mysqli_query($db, "SELECT * FROM users WHERE user_id = '".$row['appointed_by']."'");
      if (mysqli_num_rows($result_2) > 0) {
        $row_2 = mysqli_fetch_assoc($result_2);
        $approved_by = $row_2['lname'].', '.$row_2['fname'];
      }
    }

    $checked_by = '-';
    if ($row['checked_by']) {
      $result_3 = mysqli_query($db, "SELECT * FROM users WHERE user_id = '".$row['checked_by']."'");
      if (mysqli_num_rows($result_3) > 0) {
        $row_3 = mysqli_fetch_assoc($result_3);
        $checked_by = $row_3['lname'].', '.$row_3['fname'];
      }
    }

    // blood status
    $blood_status = '-';
    if ($row['status'] > 2 && $row['type'] == '1') {
      if ($row['blood_status'] == '1') {
        $blood_status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">GOOD</span>';
      } else if ($row['blood_status'] == '0') {
        $blood_status = '<span class="bg-danger text-white" style="padding: 3px 8px; border-radius: 5px;">BAD</span>';
      }
    }

    // status
    $status = '';
    if (!$row['status']) {
      $status = '<span class="bg-danger text-white" style="padding: 3px 8px; border-radius: 5px;">DECLINED</span>';
    } 
    if ($row['status'] == '1') {
      $status = '<span class="bg-info text-white" style="padding: 3px 8px; border-radius: 5px;">PENDING</span>';
    }
    if ($row['status'] == '2') {
      $status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">APPROVED</span>';
    }
    if ($row['status'] == '3') {
      $status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">CHECKED</span>';
    }
    if ($row['status'] == '4') {
      $status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">DONE</span>';
    }

    $date_requested   = date('M d/y h:i A', strtotime($row['date_inserted']));
    $date_appointment = date('M d/y h:i A', strtotime($row['date_appt']));
    $date_approved    = date('M d/y h:i A', strtotime($row['date_appointment']));
    $date_checked     = date('M d/y h:i A', strtotime($row['date_checked']));

    // remarks
    $remarks = '-';
    if ($row['remarks']) {
      $remarks = '';
      $remarks = $row['remarks'];
      // $temp_remarks = $row['remarks'];
      // $temp_remarks = explode(',', $temp_remarks);

      // foreach ($temp_remarks as $tr) {
      //   $temp_result = mysqli_query($db, "SELECT * FROM prospects WHERE prospect_id = '$tr'");
      //   if (mysqli_num_rows($temp_result) > 0) {
      //     $temp_row = mysqli_fetch_assoc($temp_result);
      //     $temp_name = $temp_row['lname'].', '.$temp_row['fname'].' '.$temp_row['mname'];
      //     if (!$remarks) {
      //       $remarks .= $temp_name;
      //     } else {
      //       $remarks .= '<br>'.$temp_name;
      //     }
      //   }
      // }
    }

    $blood_type = '-';
    if ($row['bt_name']) {
      $blood_type = $row['bt_name'];
    }

    if ($row['status'] > 0 && $row['status'] < 2) { //pending
      $approved_by        = '-';
      $date_appointment   = '-';
      $checked_by         = '-';
      $date_checked       = '-';
      $blood_status       = '-';
      $date_approved = '-';
    } else if ($row['status'] > 0 && $row['status'] < 3) { // approved
      $checked_by         = '-';
      $date_checked       = '-';
      $blood_status       = '-';
    }

    $quantity_donee = '-';
    $quantity_donor = '-';
    if ($row['type']) {
      $quantity_donor = ($row['quantity_donor'] + 0).' ml';
    } else {
      if ($row['status'] >= 2) {
        $quantity_donor = ($row['quantity_donor'] + 0).' ml';
      }
      $quantity_donee = ($row['quantity_donee'] + 0).' ml';
    }

    $donate_to = '-';
    if ($row['donate_to']) {
      $donate_to = $row['p_lname'].', '.$row['p_fname'].' '.$row['p_mname'];
    }
    
    if (!$row['status']) {
        $date_checked = '-';
    }

    $temp_arr['request_id']       = $row['request_id'];
    $temp_arr['prospect']         = $row['lname'].', '.$row['fname'].' '.$row['mname'];
    $temp_arr['quantity_donee']   = $quantity_donee;
    $temp_arr['quantity_donor']   = $quantity_donor;
    $temp_arr['req_type']         = $req_type;
    $temp_arr['donate_to']        = $donate_to;
    $temp_arr['date_requested']   = $date_requested;
    $temp_arr['approved_by']      = $approved_by;
    $temp_arr['date_appointment'] = $date_appointment;
    $temp_arr['date_approved']    = $date_approved;
    $temp_arr['checked_by']       = $checked_by;
    $temp_arr['date_checked']     = $date_checked;
    $temp_arr['blood_type']       = $blood_type;
    $temp_arr['blood_status']     = $blood_status;
    $temp_arr['remarks']          = $remarks;
    $temp_arr['status']           = $status;
    $temp_arr['d_req_type']       = $row['type'];
    $temp_arr['d_status']         = $row['status'];

    $requests[] = $temp_arr;    
  }
}

?>