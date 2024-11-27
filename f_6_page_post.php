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
function load_group_post_data()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}

	$sql = " SELECT c.ojb_id AS id
	, c.img_src as full_picture
	,  Substring(a.msg, 1, 100) AS MSG, a.pub_time as created_time
	, IFNULL(b.case_id, ifnull(f.CASE_ID, '-')) AS CASE_ID
	, e.crp_status AS STATUS_TEXT
	, IFNULL(d.status, '-') AS STATUS_CODE
	, IFNULL(h.type_name, 
			CASE
				WHEN b.case_id is null THEN '-'
				ELSE 'CC'
			END
			) AS post_type
	, j.reach
	From system_page_all_pub a 
	LEFT Join case_pub_info b ON a.post_id = b.pub_url AND b.pub_type = 'page_WD_post'
	LEFT Join system_page_all_pub_ojb_img c ON a.ojb_id = c.ojb_id
	LEFT Join wd_case d ON b.case_id = d.case_id
	LEFT Join m_crp_status e ON d.status = e.id
	Left Join sp_case_post_data f ON a.post_id = f.POST_ID
	LEFT JOIN page_post_type g ON a.post_id = g.POST_ID
	Left Join m_page_post_type_master h ON g.POST_TYPE = h.id
	LEFT Join (Select a.post_id, MAX(a.value) AS reach From static_post a Where a.f_name = 'post_impressions_unique' Group By a.post_id) j ON a.post_id = j.post_id
	WHERE YEAR(a.pub_time) = $select_year
	
	ORDER BY a.pub_time DESC ";


	$sqlx = " Select Z.id
	, Z.full_picture
	,  Substring(Z.msg, 1, 100) AS MSG
	, Z.created_time
	, GROUP_CONCAT(Z.CASE_ID) AS CASE_ID
	, Z.STATUS_TEXT
	, Z.STATUS_CODE
	, Z.post_type
	, Z.reach
	
	From (
	SELECT c.ojb_id AS id
		, c.img_src as full_picture
		,  Substring(a.msg, 1, 100) AS MSG, a.pub_time as created_time
		, IFNULL(b.case_id, ifnull(f.CASE_ID, '-')) AS CASE_ID
		, e.crp_status AS STATUS_TEXT
		, IFNULL(d.status, '-') AS STATUS_CODE
		, IFNULL(h.type_name, 
				CASE
					WHEN b.case_id is null THEN '-'
					ELSE 'CC'
				END
				) AS post_type
		, j.reach
		From system_page_all_pub a 
		LEFT Join case_pub_info b ON a.post_id = b.pub_url AND b.pub_type = 'page_WD_post'
		LEFT Join system_page_all_pub_ojb_img c ON a.ojb_id = c.ojb_id
		LEFT Join wd_case d ON b.case_id = d.case_id
		LEFT Join m_crp_status e ON d.status = e.id
		LEFT Join sp_case_post_data f ON a.post_id = f.POST_ID
		LEFT JOIN page_post_type g ON a.post_id = g.POST_ID
		LEFT Join m_page_post_type_master h ON g.POST_TYPE = h.id
		LEFT Join (Select a.post_id, MAX(a.value) AS reach From static_post a Where a.f_name = 'post_impressions_unique' Group By a.post_id) j ON a.post_id = j.post_id
		WHERE YEAR(a.pub_time) = $select_year
		ORDER BY a.pub_time DESC) Z
		
		Group By Z.id
	, Z.full_picture
	, Z.created_time
	, Z.STATUS_TEXT
	, Z.STATUS_CODE
	, Z.post_type
	, Z.created_time
	
	ORDER BY Z.created_time DESC ";

	include "connectionDb.php";
	//$res = $conn->query(trim($sql));
	$res = $conn->query(trim($sqlx));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		//if ($row[''])
		if ($row['CASE_ID'] != '-') {
			if (strpos($row['CASE_ID'], ",")) {
				$row['print_case_id'] = $row['CASE_ID'];
			} else {
				$row['print_case_id'] = substr($row['CASE_ID'], 0, 2) . '-' . substr($row['CASE_ID'], 2, 2) . '-' . substr($row['CASE_ID'], 4);
			}
		} else {
			$row['print_case_id'] = '-';
		}

		$data_Array[] = $row;
	}
	//echo $sql;
	echo json_encode($data_Array);
}


// F=2
function dl_excel_file_post_in_group()
{
	// ==================================
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$tbl_f_all = array();
	$column = array();
	//foreach (range('A', 'Z') as $char_list) {
	//	array_push($column, $char_list);
	//}

	for ($i = 'a'; $i < 'zz'; $i++) {
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

	/*
	$sql = " SELECT   Substring(a.msg, 1, 100) AS ข้อความ
		,DATE_FORMAT(a.pub_time, '%Y-%m-%d') AS วันที่โพส
		, IFNULL(b.case_id, ifnull(f.CASE_ID, '-')) AS  'CASE_ID'
		, e.crp_status AS สถานะเคส
		, IFNULL(h.type_name, 
				CASE
					WHEN b.case_id is null THEN '-'
					ELSE 'CCC'
				END
				) AS ประเภทโพส
		, j.reach AS Reach
		, a.post_id AS URL
		From system_page_all_pub a 
		LEFT Join case_pub_info b ON a.post_id = b.pub_url AND b.pub_type = 'page_WD_post'
		LEFT Join system_page_all_pub_ojb_img c ON a.ojb_id = c.ojb_id
		LEFT Join wd_case d ON b.case_id = d.case_id
		LEFT Join m_crp_status e ON d.status = e.id
		Left Join sp_case_post_data f ON a.post_id = f.POST_ID
		LEFT JOIN page_post_type g ON a.post_id = g.POST_ID
		Left Join m_page_post_type_master h ON g.POST_TYPE = h.id
		LEFT Join (Select a.post_id, MAX(a.value) AS reach From static_post a Where a.f_name = 'post_impressions_unique' Group By a.post_id) j ON a.post_id = j.post_id
		WHERE YEAR(a.pub_time) = $select_year
		
		ORDER BY a.pub_time DESC
		";
*/
	$sqlx = "SELECT Substring(Z.msg, 1, 100)  AS ข้อความ
		,DATE_FORMAT(Z.created_time, '%Y-%m-%d') AS วันที่โพส
		, GROUP_CONCAT(Z.CASE_ID) AS CASE_ID
		, Z.STATUS_TEXT  AS สถานะเคส
		, Z.post_type AS ประเภทโพส
		, Z.reach AS Reach
		, Z.URL
		From (
		SELECT c.ojb_id AS id
			, c.img_src as full_picture
			,  Substring(a.msg, 1, 100) AS MSG, a.pub_time as created_time
			, IFNULL(b.case_id, ifnull(f.CASE_ID, '-')) AS CASE_ID
			, e.crp_status AS STATUS_TEXT
			, IFNULL(d.status, '-') AS STATUS_CODE
			, IFNULL(h.type_name, 
					CASE
						WHEN b.case_id is null THEN '-'
						ELSE 'CCC'
					END
					) AS post_type
			, j.reach
			, a.post_id AS URL
			From system_page_all_pub a 
			LEFT Join case_pub_info b ON a.post_id = b.pub_url AND b.pub_type = 'page_WD_post'
			LEFT Join system_page_all_pub_ojb_img c ON a.ojb_id = c.ojb_id
			LEFT Join wd_case d ON b.case_id = d.case_id
			LEFT Join m_crp_status e ON d.status = e.id
			LEFT Join sp_case_post_data f ON a.post_id = f.POST_ID
			LEFT JOIN page_post_type g ON a.post_id = g.POST_ID
			LEFT Join m_page_post_type_master h ON g.POST_TYPE = h.id
			LEFT Join (Select a.post_id, MAX(a.value) AS reach From static_post a Where a.f_name = 'post_impressions_unique' Group By a.post_id) j ON a.post_id = j.post_id
			WHERE YEAR(a.pub_time) = $select_year
			ORDER BY a.pub_time DESC) Z
			
			Group By Z.id
		, Z.full_picture
		, Z.created_time
		, Z.STATUS_TEXT
		, Z.STATUS_CODE
		, Z.post_type
		, Z.created_time

		ORDER BY Z.created_time DESC ";


	//$res = $conn->query(trim($sql));
	$res = $conn->query(trim($sqlx));
	mysqli_close($conn);

	// Set Active Sheet = 0
	$objPHPExcel->setActiveSheetIndex(0);

	// Print_page Heder
	$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
	$objPHPExcel->getActiveSheet()->setCellValue("A1", "ข้อมูลโพสในเพจปฏิบัติการหมาเฝ้าบ้าน");
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

	$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
	$objPHPExcel->getActiveSheet()->setCellValue("A2", "ปี " . $select_year);
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setItalic(true);

	$objPHPExcel->getActiveSheet()->mergeCells('A3:H3');
	$objPHPExcel->getActiveSheet()->setCellValue("A3", "Update : " . thai_date(date('U')) . " เวลา " . date('H:i'));
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setName('Leelawadee UI');
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setItalic(true);

	// Print column Name
	$i_colum = 0;
	$i_row = 5;
	while ($property = mysqli_fetch_field($res)) {
		//$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $tbl_f[$property->name]);
		$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $property->name);
		//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->getStartColor()->setRGB('FFFFCC');
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum])->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('Leelawadee UI');
		array_push($tbl_f_all, $property->name);
		$i_colum++;
	}
	// Print Data
	while ($row = $res->fetch_assoc()) {
		$i_colum = 0;
		$i_row++;
		foreach ($tbl_f_all as $f_name) {

			if (validateDate($row[$f_name], 'Y-m-d')) {
				$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
				$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('yyyy-mm-dd');
			} else {
				if ($f_name == "CASE_ID") {
					if ($row[$f_name] == '-') {
						$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
					} else {
						$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, substr($row[$f_name], 0, 2) . '-' . substr($row[$f_name], 2, 2) . '-' . substr($row[$f_name], 4));
					}
				} else if ($f_name == "ประเภทโพส") {
					if ($row[$f_name] == 'CCC') {
						$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, 'โพสเคสจากศูนย์');
					} else {
						$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
					}
				} else if ($f_name == "URL") {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, "[Link]");
					//$url_data = str_replace('https://', '', $row[$f_name]);
					$objPHPExcel->getActiveSheet()->getCell((string)$column[$i_colum] . (string)$i_row)->getHyperlink()->setUrl('https://www.facebook.com/Watchdog.ACT/posts/' . $row[$f_name]);
				} else {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
					if (is_numeric($row[$f_name]) and ($f_name != "CASE_ID")) {
						$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('#,##');
					}
				}
			}
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('Leelawadee UI');

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


	$file_name = "files/ข้อมูลโพสในเพจปี $select_year " . date('dmyH') . gen_rnd_str(4);
	$file_name .= ".xlsx";
	$objWriter = new Xlsx($objPHPExcel);
	$objWriter->save($file_name);
	echo '<button type="button" class="btn btn-box-tool" onclick="location.href=' . "'" . $file_name . "'" . '"> <i class="fa fa-file-excel-o"></i> Download Excel</button>';
}

// F=3
function load_page_post_status_for_select()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = " SELECT a.id, a.type_name FROM  m_page_post_type_master a WHERE id <> 0 AND ATTR_1 = 1 Order By a.id_ORDER ";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

//F=4
function update_post_type()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}

	include "connectionDb.php";


	if ($type_post == 1) {
		//echo $create_new_sp;
		if ($create_new_sp == "NEW") {
			$create_code_month = 'SP' . substr((string)date('Y') + 543, 2, 4);
			$query_sql = "Select IFNULL(max(CONVERT(substring(case_id,6,3), UNSIGNED INTEGER)),0)as max_in_month from sp_case_data Where case_id like '$create_code_month%' ";
			$res = $conn->query(trim($query_sql));
			$row = $res->fetch_assoc();
			$case_id = $create_code_month . sprintf('%03d', $row['max_in_month'] + 1);
			$case_id = (string)$case_id;
			$ran_str = $case_id . gen_rnd_str(5);
			// INSERT NEW SP_CASE
			$ins_sql = "Insert Into sp_case_data value ('$case_id', '$new_sp_case_title', '$new_sp_case_detail', $staff_key_id , CURRENT_TIMESTAMP, NULL, NULL, NULL, NULL, NULL)";
			//echo $ins_sql;
			if (!$conn->query($ins_sql)) {
				echo  $conn->errno;
				exit();
			}


			// Insert Case History
			$ins_sql = "Insert Into case_history Value ('$case_id', 0, 'บันทึกเคสนอกลงระบบ', '', $staff_key_id, CURRENT_TIMESTAMP(), '$ran_str ')";
			if (!$conn->query($ins_sql)) {
				echo  $conn->errno;
				exit();
			}

			sleep(1);
			// UPDATE CASE SP_case_post_data
			$ins_sql = "Insert Into sp_case_post_data value ('$case_id', '$__TARGET_POST_ID', CURRENT_TIMESTAMP(), '$ran_str', NULL, NULL, NULL)";
			//echo $ins_sql;
			if (!$conn->query($ins_sql)) {
				echo  $conn->errno;
				exit();
			}

			// Insert Case History
			//$ins_sql = "Insert Into case_history Value ('$case_id', 5, 'บันทึกเคสนอกลงระบบ', '$__TARGET_POST_ID', $staff_key_id, CURRENT_TIMESTAMP(), '$ran_str ')";
			$ins_sql = "Insert Into case_history
					SELECT 
					'$case_id', 5, 'บันทึกเคสนอกลงระบบ', a.post_id, '$staff_key_id', a.pub_time, '$ran_str '
					FROM system_page_all_pub a 
					Where a.post_id = '$__TARGET_POST_ID'
				";

			if (!$conn->query($ins_sql)) {
				echo  $conn->errno;
				exit();
			}
		} else {
			$ran_str = $case_id . gen_rnd_str(5);
			// UPDATE CASE SP_case_post_data
			// UPDATE CASE SP_case_post_data
			$ins_sql = "Insert Into sp_case_post_data value ('$case_id', '$__TARGET_POST_ID', CURRENT_TIMESTAMP(), '$ran_str', NULL, NULL, NULL)";
			//echo $ins_sql;
			if (!$conn->query($ins_sql)) {
				echo  $conn->errno;
				exit();
			}

			// Insert Case History
			$ins_sql = "Insert Into case_history Value ('$case_id', 5, 'บันทึกเคสนอกลงระบบ', '$__TARGET_POST_ID', $staff_key_id, CURRENT_TIMESTAMP(), '$ran_str ')";
			if (!$conn->query($ins_sql)) {
				echo  $conn->errno;
				exit();
			}
		}
	}

	// INSERT POST TYPE
	$ins_sql = "Insert Into page_post_type Value ('$__TARGET_POST_ID', $type_post, '$ran_str')";
	//echo $ins_sql;
	if (!$conn->query($ins_sql)) {
		echo  $conn->errno;
		exit();
	}

	mysqli_close($conn);
}

//F=5 
function load_exist_sp_case()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = " SELECT a.CASE_ID, a.Case_Title, a.Case_Detail FROM sp_case_data a Order By a.time_stamp DESC ";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['print_case_id'] = substr($row['CASE_ID'], 0, 2) . '-' . substr($row['CASE_ID'], 2, 2) . '-' . substr($row['CASE_ID'], 4);
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

//F=6
function load_sp_case_data()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = " SELECT * FROM sp_case_data a Where a.CASE_ID = '$case_id' ";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['print_case_id'] = substr($row['CASE_ID'], 0, 2) . '-' . substr($row['CASE_ID'], 2, 2) . '-' . substr($row['CASE_ID'], 4);
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}




//============================ MAIN =========================================================
switch ($f) {
	case 1: {
			load_group_post_data();
			break;
		}
	case 2: {
			dl_excel_file_post_in_group();
			break;
		}
	case 3: {
			load_page_post_status_for_select();
			break;
		}
	case 4: {
			update_post_type();
			break;
		}
	case 5: {
			load_exist_sp_case();
			break;
		}
	case 6: {
			load_sp_case_data();
			break;
		}
}
