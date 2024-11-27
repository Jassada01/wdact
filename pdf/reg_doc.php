<?php


// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');
// Get paramiter
$trid = $_GET['trid'];
// create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Get header Data
$server_name = "localhost";
$UID = "root";
$Pass = "caster@2017";
$DB_name = "wds";
$conn = new mysqli($server_name,$UID,$Pass,$DB_name);
mysqli_set_charset($conn, "utf8");
# $sql = "Select * from RM_Stock Where count_no between 1 and 4";
$sql = "SELECT * FROM `m_training_sjb` WHERE `Training_ID` = $trid";
$res = $conn->query($sql);

$row = $res->fetch_assoc();
$tr_name = $row['Training_subject'];
$tr_location = $row['location'];











// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ACT');
$pdf->SetTitle('ใบลงทะเบียน');
$pdf->SetSubject('ใบลงทะเบียน');
$pdf->SetKeywords('WDS');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 050', PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins('5', '10', '10');
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
//$pdf->SetFont('thsarabunb', '', 16, '', true);
$pdf->SetFont('thsarabunb', 'B', 24, '', true);
$print_html = '<table border="0" style="width:100%"><tr><td align="center" style="width:100%">ใบลงทะเบียน</td></tr></table>';
$pdf->writeHTMLCell(190, '', 10,10, $print_html, '', 0, 0, true, 'L', true);

$pdf->SetFont('thsarabunb', 'B', 18, '', true);
//$pdf->Text(65, 24, "$tr_name $tr_location");
$print_html = '<table border="0" style="width:100%"><tr><td align="center" style="width:100%">'.$tr_name .'</td></tr></table>';
$pdf->writeHTMLCell(190, '', 10,20, $print_html, '', 0, 0, true, 'L', true);
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
// ============= End Item 1 in Page ===========================

// Download tr data
$sql = "Select a.wd_id,b.gen, b.name, b.s_name, b.n_name, b.sex, b.tel, b.tel_2, d.PROVINCE_NAME From wd_training a Inner Join wd_db b ON a.wd_id = b.wd_id INNER Join add_districts c ON b.add_code = c.DISTRICT_CODE Inner Join add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID Where a.Training_ID = $trid Order By a.wd_id";
$res = $conn->query(trim($sql));


$html = '
<table border="1" style="width:100%">
<tr>
	<th align="center" style="width: 40px">ลำดับ</th>
	<th align="center" style="width: 120px">ชื่อ นามสกุล</th>
	<th align="center" style="width: 50px">ชื่อเล่น</th>
	<th align="center" style="width: 80px">จังหวัด</th>
	<th align="center" style="width: 80px">โทร</th>
	<th align="center" style="width: 100px">ลายมือชื่อ</th>
	<th align="center" style="width: 70px">หมายเหตุ</th>
</tr>';

$tr_cnt = 1;
while ($row = $res->fetch_assoc()){
	$html.= '
	<tr>
	<td align="center">'.$tr_cnt.'</td>
	<td>   '.$row['name']."  ".$row['s_name'].'</td>
	<td align="center">'.$row['n_name'].'</td>
	<td align="center">'.$row['PROVINCE_NAME'].'</td>
	<td align="center">'.$row['tel'].'</td>
	<td></td>
	<td></td>
	</tr>
	
	';

	$tr_cnt +=1;
	
	
}

$html .='</table>';

$pdf->SetFont('thsarabunb', '', 14, '', true);
$pdf->writeHTMLCell(130, '', 10,30, $html, '', 0, 0, true, 'L', true);


mysqli_close($conn);
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
$pdf->Output('register_doc_'.$trid.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
