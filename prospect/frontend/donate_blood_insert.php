<?php 
date_default_timezone_set('Asia/Manila');

include_once('connection.php');

$module = 'donate'; 

$data = array();

$query = "
  INSERT INTO requests (
    prospect_id, 
    type, 
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
    '1', 
    '".date('Y-m-d H:i:s')."', 
    '', 
    '', 
    '', 
    '', 
    '', 
    '', 
    '', 
    '', 
    '', 
    '1'	
  )
";
mysqli_query($db, $query);

echo json_encode($data);

?>