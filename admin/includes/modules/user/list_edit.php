<?php 

require_once '../../connection.php'; 

$user_id = mysqli_real_escape_string($db, trim($_POST['user_id']));

$data = array();

$username     = '';
$lname        = '';
$fname        = '';
$gender       = '';
$phone        = '';
$user_type_id = '';

$user_types = array();

$query = "
  SELECT * 
  FROM users 
  WHERE user_id = '$user_id'
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  
  $row = mysqli_fetch_assoc($result);

  $username     = $row['username'];
  $lname        = $row['lname'];
  $fname        = $row['fname'];
  $gender       = $row['gender'];
  $phone        = $row['phone'];
  $user_type_id = $row['user_type_id'];
  $is_active    = $row['is_active'];

}

$query = "
  SELECT * 
  FROM user_types 
  ORDER BY name ASC
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $temp_arr['user_type_id'] = $row['user_type_id'];
    $temp_arr['name']         = $row['name'];

    $user_types[] = $temp_arr;
  }
}

$data['user_id']      = $user_id;
$data['username']     = $username;
$data['lname']        = $lname;
$data['fname']        = $fname;
$data['gender']       = $gender;
$data['phone']        = $phone;
$data['user_type_id'] = $user_type_id;
$data['is_active']    = $is_active;

$data['user_types'] = $user_types;

echo json_encode($data);


?>