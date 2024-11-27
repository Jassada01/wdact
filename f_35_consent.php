<?php

	// Add for PHPSpreadsheet : 2020-12-27
	require_once("plugins/PHPSpreadsheet/autoload.php");

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	use PhpOffice\PhpSpreadsheet\IOFactory;

// ======== Get Var ========
$f = $_POST['f'];
//$p1 = $_POST['p1'];
//$p2 = $_POST['p2'];
//$p3 = $_POST['p3'];


if (isset($_POST['p1'])) {
	$p1 = $_POST['p1'];
}
if (isset($_POST['p2'])) {
	$p2 = $_POST['p2'];
}
if (isset($_POST['p3'])) {
	$p3 = $_POST['p3'];
}
// ================ Global Function =============================
$thai_day_arr = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์");
$thai_month_arr = array(
	"0" => "",
	"1" => "มกราคม",
	"2" => "กุมภาพันธ์",
	"3" => "มีนาคม",
	"4" => "เมษายน",
	"5" => "พฤษภาคม",
	"6" => "มิถุนายน",
	"7" => "กรกฎาคม",
	"8" => "สิงหาคม",
	"9" => "กันยายน",
	"10" => "ตุลาคม",
	"11" => "พฤศจิกายน",
	"12" => "ธันวาคม"
);
function thai_date($time)
{
	global $thai_day_arr, $thai_month_arr;
	$thai_date_return = "วัน" . $thai_day_arr[date("w", $time)];
	$thai_date_return .= "ที่ " . date("j", $time);
	$thai_date_return .= " " . $thai_month_arr[date("n", $time)];
	$thai_date_return .= " " . (date("Y", $time) + 543);
	return $thai_date_return;
}

function validateDate($date, $format = 'Y-m-d H:i:s')
{
	$d = DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) == $date;
}

function gen_rnd_str($length = 10)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function gen_rnd_num($length = 5)
{
	$characters = '0123456789';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}





// ======== Function ========
// 1
function load_consent_data()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}

	$sql = "SELECT * from consent_master a where a.consent_id = $consent_id ";


	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	//echo $sql;
	echo json_encode($data_Array);
}


// F=2
function update_consent_master()
{
	foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			//echo $key . ":" . $value . "\n";
		}
		include "connectionDb.php";
		// Insert Case status
		$sql = " Update consent_master set 
		consent_desc = '$consent_desc'
		, consent_active = $consent_active
		, Last_update = CURRENT_TIMESTAMP()
		Where consent_id = $consent_id";
		if(!$conn->query($sql))
		{
			echo  $conn->errno;
			exit();
		}
		mysqli_close($conn);

}

// F=3
function initial_consent_data()
{
	foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			//echo $key . ":" . $value . "\n";
		}
		include "connectionDb.php";
		// Delete All consent
		$sql = " Delete From consent_data where consent_id = $consent_id";
		if(!$conn->query($sql))
		{
			echo  $conn->errno;
			exit();
		}

		// Initial Consent 
		$sql = " Insert Into consent_data Select a.wd_id, $consent_id, 0, CURRENT_TIMESTAMP() From wd_db a ";
		if(!$conn->query($sql))
		{
			echo  $conn->errno;
			exit();
		}
		mysqli_close($conn);

}

// F = 4
// F=2
function export_data()
{
	// ==================================
	foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$tbl_f_all = array();
		$column = array();
		//foreach (range('A', 'Z') as $char_list) {
		//	array_push($column, $char_list);
		//}
		
		for ($i = 'a'; $i < 'zz'; $i++) 
		{
			array_push($column, $i);
		}
		
		
		/** Error reporting */
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Asia/Bangkok');

		/** Include PHPExcel */
		//require_once dirname(__FILE__) . '/plugins/Classes/PHPExcel.php';

		// Create new PHPExcel object
		//$objPHPExcel = new PHPExcel();
		$objPHPExcel = new Spreadsheet();
		$styleArray = array(
			'font'  => array(
				'bold'  => true
				),
			  'fill' => array(
				'type' => PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
				'startcolor' => array(
				  'argb' => 'FFFFFFCC',
				),
			  ),
			);
			
			$styleBan = array(
			  'fill' => array(
				'type' => PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
				'startcolor' => array(
				  'argb' => 'FFFFE6E6',
				),
			  ),
			);
			
			
		// Set document properties
		$objPHPExcel->getProperties()->setCreator("WD_System")
									 ->setLastModifiedBy("WD_System");
									 
		// Query Data
		include "connectionDb.php";


		$sql = " SELECT a.wd_id AS 'WD ID', a.gen as 'รุ่น'
		, a.name as ชื่อ
		, a.s_name as นามสกุล
		, a.n_name as ชื่อเล่น
		, FLOOR(DATEDIFF(CURRENT_DATE, a.birthday)/365) AS อายุ
		, a.occ as อาชีพ
		, c.occ_type as ประเภทอาชีพ
		, d.sex_desc as เพศ
		, e.wd_status_dec as สถานะ
		, a.education as ระดับการศึกษา
		, CONCAT(a.soc_fb, ' ', a.soc_fb_2) AS Facebook
		, a.soc_line AS LINE_ID
		, a.soc_twitter AS Twitter
		, CONCAT(a.tel, '  ', a.tel_2) AS เบอร์โทร
		, a.email
		, a.address AS ที่อยู่
		,  b.prv_name AS จังหวัด
		, b.geo_name  AS ภาค 
		, f.consent_value AS ยินยอมเปิดเผยข้อมูลส่วนบุคคล
		From wd_db a INNER JOIN all_address b ON a.add_code = b.dis_code INNER JOIN m_occ_type c ON a.occ_type = c.id INNER Join m_sex d ON a.sex = d.sex_id INNER JOIN m_wd_status e ON a.status = e.wd_status_id 
		
		LEFT JOIN consent_data f ON a.wd_id = f.wd_id and f.consent_id = $consent_id
		Order By a.wd_id
		";


		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		
		// Set Active Sheet = 0
		$objPHPExcel->setActiveSheetIndex(0);
		
		// Print_page Heder
		$objPHPExcel->getActiveSheet()->mergeCells('A1:T1');
		$objPHPExcel->getActiveSheet()->setCellValue("A1", "ข้อมูลสมาชิกหมาเฝ้าบ้าน");
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		
		$objPHPExcel->getActiveSheet()->mergeCells('A2:T2');
		$objPHPExcel->getActiveSheet()->setCellValue("A2", "ตามความยินยอม : ".$consent_desc);
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setItalic(true);

		$objPHPExcel->getActiveSheet()->mergeCells('A3:H3');
		$objPHPExcel->getActiveSheet()->setCellValue("A3", "Update : ".thai_date(date('U'))." เวลา ".date('H:i'));
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setItalic(true);
		
		// Print column Name
		$i_colum = 0;
		$i_row = 5;
		while ($property = mysqli_fetch_field($res)) {
			//$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $tbl_f[$property->name]);
			$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $property->name);
			//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFill()->getStartColor()->setRGB('FFFFCC');
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum])->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFont()->setName('Leelawadee UI');
			array_push($tbl_f_all, $property->name);
			$i_colum ++;
		}
		// Print Data
		while ($row = $res->fetch_assoc()){
				if ($row['ยินยอมเปิดเผยข้อมูลส่วนบุคคล'] != '1')
				{
					$row['ชื่อ'] = "";
					$row['นามสกุล'] = "";
					$row['ชื่อเล่น'] = "";
					$row['อาชีพ'] = "";
					$row['Facebook'] = "";
					$row['LINE_ID'] = "";
					$row['Twitter'] = "";
					$row['เบอร์โทร'] = "";
					$row['email'] = "";
					$row['ที่อยู่'] = "";
					$row['ยินยอมเปิดเผยข้อมูลส่วนบุคคล'] = "ไม่ยินยอม";
				}
				else{
					$row['ยินยอมเปิดเผยข้อมูลส่วนบุคคล'] = "ยินยอม";
				}
				$i_colum = 0;
				$i_row++;
				foreach ($tbl_f_all as $f_name) {
					
					

					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $row[$f_name]);
					$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFont()->setName('Leelawadee UI');
					
					//if ($row['wd_status'] == "Banned")
					//{
					//	$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleBan);
					//}
					$i_colum++;
				}
				
		}

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('สถิติโพส');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		$file_name = "files/ข้อมูลสมาชิกหมาเฝ้าบ้าน ".date('dmyH').gen_rnd_str(4);
		$file_name.= ".xlsx";
		$objWriter = new Xlsx($objPHPExcel);
		$objWriter->save($file_name);
		echo '<button type="button" class="btn btn-box-tool" onclick="location.href='."'".$file_name."'".'"> <i class="fa fa-file-excel-o"></i> Download Excel</button>';

}




//============================ MAIN =========================================================
switch ($f) {
	case 1: {
			load_consent_data();
			break;
		}
	case 2: {
			update_consent_master();
			break;
		}
	case 3: {
			initial_consent_data();
			break;
		}
	case 4: {
			export_data();
			break;
		}
}
