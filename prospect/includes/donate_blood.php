<?php 

$module = 'donate'; 

$has_pending = 0;

$donations = array();

$query = "
  SELECT * 
  FROM requests 
  WHERE 
    prospect_id = '".$_SESSION['user']['prospect_id']."' 
    AND status IN (1,2,3)
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  $has_pending = 1;
}

$query = "
  SELECT 
    req.*, 
    bt.name as bt_name, 
    pros.lname AS p_lname, pros.fname AS p_fname, pros.mname AS p_mname
  FROM requests as req 
  LEFT JOIN blood_types AS bt ON req.blood_type_id = bt.blood_type_id 
  LEFT JOIN requests AS req2 ON req.donate_to = req2.request_id  
  LEFT JOIN prospects AS pros ON req2.prospect_id = pros.prospect_id 
  WHERE 
    req.prospect_id = '".$_SESSION['user']['prospect_id']."' 
    AND req.type = '1'
  ORDER BY req.request_id DESC
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $blood_status = '-';
    if ($row['status'] > 2) {
      if ($row['blood_status']) {
        $blood_status = '<span class="bg-success" style="padding: 3px 8px; color: white;">GOOD</span>';
      } else {
        $blood_status = '<span class="bg-danger" style="padding: 3px 8px; color: white;">BAD</span>';
      }
    }

    $status = '';
    if ($row['status'] < 1) {
      $status = '<span class="bg-danger" style="padding: 3px 8px; color: white;">DECLINED</span>';
    } else if ($row['status'] < 2) {
      $status = '<span class="bg-info" style="padding: 3px 8px; color: white;">PENDING</span>';
    } else if ($row['status'] < 3) {
      $status = '<span class="bg-info" style="padding: 3px 8px; color: white;">APPROVED</span>';
    } else if ($row['status'] < 4) {
      $status = '<span class="bg-info" style="padding: 3px 8px; color: white;">CHECKED</span>';
    } else {
      $status = '<span class="bg-success" style="padding: 3px 8px; color: white;">DONE</span>';
    }

    $donate_to = '';
    if ($row['donate_to'] > 0) {
      $donate_to = $row['p_fname'].' '.$row['p_mname'].' '.$row['p_lname'];
    }

    $temp_arr['request_id']     = $row['request_id'];
    $temp_arr['date_appt']      = ($row['date_appt'] != '0000-00-00') ? date('M d-y', strtotime($row['date_appt'])) : '-';
    $temp_arr['date_requested'] = date('M d/y h:i A', strtotime($row['date_inserted']));
    $temp_arr['date_approved']  = ($row['date_appointment'] != '0000-00-00 00:00:00') ? date('M d/y h:i A', strtotime($row['date_appointment'])) : '-';
    $temp_arr['date_checked']   = ($row['date_checked'] != '0000-00-00 00:00:00') ? date('M d/y h:i A', strtotime($row['date_checked'])) : '-';
    $temp_arr['blood_type']     = ($row['bt_name']) ? $row['bt_name'] : '-';
    $temp_arr['blood_status']   = $blood_status;
    $temp_arr['quantity']       = ($row['quantity_donor'] > 0) ? $row['quantity_donor'] : '-';
    $temp_arr['date_done']      = ($row['date_done']) ? date('M d/y h:i A', strtotime($row['date_done'])) : '-';;
    $temp_arr['donate_to']      = $donate_to;
    $temp_arr['status_html']    = $status;
    $temp_arr['status']         = $row['status'];

    $donations[] = $temp_arr;
  }
}

?>