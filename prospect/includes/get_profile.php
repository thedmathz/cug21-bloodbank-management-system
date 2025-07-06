<?php 
require_once 'connection.php'; 

$data = array();

$provinces  = array();
$cities     = array();
$barangays  = array();

$res_success = 0;
$res_message = '';

$avatar       = '../assets/images/avatars/avatar.jpg';
$username     = '';
$phone        = '';
$lname        = '';
$fname        = '';
$mname        = '';
$province_id  = '';
$city_id      = '';
$barangay_id  = '';
$gender       = '';
$bday         = '';

$query = "
  SELECT * 
  FROM prospects 
  WHERE prospect_id = '".$_SESSION['user']['prospect_id']."'
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $username     = $row['username'];
  $phone        = $row['phone'];
  $lname        = $row['lname'];
  $fname        = $row['fname'];
  $mname        = $row['mname'];
  $province_id  = $row['province_id'];
  $city_id      = $row['city_id'];
  $barangay_id  = $row['barangay_id'];
  $gender       = $row['gender'];
  $bday         = date('Y-m-d', strtotime($row['bday']));
  if ($row['pic_ext']) {
    $avatar = '../uploads/'.md5($_SESSION['user']['prospect_id']).'.'.$row['pic_ext'];
  }
}

$query = "
  SELECT * 
  FROM provinces
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_array($result)) {
    $temp_arr = array();
    $temp_arr['province_id']  = $row['province_id'];
    $temp_arr['name']         = $row['name'];
    $provinces[] = $temp_arr;
  }
}

if ($province_id) {
  $query = "
    SELECT * 
    FROM cities
    WHERE province_id = '$province_id'
  ";
  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)) {
      $temp_arr = array();
      $temp_arr['city_id']  = $row['city_id'];
      $temp_arr['name']     = $row['name'];
      $cities[] = $temp_arr;
    }
  }
}

if ($city_id) {
  $query = "
    SELECT * 
    FROM barangays
    WHERE city_id = '$city_id'
  ";
  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)) {
      $temp_arr = array();
      $temp_arr['barangay_id']  = $row['barangay_id'];
      $temp_arr['name']         = $row['name'];
      $barangays[] = $temp_arr;
    }
  }
}

$data['res_success']  = $res_success;
$data['res_message']  = $res_message;

$data['avatar']       = $avatar;
$data['username']     = $username;
$data['phone']        = $phone;
$data['lname']        = $lname;
$data['fname']        = $fname;
$data['mname']        = $mname;
$data['province_id']  = $province_id;
$data['city_id']      = $city_id;
$data['barangay_id']  = $barangay_id;
$data['gender']       = $gender;
$data['bday']         = $bday;

$data['provinces']  = $provinces;
$data['cities']     = $cities;
$data['barangays']  = $barangays;

echo json_encode($data);

?>