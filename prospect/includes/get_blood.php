<?php 

$module = 'get';

$has_request = 0;

$a_plus       = '0';
$a_minus      = '0';
$b_plus       = '0';
$b_minus      = '0';
$ab_plus      = '0';
$ab_minus     = '0';
$o_plus       = '0';
$o_minus      = '0';

$requests = array();

// for a+
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '1'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $a_plus   = floor($row['quantity']/$row2['unit_per_bag']);
}
// for a-
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '2'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $a_minus   = floor($row['quantity']/$row2['unit_per_bag']);
}
// for b+
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '3'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $b_plus   = floor($row['quantity']/$row2['unit_per_bag']);
}
// for b-
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '4'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $b_minus   = floor($row['quantity']/$row2['unit_per_bag']);
}
// for ab+
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '5'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $ab_plus   = floor($row['quantity']/$row2['unit_per_bag']);
}
// for ab-
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '6'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $ab_minus   = floor($row['quantity']/$row2['unit_per_bag']);
}
// for o+
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '7'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $o_plus   = floor($row['quantity']/$row2['unit_per_bag']);
}
// for o+
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '8'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $o_minus   = floor($row['quantity']/$row2['unit_per_bag']);
}

$query = "
  SELECT * 
  FROM requests 
  WHERE 
    prospect_id = '".$_SESSION['user']['prospect_id']."' 
    AND status IN (1,2,3)
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  $has_request = 1;
}

$query = "
  SELECT 
    req.*, 
    bt.name as bt_name, bt.unit_per_bag
  FROM requests as req 
  LEFT JOIN blood_types AS bt ON req.blood_type_id = bt.blood_type_id 
  WHERE 
    req.prospect_id = '".$_SESSION['user']['prospect_id']."' 
    AND req.type = '0'
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

    $donate_by = '';
    if ($row['donate_from'] != '') {
        $temp_donated_by = explode(', ', $row['donate_from']);
        foreach ($temp_donated_by as $tdb) {
            if (trim($tdb)) {
                $ss_query = "
                    SELECT 
                        pros.lname, pros.fname, pros.mname 
                    FROM prospects as pros 
                    LEFT JOIN requests as req ON pros.prospect_id = req.prospect_id
                    WHERE 
                        req.request_id = '$tdb'
                ";
                $ss_result = mysqli_query($db, $ss_query);
                if (mysqli_num_rows($ss_result) > 0) {
                    $ss_row = mysqli_fetch_assoc($ss_result);
                    $donate_by .= '<p class="text-white bg-success me-2" style="margin-bottom: 3px; padding: 5px 12px; font-size: 13px;">' . $ss_row['lname'] . ', ' . $ss_row['fname'] . ' ' . $ss_row['mname'] . '</p>';
                }
            }
        }
    }

    $temp_arr['request_id']     = $row['request_id'];
    $temp_arr['date_appt']      = ($row['date_appt'] != '0000-00-00') ? date('M d-y', strtotime($row['date_appt'])) : '-';
    $temp_arr['date_requested'] = date('M d/y h:i A', strtotime($row['date_inserted']));
    $temp_arr['date_approved']  = ($row['date_appointment'] != '0000-00-00 00:00:00') ? date('M d/y h:i A', strtotime($row['date_appointment'])) : '-';
    $temp_arr['date_checked']   = ($row['date_checked'] != '0000-00-00 00:00:00') ? date('M d/y h:i A', strtotime($row['date_checked'])) : '-';
    $temp_arr['blood_type']     = ($row['bt_name']) ? $row['bt_name'] : '-';
    $temp_arr['blood_status']   = $blood_status;
    $temp_arr['quantity']       = ($row['quantity_donee'] > 0) ? ($row['quantity_donee']+0).'ml ('.(($row['quantity_donee']/$row['unit_per_bag'])+0).' bags)' : '-';
    $temp_arr['date_done']      = ($row['date_done']) ? date('M d/y h:i A', strtotime($row['date_done'])) : '-';;
    $temp_arr['donate_by']      = $donate_by;
    $temp_arr['status_html']    = $status;
    $temp_arr['status']         = $row['status'];

    $requests[] = $temp_arr;
  }
}

?>