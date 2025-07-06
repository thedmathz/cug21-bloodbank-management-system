<?php 

require_once '../../connection.php'; 

$request_id = mysqli_real_escape_string($db, trim($_POST['request_id']));

$data = array();

$statuses       = array('DECLINED', 'PENDING', 'APPROVED', 'CHECKED', 'DONE');
$requests       = array('GET', 'DONATE');
$blood_statuses = array(0=>'BAD', 1=>'GOOD');
$blood_types    = array();

$res_success = 0;
$res_message = '';

$request_type   = '';

$prospect_name  = '';
$type           = '';
$date_inserted  = '';
$status         = '';

$appointed_by   = '';
$date_appointed = '';

$checked_by     = '';
$date_checked   = '';
$blood_type_id  = '';
$blood_type     = '';
$blood_status   = '';

$donate_to      = '-';
$quantity_donor = '';
$quantity_donee = '';
$remarks        = '';

$query = "
  SELECT * 
  FROM blood_types
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $temp_arr['blood_type_id']  = $row['blood_type_id'];
    $temp_arr['name']           = $row['name'];

    $blood_types[] = $temp_arr;
  }
}

$query = "
  SELECT 
    req.*, 
    pros.lname, pros.fname, pros.mname, 
    pros2.lname as p_lname, pros2.fname as p_fname, pros2.mname as p_mname, 
    bt.name AS bt_name
  FROM requests AS req 
  LEFT JOIN prospects AS pros ON req.prospect_id = pros.prospect_id
  LEFT JOIN blood_types AS bt ON req.blood_type_id = bt.blood_type_id
  LEFT JOIN requests AS req2 ON req.donate_to = req2.request_id
  LEFT JOIN prospects AS pros2 ON req2.prospect_id = pros2.prospect_id
  WHERE req.request_id = '$request_id'
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  
  $request_type   = $row['type'];

  $prospect_name  = $row['lname'].', '.$row['fname'].' '.$row['mname'];
  $blood_type_id  = $row['blood_type_id'];
  $type           = $requests[$row['type']];
  $date_inserted  = date('M d/y h:i A', strtotime($row['date_inserted']));
  $status         = $row['status'];

  if ($row['appointed_by']) {
    $query = "
      SELECT *
      FROM users
      WHERE user_id = '".$row['appointed_by']."'
    ";
    $result1 = mysqli_query($db, $query);
    $row1    = mysqli_fetch_assoc($result1);

    $appointed_by   = $row1['lname'].', '.$row1['fname'];
    $date_appointed = date('M d/y h:i A', strtotime($row['date_appointment']));
  }

  if ($row['checked_by']) {
    $query = "
      SELECT *
      FROM users
      WHERE user_id = '".$row['checked_by']."'
    ";
    $result2 = mysqli_query($db, $query);
    $row2    = mysqli_fetch_assoc($result2);

    $checked_by   = $row2['lname'].', '.$row2['fname'];
    $date_checked = date('M d/y h:i A', strtotime($row['date_checked']));
  }

  if (!is_null($row['blood_status'])) {
    $blood_status   = $blood_statuses[$row['blood_status']];
  }

  $blood_type     = $row['bt_name'];

  if ($row['donate_to']) {
    $donate_to = $row['p_lname'].', '.$row['p_fname'].' '.$row['p_mname'];
  }
  $quantity_donee = ($row['quantity_donee'] + 0);
  $quantity_donor = ($row['quantity_donor'] + 0);
  $remarks        = $row['remarks'];
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

$data['request_type']   = $request_type;

$data['prospect_name']  = $prospect_name;
$data['type']           = $type;
$data['date_inserted']  = $date_inserted;
$data['status']         = $status;

$data['appointed_by']   = $appointed_by;
$data['date_appointed'] = $date_appointed;

$data['checked_by']     = $checked_by;
$data['date_checked']   = $date_checked;
$data['blood_type_id']  = $blood_type_id;
$data['blood_type']     = $blood_type;
$data['blood_status']   = $blood_status;

$data['donate_to']      = $donate_to;
$data['quantity_donee'] = $quantity_donee;
$data['quantity_donor'] = $quantity_donor;
$data['remarks']        = $remarks;

$data['blood_types']    = $blood_types;
$data['blood_statuses'] = $blood_statuses;
$data['statuses']       = $statuses;

echo json_encode($data);


?>