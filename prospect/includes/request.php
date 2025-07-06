<?php 
date_default_timezone_set('Asia/Manila');

include_once('connection.php');

$app            =  mysqli_real_escape_string($db, $_POST['app']);
$blood_type_id  =  mysqli_real_escape_string($db, $_POST['blood_type_id']);
$bags           =  mysqli_real_escape_string($db, $_POST['bags']);
$reason         =  mysqli_real_escape_string($db, $_POST['reason']);
$ml             =  mysqli_real_escape_string($db, $_POST['ml']);

$data = array();

$query = "
  INSERT INTO requests (
    prospect_id, 
    type, 
    date_appt, 
    date_inserted, 
    appointed_by, 
    date_appointment, 
    checked_by, 
    date_checked, 
    blood_type_id, 
    blood_status, 
    quantity_donor, 
    quantity_donee, 
    remarks, 
    status	
  ) VALUES (
    '".$_SESSION['user']['prospect_id']."', 
    '0', 
     '$app',
    '".date('Y-m-d H:i:s')."', 
    '', 
    '', 
    '', 
    '', 
    '$blood_type_id', 
    '', 
    '', 
    '$ml', 
    '$reason', 
    '1'	
  )
";
mysqli_query($db, $query);

echo json_encode($data);

?>