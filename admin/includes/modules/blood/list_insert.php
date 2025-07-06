<?php 
date_default_timezone_set('Asia/Manila');

require_once '../../connection.php'; 

$prospect_id    = mysqli_real_escape_string($db, trim($_POST['prospect_id']));
$blood_type_id  = mysqli_real_escape_string($db, trim($_POST['blood_type_id']));
$quantity       = mysqli_real_escape_string($db, trim($_POST['quantity']));

$data = array();

$res_success = 0;
$res_message = '';

$stock_id = 0;

$query = "
  SELECT * 
  FROM stocks 
  WHERE blood_type_id = '$blood_type_id'
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $stock_id = $row['stock_id'];
} else {
  $query = "
    INSERT INTO stocks (
      blood_type_id,  
      quantity
    ) VALUES (
      '$blood_type_id',  
      '0'
    )
  ";
  mysqli_query($db, $query);
  $stock_id = $db->insert_id;
}

$query = "
  UPDATE stocks 
  SET 
    quantity = quantity + ".$quantity."
  WHERE stock_id = '$stock_id'
";
mysqli_query($db, $query);

$query = "
  INSERT INTO stock_logs (
    stock_id, 
    prospect_id, 
    type, 
    quantity, 
    inserted_by, 
    date_inserted
  ) VALUE (
    '$stock_id', 
    '$prospect_id', 
    '2', 
    '$quantity', 
    '".$_SESSION['user']['user_id']."', 
    '".date('Y-m-d H:i:s')."'
  )
";
mysqli_query($db, $query);

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);


?>