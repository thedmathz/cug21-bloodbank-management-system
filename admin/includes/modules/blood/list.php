<?php 
date_default_timezone_set('Asia/Manila');

require_once '../../includes/connection.php'; 

$a_plus   = '2 bags';
$a_minus  = '0 bags';
$b_plus   = '0 bags';
$b_minus  = '0 bags';
$ab_plus  = '0 bags';
$ab_minus = '0 bags';
$o_plus   = '0 bags';
$o_minus  = '0 bags';

$d_blood_type_id  = '';
$d_lname          = '';
$d_type           = '';
$d_quantity       = '';
$d_user_id        = '';
$d_date_inserted  = '';

$date_inserted_from    = '';
$date_inserted_to      = '';

$stock_logs   = array();
$blood_types  = array();
$users        = array();

if (isset($_POST['d_submit'])) {

  $d_blood_type_id  = mysqli_real_escape_string($db, trim($_POST['d_blood_type_id']));
  $d_lname          = mysqli_real_escape_string($db, trim($_POST['d_lname']));
  $d_type           = mysqli_real_escape_string($db, trim($_POST['d_type']));
  $d_quantity       = mysqli_real_escape_string($db, trim($_POST['d_quantity']));
  $d_user_id        = mysqli_real_escape_string($db, trim($_POST['d_user_id']));
  $d_date_inserted  = mysqli_real_escape_string($db, trim($_POST['d_date_inserted']));

  $temp_date_inserted = explode(' - ', $d_date_inserted);
  $date_inserted_from = date('Y-m-d', strtotime($temp_date_inserted[0]));
  $date_inserted_to   = date('Y-m-d', strtotime($temp_date_inserted[1]));

}

if (!$d_date_inserted) {
  $date_inserted_from    = date('Y-m-01');
  $date_inserted_to      = date('Y-m-d');
}


// for a+
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '1'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $a_plus   = floor($row['quantity']/$row2['unit_per_bag']). ' bags';
}
// for a-
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '2'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $a_minus   = floor($row['quantity']/$row2['unit_per_bag']). ' bags';
}
// for b+
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '3'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $b_plus   = floor($row['quantity']/$row2['unit_per_bag']). ' bags';
}
// for b-
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '4'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $b_minus  = floor($row['quantity']/$row2['unit_per_bag']). ' bags';
}
// for ab+
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '5'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $ab_plus  = floor($row['quantity']/$row2['unit_per_bag']). ' bags';
}
// for ab-
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '6'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $ab_minus   = floor($row['quantity']/$row2['unit_per_bag']). ' bags';
}
// for o+
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '7'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $o_plus   = floor($row['quantity']/$row2['unit_per_bag']). ' bags';
}
// for o+
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '8'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $o_minus  = floor($row['quantity']/$row2['unit_per_bag']). ' bags';
}

// for logs
$query = "
  SELECT 
    sl.*, 
    bt.name AS bt_name, 
    pros.lname as pros_lname, pros.fname as pros_fname, pros.mname as pros_mname, 
    u.lname as u_lname, u.fname as u_fname
  FROM stock_logs AS sl 
  LEFT JOIN stocks AS s ON sl.stock_id = s.stock_id
  LEFT JOIN blood_types AS bt ON s.blood_type_id = bt.blood_type_id
  LEFT JOIN prospects AS pros ON sl.prospect_id = pros.prospect_id
  LEFT JOIN users AS u ON sl.inserted_by = u.user_id
";
$has_where = 0;
if ($d_blood_type_id) {
  if ($has_where) {
    $query .= " AND bt.blood_type_id = '$d_blood_type_id' ";
  } else {
    $query .= " WHERE bt.blood_type_id = '$d_blood_type_id' ";
  }
  $has_where = 1;
}
if ($d_type != '') {
  if ($has_where) {
    $query .= " AND sl.type = '$d_type' ";
  } else {
    $query .= " WHERE sl.type = '$d_type' ";
  }
  $has_where = 1;
}
if ($d_user_id) {
  if ($has_where) {
    $query .= " AND sl.inserted_by = '$d_user_id' ";
  } else {
    $query .= " WHERE sl.inserted_by = '$d_user_id' ";
  }
  $has_where = 1;
}
if ($date_inserted_from) {
  if ($has_where) {
    $query .= " AND (sl.date_inserted >= '$date_inserted_from 00:00:00' AND sl.date_inserted <= '$date_inserted_to 23:59:59') ";
  } else {
    $query .= " WHERE (sl.date_inserted >= '$date_inserted_from 00:00:00' AND sl.date_inserted <= '$date_inserted_to 23:59:59') ";
  }
  $has_where = 1;
}
if ($d_lname) {
  if ($has_where) {
    $query .= " AND pros.lname LIKE '%$d_lname%' ";
  } else {
    $query .= " WHERE pros.lname LIKE '%$d_lname%' ";
  }
  $has_where = 1;
}
if ($d_quantity) {
  if ($has_where) {
    $query .= " AND sl.quantity LIKE '%$d_quantity%' ";
  } else {
    $query .= " WHERE sl.quantity LIKE '%$d_quantity%' ";
  }
  $has_where = 1;
}
$query .= "
  ORDER BY sl.date_inserted DESC
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $log_type = '';
    if ($row['type'] == '2') {
      $log_type = '<span class="bg-secondary text-white" style="padding: 3px 8px; border-radius: 5px;">UPDATED</span>';
    } else if ($row['type'] == '1') {
      $log_type = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">DONATE</span>';
    } else {
      $log_type = '<span class="bg-danger text-white" style="padding: 3px 8px; border-radius: 5px;">GET</span>';
    }

    $temp_arr['blood_type']     = $row['bt_name'];
    $temp_arr['prospect']       = $row['pros_lname'].', '.$row['pros_fname'].' '.$row['pros_mname'];
    $temp_arr['log_type']       = $log_type;
    $temp_arr['quantity']       = number_format($row['quantity'], 0);
    $temp_arr['inserted_by']    = $row['u_lname'].', '.$row['u_fname'];
    $temp_arr['date_inserted']  = date('M d/y h:i A', strtotime($row['date_inserted']));

    $stock_logs[] = $temp_arr;
  }
}

$query = "
  SELECT * 
  FROM blood_types 
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $temp_arr['blood_type_id']  = $row['blood_type_id'];
    $temp_arr['name']           = $row['name'];

    $blood_types[] = $temp_arr;
  }
}

$query = "
  SELECT * 
  FROM users 
  ORDER BY lname, fname
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $temp_arr['user_id']  = $row['user_id'];
    $temp_arr['name']     = $row['lname'].', '.$row['fname'];

    $users[] = $temp_arr;
  }
}

?>