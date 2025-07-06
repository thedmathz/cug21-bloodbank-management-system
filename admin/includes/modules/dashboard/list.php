<?php 

require_once '../../includes/connection.php'; 

$a_plus       = '0';
$a_minus      = '0';
$b_plus       = '0';
$b_minus      = '0';
$ab_plus      = '0';
$ab_minus     = '0';
$o_plus       = '0';
$o_minus      = '0';
$tot_donors   = '0';
$tot_requests = '0';
$app_requests = '0';
$tot_bloods   = '0';

// for a+
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '1'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $a_plus   = floor($row['quantity']/$row2['unit_per_bag']);
}
// for a-
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '2'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $a_minus   = floor($row['quantity']/$row2['unit_per_bag']);
}
// for b+
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '3'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $b_plus   = floor($row['quantity']/$row2['unit_per_bag']);
}
// for b-
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '4'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $b_minus   = floor($row['quantity']/$row2['unit_per_bag']);
}
// for ab+
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '5'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $ab_plus   = floor($row['quantity']/$row2['unit_per_bag']);
}
// for ab-
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '6'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $ab_minus   = floor($row['quantity']/$row2['unit_per_bag']);
}
// for o+
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '7'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $o_plus   = floor($row['quantity']/$row2['unit_per_bag']);
}
// for o+
$result = mysqli_query($db, "SELECT * FROM stocks WHERE stock_id = '8'");
if (mysqli_num_rows($result) > 0) {
  $row      = mysqli_fetch_assoc($result);
  $result2  = mysqli_query($db, "SELECT * FROM blood_types WHERE blood_type_id = '".$row['blood_type_id']."'");
  $row2     = mysqli_fetch_assoc($result2);
  $o_minus   = floor($row['quantity']/$row2['unit_per_bag']);
}
// total unique donors
$result = mysqli_query($db, "SELECT DISTINCT prospect_id FROM stock_logs");
if (mysqli_num_rows($result) > 0) {
  $tot_donors = mysqli_num_rows($result);
}
// total requests
$result = mysqli_query($db, "SELECT * FROM requests");
if (mysqli_num_rows($result) > 0) {
  $tot_requests = mysqli_num_rows($result);
}
// approved requests
$result = mysqli_query($db, "SELECT * FROM requests WHERE status >= 2");
if (mysqli_num_rows($result) > 0) {
  $app_requests = mysqli_num_rows($result);
}
// 
$result = mysqli_query($db, "SELECT SUM(quantity) AS tot_bloods FROM stocks");
if (mysqli_num_rows($result) > 0) {
  $row        = mysqli_fetch_assoc($result);
  $tot_bloods = $row['tot_bloods'];
}

?>