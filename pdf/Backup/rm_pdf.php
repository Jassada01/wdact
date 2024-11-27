<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');

// create new PDF document
$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Jassadaporn_Deewan_STHC');
$pdf->SetTitle('SHT_Stock_taking');
$pdf->SetSubject('SHT_Stock_taking');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

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

// set cell padding
//$cp = 1;
//$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
//$cm = 20;
//$pdf->setCellMargins(5, 5, 5, 5);

//$pdf->MultiCell(130, 75, '', 1, 'L', 0, 0, '', '', true);
//$pdf->MultiCell(130, 75, '', 1, 'L', 0, 1, '', '', true);
//$pdf->MultiCell(130, 75, '', 1, 'L', 0, 0, '', '', true);
//$pdf->MultiCell(130, 75, '', 1, 'L', 0, 2, '' ,'', true);

$server_name = "localhost";
$UID = "root";
$Pass = "caster";
$DB_name = "stock_taking";
$conn = new mysqli($server_name,$UID,$Pass,$DB_name);
# $sql = "Select * from RM_Stock Where count_no between 1 and 4";
$sql = "Select * from RM_Stock";
$res = $conn->query($sql);
mysqli_close($conn);
$i = 0;
while ($row = $res->fetch_assoc())
{	//Var
	// Set Location
	if ($i == 4)
	{
		$i = 0;
		// add a page
		$pdf->AddPage();
	}
	switch ($i) {
		case 0:
			$iw = 0;
			$ih = 0;
			break;
		case 1:
			$iw = 155;
			$ih = 0;
			break;
		case 2:
			$iw = 0;
			$ih = 110;
			break;
		case 3:
			$iw = 155;
			$ih = 110;
			break;
	}
	$date = $row['stk_date'];
	$wh = "WH";
	$cnt = $row['count_no'];
	$item_c = $row['item_c'];
	$item_n = $row['item_n'];
	$item_k = "PRODUCT FACTORY";
	$bar_cd = $row['check_code'];
	#  $bar_cd = "1234";

	$html = '
	<table border="1" >
		<tr>
			<th align="center">ชนิดสินค้า</th>
			<th align="center">จำนวนในระบบ</th>
			<th align="center">จำนวนที่นับจริง</th>
			<th align="center">หมายเหตุ</th>
		</tr>
		<tr>
			<td align="center">RM (Full size)</td>
			<td align="center">'.$row['rm_qty'].'</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td align="center">PM (Partial size)</td>
			<td align="center">'.$row['pm_qty'].'</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td align="center">รวม</td>
			<td align="center">'.$row['all_qty'].'</td>
			<td></td>
			<td></td>
		</tr>
	</table>';

	// Print to PDf
	$pdf->SetFont('thsarabunb', 'B', 25, '', true);
	$pdf->Text($iw + 5, $ih + 6, 'RAW MATERIALS') ;
	
	
	$pdf->SetFont('thsarabunb', '', 16, '', true);
	$pdf->Text($iw + 5, $ih + 14, 'รายงานสินค้าและวัตถุดิบคงเหลือ') ;
	
	$pdf->SetFont('thsarabun', '', 16, '', true);
	$pdf->Text($iw + 5, $ih + 22, 'วันที่  '.$date) ;
	$pdf->Text($iw + 65, $ih + 22, 'ตำแหน่งที่  '.$wh) ;
	$pdf->Text($iw + 108, $ih + 22, 'ลำดับที่  ') ;
	
	$pdf->SetFont('thsarabunb', '', 16, '', true);
	$pdf->Text($iw + 120, $ih + 22, $cnt) ;
	$pdf->Text($iw + 27, $ih + 28, $item_c);
	$pdf->Text($iw + 27, $ih + 34, $item_n) ;
	
	
	$pdf->SetFont('thsarabun', '', 16, '', true);
	$pdf->Text($iw + 5, $ih + 28, 'รายละเอียด  : ') ;
	
	//$pdf->Text($iw + 5, $ih + 40, $item_k) ;
	// Print_barcode
	$pdf->write1DBarcode($bar_cd, 'C128', $iw + 90, $ih + 8, '', 15, 0.2, $style, 'N');
	// output the HTML content
	$pdf->writeHTMLCell(130, '', $iw + 5, $ih + 48, $html, '', 0, 0, true, 'L', true);
	$pdf->Text($iw + 5, $ih + 84, 'นับโดย_____________') ;
	$pdf->Text($iw + 55, $ih + 84, 'ตรวจโดย_____________') ;
	$pdf->Text($iw + 105, $ih + 84, 'วันที่_____________') ;
	
	$i++;


}

// ============= End Item 1 in Page ===========================






// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
$pdf->Output('SHT_RM_Stock_Taking.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
