<?php 

require_once '../../connection.php'; 

$data = array();

$res_success = 0;
$res_message = '';

$provinces    = array();
$blood_types  = array();

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

$data['provinces']    = $provinces;
$data['blood_types']  = $blood_types;

echo json_encode($data);


?>