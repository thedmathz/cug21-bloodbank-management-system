<?php 

require_once '../../includes/connection.php'; 

$feedbacks = array();

$query = "
  SELECT 
    feedbacks.*, 
    prospects.lname, prospects.fname, prospects.mname 
  FROM feedbacks 
  LEFT JOIN prospects ON feedbacks.prospect_id = prospects.prospect_id
  ORDER BY feedbacks.date_inserted DESC
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $temp_arr['fb_id']          = $row['fb_id'];
    $temp_arr['lname']          = $row['lname'];
    $temp_arr['fname']          = $row['fname'];
    $temp_arr['mname']          = $row['mname'];
    $temp_arr['feedback']       = $row['feedback'];
    $temp_arr['date_inserted']  = date('M d/y h:i A', strtotime($row['date_inserted']));

    $feedbacks[] = $temp_arr;
  }
}


?>