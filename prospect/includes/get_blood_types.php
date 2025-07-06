<?php 
include_once('connection.php');

$data = array();

$blood_types = array();

$query = "
  SELECT * 
  FROM blood_types 
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $temp_arr['blood_type_id']  = $row['blood_type_id'];
    $temp_arr['name']           = $row['name'];
    $temp_arr['per_bag']        = $row['unit_per_bag'];

    $blood_types[] = $temp_arr;
  }
}

$data['blood_types'] = $blood_types;

echo json_encode($data);

?>