<?php 

require_once '../../connection.php'; 

$city_id = mysqli_real_escape_string($db, trim($_POST['city_id']));

$data = array();

$res_success = 0;
$res_message = '';

$barangays = array();

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
    $temp_arr['name']     = $row['name'];

    $barangays[] = $temp_arr;
  }
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

$data['barangays'] = $barangays;

echo json_encode($data);


?>