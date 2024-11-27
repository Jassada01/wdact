<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');
require_once('n2w.php');
// create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

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
$DB_name = "Rev_Inv";
$conn = new mysqli($server_name,$UID,$Pass,$DB_name);
# $sql = "Select * from RM_Stock Where count_no between 1 and 4";
$sql = "Select * from rinv_header";
$res = $conn->query($sql);
$rh = $res->fetch_assoc();


$sql = "Select * from rinv_detail";
$res_detail = $conn->query($sql);

mysqli_close($conn);

$addlist = preg_split("/\\r\\n|\\r|\\n/", $rh['CUST_ADDR']);


// New Page Setup
$pdf->SetFont('thsarabun', 'B', 16, '', true);
$pdf->Text(180,35, $rh['RV_NO']) ;

$pdf->SetFont('thsarabun', 'B', 14, '', true);
$pdf->Text(20,52, $rh['CUST_NAME'].' '.$rh['CUST_BR']) ;				// Cust Name and Branch

$pdf->SetFont('thsarabun', '', 14, '', true);
$date = date("j/m/Y", strtotime($rh['RINV_DATE']));
$pdf->Text(165,52, $date) ;				// INV Date
$pdf->Text(20,56, 'TAX ID : '.$rh['TAXID']) ;
$pdf->Text(138,220, $rh['CUST_CODE']) ;	

$pdf->SetFont('thsarabun', '', 15, '', true);
for ($i = 0; $i < count($addlist) ; $i++)
{
		$pdf->Text(20,62+($i*4), $addlist[$i]) ;
}
// Reson
//$wg_total = convertNumber(829311.46);




// Page Set



$std_vat = 0.07;
$diff_btw_item = 25;
$item_cnt = 1;
$current_Page = 1;
$total = 0;
while ($rd = $res_detail->fetch_assoc())
{
	
	if ($item_cnt > 3)
	{
		$pdf->AddPage();
		$current_Page ++;
		$item_cnt = 1;
		// New Page Setup
		$pdf->SetFont('thsarabun', 'B', 16, '', true);
		$pdf->Text(180,35, $rh['RV_NO']) ;

		$pdf->SetFont('thsarabun', 'B', 14, '', true);
		$pdf->Text(20,52, $rh['CUST_NAME'].' '.$rh['CUST_BR']) ;				// Cust Name and Branch

		$pdf->SetFont('thsarabun', '', 14, '', true);
		$date = date("j/m/Y", strtotime($rh['RINV_DATE']));
		$pdf->Text(165,52, $date) ;				// INV Date
		$pdf->Text(20,56, 'TAX ID : '.$rh['TAXID']) ;
		$pdf->Text(138,220, $rh['CUST_CODE']) ;	

		$pdf->SetFont('thsarabun', '', 15, '', true);
		for ($i = 0; $i < count($addlist) ; $i++)
		{
				$pdf->Text(20,62+($i*4), $addlist[$i]) ;
		}

	}
	
	
	
	
	
	// Item_no
	$pdf->Text(13,100+(($item_cnt - 1) * $diff_btw_item), $item_cnt + (($current_Page-1)*3));
	
	// Item_Name
	$itemN_L1 = $rd['WORK_NO']." ".$rd['DKPART_N']." "."(P/O No. ".$rd['PO_NO'].")";
	$itemN_L2 = $rd['PROD_DESC']." [".$rd['GRADE']."]";
	$item_L3 = "Refer : Inv No. ".$rd['INV_NO']." (".date("j/m/Y", strtotime($rd['INV_DATE'])).")";
	$item_L4 = "Old Amt : ". number_format($rd['Old_amt'], 2, '.', ',');
	$item_L5 = "New Amt : ". number_format($rd['New_amt'], 2, '.', ',');
	
	$pdf->Text(22,100+(($item_cnt - 1) * $diff_btw_item), $itemN_L1);
	$pdf->Text(22,104+(($item_cnt - 1) * $diff_btw_item), $itemN_L2);
	$pdf->Text(22,108+(($item_cnt - 1) * $diff_btw_item), $item_L3);
	$pdf->Text(22,112+(($item_cnt - 1) * $diff_btw_item), $item_L4);
	$pdf->Text(22,116+(($item_cnt - 1) * $diff_btw_item), $item_L5);
	
	// QTY
	$pdf->Text(138,100+(($item_cnt - 1) * $diff_btw_item), $rd['QTY']);
	
	// Unit_Cost
	$pdf->Text(158,100+(($item_cnt - 1) * $diff_btw_item), number_format($rd['DIFF_UC'], 2, '.', ','));
	
	
	// Unit_Amt
	$pdf->Text(180,100+(($item_cnt - 1) * $diff_btw_item), number_format($rd['DIFF_UC_AMT'], 2, '.', ','));
	
	
	// Increase Toatl
	$total += $rd['DIFF_UC_AMT'];
	
	$item_cnt++;
}

// Calculation Grand Total
$vat = $total * $std_vat;
$g_total = $total + $vat;


// Print Reason
$pdf->Text(25,180, 'Reason : '. $rh['REASON']);
// Print Total
$pdf->Text(180,187, number_format($total, 2, '.', ',')) ;	
$pdf->Text(180,193, number_format($vat, 2, '.', ',')) ;	
$pdf->Text(180,200, number_format($g_total, 2, '.', ',')) ;	


$pdf->Text(25,190, convertNumber($g_total)) ;	





// ============= End Item 1 in Page ===========================






// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
$pdf->Output($rh['RV_NO'].'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
