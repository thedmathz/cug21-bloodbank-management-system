<?php 

require_once '../../includes/connection.php'; 

$users = array();

$query = "
  SELECT 
    u.*, 
    ut.name as ut_name
  FROM users AS u 
  LEFT JOIN user_types AS ut ON u.user_type_id = ut.user_type_id 
  ORDER BY u.lname, u.fname ASC
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $temp_arr['user_id']    = $row['user_id'];
    $temp_arr['username']   = $row['username'];
    $temp_arr['lname']      = $row['lname'];
    $temp_arr['fname']      = $row['fname'];
    $temp_arr['gender']     = ($row['gender']) ? 'Male' : 'Female';
    $temp_arr['phone']      = $row['phone'];
    $temp_arr['type']       = $row['ut_name'];
    $temp_arr['is_active']  = ($row['is_active']) ? 'Active' : 'Deactivated';

    $users[] = $temp_arr;
  }
}


?>