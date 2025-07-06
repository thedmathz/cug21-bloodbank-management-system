<?php 

require_once '../../connection.php'; 

$username       = mysqli_real_escape_string($db, trim($_POST['username']));
$lname          = mysqli_real_escape_string($db, trim($_POST['lname']));
$fname          = mysqli_real_escape_string($db, trim($_POST['fname']));
$mname          = mysqli_real_escape_string($db, trim($_POST['mname']));
$phone          = mysqli_real_escape_string($db, trim($_POST['phone']));
$province_id    = mysqli_real_escape_string($db, trim($_POST['province_id']));
$city_id        = mysqli_real_escape_string($db, trim($_POST['city_id']));
$barangay_id    = mysqli_real_escape_string($db, trim($_POST['barangay_id']));
$gender         = mysqli_real_escape_string($db, trim($_POST['gender']));
$bday           = mysqli_real_escape_string($db, trim($_POST['bday']));
$blood_type_id  = mysqli_real_escape_string($db, trim($_POST['blood_type_id']));

$data = array();

$res_success = 0;
$res_message = '';

$query = "
  SELECT * 
  FROM prospects 
  WHERE 
    username = '$username'
    OR phone = '$phone'
";
$result = mysqli_query($db, $query);
if (!mysqli_num_rows($result)) {
  $query = "
    SELECT * 
    FROM prospects 
    WHERE 
      lname = '$lname' 
      AND fname = '$fname' 
      AND bday = '$bday' 
      AND blood_type_id = '$blood_type_id'
  ";
  $result = mysqli_query($db, $query);
  if (!mysqli_num_rows($result)) {
    $query = "
      INSERT INTO prospects (
        username, 
        phone, 
        password, 
        lname, 
        fname, 
        mname, 
        province_id, 
        city_id, 
        barangay_id, 
        gender, 
        bday, 
        blood_type_id
      ) VALUES (
        '$username', 
        '$phone', 
        '".md5($username)."', 
        '$lname', 
        '$fname', 
        '$mname', 
        '$province_id', 
        '$city_id', 
        '$barangay_id', 
        '$gender', 
        '$bday', 
        '$blood_type_id'
      )
    ";
    mysqli_query($db, $query);
    $res_success = 1;
  } else {
    $res_message = 'Prospect already exists!';
  }
} else {
  $res_message = 'Username or Phone Number already exists!';
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);


?>