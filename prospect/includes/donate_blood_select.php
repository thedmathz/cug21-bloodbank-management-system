<?php 
date_default_timezone_set('Asia/Manila');

include_once('connection.php');

$d_request_id =  mysqli_real_escape_string($db, $_POST['d_request_id']);
$request_id   =  mysqli_real_escape_string($db, $_POST['request_id']);

$data = array();

$query = "UPDATE requests SET donate_to = '$request_id' WHERE request_id = '$d_request_id'";
mysqli_query($db, $query);

echo json_encode($data);

?>