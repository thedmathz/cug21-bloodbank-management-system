<?php 
require_once 'connection.php'; 

$data = array();

$res_success = 0;
$res_message = '';

$username = mysqli_real_escape_string($db, trim($_POST['username']));
$password = mysqli_real_escape_string($db, trim($_POST['password']));


if ($username && $username) {

  $query = "
    SELECT * 
    FROM prospects
    WHERE (
        username = '$username' 
        AND password = '".md5($password)."'
      ) OR (
        phone = '$username' 
        AND password = '".md5($password)."'
      )
  ";
  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    unset($row['password']);
    $_SESSION['user'] = $row;
    $res_success = 1;
  } else {
    $res_message = 'Invalid username or password!';
  }

} else {
  $res_message = 'Invalid username or password!';
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);

?>