<?php 
date_default_timezone_set('Asia/Manila');

require_once '../../connection.php'; 

function itexmo($number,$message,$apicode,$passwd)
{

  $ch = curl_init();
  $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
  curl_setopt($ch, CURLOPT_URL,"https://www.itexmo.com/php_api/api.php");
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, 
  http_build_query($itexmo));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  return curl_exec ($ch);
  curl_close ($ch);

}

$d_type               = mysqli_real_escape_string($db, trim($_POST['d_type']));
$request_id           = mysqli_real_escape_string($db, trim($_POST['request_id']));
$status               = mysqli_real_escape_string($db, trim($_POST['status']));
$edit_status          = mysqli_real_escape_string($db, trim($_POST['edit_status']));
$edit_blood_type_id   = mysqli_real_escape_string($db, trim($_POST['edit_blood_type_id']));
$edit_blood_status    = mysqli_real_escape_string($db, trim($_POST['edit_blood_status']));
$edit_quantity_donor  = mysqli_real_escape_string($db, trim($_POST['edit_quantity_donor']));

$data = array();

$res_success = 1;
$res_message = '';

$stock_id       = '';
$blood_type_id  = '';
$prospect_id    = '';
$donate_to      = '';
$donate_from    = '';

// for sms
$number   = '09272828926';
$message  = '';
$apicode  = 'ST-ROGIN828926_4RAF5';
$passwd   = 'b6a!#n7ndv';

if ($status == '1') {
  $query = "
    UPDATE requests 
    SET 
  ";
  if ($edit_status == '0') {
    $query .= " 
      status    = '$edit_status', 
      done_by   = '".$_SESSION['user']['user_id']."',  
      date_done = '".date('Y-m-d H:i:s')."'
    ";
    $ds_query = "
      SELECT 
        req.type, 
        pros.phone  
      FROM requests AS req 
      LEFT JOIN prospects as pros ON req.prospect_id = pros.prospect_id
      WHERE 
        req.request_id = '$request_id'
    ";
    $ds_result = mysqli_query($db, $ds_query);
    if (mysqli_num_rows($ds_result) > 0) {
      $ds_row = mysqli_fetch_assoc($ds_result);

      $number = $ds_row['phone'];
      if ($ds_row['type'] == '0') {
        $message = '[BBDMS] Your blood request is not available at this moment. You may visit bbdms.tech for more information.';
      } else {
        $message = "[BBDMS] Your blood donation request has been declined because BBDMS Office is not available on the day of your appointment. Thank you.";
      }

      itexmo($number,$message,$apicode,$passwd);
    }
  }
  if ($edit_status == '2') {
    $query .= " 
      status            = '$edit_status', 
      appointed_by      = '".$_SESSION['user']['user_id']."',  
      date_appointment  = '".date('Y-m-d H:i:s')."'
    ";

    $ds_query = "
      SELECT 
        req.type, 
        pros.phone  
      FROM requests AS req 
      LEFT JOIN prospects as pros ON req.prospect_id = pros.prospect_id
      WHERE 
        req.request_id = '$request_id'
    ";
    $ds_result = mysqli_query($db, $ds_query);
    if (mysqli_num_rows($ds_result) > 0) {
      $ds_row = mysqli_fetch_assoc($ds_result);

      $number = $ds_row['phone'];
      if ($ds_row['type'] == '0') {
        $message = '[BBDMS] Your request has been approved! Please wait for admins approval to get your blood request. Thank you.';
      } else {
        $message = "[BBDMS] Your request has been approved! You may now go to the Blood Bank located at Government Center, Patin-ay, Prosperidad, Agusan del Sur, in the day that you're appointed to check your blood and donate.";
      }

      itexmo($number,$message,$apicode,$passwd);
    }

  }
  $query .= "
    WHERE request_id = '$request_id'
  ";
}
if ($status == '2') {
  $query = "
    UPDATE requests 
    SET 
  ";
  if ($d_type == '1') {
    if ($edit_status == '0') {
      $query .= " 
        status    = '$edit_status', 
        done_by   = '".$_SESSION['user']['user_id']."',  
        date_done = '".date('Y-m-d H:i:s')."'
      ";
    }
    if ($edit_status == '3') {
        
        if ($edit_blood_status == '0') {
            $query .= " 
                status        = '0', 
                done_by       = '".$_SESSION['user']['user_id']."',  
                date_done     = '".date('Y-m-d H:i:s')."', 
                blood_type_id = '$edit_blood_type_id', 
                blood_status  = '$edit_blood_status', 
                checked_by    = '".$_SESSION['user']['user_id']."',  
                date_checked  = '".date('Y-m-d H:i:s')."'
              ";
        } else {
            $query .= " 
                status        = '$edit_status', 
                blood_type_id = '$edit_blood_type_id', 
                blood_status  = '$edit_blood_status', 
                checked_by    = '".$_SESSION['user']['user_id']."',  
                date_checked  = '".date('Y-m-d H:i:s')."'
              ";
        }
      

      $d_query = "
        SELECT * 
        FROM requests 
        WHERE request_id = '$request_id'
      ";
      $d_result = mysqli_query($db, $d_query);
      if (mysqli_num_rows($d_result) > 0) {
        $d_row = mysqli_fetch_assoc($d_result);
        
        $d_query2 = "
          UPDATE prospects 
          SET blood_type_id = '$edit_blood_type_id'
          WHERE prospect_id = '".$d_row['prospect_id']."'
        ";
        mysqli_query($db, $d_query2);
      }
      
        $ds_query = "
          SELECT 
            req.type, 
            pros.phone  
          FROM requests AS req 
          LEFT JOIN prospects as pros ON req.prospect_id = pros.prospect_id
          WHERE 
            req.request_id = '$request_id'
        ";
        $ds_result = mysqli_query($db, $ds_query);
        if (mysqli_num_rows($ds_result) > 0) {
          $ds_row = mysqli_fetch_assoc($ds_result);
    
          $number = $ds_row['phone'];
          if ($ds_row['type'] == '0') {
            // $message = '[BBDMS] Your request has been approved! You can now search donors/blood and/or wait for admins approval to get your blood.';
          } else {
              if ($edit_blood_status == '0') {
                    $message = "[BBDMS] Your blood has been verified and checked but we're sorry that its not suitable for donation. Thank you!";
              } else {
                    $message = '[BBDMS] Your blood has been verified and checked! Your blood is good to be donated.';   
              }
          }
    
          itexmo($number,$message,$apicode,$passwd);
        }

    }
  } else if ($edit_status == '4') {

    $query .= " 
      quantity_donor        = '$edit_quantity_donor', 
      status        = '$edit_status', 
      checked_by    = '".$_SESSION['user']['user_id']."',  
      date_checked  = '".date('Y-m-d H:i:s')."', 
      done_by       = '".$_SESSION['user']['user_id']."',  
      date_done     = '".date('Y-m-d H:i:s')."'
    ";

    $query8 = "
      SELECT * 
      FROM requests 
      WHERE request_id = '$request_id'
    ";
    $result8 = mysqli_query($db, $query8);
    if (mysqli_num_rows($result8) > 0) {
      $row = mysqli_fetch_assoc($result8);

      $prospect_id          = $row['prospect_id'];
      $blood_type_id        = $row['blood_type_id'];
      $edit_quantity_donee  = $row['quantity_donee'];
      $stock_id             = '';
      $d_qty                = 0;

      $query9 = "
        SELECT * 
        FROM stocks 
        WHERE blood_type_id = '$blood_type_id'
      ";
      $result9 = mysqli_query($db, $query9);
      if (mysqli_num_rows($result9) > 0) {
        $row9 = mysqli_fetch_assoc($result9);
        $stock_id = $row9['stock_id'];
        $d_qty    = (float) $row9['quantity'];
      }
      
        if ($edit_quantity_donee > $d_qty) { // if get is greater than stock
            $data['res_success'] = '0';
            $data['res_message'] = 'Invalid! The selected blood type is out of stock!';
            
            echo json_encode($data);
            die();
        }

      $query10 = "
        INSERT INTO stock_logs (
          stock_id, 
          prospect_id, 
          type, 
          quantity, 
          inserted_by, 
          date_inserted
        ) VALUES (
          '$stock_id', 
          '$prospect_id', 
          '0', 
          '$edit_quantity_donee', 
          '".$_SESSION['user']['user_id']."', 
          '".date('Y-m-d H:i:s')."'
        )
      ";
      mysqli_query($db, $query10);

      $query11 = "
        UPDATE stocks 
        SET quantity = '".($d_qty - $edit_quantity_donee)."' 
        WHERE stock_id = '$stock_id' 
      ";
      mysqli_query($db, $query11);
      
    }
    
    $ds_query = "
      SELECT 
        req.type, 
        pros.phone  
      FROM requests AS req 
      LEFT JOIN prospects as pros ON req.prospect_id = pros.prospect_id
      WHERE 
        req.request_id = '$request_id'
    ";
    $ds_result = mysqli_query($db, $ds_query);
    if (mysqli_num_rows($ds_result) > 0) {
      $ds_row = mysqli_fetch_assoc($ds_result);

      $number = $ds_row['phone'];
        $message = "[BBDMS] Thank you for patronizing blood bank. Hope to see you next on next blood bank transaction.";

      itexmo($number,$message,$apicode,$passwd);
    }

  } else if ($d_type == '0' && $edit_status == '0') {
    $query .= " 
      status    = '$edit_status', 
      done_by   = '".$_SESSION['user']['user_id']."',  
      date_done = '".date('Y-m-d H:i:s')."'
    ";  
    
    $ds_query = "
      SELECT 
        req.type, 
        pros.phone  
      FROM requests AS req 
      LEFT JOIN prospects as pros ON req.prospect_id = pros.prospect_id
      WHERE 
        req.request_id = '$request_id'
    ";
    $ds_result = mysqli_query($db, $ds_query);
    if (mysqli_num_rows($ds_result) > 0) {
      $ds_row = mysqli_fetch_assoc($ds_result);

      $number = $ds_row['phone'];
        $message = '[BBDMS] Your blood request is not available at this moment. You may visit bbdms.tech for more information.';
        
      itexmo($number,$message,$apicode,$passwd);
    }
  }
  $query .= "
    WHERE request_id = '$request_id'
  ";
}
if ($status == '3') {
  $query = "
    UPDATE requests 
    SET 
  ";
  if ($edit_status == '0') {
    $query .= " 
      status    = '$edit_status', 
      done_by   = '".$_SESSION['user']['user_id']."',  
      date_done = '".date('Y-m-d H:i:s')."'
    ";
  }
  if ($edit_status == '4') {
    $query2 = "
      SELECT donate_to, prospect_id, blood_type_id
      FROM requests
      WHERE request_id = '$request_id'
    ";
    $result2 = mysqli_query($db, $query2);
    if (mysqli_num_rows($result2) > 0) {
      $row2           = mysqli_fetch_assoc($result2);
      $donate_to      = $row2['donate_to'];
      $prospect_id    = $row2['prospect_id'];
      $blood_type_id  = $row2['blood_type_id'];

      $query3 = "
        SELECT donate_from, quantity_donor 
        FROM requests 
        WHERE request_id = '$donate_to' 
      ";
      $result3 = mysqli_query($db, $query3);
      if (mysqli_num_rows($result3) > 0) {
        $row3 = mysqli_fetch_assoc($result3);
        $temp_quantity_donee  = trim($row3['quantity_donor']);
        $temp_donate_from     = trim($row3['donate_from']);
        $temp_donate_from     = explode(', ', $temp_donate_from);

        if (!in_array($request_id, $temp_donate_from)) {
          $temp_donate_from[] = $request_id;
          $temp_quantity_donee = (float) $temp_quantity_donee + $edit_quantity_donor;
        }
        $donate_from = implode(', ', $temp_donate_from);

        $query4 = "
          UPDATE requests 
          SET 
            donate_from = '$donate_from', 
            quantity_donor = '$temp_quantity_donee'
          WHERE request_id = '$donate_to' 
        ";
        mysqli_query($db, $query4);
      }

      $query5 = "
        SELECT * 
        FROM stocks 
        WHERE blood_type_id = '$blood_type_id'
      ";
      $result5 = mysqli_query($db, $query5);
      if (mysqli_num_rows($result5) > 0) {
        $row5     = mysqli_fetch_assoc($result5);

        $stock_id = $row5['stock_id'];
        $d_qty    = (float) $row5['quantity'];

        $query6 = "
          INSERT INTO stock_logs (
            stock_id, 
            prospect_id, 
            type, 
            quantity, 
            inserted_by, 
            date_inserted
          ) VALUES (
            '$stock_id', 
            '$prospect_id', 
            '1', 
            '$edit_quantity_donor', 
            '".$_SESSION['user']['user_id']."', 
            '".date('Y-m-d H:i:s')."'
          )
        ";
        mysqli_query($db, $query6);

        $query7 = "
          UPDATE stocks
          SET quantity = '".($d_qty + $edit_quantity_donor)."' 
          WHERE stock_id = '$stock_id'
        ";
        mysqli_query($db, $query7);

      }

    }
    $query .= " 
      quantity_donor  = '$edit_quantity_donor', 
      status          = '$edit_status', 
      done_by         = '".$_SESSION['user']['user_id']."',  
      date_done       = '".date('Y-m-d H:i:s')."'
    ";
    $rd_query = "
      UPDATE searches
      SET status = '1' 
      WHERE requested_to = '$prospect_id'
    ";
    mysqli_query($db, $rd_query);
    
    $ds_query = "
      SELECT 
        req.type, 
        pros.phone  
      FROM requests AS req 
      LEFT JOIN prospects as pros ON req.prospect_id = pros.prospect_id
      WHERE 
        req.request_id = '$request_id'
    ";
    $ds_result = mysqli_query($db, $ds_query);
    if (mysqli_num_rows($ds_result) > 0) {
      $ds_row = mysqli_fetch_assoc($ds_result);

      $number = $ds_row['phone'];
      if ($ds_row['type'] == '0') {
        // $message = '[BBDMS] Your blood request is not available at this moment. You may visit bbdms.tech for more information.';
      } else {
        $message = "[BBDMS] Thank you for patronizing blood bank. Hope to see you next on the next blood bank transaction.";
      }

      itexmo($number,$message,$apicode,$passwd);
    }
  }
  $query .= "
    WHERE request_id = '$request_id'
  ";
}
mysqli_query($db, $query);

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);


?>