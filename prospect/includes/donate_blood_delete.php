<?php 
date_default_timezone_set('Asia/Manila');

include_once('connection.php');

$request_id =  mysqli_real_escape_string($db, $_POST['request_id']);

$data = array();

$query = "DELETE FROM requests WHERE request_id = '$request_id'";
mysqli_query($db, $query);

echo json_encode($data);

?>