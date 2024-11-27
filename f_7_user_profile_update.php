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
function check_exist_email()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = " SELECT b.token, a.wd_id From wd_db a 
		Inner Join wd_access_code b ON a.wd_id = b.wd_id
		Where UPPER(a.email) = UPPER('$request_check')
		AND b.expire >= CURRENT_DATE()
		AND LENGTH(a.email) > 3";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['url'] = "https://www.wdact.co/WD_system/user_profile.php?token=".$row['token'] ;
		$data_Array[] = $row;
		
	}
	echo json_encode($data_Array);
}


//============================ MAIN =========================================================
switch ($f) {
	case 1: {
			check_exist_email();
			break;
		}
}
