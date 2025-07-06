<?php 
require_once 'connection.php'; 

$phone        = mysqli_real_escape_string($db, trim($_POST['phone']));
$fname        = mysqli_real_escape_string($db, trim($_POST['fname']));
$mname        = mysqli_real_escape_string($db, trim($_POST['mname']));
$lname        = mysqli_real_escape_string($db, trim($_POST['lname']));
$gender       = mysqli_real_escape_string($db, trim($_POST['gender']));
$bday         = mysqli_real_escape_string($db, trim($_POST['bday']));
$province_id  = mysqli_real_escape_string($db, trim($_POST['province_id']));
$city_id      = mysqli_real_escape_string($db, trim($_POST['city_id']));
$barangay_id  = mysqli_real_escape_string($db, trim($_POST['barangay_id']));

$data = array();

$res_success = 0;
$res_message = '';

$query = "
  SELECT * 
  FROM prospects 
  WHERE 
    phone = '$phone' 
    AND prospect_id != '".$_SESSION['user']['prospect_id']."'
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
      AND prospect_id != '".$_SESSION['user']['prospect_id']."'
  ";
  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) == 0) {

    $file_ext = '';
    $last_id = $_SESSION['user']['prospect_id'];

    // file upload
    if ($_FILES['file_ext']['name']) {
      $file_ext   = explode(".", $_FILES["file_ext"]["name"]);
      $file_ext   = end($file_ext);
      $file_name  = md5($last_id) . '.' . $file_ext;
      move_uploaded_file($_FILES["file_ext"]["tmp_name"], "../uploads/" . $file_name);

      $query = "
        UPDATE residents 
        SET pic_ext = '$file_ext'
        WHERE resident_id = '$last_id'
      ";
      mysqli_query($db, $query);
    }

    $query = "
      UPDATE prospects 
      SET 
        phone       = '$phone', 
        fname       = '$fname', 
        mname       = '$mname', 
        lname       = '$lname', 
        gender      = '$gender', 
        bday        = '$bday', 
        province_id = '$province_id', 
        city_id     = '$city_id', 
        barangay_id = '$barangay_id', 
        pic_ext     = '$file_ext'
      WHERE prospect_id = '".$_SESSION['user']['prospect_id']."'
    ";
    mysqli_query($db, $query);

    $res_success = 1;
  } else {
    $res_message = 'Resident already recorded!';
  }
} else {
  $res_message = 'Phone already exists!';
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);

?>