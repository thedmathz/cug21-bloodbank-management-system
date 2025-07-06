<?php 
date_default_timezone_set('Asia/Manila');

include_once('connection.php');

$data = array();

$barangays    = array();
$blood_types  = array();

$query = "
  SELECT * 
  FROM barangays 
  WHERE city_id = 47
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
  ORDER BY name ASC
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

$data['barangays']    = $barangays;
$data['blood_types']  = $blood_types;

echo json_encode($data);

?>