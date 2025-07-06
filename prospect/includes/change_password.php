<?php 

include_once('connection.php');

$cur_password =  mysqli_real_escape_string($db, $_POST['cur_password']);
$new_password =  mysqli_real_escape_string($db, $_POST['new_password']);

$data = array();

$res_success = 0;
$res_message = '';

$query = "
  SELECT * 
  FROM prospects 
  WHERE 
    prospect_id = '".$_SESSION['user']['prospect_id']."' 
    AND password = '".md5($cur_password)."' 
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  $query = "
    UPDATE prospects 
    SET password = '".md5($new_password)."' 
    WHERE prospect_id = '".$_SESSION['user']['prospect_id']."' 
  ";
  mysqli_query($db, $query);
  $res_success = 1;
} else {
  $res_message = 'Invalid current password!';
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);

?>