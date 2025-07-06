<?php
include('connection.php');

$province_id =  mysqli_real_escape_string($db, $_POST['province_id']);

$query = "SELECT * FROM cities WHERE province_id = '$province_id'";
$result= mysqli_query($db,$query)or die ('Error in'. $query);

$html = '<option value="">&nbsp;</option>';
if($province_id != "") {
    $html = '';
    while($row = mysqli_fetch_array($result)) {
        $html .= "<option value='".$row['city_id']."'>".$row['name']."</option>";
    }
}

echo $html;



?>