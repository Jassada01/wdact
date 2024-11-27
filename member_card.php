<?php
// Check Cookie
ob_start();
include "f_check_cookie.php";
ob_end_clean();

// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');

$tr_id = $_GET['tr_id'];
// create new PDF document
$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Jassadaporn_Deewan');
$pdf->SetTitle('Wd_dog_tag');
$pdf->SetSubject('Wd_dog_tag');
//exit();
// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 050', PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins('5', '5', '5');
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(10);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 0);

// set image scale factor
$pdf->setImageScale(1);

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
// set some language-dependent strings (optional)
$l = Array();
$l['a_meta_charset'] = 'UTF-8';
$l['a_meta_dir'] = 'ltr';
$l['a_meta_language'] = 'th';
// TRANSLATIONS --------------------------------------
$l['w_page'] = 'page';
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// NOTE: 2D barcode algorithms must be implemented on 2dbarcode.php class file.

// add a page
$pdf->AddPage();


//$pdf->SetFont('helvetica', '', 10);
$pdf->SetFont('thsarabunb', '', 16, '', true);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// set style for barcode
// define barcode style
$style = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => 0,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'thsarabunb',
    'fontsize' => 10,
    'stretchtext' => 8
);


$server_name = "127.0.0.1";
$UID = "root";
$Pass = "caster@2017";
$DB_name = "wds";
$conn = new mysqli($server_name,$UID,$Pass,$DB_name);
mysqli_set_charset($conn, "utf8");

# $sql = "Select * from RM_Stock Where count_no between 1 and 4";
#$sql = "Select a.Training_subject, c.wd_id, c.name, c.s_name, c.n_name, c.gen,  d.token from m_training_sjb a Inner Join wd_training b ON a.Training_ID = b.Training_ID INNER join wd_db c ON b.wd_id = c.wd_id LEFT JOIN wd_access_code d ON c.wd_id = d.wd_id Where a.Training_ID = 47 AND d.expire > CURRENT_TIMESTAMP() LIMIT 4";
# $sql = "Select a.Training_subject, c.wd_id, c.name, c.s_name, c.n_name, c.gen,  d.token from m_training_sjb a Inner Join wd_training b ON a.Training_ID = b.Training_ID INNER join wd_db c ON b.wd_id = c.wd_id LEFT JOIN wd_access_code d ON c.wd_id = d.wd_id Where a.Training_ID = $tr_id AND d.expire > CURRENT_TIMESTAMP() Order By c.gen";
$sql = "Select a.Training_subject, c.wd_id, c.name, c.s_name, c.n_name, c.gen, d.token, e.pwd from m_training_sjb a Inner Join wd_training b ON a.Training_ID = b.Training_ID INNER join wd_db c ON b.wd_id = c.wd_id LEFT JOIN wd_access_code d ON c.wd_id = d.wd_id Left Join wd_access_password e ON c.wd_id = e.wd_id Where a.Training_ID = $tr_id AND d.expire > CURRENT_TIMESTAMP() Order By c.gen, c.wd_id";
$res = $conn->query($sql);
mysqli_close($conn);
$i = 0;
while ($row = $res->fetch_assoc())
{	//Var
	// Set Location
	if ($i == 8)
	{
		$i = 0;
		$pdf->AddPage();
	}
	switch ($i) {
		case 0:
			$iw = 0;
			$ih = 0;
			break;
		case 1:
			$iw = 74.5;
			$ih = 0;
			break;
		case 2:
			$iw = 147.25;
			$ih = 0;
			break;
		case 3:
			$iw = 220.25;
			$ih = 0;
			break;
		case 4:
			$iw = 0;
			$ih = 105;
			break;
		case 5:
			$iw = 74.5;
			$ih = 105;
			break;
		case 6:
			$iw = 147.25;
			$ih = 105;
			break;
		case 7:
			$iw = 220.25;
			$ih = 105;
			break;
	}
	
	
	
	$pdf->SetDrawColor(255, 255, 255, 0);
	$pdf->SetFillColor(0, 0, 0, 0);
	$pdf->Rect(0+$iw , 0+$ih , 74.25,105, 'DF');
	$pdf->Image('bg/001.png',0+$iw , 0+$ih , 74.25,105, '', '', '', false, 300, '', false, false, 0);
	//$pdf->Image('bg/001.png', 15, 140, 75, 113, 'PNG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
	
	
	
	# $date = $row['stk_date'];
	//$date = date("j M Y G:i", strtotime($row['stk_date']));
	$name = $row['name']." ".$row['s_name'];
	$nick_name = $row['n_name'];
	$ini_pwd = $row['pwd'];
	$Training_subject = $row['Training_subject'];
	$gen = $row['gen'];
	$token_link = "https://www.wdact.co/WD_system/user_profile.php?token=".$row['token'];
	//$token_link = "http://192.168.0.122/WD_system/user_profile.php?token=".$row['token'];


	// Print to PDf
	$pdf->SetFont('thsarabunb', 'B', 25, '', true);
	$pdf->Text($iw + 5, $ih + 5, $Training_subject) ;
	
	
	$pdf->SetFont('thsarabunb', 'B', 25, '', true);
	//$html = '<font stroke="0.5" fill="true" strokecolor="black" color="white" style="font-weight:bold;font-size:80;">'.$nick_name.'</font> รุ่น '.$gen;
	if (strlen(trim($nick_name)) <= 12 )
	{
		//$html = '<font stroke="0.4" fill="true" strokecolor="black" color="black" style="font-weight:bold;font-size:100;"><i>'.$nick_name.'</i></font>';
		$html = '<font stroke="0.4" fill="true" strokecolor="black" color="black" style="font-weight:bold;font-size:70;"><i>'.$nick_name.'</i></font>';
		$pdf->writeHTMLCell(68, '', $iw + 5, $ih + 60, $html, '', 0, 0, false, 'L', true);
	}
	else if (strlen(trim($nick_name)) <= 18)
	{
		//$html = '<font stroke="0.4" fill="true" strokecolor="black" color="black" style="font-weight:bold;font-size:85;"><i>'.$nick_name.'</i></font>';
		$html = '<font stroke="0.4" fill="true" strokecolor="black" color="black" style="font-weight:bold;font-size:65;"><i>'.$nick_name.'</i></font>';
		$pdf->writeHTMLCell(68, '', $iw + 5, $ih + 60, $html, '', 0, 0, false, 'L', true);
	}
	else
	{
		//$html = '<font stroke="0.4" fill="true" strokecolor="black" color="black" style="font-weight:bold;font-size:75;"><i>'.$nick_name.'</i></font>';
		$html = '<font stroke="0.4" fill="true" strokecolor="black" color="black" style="font-weight:bold;font-size:55;"><i>'.$nick_name.'</i></font>';
		$pdf->writeHTMLCell(68, '', $iw + 5, $ih + 60, $html, '', 0, 0, false, 'L', true);
	}
	

	
	$pdf->SetFont('thsarabunb', 'B', 25, '', true);
	$pdf->Text($iw + 0, $ih + 92, 'รุ่น '.$gen) ;
	
	$pdf->write2DBarcode($token_link, 'QRCODE,H', $iw + 49.25, $ih + 82, 21.5,21.5, $style, 'N');
	
	//$pdf->SetFont('thsarabunb', 'B', 10, '', true);
	//$pdf->Text($iw + 56, $ih + 100.5, $ini_pwd) ;
	
	$i++;

	switch ($i) {
		case 0:
			$iw = 0;
			$ih = 0;
			break;
		case 1:
			$iw = 74.5;
			$ih = 0;
			break;
		case 2:
			$iw = 147.25;
			$ih = 0;
			break;
		case 3:
			$iw = 220.25;
			$ih = 0;
			break;
		case 4:
			$iw = 0;
			$ih = 105;
			break;
		case 5:
			$iw = 74.5;
			$ih = 105;
			break;
		case 6:
			$iw = 147.25;
			$ih = 105;
			break;
		case 7:
			$iw = 220.25;
			$ih = 105;
			break;
	}
	
	$pdf->SetDrawColor(255, 255, 255, 0);
	$pdf->SetFillColor(0, 0, 0, 0);
	$pdf->Rect(0+$iw , 0+$ih , 74.25,105, 'DF');
	$pdf->Image('bg/001.png',0+$iw , 0+$ih , 74.25,105, '', '', '', false, 300, '', false, false, 0);
	
	
		// Print to PDf
	$pdf->SetFont('thsarabunb', 'B', 25, '', true);
	$pdf->Text($iw + 5, $ih + 5, $Training_subject) ;
	
	
	$pdf->SetFont('thsarabunb', 'B', 25, '', true);
	//$html = '<font stroke="0.5" fill="true" strokecolor="black" color="white" style="font-weight:bold;font-size:80;">'.$nick_name.'</font> รุ่น '.$gen;
	if (strlen(trim($nick_name)) <= 12 )
	{
		//$html = '<font stroke="0.4" fill="true" strokecolor="black" color="black" style="font-weight:bold;font-size:100;"><i>'.$nick_name.'</i></font>';
		$html = '<font stroke="0.4" fill="true" strokecolor="black" color="black" style="font-weight:bold;font-size:70;"><i>'.$nick_name.'</i></font>';
		$pdf->writeHTMLCell(68, '', $iw + 5, $ih + 60, $html, '', 0, 0, false, 'L', true);
	}
	else if (strlen(trim($nick_name)) <= 18)
	{
		//$html = '<font stroke="0.4" fill="true" strokecolor="black" color="black" style="font-weight:bold;font-size:85;"><i>'.$nick_name.'</i></font>';
		$html = '<font stroke="0.4" fill="true" strokecolor="black" color="black" style="font-weight:bold;font-size:65;"><i>'.$nick_name.'</i></font>';
		$pdf->writeHTMLCell(68, '', $iw + 5, $ih + 60, $html, '', 0, 0, false, 'L', true);
	}
	else
	{
		//$html = '<font stroke="0.4" fill="true" strokecolor="black" color="black" style="font-weight:bold;font-size:75;"><i>'.$nick_name.'</i></font>';
		$html = '<font stroke="0.4" fill="true" strokecolor="black" color="black" style="font-weight:bold;font-size:55;"><i>'.$nick_name.'</i></font>';
		$pdf->writeHTMLCell(68, '', $iw + 5, $ih + 60, $html, '', 0, 0, false, 'L', true);
	}
	

	
	$pdf->SetFont('thsarabunb', 'B', 25, '', true);
	$pdf->Text($iw + 0, $ih + 92, 'รุ่น '.$gen) ;
	
	$pdf->write2DBarcode($token_link, 'QRCODE,H', $iw + 49.25, $ih + 82, 21.5,21.5, $style, 'N');
	
	//$pdf->SetFont('thsarabunb', 'B', 10, '', true);
	//$pdf->Text($iw + 56, $ih + 100.5, $ini_pwd) ;
	
	$i++;
}

// ============= End Item 1 in Page ===========================






// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
$pdf->Output('Wd_dog_tag.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
