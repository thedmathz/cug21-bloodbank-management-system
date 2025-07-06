<?php 

require_once '../../connection.php'; 

$data = array();

$res_success = 0;
$res_message = '';

$prospects    = array();
$blood_types  = array();

$query = "
  SELECT 
    pros.*, 
    pro.name AS pro_name, 
    cit.name AS cit_name, 
    bar.name AS bar_name
  FROM prospects AS pros 
  LEFT JOIN provinces AS pro ON pros.province_id = pro.province_id
  LEFT JOIN cities AS cit ON pros.city_id = cit.city_id
  LEFT JOIN barangays AS bar ON pros.barangay_id = bar.barangay_id
  ORDER BY pros.lname, pros.fname, pros.mname ASC
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $address = '';
    if ($row['pro_name']) {
      $address = $row['pro_name'];
      if ($row['cit_name']) {
        $address = $row['cit_name'].', '.$address;
        if ($row['bar_name']) {
          $address = $row['bar_name'].', '.$address;
        }
      }
    }

    $temp_arr['prospect_id']    = $row['prospect_id'];
    $temp_arr['prospect']       = $row['lname'].', '.$row['fname'].' '.$row['mname'];
    $temp_arr['address']        = $address;
    $temp_arr['blood_type_id']  = $row['blood_type_id'];

    $prospects[] = $temp_arr;
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

$data['prospects']    = $prospects;
$data['blood_types']  = $blood_types;

echo json_encode($data);


?>