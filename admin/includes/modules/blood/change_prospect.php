<?php 

require_once '../../connection.php'; 

$blood_type_id = mysqli_real_escape_string($db, trim($_POST['blood_type_id']));

$data = array();

$res_success = 0;
$res_message = '';

$blood_types  = array();

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

$data['blood_type_id']  = $blood_type_id;
$data['blood_types']    = $blood_types;

echo json_encode($data);


?>