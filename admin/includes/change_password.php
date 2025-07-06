<?php 

require_once 'connection.php'; 

$data = array();

$password = mysqli_real_escape_string($db, trim($_POST['password']));

$query  = "
  UPDATE users
  SET password = '".md5($password)."' 
  WHERE user_id = '".$_SESSION['user']['user_id']."'
";
mysqli_query($db, $query);

echo json_encode($data);

?>