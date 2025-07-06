<?php
include('connection.php');

$city_id =  mysqli_real_escape_string($db, $_POST['city_id']);

$query = "SELECT * FROM barangays WHERE city_id = '$city_id'";
$result= mysqli_query($db,$query)or die ('Error in'. $query);

$html = '<option value="">&nbsp;</option>';
if($city_id != "") {
    $html = '';
    while($row = mysqli_fetch_array($result)) {
        $html .= "<option value='".$row['barangay_id']."'>".$row['name']."</option>";
    }
}

echo $html;

?>