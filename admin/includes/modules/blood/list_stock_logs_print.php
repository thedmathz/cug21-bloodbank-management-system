<?php 

require_once("../../connection.php"); 
require_once("../../../libraries/tcpdf/tcpdf.php");

$t_body = '';

$blood_type_id  = mysqli_real_escape_string($db, trim($_GET['blood_type_id']));
$lname          = mysqli_real_escape_string($db, trim($_GET['lname']));
$type           = mysqli_real_escape_string($db, trim($_GET['type']));
$quantity       = mysqli_real_escape_string($db, trim($_GET['quantity']));
$user_id        = mysqli_real_escape_string($db, trim($_GET['user_id']));
$date_inserted  = mysqli_real_escape_string($db, trim($_GET['date_inserted']));

$d_blood_type   = '';
$d_prospect     = '';
$d_type         = '';
$d_quantity     = '';
$d_inserted_by  = '';
$d_ate_inserted = '';

$blood_types  = array();
$types        = array('Get', 'Donate', 'Update');

$date_inserted_from = '';
$date_inserted_to   = '';

if (!$date_inserted) {
  $date_inserted_from = date('Y-m-01');
  $date_inserted_to   = date('Y-m-d');
} else {
  $temp_date_inserted = explode(' - ', $date_inserted);
  $date_inserted_from = date('Y-m-d', strtotime($temp_date_inserted[0]));
  $date_inserted_to   = date('Y-m-d', strtotime($temp_date_inserted[1]));
}

// ==================== DATA ====================

$query = "
  SELECT 
    sl.*, 
    bt.name AS bt_name, 
    pros.lname as pros_lname, pros.fname as pros_fname, pros.mname as pros_mname, 
    u.lname as u_lname, u.fname as u_fname
  FROM stock_logs AS sl 
  LEFT JOIN stocks AS s ON sl.stock_id = s.stock_id
  LEFT JOIN blood_types AS bt ON s.blood_type_id = bt.blood_type_id
  LEFT JOIN prospects AS pros ON sl.prospect_id = pros.prospect_id
  LEFT JOIN users AS u ON sl.inserted_by = u.user_id
";
$has_where = 0;
if ($blood_type_id) {
  if ($has_where) {
    $query .= " AND bt.blood_type_id = '$blood_type_id' ";
  } else {
    $query .= " WHERE bt.blood_type_id = '$blood_type_id' ";
  }
  $has_where = 1;
}
if ($type != '') {
  if ($has_where) {
    $query .= " AND sl.type = '$type' ";
  } else {
    $query .= " WHERE sl.type = '$type' ";
  }
  $has_where = 1;
}
if ($user_id) {
  if ($has_where) {
    $query .= " AND sl.inserted_by = '$user_id' ";
  } else {
    $query .= " WHERE sl.inserted_by = '$user_id' ";
  }
  $has_where = 1;
}
if ($date_inserted_from) {
  if ($has_where) {
    $query .= " AND (sl.date_inserted >= '$date_inserted_from 00:00:00' AND sl.date_inserted <= '$date_inserted_to 23:59:59') ";
  } else {
    $query .= " WHERE (sl.date_inserted >= '$date_inserted_from 00:00:00' AND sl.date_inserted <= '$date_inserted_to 23:59:59') ";
  }
  $has_where = 1;
}
if ($lname) {
  if ($has_where) {
    $query .= " AND pros.lname LIKE '%$lname%' ";
  } else {
    $query .= " WHERE pros.lname LIKE '%$lname%' ";
  }
  $has_where = 1;
}
if ($quantity) {
  if ($has_where) {
    $query .= " AND sl.quantity LIKE '%$quantity%' ";
  } else {
    $query .= " WHERE sl.quantity LIKE '%$quantity%' ";
  }
  $has_where = 1;
}
$query .= "
  ORDER BY sl.date_inserted DESC
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $t_body .=  '<tr>';
    $t_body .=    '<td valign="middle" style="font-size: 10px; text-align: center;">&nbsp;'.$row['bt_name'].'&nbsp;</td>';
    $t_body .=    '<td valign="middle" style="font-size: 10px; text-align: left; white-space: nowrap;">&nbsp;'.$row['pros_lname'].', '.$row['pros_fname'].' '.$row['pros_mname'].'&nbsp;</td>';
    $t_body .=    '<td valign="middle" style="font-size: 10px; text-align: center;">&nbsp;'.$types[$row['type']].'&nbsp;</td>';
    $t_body .=    '<td valign="middle" style="font-size: 10px; text-align: center;">&nbsp;'.($row['quantity'] + 0).'&nbsp;</td>';
    $t_body .=    '<td valign="middle" style="font-size: 10px; text-align: left;">&nbsp;'.$row['u_lname'].', '.$row['u_fname'].'&nbsp;</td>';
    $t_body .=    '<td valign="middle" style="font-size: 10px; text-align: center;">&nbsp;'.date('M d/y h:i A', strtotime($row['date_inserted'])).'&nbsp;</td>';
    $t_body .=  '</tr>';
  }
} else {
  $t_body .=  '<tr>';
  $t_body .=    '<td colspan="6" style="color: red; text-align: center;">No Record Found</td>';
  $t_body .=  '</tr>';
}

// ===================== PDF =====================
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Christopher Santing');
$pdf->SetTitle('Stock Logs');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(15, 15, 15);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// add a page
$pdf->AddPage();

$d_html = '
<div>
  <h1 style="margin: 0; padding: 0; text-align: center; line-height: 0;">Blood Bank Donor Management System</h1>
  <p style="margin: 0; padding: 0; text-align: center; line-height: 0;">San Francisco, Agusan del Sur</p> 
  <p></p>
  <p style="margin: 0; padding: 0; text-align: center; line-height: 0;">STOCK LOGS</p> 
  <br>
</div>
<table style="width: 50%; font-size: 12px;">
  <tr>
    <td colspan="2"><b>FILTERS:</b></td>
  </tr>
';

if ($blood_type_id) {
  $query = "
    SELECT *
    FROM blood_types 
    WHERE blood_type_id = '$blood_type_id'
  ";
  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($row) {
      $d_html .= '
        <tr>
          <td>Blood Type</td>
          <td><b>'.$row['name'].'</b></td>
        </tr>
      '; 
    }
  }
}
if ($lname) {
  $d_html .= '
    <tr>
      <td>Prospect (%)</td>
      <td><b>'.$lname.'</b></td>
    </tr>
  ';  
}
if ($type) {
  $d_html .= '
    <tr>
      <td>Log Type</td>
      <td><b>'.$types[$type].'</b></td>
    </tr>
  ';  
}
if ($quantity) {
  $d_html .= '
    <tr>
      <td>Quantity (%)</td>
      <td><b>'.$quantity.'</b></td>
    </tr>
  ';  
}
if ($user_id) {
  $query = "
    SELECT *
    FROM users 
    WHERE user_id = '$user_id'
  ";
  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($row) {
      $d_html .= '
        <tr>
          <td>Inserted By</td>
          <td><b>'.$row['lname'].', '.$row['fname'].'</b></td>
        </tr>
      '; 
    }
  }
}

$d_html .= '
  <tr>
    <td>Date Inserted</td>
    <td><b>'.$date_inserted.'</b></td>
  </tr>
</table>
<br><br>
<table border="1">
  <tr>
    <td style="font-size: 12px; font-weight: bold; text-align: center;">&nbsp;Blood Type&nbsp;&nbsp;</td>
    <td style="font-size: 12px; font-weight: bold; text-align: left;">&nbsp;Prospect&nbsp;&nbsp;</td>
    <td style="font-size: 12px; font-weight: bold; text-align: center;">&nbsp;Log Type&nbsp;&nbsp;</td>
    <td style="font-size: 12px; font-weight: bold; text-align: center;">&nbsp;Quantity (ml)&nbsp;&nbsp;</td>
    <td style="font-size: 12px; font-weight: bold; text-align: left;">&nbsp;Inserted By&nbsp;&nbsp;</td>
    <td style="font-size: 12px; font-weight: bold; text-align: center;">&nbsp;Date Inserted&nbsp;&nbsp;</td>
  </tr>
  '.$t_body.'
</table>
';

// Set some content to print
$html = <<<EOD

$d_html


EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('stock_logs.pdf', 'I');