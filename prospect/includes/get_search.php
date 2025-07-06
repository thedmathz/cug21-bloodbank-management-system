<?php 
date_default_timezone_set('Asia/Manila');

include_once('connection.php');

$lname          =  mysqli_real_escape_string($db, $_POST['lname']);
$barangay_id    =  mysqli_real_escape_string($db, $_POST['barangay_id']);
$blood_type_id  =  mysqli_real_escape_string($db, $_POST['blood_type_id']);

$data = array();

$searches = array();

$query = "
  SELECT 
    pros.*, 
    bar.name AS b_name, 
    bt.name AS bt_name
  FROM prospects AS pros 
  LEFT JOIN barangays AS bar ON pros.barangay_id = bar.barangay_id
  LEFT JOIN blood_types AS bt ON pros.blood_type_id = bt.blood_type_id
  WHERE 
    pros.prospect_id != '".$_SESSION['user']['prospect_id']."' 
";
$hasWhere = 1;
if ($barangay_id) {
  if (!$hasWhere) {
    $query .= " WHERE pros.barangay_id = '$barangay_id' ";
  } else {
    $query .= " AND pros.barangay_id = '$barangay_id' ";
  }
  $hasWhere = 1;
}
if ($blood_type_id) {
  if (!$hasWhere) {
    $query .= " WHERE pros.blood_type_id = '$blood_type_id' ";
  } else {
    $query .= " AND pros.blood_type_id = '$blood_type_id' ";
  }
  $hasWhere = 1;
}
if ($lname) {
  if (!$hasWhere) {
    $query .= " WHERE pros.lname LIKE '%$lname%' ";
  } else {
    $query .= " AND pros.lname LIKE '%$lname%' ";
  }
  $hasWhere = 1;
}
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $status = 0;

    $query2 = " 
      SELECT * 
      FROM searches 
      WHERE 
        requested_by = '".$_SESSION['user']['prospect_id']."' 
        AND requested_to = '".$row['prospect_id']."' 
        AND status = '0' 
    ";
    $result2 = mysqli_query($db, $query2);
    if (mysqli_num_rows($result2) > 0) {
      $status = 1;
    }

    $name = $row['lname'].', '.$row['fname'].' '.$row['mname'];

    $name = substr($name, 0, 3).str_pad('', (strlen($name)-3), '*');

    $temp_arr['prospect_id']  = $row['prospect_id'];
    $temp_arr['name']         = $name;
    $temp_arr['barangay']     = $row['b_name'];
    $temp_arr['blood_type']   = ($row['bt_name']) ? $row['bt_name'] : '-';
    $temp_arr['status']       = $status;

    $searches[] = $temp_arr;
  }
}

$data['searches'] = $searches;

echo json_encode($data);

?>