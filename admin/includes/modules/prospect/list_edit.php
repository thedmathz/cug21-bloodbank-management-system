<?php 

require_once '../../connection.php'; 

$prospect_id = mysqli_real_escape_string($db, trim($_POST['prospect_id']));

$data = array();

$res_success = 0;
$res_message = '';

$username       = '';
$lname          = '';
$fname          = '';
$mname          = '';
$phone          = '';
$province_id    = '';
$city_id        = '';
$barangay_id    = '';
$gender         = '';
$bday           = '';
$blood_type_id  = '';

$provinces    = array();
$cities       = array();
$barangays    = array();
$blood_types  = array();

$query = "
  SELECT * 
  FROM prospects 
  WHERE prospect_id = '$prospect_id'
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);

  $username       = $row['username'];
  $lname          = $row['lname'];
  $fname          = $row['fname'];
  $mname          = $row['mname'];
  $phone          = $row['phone'];
  $province_id    = $row['province_id'];
  $city_id        = $row['city_id'];
  $barangay_id    = $row['barangay_id'];
  $gender         = $row['gender'];
  $bday           = date('Y-m-d', strtotime($row['bday']));
  $blood_type_id  = $row['blood_type_id'];

}

$query = "
  SELECT *
  FROM provinces
  ORDER BY name ASC
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $temp_arr['province_id']  = $row['province_id'];
    $temp_arr['name']         = $row['name'];

    $provinces[] = $temp_arr;
  }
}

$query = "
  SELECT *
  FROM cities 
  WHERE province_id = '$province_id'
  ORDER BY name ASC
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $temp_arr['city_id']  = $row['city_id'];
    $temp_arr['name']         = $row['name'];

    $cities[] = $temp_arr;
  }
}

$query = "
  SELECT *
  FROM barangays 
  WHERE city_id = '$city_id'
  ORDER BY name ASC
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $temp_arr['barangay_id']  = $row['barangay_id'];
    $temp_arr['name']         = $row['name'];

    $barangays[] = $temp_arr;
  }
}

$query = "
  SELECT *
  FROM blood_types
  ORDER BY blood_type_id ASC
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $temp_arr['blood_type_id']  = $row['blood_type_id'];
    $temp_arr['name']           = $row['name'];

    $blood_types[] = $temp_arr;
  }
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

$data['username']       = $username;
$data['lname']          = $lname;
$data['fname']          = $fname;
$data['mname']          = $mname;
$data['phone']          = $phone;
$data['province_id']    = $province_id;
$data['city_id']        = $city_id;
$data['barangay_id']    = $barangay_id;
$data['gender']         = $gender;
$data['bday']           = $bday;
$data['blood_type_id']  = $blood_type_id;

$data['provinces']    = $provinces;
$data['cities']    = $cities;
$data['barangays']    = $barangays;
$data['blood_types']  = $blood_types;

echo json_encode($data);


?>