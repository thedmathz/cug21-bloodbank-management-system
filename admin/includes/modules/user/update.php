<?php 

require_once '../../connection.php'; 

// $username = mysqli_real_escape_string($db, trim($_POST['username']));

$data = array();

$res_success = 0;
$res_message = '';



$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);


?>