<?php 

require_once '../../includes/connection.php'; 

$prospects = array();

$query = "
  SELECT 
    pros.*, 
    pro.name as pro_name, 
    cit.name as cit_name, 
    bar.name as bar_name
  FROM prospects AS pros
  LEFT JOIN provinces AS pro ON pros.province_id = pro.province_id
  LEFT JOIN cities AS cit ON pros.city_id = cit.city_id
  LEFT JOIN barangays AS bar ON pros.barangay_id = bar.barangay_id
  ORDER BY pros.lname, pros.fname, pros.mname
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $address = '';
    if ($row['pro_name']) {
      $address = $row['pro_name'];
      if ($row['cit_name']) {
        $address = $row['cit_name'] .', '. $address;
        if ($row['bar_name']) {
          $address = $row['bar_name'] .', '. $address;
        }
      }
    }

    $avatar = '../../assets/images/avatars/avatar.jpg';
    if ($row['pic_ext']) {
      $avatar = '../../../prospect/uploads/'.md5($row['prospect_id']).'.'.$row['pic_ext'];
    }

    $temp_arr['prospect_id']  = $row['prospect_id'];
    $temp_arr['avatar']       = $avatar;
    $temp_arr['username']     = $row['username'];
    $temp_arr['phone']        = $row['phone'];
    $temp_arr['lname']        = $row['lname'];
    $temp_arr['fname']        = $row['fname'];
    $temp_arr['mname']        = $row['mname'];
    $temp_arr['gender']       = ($row['gender']) ? 'Male' : 'Female';
    $temp_arr['address']      = $address;
    $temp_arr['province']     = $row['pro_name'];
    $temp_arr['city']         = $row['cit_name'];
    $temp_arr['barangay']     = $row['bar_name'];
    $temp_arr['bday']         = date('M d/y', strtotime($row['bday']));

    $prospects[] = $temp_arr;
  }
}


?>