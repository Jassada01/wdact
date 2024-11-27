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
$pdf->SetMargins('15', '10', '10');
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
    'font' => 'helvetica',
    'fontsize' => 6,
    'stretchtext' => 4
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


for ($i = 0 ; $i < 4 ; $i ++)
{
	//Var
	// Set Location
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
	
	$date = '31-Mar-2016';
	$wh = "WH";
	$cnt = "0032";
	$item_c = "GLM4100SF-R02-ACZ20W";
	$item_n = "GLM4100SF-R02";
	$item_k = "PRODUCT FACTORY";
	$bar_cd = "16082409152312345";
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
			<td align="center">FG-SHT</td>
			<td align="center">5</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td align="center">FG-NIDEC</td>
			<td align="center">0</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td align="center">TOTAL</td>
			<td align="center">5</td>
			<td></td>
			<td></td>
		</tr>
	</table>';

	// Print to PDf
	$pdf->Text($iw + 5, $ih + 10, 'FINISHED GOODS') ;
	$pdf->Text($iw + 5, $ih + 16, 'รายงานสินค้าและวัตถุดิบคงเหลือ') ;
	$pdf->Text($iw + 5, $ih + 22, 'วันที่  '.$date) ;
	$pdf->Text($iw + 65, $ih + 22, 'ตำแหน่งที่  '.$wh) ;
	$pdf->Text($iw + 110, $ih + 22, 'ลำดับที่  '.$cnt) ;
	$pdf->Text($iw + 5, $ih + 28, 'รายละเอียด  : '.$item_c) ;
	$pdf->Text($iw + 5, $ih + 34, 'เกรด :  '.$item_c) ;
	$pdf->Text($iw + 5, $ih + 40, $item_k) ;
	// Print_barcode
	$pdf->write1DBarcode($bar_cd, 'C128', $iw + 80, $ih + 10, '', 12, 0.25, $style, 'N');
	// output the HTML content
	$pdf->writeHTMLCell(130, '', $iw + 5, $ih + 48, $html, '', 0, 0, true, 'L', true);
	$pdf->Text($iw + 5, $ih + 84, 'นับโดย_____________') ;
	$pdf->Text($iw + 55, $ih + 84, 'ตรวจโดย_____________') ;
	$pdf->Text($iw + 105, $ih + 84, 'วันที่_____________') ;

}

// ============= End Item 1 in Page ===========================






// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
$pdf->Output('example_050.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
