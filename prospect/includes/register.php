<?php 
require_once 'connection.php'; 

$username     = mysqli_real_escape_string($db, trim($_POST['username']));
$password     = mysqli_real_escape_string($db, trim($_POST['password']));
$phone        = mysqli_real_escape_string($db, trim($_POST['phone']));
$lname        = mysqli_real_escape_string($db, trim($_POST['lname']));
$fname        = mysqli_real_escape_string($db, trim($_POST['fname']));
$mname        = mysqli_real_escape_string($db, trim($_POST['mname']));
$province_id  = mysqli_real_escape_string($db, trim($_POST['province_id']));
$city_id      = mysqli_real_escape_string($db, trim($_POST['city_id']));
$barangay_id  = mysqli_real_escape_string($db, trim($_POST['barangay_id']));
$gender       = mysqli_real_escape_string($db, trim($_POST['gender']));
$bday         = mysqli_real_escape_string($db, trim($_POST['bday']));

$data = array();

$res_success = 0;
$res_message = '';

$query = "
  SELECT * 
  FROM prospects 
  WHERE username = '$username' 
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) == 0) {
  $query = "
    SELECT * 
    FROM prospects 
    WHERE phone = '$phone' 
  ";
  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) == 0) {
    $query = "
      SELECT * 
      FROM prospects 
      WHERE 
        lname = '$lname' 
        AND fname = '$fname' 
        AND bday = '".date('Y-m-d', strtotime($bday))."' 
    ";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 0) {
      $query = "
        INSERT INTO prospects (
          username, 
          password, 
          phone, 
          lname, 
          fname, 
          mname, 
          province_id, 
          city_id, 
          barangay_id, 
          gender, 
          bday
        ) VALUES (
          '$username', 
          '".md5($password)."', 
          '$phone', 
          '$lname', 
          '$fname', 
          '$mname', 
          '$province_id', 
          '$city_id', 
          '$barangay_id', 
          '$gender', 
          '$bday'
        )
      ";
      mysqli_query($db, $query);
      $last_id = $db->insert_id;

      $query = "
        SELECT * 
        FROM prospects 
        WHERE prospect_id = '$last_id'
      ";
      $result = mysqli_query($db, $query);
      $row    = mysqli_fetch_assoc($result);
      unset($row['password']);
      $_SESSION['user'] = $row;

      $res_success = 1;
    } else {
      $res_message = 'Resident already recorded!';
    }
  } else {
    $res_message = 'Phone already exists!';
  }
} else {
  $res_message = 'Username already exists!';
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);

?>