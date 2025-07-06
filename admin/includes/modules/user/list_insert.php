<?php 
date_default_timezone_set('Asia/Manila');

require_once '../../connection.php'; 

$username     = mysqli_real_escape_string($db, trim($_POST['username']));
$lname        = mysqli_real_escape_string($db, trim($_POST['lname']));
$fname        = mysqli_real_escape_string($db, trim($_POST['fname']));
$gender       = mysqli_real_escape_string($db, trim($_POST['gender']));
$phone        = mysqli_real_escape_string($db, trim($_POST['phone']));
$user_type_id = mysqli_real_escape_string($db, trim($_POST['user_type_id']));

$data = array();

$res_success = 0;
$res_message = '';

$query = "
  SELECT * 
  FROM users 
  WHERE username = '$username'
";
$result = mysqli_query($db, $query);
if (!mysqli_num_rows($result)) {
  
  $query = "
    INSERT INTO users (
      username, 
      password, 
      lname, 
      fname, 
      gender, 
      phone, 
      user_type_id, 
      inserted_by, 
      date_inserted
    ) VALUES (
      '$username', 
      '".md5($username)."', 
      '$lname', 
      '$fname', 
      '$gender', 
      '$phone', 
      '$user_type_id', 
      '".$_SESSION['user']['user_id']."', 
      '".date('Y-m-d H:i:s')."'
    )
  ";
  if (mysqli_query($db, $query)) {
    $res_success = 1;
  } else {
    $res_message = 'Query Failed!';
  }

} else {
  $res_message = 'Username already exists!';
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);


?>