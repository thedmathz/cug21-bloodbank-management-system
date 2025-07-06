<?php 
include_once('connection.php');

$prospect_id  =  mysqli_real_escape_string($db, $_POST['prospect_id']);

$data = array();

$query = "
  INSERT INTO searches (
    requested_by, 
    requested_to, 
    status
  ) VALUES (
    '".$_SESSION['user']['prospect_id']."', 
    '$prospect_id', 
    '0'
  )
";
mysqli_query($db, $query);

echo json_encode($data);

?>