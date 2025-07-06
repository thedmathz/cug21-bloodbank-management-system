<?php 
require_once 'connection.php'; 

$feedback = mysqli_real_escape_string($db, trim($_POST['feedback']));

$data = array();

$res_success = 0;
$res_message = '';

$query = "
  INSERT INTO feedbacks (
    prospect_id, 
    feedback, 
    date_inserted
  ) VALUES (
    '".$_SESSION['user']['prospect_id']."', 
    '$feedback', 
    '".date('Y-m-d H:i:s')."'
  )
";
mysqli_query($db, $query);

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);

?>