<?php 

require_once '../../connection.php'; 

$data = array();

$res_success = 0;
$res_message = '';

$user_types = array();

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

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

$data['user_types'] = $user_types;

echo json_encode($data);


?>