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

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);


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

$sql = "Select a.Training_subject, c.wd_id, c.name, c.s_name, c.n_name, c.gen, d.token, e.pwd from m_training_sjb a Inner Join wd_training b ON a.Training_ID = b.Training_ID INNER join wd_db c ON b.wd_id = c.wd_id LEFT JOIN wd_access_code d ON c.wd_id = d.wd_id Left Join wd_access_password e ON c.wd_id = e.wd_id Where a.Training_ID = $tr_id AND d.expire > CURRENT_TIMESTAMP() Order By c.gen, c.wd_id";
$res = $conn->query($sql);
mysqli_close($conn);
$i = 0;
while ($row = $res->fetch_assoc())
{	//Var
	// Set Location
	if ($i == 9)
	{
		$i = 0;
		$pdf->AddPage();
	}
	switch ($i) {
		case 0:
			$iw = 15;
			$ih = 15;
			break;
		case 1:
			$iw = 105;
			$ih = 15;
			break;
		case 2:
			$iw = 195;
			$ih = 15;
			break;
		case 3:
			$iw = 15;
			$ih = 65;
			break;
		case 4:
			$iw = 105;
			$ih = 65;
			break;
		case 5:
			$iw = 195;
			$ih = 65;
			break;
		case 6:
			$iw = 15;
			$ih = 115;
			break;
		case 7:
			$iw = 105;
			$ih = 115;
			break;
		case 8:
			$iw = 195;
			$ih = 115;
			break;
	}
	
	
	
	$pdf->SetDrawColor(255, 255, 255, 0);
	$pdf->SetFillColor(0, 0, 0, 0);
	$pdf->Rect(0+$iw , 0+$ih , 90,50, 'DF');
	// BG 
	$pdf->Image('bg/bg.png',$iw , $ih , 90,50, '', '', '', false, 300, '', false, false, 0);
	
	// Nick name
	$nick_name = $row['n_name'];
	$gen = $row['gen'];
	$pdf->SetFont('thsarabunb', 'B', 30, '', true);
	//$html = '<font stroke="0.1" fill="true" strokecolor="#FFFFFF" color="#FFFFFF" style="font-weight:bold;font-size:30;"><i>'.$nick_name.'</i></font>';
	$html = '<font stroke="0.1" fill="true" strokecolor="#FFFFFF" color="#FFFFFF" style="font-weight:bold;font-size:30;"><i>'.$nick_name.'</i></font><font stroke="0.1" fill="true" strokecolor="#FFFFFF" color="#FFFFFF" style="font-weight:bold;font-size:10;"><i> '.$gen.'</i></font>';
	//$pdf->writeHTMLCell(200, '', $iw + 65 , $ih + 2, $html, 0, 0, 0, true, 'L', true);
	//$pdf->MultiCell($iw + 65, $ih + 2, $html, 0, 'R', 0, 0, '', '', true, 0, true);
	
	$pdf->writeHTMLCell( 88, 50, $iw, $ih, $html, '', 0, 0, true, 'R', true);
	
	// Generate QR Code
	$pdf->Rect($iw + 70, $ih+16, 18, 18, 'F');
	$token_link = "https://www.wdact.co/WD_system/user_profile.php?token=".$row['token'];
	$pdf->write2DBarcode($token_link, 'QRCODE,H', $iw +70, $ih+16, 18, 18, $style, 'N');
	
	// Tets 
	
	
	
	
	//$style5 = array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 64, 128));
	//$pdf->SetLineStyle($style5);
	$pdf->Circle($iw+11,$ih+11,8.5, 0, 360, 'F');
	// Logo
	$pdf->Image('bg/logo.png',$iw+1 , $ih+1 , 20,20, '', '', '', false, 300, '', false, false, 0);
	//$pdf->Image('bg/wearedog.png',$iw+1 , $ih+1 , 18,5, '', '', '', false, 300, '', false, false, 0);
		
	$i++;
}

// ============= End Item 1 in Page ===========================






// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
$pdf->Output('Wd_dog_tag.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
