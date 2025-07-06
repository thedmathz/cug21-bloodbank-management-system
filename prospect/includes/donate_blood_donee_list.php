<?php 
date_default_timezone_set('Asia/Manila');

include_once('connection.php');

$request_id     = mysqli_real_escape_string($db, trim($_POST['request_id']));
$lname          = mysqli_real_escape_string($db, trim($_POST['lname']));
$barangay_id    = mysqli_real_escape_string($db, trim($_POST['barangay_id']));
$blood_type_id  = mysqli_real_escape_string($db, trim($_POST['blood_type_id']));

$data = array();

$donate_to  = '';
$donees     = array();

$query = "
  SELECT donate_to
  FROM requests 
  WHERE request_id = '$request_id'
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $donate_to = $row['donate_to'];
}

$query = "
  SELECT 
    req.*, 
    pros.lname, pros.fname, pros.mname, 
    bar.name AS bar_name, 
    bt.name AS bt_name 
  FROM requests AS req 
  LEFT JOIN prospects AS pros ON req.prospect_id = pros.prospect_id
  LEFT JOIN barangays AS bar ON pros.barangay_id = bar.barangay_id
  LEFT JOIN blood_types AS bt ON req.blood_type_id = bt.blood_type_id
  WHERE 
    req.type = 0 
    AND req.status = 2
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $selected = 0;
    if ($donate_to == $row['request_id']) {
      $selected = 1;
    }

    $temp_arr['request_id']   = $row['request_id'];
    $temp_arr['name']         = $row['lname'].', '.$row['fname'].' '.$row['mname'];
    $temp_arr['barangay']     = $row['bar_name'];
    $temp_arr['blood_type']   = $row['bt_name'];
    $temp_arr['selected']     = $selected;

    $donees[] = $temp_arr;
  }
}

$data['request_id'] = $request_id;
$data['donate_to']  = $donate_to;
$data['donees']     = $donees;

echo json_encode($data);

?>