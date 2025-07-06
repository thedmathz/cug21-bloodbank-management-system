<?php

// $db = new mysqli("127.0.0.1", "u550545620_bbdms", "Bbdms2022", "u550545620_bbdms");
$db = new mysqli("localhost", "dmathz", "D@2022", "bdms", 3307);
$prospect_id  = mysqli_real_escape_string($db, trim($_GET['prospect_id']));

$genders  = array('', 'Male', 'Female');
$types    = array('Get Blood', 'Donate Blood');
$statuses = array('Declined', 'Pending', 'Approved', 'Checked', 'Done');

$avatar     = '../prospect/assets/images/avatars/avatar.jpg';
$name       = '';
$gender     = '';
$address    = '';
$phone      = '';
$trans_type = 'None'; // Get or Donate Blood
$date       = '-'; // Appointment Date
$status     = 'None';
$valid      = 0;

$query = "
  SELECT 
    pros.*, 
    bar.name AS bar_name 
  FROM prospects AS pros
  LEFT JOIN barangays AS bar ON pros.barangay_id = bar.barangay_id 
  WHERE 
    pros.prospect_id = '$prospect_id'
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);

  if ($row['pic_ext']) {
    $avatar = '../prospect/uploads/'.md5($prospect_id).'.'.$row['pic_ext'];
  }
  $name       = strtoupper($row['fname'].' '.$row['mname'].' '.$row['lname']);
  $gender     = $genders[$row['gender']];
  $address    = $row['bar_name'];
  $phone      = $row['phone'];

  $valid = 1;

}

$query = "
  SELECT * 
  FROM requests 
  WHERE 
    prospect_id = '$prospect_id'
    AND status NOT IN (0,4)
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $trans_type = $types[$row['type']];
  $status     = $statuses[$row['status']];
  if ($row['status'] > 1 && $row['status'] != 4) {
    $date = date('M d/y', strtotime($row['date_appt']));
  }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BBDMS</title>

  <style>
    html, body {
      padding: 0;
      margin: 0;
      background: #ff3a3a;
    }
    body {
      padding: 16px;
      display: flex;
      justify-content: center;
    }
    .d_ahem {
      width: 400px;
      height: calc(100vh - 32px);
      box-shadow: 0 0 2px 1px #000;
      background: #fff !important;
    }
    .d_ahem_div {
      padding: 25px 15px;
      width: 100%;
      height: calc(100% - 50px);
    }
    @media (max-width: 360px) {
      .d_ahem {
        width: 100%;
      }
    }
  </style>
</head>
<body>

  <div class="d_ahem" style="display: flex; justify-content: center; background: url('../assets/img/checker_bg.jpg');">
    <div class="d_ahem_div">
      <div style="height: 0px; display: flex; justify-content: center; width: 100%;">
        <div style="flex: 1; color: #000; text-align: center;">
          <h2 style="margin: 15px ​0 0; padding: 0 40px;">Blood Bank and Donor Management System</h2>
        </div>
      </div>
      <div style="padding-top: 145px; text-align: center">
        <div style="width: 220px; height: 220px; margin: auto; background: #ccc">
          <img src="<?php echo $avatar; ?>" style="width: 100%; height: 100%; background: #ccc;" alt="">
        </div>
        <?php if ($valid) { ?>
          <div style="margin-top: 35px; width: auto; background: transparent; padding: 0 10px;">
            <table style="font-family: sans-serif; font-size: 14px;">
              <tr>
                <td style="text-align: left; vertical-align: baseline;">Name</td>
                <td style="vertical-align: baseline;">:</td>
                <td style="text-align: left; vertical-align: baseline;"><b><?php echo $name; ?></b></td>
              </tr>
              <tr>
                <td style="text-align: left; vertical-align: baseline;">Gender</td>
                <td style="vertical-align: baseline;">:</td>
                <td style="text-align: left; vertical-align: baseline;"><?php echo $gender; ?></td>
              </tr>
              <tr>
                <td style="text-align: left; vertical-align: baseline;">Barangay</td>
                <td style="vertical-align: baseline;">:</td>
                <td style="text-align: left; vertical-align: baseline;"><?php echo $address; ?></td>
              </tr>
              <tr>
                <td style="text-align: left; vertical-align: baseline;">Phone</td>
                <td style="vertical-align: baseline;">:</td>
                <td style="text-align: left; vertical-align: baseline;"><?php echo $phone; ?></td>
              </tr>
              <tr>
                <td style="text-align: left; vertical-align: baseline;">Transaction</td>
                <td style="vertical-align: baseline;">:</td>
                <td style="text-align: left; vertical-align: baseline;"><?php echo $trans_type; ?></td>
              </tr>
              <tr>
                <td style="text-align: left; vertical-align: baseline;">Date Appt.</td>
                <td style="vertical-align: baseline;">:</td>
                <td style="text-align: left; vertical-align: baseline;"><?php echo $date; ?></td>
              </tr>
              <tr>
                <td style="text-align: left; vertical-align: baseline;">Status</td>
                <td style="vertical-align: baseline;">:</td>
                <td style="text-align: left; vertical-align: baseline;"><?php echo $status; ?></td>
              </tr>
            </table>
          </div>
        <?php } else { ?>
          <div style="margin-top: 80px; width: 100%; background: #cc0000; color: white;">
            <h1 style="padding: 3px 8px;">UNKNOWN QR CODE</h1>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  
</body>
</html>