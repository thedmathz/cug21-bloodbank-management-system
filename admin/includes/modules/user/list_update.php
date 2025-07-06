<?php 
date_default_timezone_set('Asia/Manila');

require_once '../../connection.php'; 

$user_id      = mysqli_real_escape_string($db, trim($_POST['user_id']));
$lname        = mysqli_real_escape_string($db, trim($_POST['lname']));
$fname        = mysqli_real_escape_string($db, trim($_POST['fname']));
$gender       = mysqli_real_escape_string($db, trim($_POST['gender']));
$phone        = mysqli_real_escape_string($db, trim($_POST['phone']));
$user_type_id = mysqli_real_escape_string($db, trim($_POST['user_type_id']));
$status       = mysqli_real_escape_string($db, trim($_POST['status']));

$data = array();

$res_success = 0;
$res_message = '';

$query = "
  SELECT * 
  FROM users 
  WHERE user_id = '$user_id'
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {

  $query = "
    UPDATE users
    SET 
      lname         = '$lname', 
      fname         = '$fname', 
      gender        = '$gender', 
      phone         = '$phone', 
      user_type_id  = '$user_type_id', 
      is_active     = '$status'
    WHERE user_id = '$user_id' 
  ";
  if (mysqli_query($db, $query)) {
    $res_success = 1;
  } else {
    $res_message = 'Query Failed!';
  }

} else {
  $res_message = 'Username does not exists!';
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);


?>