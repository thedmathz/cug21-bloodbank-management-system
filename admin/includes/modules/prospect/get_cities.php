<?php 

require_once '../../connection.php'; 

$province_id = mysqli_real_escape_string($db, trim($_POST['province_id']));

$data = array();

$res_success = 0;
$res_message = '';

$cities = array();

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
    $temp_arr['name']     = $row['name'];

    $cities[] = $temp_arr;
  }
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

$data['cities'] = $cities;

echo json_encode($data);


?>