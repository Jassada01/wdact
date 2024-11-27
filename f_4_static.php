<?php

// Add for PHPSpreadsheet : 2020-12-27
require_once("plugins/PHPSpreadsheet/autoload.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;



// ======== Get Var ========
if (isset($_GET['f'])) {
	$f = $_GET['f'];
}
if (isset($_POST['f'])) {
	$f = $_POST['f'];
}
if (isset($_GET['p1'])) {
	$p1 = $_GET['p1'];
}
if (isset($_GET['p2'])) {
	$p2 = $_GET['p2'];
}
if (isset($_GET['p3'])) {
	$p3 = $_GET['p3'];
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

$thai_month_arr_shot = array(
	"0" => "",
	"1" => "ม.ค.",
	"2" => "ก.พ.",
	"3" => "มี.ค.",
	"4" => "ม.ย.",
	"5" => "พ.ค.",
	"6" => "มิ.ย.",
	"7" => "ก.ค.",
	"8" => "ส.ค.",
	"9" => "ก.ย.",
	"10" => "ต.ค.",
	"11" => "พ.ย.",
	"12" => "ธ.ค."
);

$thai_month_arr_shot_2 = array(
	0 => "",
	1 => "ม.ค.",
	2 => "ก.พ.",
	3 => "มี.ค.",
	4 => "ม.ย.",
	5 => "พ.ค.",
	6 => "มิ.ย.",
	7 => "ก.ค.",
	8 => "ส.ค.",
	9 => "ก.ย.",
	10 => "ต.ค.",
	11 => "พ.ย.",
	12 => "ธ.ค."
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

function thai_date_non_dow($time)
{
	global $thai_day_arr, $thai_month_arr;
	//$thai_date_return = "วัน".$thai_day_arr[date("w",$time)];
	$thai_date_return = "";
	$thai_date_return .= date("j", $time);
	$thai_date_return .= " " . $thai_month_arr[date("n", $time)];
	$thai_date_return .= " " . (date("Y", $time) + 543);
	return $thai_date_return;
}

function thai_date_short_date($time)
{
	global $thai_day_arr, $thai_month_arr_shot;
	//$thai_date_return = "วัน".$thai_day_arr[date("w",$time)];
	$thai_date_return = "";
	$thai_date_return .= date("j", $time);
	$thai_date_return .= " " . $thai_month_arr_shot[date("n", $time)];
	$thai_date_return .= " " . (date("Y", $time) + 543);
	return $thai_date_return;
}

function cal_post_level($reach_value)
{
	$star = 1.0;
	if ($reach_value > 10000) {
		$star = $star  + 0.5;
	}
	if ($reach_value > 30000) {
		$star = $star  + 0.5;
	}
	if ($reach_value > 50000) {
		$star = $star  + 0.5;
	}
	if ($reach_value > 65000) {
		$star = $star  + 0.5;
	}
	if ($reach_value > 100000) {
		$star = $star  + 0.5;
	}
	if ($reach_value > 200000) {
		$star = $star  + 0.5;
	}
	if ($reach_value > 500000) {
		$star = $star  + 0.5;
	}
	if ($reach_value > 1000000) {
		$star = $star  + 0.5;
	}
	return $star;
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


// ======== Function ========
// F=1
function get_like_count_data()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	// Connect to MySQL Database
	include "connectionDb.php";

	if ($group_by_str == "Day") {
		//$sql = "SELECT MAX(data_date) as data_date, sum(value) as value FROM `static_page` WHERE f_name = '$selected_data_type' And value <> 0 AND data_date > DATE_SUB(now(), INTERVAL 12 MONTH) Group by YEAR(data_date), MONTH(data_date), ".$group_by_str."(data_date) Order By data_date";
		$sql = "SELECT MAX(data_date) as data_date, sum(value) as value FROM `static_page` WHERE f_name = '$selected_data_type' And value <> 0 AND data_date > DATE_SUB(now(), INTERVAL 3 MONTH) Group by YEAR(data_date), MONTH(data_date), " . $group_by_str . "(data_date) Order By data_date";
		$avg_sql = "Select avg(a.ave_r) as avg_val From (Select sum(value) as ave_r From static_page Where f_name = '$selected_data_type' And value <> 0  AND data_date > DATE_SUB(now(), INTERVAL 12 MONTH)  Group by YEAR(data_date), MONTH(data_date), " . $group_by_str . "(data_date)) a";
	} else {
		//$sql = "SELECT MAX(data_date) as data_date, sum(value) as value FROM `static_page` WHERE f_name = '$selected_data_type' Group by YEAR(data_date), ".$group_by_str."(data_date) Order By data_date";
		//$avg_sql = "Select avg(a.ave_r) as avg_val From (Select sum(value) as ave_r From static_page Where f_name = '$selected_data_type' Group by YEAR(data_date), ".$group_by_str."(data_date)) a";
		$avg_sql = "Select avg(value) as avg_val From static_page_wm Where f_name = '$selected_data_type' AND data_type = '$group_by_str' AND data_date > DATE_SUB(now(), INTERVAL 12 MONTH) ";
		//$sql = "Select * FROM static_page_wm a Where a.data_type = '$group_by_str' AND f_name = '$selected_data_type' Order By a.data_date";
		$sql = "Select data_date, value From static_page_wm Where f_name = '$selected_data_type' AND data_type = '$group_by_str' AND data_date > DATE_SUB(now(), INTERVAL 12 MONTH) Order By data_date";
	}
	//echo $sql;
	//exit();
	$res = $conn->query(trim($avg_sql));
	$row = $res->fetch_assoc();
	$avg_value = $row['avg_val'];

	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	// Echo select header
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['avg_val'] = round($avg_value);
		$row['avg_val_text'] = number_format($avg_value);
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

//F=2
function get_current_title_desc()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	// Connect to MySQL Database
	include "connectionDb.php";

	$sql = "Select Full_Desc, show_name From m_field_desc WHERE f_name = '$data_type'";
	$res = $conn->query(trim($sql));
	$row = $res->fetch_assoc();
	$f_desc = $row['Full_Desc'];
	mysqli_close($conn);
	echo $f_desc;
}


//F=3
function get_data_max_min_avg()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}

	$data_Array = array();

	// Connect to MySQL Database
	include "connectionDb.php";

	// Get unit
	$sql = "SELECT Unit FROM m_field_desc WHERE f_name = '$data_type'";
	$res = $conn->query(trim($sql));
	$row = $res->fetch_assoc();
	$unit = " " . $row['Unit'];


	//Get Average
	$sql = "Select AVG(value) as value From static_page Where f_name = '$data_type'  And value <> 0 ";
	$res = $conn->query(trim($sql));
	$row = $res->fetch_assoc();
	$data_Array['avg'] = number_format($row['value']) . $unit;
	$average = $row['value'];

	// Get Max
	$sql = "Select * From static_page Where value = (Select max(value) From static_page WHERE f_name = '$data_type'  And value <> 0 ) And f_name = '$data_type'";
	$res = $conn->query(trim($sql));
	$row = $res->fetch_assoc();
	$data_Array['date_max'] = thai_date_non_dow(date_format(date_create($row['data_date']), 'U'));
	$data_Array['value_max'] = number_format($row['value']) . $unit;
	$data_Array['pct_max'] = number_format(($row['value'] / $average) * 100);

	// Get min
	$sql = "Select * From static_page Where value = (Select min(value) From static_page WHERE f_name = '$data_type'  And value <> 0 ) And f_name = '$data_type'";
	$res = $conn->query(trim($sql));
	$row = $res->fetch_assoc();
	$data_Array['date_min'] = thai_date_non_dow(date_format(date_create($row['data_date']), 'U'));
	$data_Array['value_min'] = number_format($row['value']) . $unit;
	$data_Array['pct_min'] = number_format(($row['value'] / $average) * 100, 2);


	mysqli_close($conn);
	echo json_encode($data_Array);
}

// F=4
function  get_page_heatmap_data()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	// Connect to MySQL Database
	include "connectionDb.php";

	$sql_get_max = "Select MAX(value) AS MAX From ( SELECT sub_name, AVG(Value) as value FROM static_page_detail WHERE main_name = '$data_type' AND (data_date Between '$start_date' AND '$end_date') Group by sub_name ) a";
	$res = $conn->query(trim($sql_get_max));
	$div_value = 101 - $div_value;
	$row = $res->fetch_assoc();
	$max_value = $row['MAX'];
	$step_value = $max_value / $div_value;

	$sql = "Select a.sub_name, b.lat, b.lon, a.value From ( SELECT sub_name, AVG(Value) as value FROM static_page_detail WHERE main_name = '$data_type' AND (data_date Between '$start_date' AND '$end_date') Group by sub_name ) a Inner Join m_fb_city_location b ON a.sub_name = b.city_name Order By a.value";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	// Echo select header
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['value_kai'] = round(($row['value'] / $step_value) + 1);
		$data_Array[] = $row;
	}
	sleep($wait_time);
	echo json_encode($data_Array);
}


// F = 5
function get_gender_fan_daily()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Select sub_name, value From static_page_detail WHERE main_name = '$data_type' AND data_date = '$target' ORDER By sub_name";

	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F =6
function get_best_post()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	//$sql = "SELECT a.post_id, b.msg, c.img_src, a.value FROM static_post a INNER Join system_page_all_pub b ON a.post_id = b.post_id LEFT Join system_page_all_pub_ojb_img c ON b.ojb_id = c.ojb_id WHERE a.data_type = '1' and a.f_name = 'post_impressions_unique' Order By value DESC LIMIT 8";
	$sql = "SELECT a.post_id, b.msg, c.img_src, a.value FROM static_post a INNER Join system_page_all_pub b ON a.post_id = b.post_id LEFT Join system_page_all_pub_ojb_img c ON b.ojb_id = c.ojb_id WHERE a.data_type = '1' and a.f_name = 'post_impressions_unique' AND DATE(b.pub_time) >= DATE_SUB(NOW(), INTERVAL 30 DAY) Order By value DESC LIMIT 8";

	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['value_str'] = number_format($row['value']);
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F =7
function get_lasted_post()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	if ($target == "") {
		$sql = "SELECT a.post_id, a.msg, a.pub_time, b.img_src FROM system_page_all_pub a LEFT JOIN system_page_all_pub_ojb_img b ON a.ojb_id = b.ojb_id  ORDER BY a.pub_time DESC LIMIT $result_cnt";
	} else {
		$sql = "SELECT a.post_id, a.msg, a.pub_time, b.img_src FROM system_page_all_pub a LEFT JOIN system_page_all_pub_ojb_img b ON a.ojb_id = b.ojb_id WHERE   a.msg like '%$target%' ORDER BY a.pub_time DESC";
	}
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F = 8
function get_post_static()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	//$sql = "SELECT f_name, value FROM static_post Where data_type = 1 and post_id = '$post_id' and f_name not LIKE 'post_reactions_%'";
	$sql = "SELECT f_name, value FROM static_post Where post_id = '$post_id' and f_name not LIKE 'post_reactions_%' AND time_stmp = (Select max(time_stmp) from static_post WHERE post_id = '$post_id')";

	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['value_str'] = number_format($row['value']);
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F =9
function get_post_static_chart()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Select time_stmp, value From static_post WHERE data_type = 2 AND f_name = '$data_target' AND post_id = '$post_id' Order BY data_type";

	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	$current_value = 0;
	while ($row = $res->fetch_assoc()) {
		$row['diff_value'] = $row['value'] - $current_value;
		$current_value = $row['value'];
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

//F=10
function get_current_title_desc_v2()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	include "connectionDb.php";

	$sql = "Select Full_Desc, show_name From m_field_desc WHERE f_name = '$data_type'";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

//F=11
function get_relate_case_list()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	include "connectionDb.php";

	$sql = "SELECT a.case_id, b.topic, b.t_sum , b.add_date FROM case_pub_info a INNER JOIN wd_case b ON a.case_id = b.case_id WHERE a.pub_url = '$post_id'";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F = 12
function get_monthly_graph_data()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	//$sql = "Select Year(a.add_date) as year, MONTH(a.add_date) as Month ,sum(case when b.id = 0 then 1 else 0 end) as s_0 ,sum(case when b.id = 1 then 1 else 0 end) as s_1 ,sum(case when b.id = 2 then 1 else 0 end) as s_2 ,sum(case when b.id = 3 then 1 else 0 end) as s_3 ,sum(case when b.id = 4 then 1 else 0 end) as s_4 ,sum(case when b.id = 5 then 1 else 0 end) as s_5 ,sum(case when b.id = 6 then 1 else 0 end) as s_6 ,sum(case when b.id = 7 then 1 else 0 end) as s_7 From wd_case a INNER Join m_crp_status b ON a.status = b.id Group By Year(a.add_date), MONTH(a.add_date) Order By Year(a.add_date), MONTH(a.add_date)";
	$sql = "Select Year(a.add_date) as year, MONTH(a.add_date) as Month ,sum(case when b.id = 0 then 1 else 0 end) as s_0 ,sum(case when b.id = 1 then 1 else 0 end) as s_1 ,sum(case when b.id = 2 then 1 else 0 end) as s_2 ,sum(case when b.id = 3 then 1 else 0 end) as s_3 ,sum(case when b.id = 4 then 1 else 0 end) as s_4 ,sum(case when b.id = 5 then 1 else 0 end) as s_5 ,sum(case when b.id = 6 then 1 else 0 end) as s_6 ,sum(case when b.id = 7 then 1 else 0 end) as s_7 From wd_case a INNER Join m_crp_status b ON a.status = b.id WHERE a.add_date >= now() - interval 12 month Group By Year(a.add_date), MONTH(a.add_date) Order By Year(a.add_date), MONTH(a.add_date)";
	//$sql = "Select Year(a.add_date) as year, MONTH(a.add_date) as Month ,sum(case when b.id = 0 then 1 else 0 end) as s_0 ,sum(case when b.id = 1 then 1 else 0 end) as s_1 ,sum(case when b.id = 2 then 1 else 0 end) as s_2 ,sum(case when b.id = 3 then 1 else 0 end) as s_3 ,sum(case when b.id = 4 then 1 else 0 end) as s_4 ,sum(case when b.id = 5 then 1 else 0 end) as s_5 ,sum(case when b.id = 6 then 1 else 0 end) as s_6 ,sum(case when b.id = 7 then 1 else 0 end) as s_7 From wd_case a INNER Join m_crp_status b ON a.status = b.id WHERE YEAR(a.add_date) = $select_year Group By Year(a.add_date), MONTH(a.add_date) Order By Year(a.add_date), MONTH(a.add_date)";

	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		//$row['cat_str'] = $row['Month'];
		$row['cat_str'] = date("F", mktime(0, 0, 0, $row['Month'], 10));
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}


// F=13
function get_case_static_by_crp_type()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	include "connectionDb.php";

	// $sql = "Select a.crp_id, a.crp_type ,sum(case when b.status = 5 then 1 else 0 end) as on_page ,sum(case when b.status = 4 then 1 else 0 end) as stop_case ,count(a.case_id) as count_case From case_crp_type_data a Inner Join wd_case b ON a.case_id = b.case_id Group By a.crp_type, a.crp_id Order By a.crp_id";
	$sql = "Select a.crp_id, a.crp_type ,sum(case when b.status = 5 then 1 else 0 end) as on_page ,sum(case when b.status = 4 then 1 else 0 end) as stop_case ,count(a.case_id) as count_case From case_crp_type_data a Inner Join wd_case b ON a.case_id = b.case_id WHERE YEAR(b.add_date) = $select_year Group By a.crp_type, a.crp_id Order By a.crp_id";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();

	while ($row = $res->fetch_assoc()) {
		$crp_type_name = $row['crp_type'];
		if ((substr($row['crp_id'], 2, 1) <> "0") and ($row['crp_id'] <> "99999")) {
			$crp_type_name = "&nbsp;&nbsp;&nbsp;|-&nbsp;" . $crp_type_name;
		}

		if ((substr($row['crp_id'], 4, 1) <> "0") and $row['crp_id'] <> "99999") {
			$crp_type_name = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $crp_type_name;
		}


		$row['crp_real_name'] = $crp_type_name;
		$row['pending'] = $row['count_case'] - ($row['on_page'] + $row['stop_case']);
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}


//F=14
function export_excel_page_static()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Select a.* From static_page a INNER Join m_field_desc b ON a.f_name = b.f_name WHERE (a.data_date BETWEEN '$start_date' AND '$end_date') Order By a.data_date, b.render_no";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	$rowcount = mysqli_num_rows($res);
	mysqli_close($conn);
	$data_Array = array();
	$temp_array = array();
	$current_date = "";
	while ($row = $res->fetch_assoc()) {
		if (($current_date != $row['data_date'])) {
			if ($current_date != "") {
				$data_Array[] = $temp_array;
			}
			$temp_array = array();
			$temp_array['data_date'] = $row['data_date'];
		}
		$temp_array[$row['f_name']] = $row['value'];
		$current_date = $row['data_date'];
	}
	$data_Array[] = $temp_array;


	// Start Create Excel ==============================================
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

	$styleeject = array(
		'fill' => array(
			'type' => PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
			'startcolor' => array(
				'argb' => 'fffff6f6',
			),
		),
	);

	$tbl_f = array(
		"data_date", "page_fan_adds_unique", "page_fan_removes_unique", "page_impressions", "page_impressions_unique", "page_impressions_viral", "page_impressions_viral_unique", "page_post_engagements", "page_engaged_users", "page_consumptions", "page_consumptions_unique", "page_views_total"
	);
	$tbl_f_desc = array(
		"วันที่", "จำนวนผู้คนรายใหม่ที่ถูกใจเพจของคุณ", "เลิกถูกใจเพจของคุณ", "จำนวนครั้งที่เนื้อหาใดๆ จากเพจของคุณหรือเกี่ยวกับเพจของคุณปรากฎบนหน้าจอของผู้คน ซึ่งรวมถึงโพสต์ เช็คอิน โฆษณา ข้อมูลโซเชียลจากผู้คนที่มีปฏิสัมพันธ์กับเพจของคุณ และอื่นๆ", "จำนวนคนที่เห็นเนื้อหาใดๆ จากเพจของคุณหรือเกี่ยวกับเพจของคุณปรากฎบนหน้าจอ ซึ่งรวมถึงโพสต์ เช็คอิน โฆษณา ข้อมูลโซเชียลจากผู้คนที่มีปฏิสัมพันธ์กับเพจของคุณ และอื่นๆ", "จำนวนครั้งที่เนื้อหาใดๆ จากบนเพจของคุณหรือเกี่ยวกับเพจของคุณปรากฎบนหน้าจอของผู้คนโดยมีข้อมูลโซเชียลแนบมา ข้อมูลโซเชียลจะปรากฏขึ้นเมื่อเพื่อนของผู้บุคคลดังกล่าวมีปฏิสัมพันธ์กับเพจหรือโพสต์ของคุณ ซึ่งรวมถึงเมื่อเพื่อนของบางคนกดถูกใจหรือติดตามเพจของคุณ มีส่วนร่วมกับโพสต์ แชร์รูปภาพในเพจของคุณ และเช็คอินในเพจของคุณ", "จำนวนคนที่เห็นเนื้อหาใดๆ จากเพจของคุณหรือเกี่ยวกับเพจของคุณปรากฎบนหน้าจอโดยมีข้อมูลโซเชียลแนบมา ในฐานะที่เป็นรูปแบบการกระจายแบบออร์แกนิก ข้อมูลโซเชียลจะปรากฏขึ้นเมื่อเพื่อนของผู้บุคคลดังกล่าวมีปฏิสัมพันธ์กับเพจหรือโพสต์ของคุณซึ่งรวมถึงเมื่อเพื่อนของบางคนกดถูกใจหรือติดตามเพจของคุณ มีส่วนร่วมกับโพสต์ แชร์รูปภาพในเพจของคุณ และเช็คอินในเพจของคุณ", "จำนวนครั้งที่ผู้คนมีส่วนร่วมกับโพสต์ของคุณผ่านการกดถูกใจ การแสดงความคิดเห็น การแชร์ และอื่นๆ", "จำนวนคนที่มีส่วนร่วมกับเพจของคุณ การมีส่วนร่วมรวมถึงการคลิกใดๆ ด้วย", "จำนวนครั้งที่มีผู้คลิกบนเนื้อหาใดๆ ของคุณ", "จำนวนคนที่คลิกบนเนื้อหาใดๆ ของคุณ", "จำนวนครั้งที่มีการดูโปรไฟล์ของเพจ"
	);
	// Set document properties
	$objPHPExcel->getProperties()->setCreator("WD_System")
		->setLastModifiedBy("WD_System");

	// Set Active Sheet = 0
	$objPHPExcel->setActiveSheetIndex(0);

	// Print_page Heder
	$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
	$objPHPExcel->getActiveSheet()->setCellValue("A1", "สถิติเชิงลึกของเพจ (รายวัน)");
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

	$objPHPExcel->getActiveSheet()->mergeCells('A2:E2');
	//$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ". date_format(date_create(), 'j F Y G:i'));
	//$objPHPExcel->getActiveSheet()->setCellValue("A2", "ระหว่างวันที่ ".thai_date_short_date(date_format(date_create($start_date), 'U'))." ถึง ".thai_date_short_date(date_format(date_create($end_date), 'U')));
	$objPHPExcel->getActiveSheet()->setCellValue("A2", "ระหว่างวันที่ " . thai_date_non_dow(date_format(date_create($start_date), 'U')) . " ถึง " . thai_date_non_dow(date_format(date_create($end_date), 'U')));
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');

	$objPHPExcel->getActiveSheet()->mergeCells('A3:E3');
	//$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ". date_format(date_create(), 'j F Y G:i'));
	$objPHPExcel->getActiveSheet()->setCellValue("A3", "Update : " . thai_date(date('U')) . " เวลา " . date('H:i'));
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(8);
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setName('Leelawadee UI');
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setItalic(true);

	//Table Header
	$i_colum = 0;
	$i_row = 4;
	foreach ($tbl_f as $f_name) {
		$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $f_name);
		//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->getStartColor()->setRGB('FFFFCC');
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setBold(true);
		//$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum])->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('Leelawadee UI');
		$i_colum++;
	}
	// Print column Name
	$i_colum = 0;
	$i_row = 5;
	if ($rowcount > 0) {
		foreach ($data_Array as $row_data) {
			$i_colum = 0;
			foreach ($tbl_f as $f_name) {
				if ($f_name == "data_date") {
					//$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $row_data[$f_name]);
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, thai_date_short_date(date_format(date_create($row_data[$f_name]), 'U')));
				} else {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row_data[$f_name]);
					$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('#,##');
				}
				$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('Leelawadee UI');
				$i_colum++;
			}
			$i_row++;
		}
	}
	$objPHPExcel->getActiveSheet()->setTitle('รายวัน');





	// Weekly Data ======================================================================
	$sql = "Select a.f_name, a.value, a.data_date From static_page_wm a INNER Join m_field_desc b ON a.f_name = b.f_name WHERE (a.data_date BETWEEN '$start_date' AND '$end_date') AND data_type = 'Weekly' Order By a.data_date, b.render_no";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	$rowcount = mysqli_num_rows($res);
	mysqli_close($conn);
	$data_Array = array();
	$temp_array = array();
	$current_date = "";
	while ($row = $res->fetch_assoc()) {
		if (($current_date != $row['data_date'])) {
			if ($current_date != "") {
				$data_Array[] = $temp_array;
			}
			$temp_array = array();
			$temp_array['data_date'] = $row['data_date'];
		}
		$temp_array[$row['f_name']] = $row['value'];
		$current_date = $row['data_date'];
	}
	$data_Array[] = $temp_array;

	$objWorkSheet = $objPHPExcel->createSheet(1); //Setting index when creating
	// Set Active Sheet = 1
	$objPHPExcel->setActiveSheetIndex(1);

	// Print_page Heder
	$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
	$objPHPExcel->getActiveSheet()->setCellValue("A1", "สถิติเชิงลึกของเพจ (รายสัปดาห์)");
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

	$objPHPExcel->getActiveSheet()->mergeCells('A2:E2');
	//$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ". date_format(date_create(), 'j F Y G:i'));
	//$objPHPExcel->getActiveSheet()->setCellValue("A2", "ระหว่างวันที่ ".thai_date_short_date(date_format(date_create($start_date), 'U'))." ถึง ".thai_date_short_date(date_format(date_create($end_date), 'U')));
	$objPHPExcel->getActiveSheet()->setCellValue("A2", "ระหว่างวันที่ " . thai_date_non_dow(date_format(date_create($start_date), 'U')) . " ถึง " . thai_date_non_dow(date_format(date_create($end_date), 'U')));
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');

	$objPHPExcel->getActiveSheet()->mergeCells('A3:E3');
	//$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ". date_format(date_create(), 'j F Y G:i'));
	$objPHPExcel->getActiveSheet()->setCellValue("A3", "Update : " . thai_date(date('U')) . " เวลา " . date('H:i'));
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(8);
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setName('Leelawadee UI');
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setItalic(true);

	//Table Header
	$i_colum = 0;
	$i_row = 4;
	foreach ($tbl_f as $f_name) {
		$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $f_name);
		//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->getStartColor()->setRGB('FFFFCC');
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setBold(true);
		//$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum])->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('Leelawadee UI');
		$i_colum++;
	}
	// Print column Name
	$i_colum = 0;
	$i_row = 5;
	if ($rowcount > 0) {
		foreach ($data_Array as $row_data) {
			$i_colum = 0;
			foreach ($tbl_f as $f_name) {
				if ($f_name == "data_date") {
					$_7daybf = date('Y-m-d', strtotime('-6 day', strtotime($row_data[$f_name])));
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, thai_date_short_date(date_format(date_create($_7daybf), 'U')) . " - " . thai_date_short_date(date_format(date_create($row_data[$f_name]), 'U')));
				} else {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row_data[$f_name]);
					$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('#,##');
				}
				$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('Leelawadee UI');
				$i_colum++;
			}
			$i_row++;
		}
	}
	$objPHPExcel->getActiveSheet()->setTitle('รายสัปดาห์');



	// Monthly Data ======================================================================================
	global $thai_month_arr;
	$sql = "Select a.f_name, a.value, a.data_date From static_page_wm a INNER Join m_field_desc b ON a.f_name = b.f_name WHERE (a.data_date BETWEEN '$start_date' AND '$end_date') AND data_type = 'Monthly' Order By a.data_date, b.render_no";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	$rowcount = mysqli_num_rows($res);
	mysqli_close($conn);
	$data_Array = array();
	$temp_array = array();
	$current_date = "";
	while ($row = $res->fetch_assoc()) {
		if (($current_date != $row['data_date'])) {
			if ($current_date != "") {
				$data_Array[] = $temp_array;
			}
			$temp_array = array();
			$temp_array['data_date'] = $row['data_date'];
		}
		$temp_array[$row['f_name']] = $row['value'];
		$current_date = $row['data_date'];
	}
	$data_Array[] = $temp_array;

	$objWorkSheet = $objPHPExcel->createSheet(2); //Setting index when creating
	// Set Active Sheet = 1
	$objPHPExcel->setActiveSheetIndex(2);

	// Print_page Heder
	$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
	$objPHPExcel->getActiveSheet()->setCellValue("A1", "สถิติเชิงลึกของเพจ (รายเดือน)");
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

	$objPHPExcel->getActiveSheet()->mergeCells('A2:E2');
	//$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ". date_format(date_create(), 'j F Y G:i'));
	//$objPHPExcel->getActiveSheet()->setCellValue("A2", "ระหว่างวันที่ ".thai_date_short_date(date_format(date_create($start_date), 'U'))." ถึง ".thai_date_short_date(date_format(date_create($end_date), 'U')));
	$objPHPExcel->getActiveSheet()->setCellValue("A2", "ระหว่างวันที่ " . thai_date_non_dow(date_format(date_create($start_date), 'U')) . " ถึง " . thai_date_non_dow(date_format(date_create($end_date), 'U')));
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');

	$objPHPExcel->getActiveSheet()->mergeCells('A3:E3');
	//$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ". date_format(date_create(), 'j F Y G:i'));
	$objPHPExcel->getActiveSheet()->setCellValue("A3", "Update : " . thai_date(date('U')) . " เวลา " . date('H:i'));
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(8);
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setName('Leelawadee UI');
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setItalic(true);

	//Table Header
	$i_colum = 0;
	$i_row = 4;
	foreach ($tbl_f as $f_name) {
		$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $f_name);
		//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->getStartColor()->setRGB('FFFFCC');
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setBold(true);
		//$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum])->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('Leelawadee UI');
		$i_colum++;
	}
	// Print column Name
	$i_colum = 0;
	$i_row = 5;
	if ($rowcount > 0) {
		foreach ($data_Array as $row_data) {
			$i_colum = 0;
			foreach ($tbl_f as $f_name) {
				if ($f_name == "data_date") {
					//$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , thai_date_short_date(date_format(date_create($row_data[$f_name]), 'U')));
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $thai_month_arr[date_format(date_create($row_data[$f_name]), 'n')]);
				} else {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row_data[$f_name]);
					$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('#,##');
				}
				$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('Leelawadee UI');
				$i_colum++;
			}
			$i_row++;
		}
	}

	$objPHPExcel->getActiveSheet()->setTitle('รายเดือน');


	// Desc Data ======================================================================================
	$objWorkSheet = $objPHPExcel->createSheet(3); //Setting index when creating
	// Set Active Sheet = 1
	$objPHPExcel->setActiveSheetIndex(3);
	// Print_page Heder
	$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
	$objPHPExcel->getActiveSheet()->setCellValue("A1", "คำอธิบาย");
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

	// Print column Name
	$i_colum = 0;
	$i_row = 3;
	$cnt_ = 0;
	foreach ($tbl_f as $data_zz) {
		if ($cnt_ != 0) {
			$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $tbl_f[$cnt_]);
			$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum + 1] . (string)$i_row, $tbl_f_desc[$cnt_]);
		}
		$i_row++;
		$cnt_++;
	}
	$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum])->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum + 1])->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->setTitle('คำอธิบาย');





	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);


	// Save Excel 2007 file
	// File_name
	//$file_name = "test";
	$file_name = "files/WD_page_static_" . date('dmyH') . "_" . gen_rnd_str(4);
	$file_name .= ".xlsx";
	$objWriter = new Xlsx($objPHPExcel);
	$objWriter->save($file_name);

	echo '<button type="button" class="btn btn-success pull-right" onclick="location.href=' . "'" . $file_name . "'" . '"><i class="fa fa-file-excel-o"></i> Download Excel</button>';

	//echo json_encode($data_Array);
}



/* Old Function =============================================================================================================================================
	function export_excel_page_static_2()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+/////]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		//$sql = "Select * From static_page WHERE (data_date BETWEEN '$start_date' AND '$end_date') Order By data_date, f_name";
		$sql = "Select a.* From static_page a INNER Join m_field_desc b ON a.f_name = b.f_name WHERE (a.data_date BETWEEN '$start_date' AND '$end_date') Order By a.data_date, b.render_no";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		$rowcount=mysqli_num_rows($res);
		mysqli_close($conn);		
		$data_Array = array();
		$temp_array = array();
		$current_date = "";
		while ($row = $res->fetch_assoc()){
			if (($current_date != $row['data_date']))
			{
				if ($current_date != "")
				{
					$data_Array[] = $temp_array;
				}
				$temp_array = array();
				$temp_array['data_date'] = $row['data_date'];
			}
			$temp_array[$row['f_name']] = $row['value'];
			$current_date = $row['data_date'];
		}
		$data_Array[] = $temp_array;
		
		
		// Start Create Excel ==============================================
		$tbl_f_all = array();

		$column = array();
		//foreach (range('A', 'Z') as $char_list) {
		//	array_push($column, $char_list);
		//}
		
		for ($i = 'a'; $i < 'zz'; $i++) 
		{
			array_push($column, $i);
		}
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Asia/Bangkok');

		require_once dirname(__FILE__) . '/plugins/Classes/PHPExcel.php';

		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		$styleArray = array(
			'font'  => array(
				'bold'  => true
				),
			  'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array(
				  'argb' => 'FFFFFFCC',
				),
			  ),
			);
			
			$styleBan = array(
			  'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array(
				  'argb' => 'FFFFE6E6',
				),
			  ),
			);
			
			$styleeject = array(
			  'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array(
				  'argb' => 'fffff6f6',
				),
			  ),
			);
			
			$tbl_f = array(
			"data_date"
			, "page_fan_adds_unique"
			, "page_fan_removes_unique"
			, "page_impressions"
			, "page_impressions_unique"
			, "page_impressions_viral"
			, "page_impressions_viral_unique"
			, "page_post_engagements"
			, "page_engaged_users"
			, "page_consumptions"
			, "page_consumptions_unique"
			, "page_views_total"
		);
		$tbl_f_desc = array(
			"วันที่"
			, "จำนวนผู้คนรายใหม่ที่ถูกใจเพจของคุณ"
			, "เลิกถูกใจเพจของคุณ"
			, "จำนวนครั้งที่เนื้อหาใดๆ จากเพจของคุณหรือเกี่ยวกับเพจของคุณปรากฎบนหน้าจอของผู้คน ซึ่งรวมถึงโพสต์ เช็คอิน โฆษณา ข้อมูลโซเชียลจากผู้คนที่มีปฏิสัมพันธ์กับเพจของคุณ และอื่นๆ"
			, "จำนวนคนที่เห็นเนื้อหาใดๆ จากเพจของคุณหรือเกี่ยวกับเพจของคุณปรากฎบนหน้าจอ ซึ่งรวมถึงโพสต์ เช็คอิน โฆษณา ข้อมูลโซเชียลจากผู้คนที่มีปฏิสัมพันธ์กับเพจของคุณ และอื่นๆ"
			, "จำนวนครั้งที่เนื้อหาใดๆ จากบนเพจของคุณหรือเกี่ยวกับเพจของคุณปรากฎบนหน้าจอของผู้คนโดยมีข้อมูลโซเชียลแนบมา ข้อมูลโซเชียลจะปรากฏขึ้นเมื่อเพื่อนของผู้บุคคลดังกล่าวมีปฏิสัมพันธ์กับเพจหรือโพสต์ของคุณ ซึ่งรวมถึงเมื่อเพื่อนของบางคนกดถูกใจหรือติดตามเพจของคุณ มีส่วนร่วมกับโพสต์ แชร์รูปภาพในเพจของคุณ และเช็คอินในเพจของคุณ"
			, "จำนวนคนที่เห็นเนื้อหาใดๆ จากเพจของคุณหรือเกี่ยวกับเพจของคุณปรากฎบนหน้าจอโดยมีข้อมูลโซเชียลแนบมา ในฐานะที่เป็นรูปแบบการกระจายแบบออร์แกนิก ข้อมูลโซเชียลจะปรากฏขึ้นเมื่อเพื่อนของผู้บุคคลดังกล่าวมีปฏิสัมพันธ์กับเพจหรือโพสต์ของคุณซึ่งรวมถึงเมื่อเพื่อนของบางคนกดถูกใจหรือติดตามเพจของคุณ มีส่วนร่วมกับโพสต์ แชร์รูปภาพในเพจของคุณ และเช็คอินในเพจของคุณ"
			, "จำนวนครั้งที่ผู้คนมีส่วนร่วมกับโพสต์ของคุณผ่านการกดถูกใจ การแสดงความคิดเห็น การแชร์ และอื่นๆ"
			, "จำนวนคนที่มีส่วนร่วมกับเพจของคุณ การมีส่วนร่วมรวมถึงการคลิกใดๆ ด้วย"
			, "จำนวนครั้งที่มีผู้คลิกบนเนื้อหาใดๆ ของคุณ"
			, "จำนวนคนที่คลิกบนเนื้อหาใดๆ ของคุณ"
			, "จำนวนครั้งที่มีการดูโปรไฟล์ของเพจ"
		);
		// Set document properties
		$objPHPExcel->getProperties()->setCreator("WD_System")
									 ->setLastModifiedBy("WD_System");
		
		// Set Active Sheet = 0
		$objPHPExcel->setActiveSheetIndex(0);
		
		// Print_page Heder
		$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
		$objPHPExcel->getActiveSheet()->setCellValue("A1", "สถิติเชิงลึกของเพจ (รายวัน)");
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		
		$objPHPExcel->getActiveSheet()->mergeCells('A2:E2');
		//$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ". date_format(date_create(), 'j F Y G:i'));
		//$objPHPExcel->getActiveSheet()->setCellValue("A2", "ระหว่างวันที่ ".thai_date_short_date(date_format(date_create($start_date), 'U'))." ถึง ".thai_date_short_date(date_format(date_create($end_date), 'U')));
		$objPHPExcel->getActiveSheet()->setCellValue("A2", "ระหว่างวันที่ ".thai_date_non_dow(date_format(date_create($start_date), 'U'))." ถึง ".thai_date_non_dow(date_format(date_create($end_date), 'U')));
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');
		
		$objPHPExcel->getActiveSheet()->mergeCells('A3:E3');
		//$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ". date_format(date_create(), 'j F Y G:i'));
		$objPHPExcel->getActiveSheet()->setCellValue("A3", "Update : ".thai_date(date('U'))." เวลา ".date('H:i'));
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(8);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setItalic(true);
		
		//Table Header
		$i_colum = 0;
		$i_row = 4;
		foreach ($tbl_f as $f_name) {
			$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $f_name);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum])->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFont()->setName('Leelawadee UI');
			$i_colum++;
		}
		// Print column Name
		$i_colum = 0;
		$i_row = 5;
		if ($rowcount > 0)
		{
			foreach ($data_Array as $row_data) {
				$i_colum = 0;
				foreach ($tbl_f as $f_name) {
					if ($f_name == "data_date")
					{
						//$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $row_data[$f_name]);
						$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , thai_date_short_date(date_format(date_create($row_data[$f_name]), 'U')));
					}
					else
					{
						$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $row_data[$f_name]);
						$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getNumberFormat()->setFormatCode('#,##');
					}
					$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFont()->setName('Leelawadee UI');
					$i_colum++;
				}
				$i_row++;
			}
		}
		$objPHPExcel->getActiveSheet()->setTitle('รายวัน');
		
		
		
		
		
		// Weekly Data ======================================================================
		$sql = "Select a.f_name, a.value, a.data_date From static_page_wm a INNER Join m_field_desc b ON a.f_name = b.f_name WHERE (a.data_date BETWEEN '$start_date' AND '$end_date') AND data_type = 'Weekly' Order By a.data_date, b.render_no";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		$rowcount=mysqli_num_rows($res);
		mysqli_close($conn);		
		$data_Array = array();
		$temp_array = array();
		$current_date = "";
		while ($row = $res->fetch_assoc()){
			if (($current_date != $row['data_date']))
			{
				if ($current_date != "")
				{
					$data_Array[] = $temp_array;
				}
				$temp_array = array();
				$temp_array['data_date'] = $row['data_date'];
			}
			$temp_array[$row['f_name']] = $row['value'];
			$current_date = $row['data_date'];
		}
		$data_Array[] = $temp_array;
		
		$objWorkSheet = $objPHPExcel->createSheet(1); //Setting index when creating
		// Set Active Sheet = 1
		$objPHPExcel->setActiveSheetIndex(1);
		
		// Print_page Heder
		$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
		$objPHPExcel->getActiveSheet()->setCellValue("A1", "สถิติเชิงลึกของเพจ (รายสัปดาห์)");
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		
		$objPHPExcel->getActiveSheet()->mergeCells('A2:E2');
		//$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ". date_format(date_create(), 'j F Y G:i'));
		//$objPHPExcel->getActiveSheet()->setCellValue("A2", "ระหว่างวันที่ ".thai_date_short_date(date_format(date_create($start_date), 'U'))." ถึง ".thai_date_short_date(date_format(date_create($end_date), 'U')));
		$objPHPExcel->getActiveSheet()->setCellValue("A2", "ระหว่างวันที่ ".thai_date_non_dow(date_format(date_create($start_date), 'U'))." ถึง ".thai_date_non_dow(date_format(date_create($end_date), 'U')));
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');
		
		$objPHPExcel->getActiveSheet()->mergeCells('A3:E3');
		//$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ". date_format(date_create(), 'j F Y G:i'));
		$objPHPExcel->getActiveSheet()->setCellValue("A3", "Update : ".thai_date(date('U'))." เวลา ".date('H:i'));
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(8);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setItalic(true);
		
		//Table Header
		$i_colum = 0;
		$i_row = 4;
		foreach ($tbl_f as $f_name) {
			$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $f_name);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum])->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFont()->setName('Leelawadee UI');
			$i_colum++;
		}
		// Print column Name
		$i_colum = 0;
		$i_row = 5;
		if ($rowcount > 0)
		{
			foreach ($data_Array as $row_data) {
				$i_colum = 0;
				foreach ($tbl_f as $f_name) {
					if ($f_name == "data_date")
					{
						$_7daybf = date('Y-m-d', strtotime('-6 day', strtotime($row_data[$f_name])));
						$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , thai_date_short_date(date_format(date_create($_7daybf), 'U')) ." - " .thai_date_short_date(date_format(date_create($row_data[$f_name]), 'U')));
					}
					else
					{
						$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $row_data[$f_name]);
						$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getNumberFormat()->setFormatCode('#,##');
					}
					$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFont()->setName('Leelawadee UI');
					$i_colum++;
				}
				$i_row++;
			}
		}
		$objPHPExcel->getActiveSheet()->setTitle('รายสัปดาห์');
		
		
		
		// Monthly Data ======================================================================================
		global $thai_month_arr;
		$sql = "Select a.f_name, a.value, a.data_date From static_page_wm a INNER Join m_field_desc b ON a.f_name = b.f_name WHERE (a.data_date BETWEEN '$start_date' AND '$end_date') AND data_type = 'Monthly' Order By a.data_date, b.render_no";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		$rowcount=mysqli_num_rows($res);
		mysqli_close($conn);		
		$data_Array = array();
		$temp_array = array();
		$current_date = "";
		while ($row = $res->fetch_assoc()){
			if (($current_date != $row['data_date']))
			{
				if ($current_date != "")
				{
					$data_Array[] = $temp_array;
				}
				$temp_array = array();
				$temp_array['data_date'] = $row['data_date'];
			}
			$temp_array[$row['f_name']] = $row['value'];
			$current_date = $row['data_date'];
		}
		$data_Array[] = $temp_array;
		
		$objWorkSheet = $objPHPExcel->createSheet(2); //Setting index when creating
		// Set Active Sheet = 1
		$objPHPExcel->setActiveSheetIndex(2);
		
		// Print_page Heder
		$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
		$objPHPExcel->getActiveSheet()->setCellValue("A1", "สถิติเชิงลึกของเพจ (รายเดือน)");
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		
		$objPHPExcel->getActiveSheet()->mergeCells('A2:E2');
		//$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ". date_format(date_create(), 'j F Y G:i'));
		//$objPHPExcel->getActiveSheet()->setCellValue("A2", "ระหว่างวันที่ ".thai_date_short_date(date_format(date_create($start_date), 'U'))." ถึง ".thai_date_short_date(date_format(date_create($end_date), 'U')));
		$objPHPExcel->getActiveSheet()->setCellValue("A2", "ระหว่างวันที่ ".thai_date_non_dow(date_format(date_create($start_date), 'U'))." ถึง ".thai_date_non_dow(date_format(date_create($end_date), 'U')));
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');
		
		$objPHPExcel->getActiveSheet()->mergeCells('A3:E3');
		//$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ". date_format(date_create(), 'j F Y G:i'));
		$objPHPExcel->getActiveSheet()->setCellValue("A3", "Update : ".thai_date(date('U'))." เวลา ".date('H:i'));
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(8);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setItalic(true);
		
		//Table Header
		$i_colum = 0;
		$i_row = 4;
		foreach ($tbl_f as $f_name) {
			$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $f_name);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum])->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFont()->setName('Leelawadee UI');
			$i_colum++;
		}
		// Print column Name
		$i_colum = 0;
		$i_row = 5;
		if ($rowcount > 0)
		{
			foreach ($data_Array as $row_data) {
				$i_colum = 0;
				foreach ($tbl_f as $f_name) {
					if ($f_name == "data_date")
					{
						//$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , thai_date_short_date(date_format(date_create($row_data[$f_name]), 'U')));
						$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $thai_month_arr[date_format(date_create($row_data[$f_name]), 'n')]);
					}
					else
					{
						$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $row_data[$f_name]);
						$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getNumberFormat()->setFormatCode('#,##');
					}
					$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFont()->setName('Leelawadee UI');
					$i_colum++;
				}
				$i_row++;
			}
		}
		
		$objPHPExcel->getActiveSheet()->setTitle('รายเดือน');
		
		
		// Desc Data ======================================================================================
		$objWorkSheet = $objPHPExcel->createSheet(3); //Setting index when creating
		// Set Active Sheet = 1
		$objPHPExcel->setActiveSheetIndex(3);
		// Print_page Heder
		$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
		$objPHPExcel->getActiveSheet()->setCellValue("A1", "คำอธิบาย");
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		
		// Print column Name
		$i_colum = 0;
		$i_row = 3;
		$cnt_ = 0;
		foreach ($tbl_f as $data_zz) {
			if ($cnt_ != 0)
			{
				$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $tbl_f[$cnt_]);
				$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum+1].(string)$i_row , $tbl_f_desc[$cnt_]);
			}
			$i_row++;
			$cnt_++;
		}
		$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum])->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum+1])->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->setTitle('คำอธิบาย');
		
		
		
		
		
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		// Save Excel 2007 file
		// File_name
		//$file_name = "test";
		$file_name = "files/WD_page_static_".date('dmyH')."_".gen_rnd_str(4);
		$file_name.= ".xlsx";
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save($file_name);
		
		echo '<button type="button" class="btn btn-success pull-right" onclick="location.href='."'".$file_name."'".'"><i class="fa fa-file-excel-o"></i> Download Excel</button>';
		
		//echo json_encode($data_Array);
	}
	
	*/

// F=15
function get_table_case_summary()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	//$sql = "Select * From case_summary_report Where year >= 2018  Order By year, month";
	$sql = "Select * From case_summary_report Where year = $select_year Order By year, month";
	global $thai_month_arr_shot;
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['print_month'] = $thai_month_arr_shot[$row['month']] . " " . substr($row['year'], 2);
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}


// F=16
function get_table_case_summary_detail()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "";
	switch ($type) {
		case "new": {
				$sql = "Select a.case_id, a.status, a.topic, IFNULL(d.total, 0) as ep From wd_case a  Left Join count_episode d ON a.case_id = d.case_id  Where YEAR(a.add_date) = $year AND  MONTH(a.add_date) = $month";
				break;
			}

		case "stop": {
				//$sql = "Select a.case_id, b.status, b.topic From case_history a  Inner Join wd_case b ON a.case_id = b.case_id Where a.case_status = 4 AND YEAR(a.time_stmp) = $year AND MONTH(a.time_stmp) = $month ";
				$sql = "Select a.case_id, b.status, b.topic, IFNULL(d.total, 0) as ep From case_history a  Inner Join wd_case b ON a.case_id = b.case_id  Left Join count_episode d ON a.case_id = d.case_id Where a.case_status = 4 AND YEAR(a.time_stmp) = $year AND MONTH(a.time_stmp) = $month ";
				break;
			}

		case "pub": {
				$backmonth = intval($month) - 1;
				$backyear = $year;
				if ($month == "1") {
					$backmonth = 12;
					$backyear = intval($year) - 1;
				}
				//$sql = "Select a.case_id, b.status, b.topic FROM ( Select DISTINCT(case_id) as case_id From case_history Where case_status = 5  AND YEAR(time_stmp) = $year AND MONTH(time_stmp) = $month AND case_id NOT IN ( Select DISTINCT(case_id) From case_history Where case_status = 5 AND YEAR(time_stmp) <= $backyear AND  MONTH(time_stmp) <= $backmonth ) ) a  Inner Join wd_case b ON a.case_id = b.case_id";
				$sql = "Select a.case_id, b.status, b.topic, IFNULL(d.total, 0) as ep FROM ( Select DISTINCT(case_id) as case_id From case_history Where case_status = 5  AND YEAR(time_stmp) = $year AND MONTH(time_stmp) = $month AND case_id NOT IN ( Select DISTINCT(case_id) From case_history Where case_status = 5 AND YEAR(time_stmp) <= $backyear AND  MONTH(time_stmp) <= $backmonth ) ) a  Inner Join wd_case b ON a.case_id = b.case_id Left Join count_episode d ON a.case_id = d.case_id ";
				break;
			}
	}
	global $thai_month_arr_shot;
	include "connectionDb.php";
	$res = $conn->query(trim($sql));

	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['print_case_id'] = substr($row['case_id'], 0, 2) . '-' . substr($row['case_id'], 2, 2) . '-' . substr($row['case_id'], 4);
		$row['img'] = "img/wd_img/default.png";
		if ($row['status'] == "5") {
			$sql = "SELECT a.case_id, b.pub_time, c.img_src FROM case_pub_info a INNER Join system_page_all_pub b ON a.pub_url = b.post_id INNER Join system_page_all_pub_ojb_img c ON b.ojb_id = c.ojb_id Where a.case_id = '" . $row['case_id'] . "' Order BY b.pub_time Limit 1";
			$resx = $conn->query(trim($sql));
			$row_img = $resx->fetch_assoc();
			if ($row_img['img_src'] != "") {
				$row['img'] = $row_img['img_src'];
			}
		}

		$data_Array[] = $row;
	}
	mysqli_close($conn);
	echo json_encode($data_Array);
}

// F=17
function get_like_count_chart()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	include "connectionDb.php";

	//$sql = "SELECT a.like_cnt, DATE(a.time_stamp) as data_date From (Select a.like_cnt, a.time_stamp From system_page_static a Inner Join ( Select max(time_stamp) as time_stamp From system_page_static Group By date(time_stamp)) b ON a.time_stamp = b.time_stamp ) a Group By DATE(a.time_stamp)";
	$sql = "SELECT a.like_cnt, b.value, DATE(a.time_stamp) as data_date From (Select a.like_cnt, a.time_stamp From system_page_static a Inner Join ( Select max(time_stamp) as time_stamp From system_page_static Group By date(time_stamp)) b ON a.time_stamp = b.time_stamp ) a Inner Join (SELECT * FROM static_page WHERE f_name = 'page_fan_adds_unique' AND value <> 0) b ON DATE(a.time_stamp) = b.data_date AND DATE(a.time_stamp) >= DATE_SUB(NOW(), INTERVAL 90 DAY) Group By DATE(a.time_stamp), a.like_cnt, b.value";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();

	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F=18
function get_follow_count_chart()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	include "connectionDb.php";

	$sql = "Select cnt, time_stmp as data_date FROM static_page_follow WHERE time_stmp >= DATE_SUB(NOW(), INTERVAL 90 DAY) Order By data_date";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	$flg = 0;
	$temp_cnt = 0;
	while ($row = $res->fetch_assoc()) {
		if ($flg == 0) {
			$row['value'] = 0;
			$temp_count = $row['cnt'];
			$flg = 1;
		} else {
			$row['value'] = $row['cnt'] - $temp_count;
			$temp_count = $row['cnt'];
		}
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F=19
function get_crp_list_by_type()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	//$sql = "Select a.case_id, a.crp_type, b.status, b.topic From case_crp_type_data a INNER JOIN wd_case b ON a.case_id = b.case_id Where a.crp_id = '$case_type'";
	$sql = "Select a.case_id, a.crp_type, b.status, b.topic From case_crp_type_data a INNER JOIN wd_case b ON a.case_id = b.case_id Where a.crp_type = '$case_type' AND YEAR(b.add_date) = $select_year";

	global $thai_month_arr_shot;
	include "connectionDb.php";
	$res = $conn->query(trim($sql));

	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['print_case_id'] = substr($row['case_id'], 0, 2) . '-' . substr($row['case_id'], 2, 2) . '-' . substr($row['case_id'], 4);
		$row['img'] = "img/wd_img/default.png";
		if ($row['status'] == "5") {
			$sql = "SELECT a.case_id, b.pub_time, c.img_src FROM case_pub_info a INNER Join system_page_all_pub b ON a.pub_url = b.post_id INNER Join system_page_all_pub_ojb_img c ON b.ojb_id = c.ojb_id Where a.case_id = '" . $row['case_id'] . "' Order BY b.pub_time Limit 1";
			$resx = $conn->query(trim($sql));
			$row_img = $resx->fetch_assoc();
			if ($row_img['img_src'] != "") {
				$row['img'] = $row_img['img_src'];
			}
		}
		$data_Array[] = $row;
	}
	mysqli_close($conn);
	echo json_encode($data_Array);
}

// F=20
function get_case_main_static()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}

	include "connectionDb.php";
	$data_Array = array();

	// This year Income case
	//$sql = "Select count(*) as value From wd_case WHERE YEAR(add_date) = YEAR(CURDATE())";
	$sql = "Select count(*) as value From wd_case WHERE YEAR(add_date) = $select_year";
	$res = $conn->query(trim($sql));
	$row = $res->fetch_assoc();
	$data_Array['this_year_income_case'] = $row['value'];

	// Pub case
	//$sql = "Select count(*) as value From wd_case WHERE YEAR(add_date) = YEAR(CURDATE()) AND status = 5";
	$sql = "Select count(*) as value From wd_case WHERE YEAR(add_date) = $select_year AND status = 5";
	$res = $conn->query(trim($sql));
	$row = $res->fetch_assoc();
	$data_Array['this_year_pub_case'] = $row['value'];

	// Pub case target
	//$sql = "Select pub_post_cnt From m_yearly_target";
	$sql = "Select pub_post_cnt From m_yearly_target a Where a.year = $select_year";
	$res = $conn->query(trim($sql));
	$row = $res->fetch_assoc();

	//$data_Array['pub_post_target_pct'] = ($data_Array['this_year_pub_case'] / $row['pub_post_cnt']) * 100;
	$data_Array['pub_post_target_pct'] = 20;

	// get Ofd dmg
	//$sql = "Select sum(a.ofd_dmg) / 1000000 as value From wd_case a Where a.status = 5 AND a.cannot_est_dmg = 0 AND YEAR(a.add_date) = YEAR(CURDATE())";
	$sql = "Select sum(a.ofd_dmg) / 1000000 as value From wd_case a Where a.status = 5 AND a.cannot_est_dmg = 0 AND YEAR(a.add_date) = $select_year";
	$res = $conn->query(trim($sql));
	$row = $res->fetch_assoc();
	$data_Array['this_year_pub_ofd'] = number_format($row['value'], 1);

	// get Ofd dmg cannot cnt
	//$sql = "Select count(*) as value From wd_case a Where a.status = 5 AND a.cannot_est_dmg = 1 AND YEAR(a.add_date) = YEAR(CURDATE())";
	$sql = "Select count(*) as value From wd_case a Where a.status = 5 AND a.cannot_est_dmg = 1 AND YEAR(a.add_date) = $select_year";
	$res = $conn->query(trim($sql));
	$row = $res->fetch_assoc();
	$data_Array['this_year_pub_ofd_cannot_estm'] = $row['value'];

	echo json_encode($data_Array);

	mysqli_close($conn);
}

// F=21
function get_chart_data_member_occ_type()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Select b.occ_type, count(*) as value From wd_db a Inner Join m_occ_type b ON a.occ_type = b.id Where a.status = 1 Group By b.occ_type";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}


// F=22
function get_chart_data_member_sex()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Select b.sex_desc, count(*) as value From wd_db a INNER Join m_sex b ON a.sex = b.sex_id Where a.status = 1 Group By b.sex_desc";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F=23
function get_chart_data_new_member()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Select YEAR(b.Training_End) as t_yr, MONTH(b.Training_End) as t_mn, b.gen_code, count(*) as cnt From wd_db a  Inner Join m_training_sjb b ON a.gen = b.gen_code Where (YEAR(b.Training_End) = YEAR(curdate()) OR YEAR(b.Training_End) = YEAR(curdate()) - 1) AND a.status = 1 Group By b.gen_code, YEAR(b.Training_End), MONTH(b.Training_End) Order By b.gen_code";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F=24
function get_chart_data_member_status()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	//$sql = "Select b.wd_status_dec, count(*) as value From wd_db a Inner Join m_wd_status b ON a.status = b.wd_status_id Group By b.wd_status_dec Order By b.wd_status_id";
	$sql = "Select b.render, b.wd_status_id, b.wd_status_dec, count(*) as value From wd_db a Inner Join m_wd_status b ON a.status = b.wd_status_id Group By b.render, b.wd_status_id, b.wd_status_dec Order By b.render";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		switch ($row['wd_status_id']) {
			case "1": {
					$row['color'] = "#07b38e";
					break;
				}
			case "2": {
					$row['color'] = "#e3d372";
					break;
				}
			case "3": {
					$row['color'] = "#eb9a59";
					break;
				}
			case "4": {
					$row['color'] = "#de6262";
					break;
				}
			case "5": {
					$row['color'] = "#8cc775";
					break;
				}
			default: {
					$row['color'] = "#FF0F00";
				}
		}
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F=25
function get_current_active_location()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Select a.AMPHUR_CODE, a.cnt, b.LAT, b.LON From ( Select b.AMPHUR_CODE, count(*) as cnt From wd_db a INNER JOIN wd_db_ampher_location b ON a.wd_id = b.wd_id Where a.status = 1 Group By b.AMPHUR_CODE ) a Inner Join add_amp_location b ON a.AMPHUR_CODE = b.AM_ID";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

//F=26
function get_current_active_location_name()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	//$sql = "Select a.AMPHUR_CODE, c.AMPHUR_NAME , a.cnt, b.LAT, b.LON From ( Select b.AMPHUR_CODE, count(*) as cnt From wd_db a INNER JOIN wd_db_ampher_location b ON a.wd_id = b.wd_id Where a.status = 1 Group By b.AMPHUR_CODE ) a Inner Join add_amp_location b ON a.AMPHUR_CODE = b.AM_ID INNER Join add_amphures c ON a.AMPHUR_CODE = c.AMPHUR_CODE";
	//$sql = "Select d.PROVINCE_NAME, count(*) as cnt From wd_db a INNER Join wd_db_ampher_location b ON a.wd_id = b.wd_id Inner Join add_amphures c ON b.AMPHUR_CODE = c.AMPHUR_CODE Inner Join add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID WHERE a.status = 1 Group By d.PROVINCE_NAME";
	//$sql = "Select d.PROVINCE_NAME, d.PROVINCE_ID ,e.LAT, e.LON, count(*) as cnt From wd_db a INNER Join wd_db_ampher_location b ON a.wd_id = b.wd_id Inner Join add_amphures c ON b.AMPHUR_CODE = c.AMPHUR_CODE Inner Join add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID Inner Join add_prov_location e ON d.PROVINCE_ID = e.prov_id WHERE a.status = 1 Group By d.PROVINCE_NAME,e.LAT, e.LON";
	//$sql = "Select a.PROVINCE_ID, a.PROVINCE_NAME, b.LAT, b.LON, IFNULL(b.cnt, 0) as cnt From add_provinces a Left Join ( Select d.PROVINCE_NAME, d.PROVINCE_ID ,e.LAT, e.LON, count(*) as cnt From wd_db a INNER Join wd_db_ampher_location b ON a.wd_id = b.wd_id Inner Join add_amphures c ON b.AMPHUR_CODE = c.AMPHUR_CODE Inner Join add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID Inner Join add_prov_location e ON d.PROVINCE_ID = e.prov_id WHERE a.status = 1 Group By d.PROVINCE_NAME,e.LAT, e.LON) b ON a.PROVINCE_ID = b.PROVINCE_ID";
	$sql = "Select a.PROVINCE_NAME, IFNULL(b.cnt, 0) as cnt From add_provinces a Left join ( Select b.PROVINCE_ID, count(b.PROVINCE_ID) as cnt From wd_db a INNER JOIN add_districts b ON a.add_code = b.DISTRICT_CODE Where a.status in ($check_value) Group By b.PROVINCE_ID ) b ON a.PROVINCE_ID = b.PROVINCE_ID";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));

	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		//$get_data_sql = "Select a.n_name,a.gen From wd_db a Inner Join wd_db_ampher_location b ON a.wd_id = b.wd_id INNER JOIN add_amphures c ON b.AMPHUR_CODE = c.AMPHUR_CODE Where a.status = 1 AND c.PROVINCE_ID = ".$row['PROVINCE_ID']." Order By a.gen";
		//$res_x = $conn->query(trim($get_data_sql));
		//$inside_name = "";
		//$flg=0;
		//while ($row_x = $res_x->fetch_assoc()){
		//	if ($flg)
		//	{
		//		$inside_name = $inside_name . ",";
		//	}
		//	$inside_name = $inside_name . " " . $row_x['n_name'] ."(".$row_x['gen'].")";
		//	$flg=1;
		//}
		//$row['name'] = $inside_name;
		$data_Array[] = $row;
	}
	mysqli_close($conn);
	echo json_encode($data_Array);
}

//F=27
function get_wd_skill_location()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	//$sql = "Select d.PROVINCE_NAME, d.PROVINCE_ID ,e.LAT, e.LON, count(*) as cnt From wd_db a INNER Join wd_db_ampher_location b ON a.wd_id = b.wd_id Inner Join add_amphures c ON b.AMPHUR_CODE = c.AMPHUR_CODE Inner Join add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID Inner Join add_prov_location e ON d.PROVINCE_ID = e.prov_id WHERE a.wd_id in (Select DISTINCT(wd_id) From ( Select * From wd_skill Union ALL SELECT a.wd_id, b.skill FROM wd_team_data a INNER Join m_team_skill b ON a.team_ID = b.team_ID) a WHERE a.wd_skill like '%อบรม%') Group By d.PROVINCE_NAME,e.LAT, e.LON";
	//$sql = "Select b.n_name, b.gen, c.LAT, c.LON From ( Select DISTINCT(a.wd_id) From ( Select * From wd_skill Union ALL SELECT a.wd_id, b.skill FROM wd_team_data a INNER Join m_team_skill b ON a.team_ID = b.team_ID) a WHERE a.wd_skill like '%อบรม%') a Inner Join wd_db b ON a.wd_id = b.wd_id INNER Join add_location c ON b.add_code = c.TA_ID";
	//$sql = "Select c.TA_ID, c.LAT, c.LON, count(*) AS cnt From ( Select DISTINCT(a.wd_id) From ( Select * From wd_skill Union ALL SELECT a.wd_id, b.skill FROM wd_team_data a INNER Join m_team_skill b ON a.team_ID = b.team_ID) a WHERE a.wd_skill like '%$search_text%') a Inner Join wd_db b ON a.wd_id = b.wd_id INNER Join add_location c ON b.add_code = c.TA_ID Group By c.TA_ID, c.LAT, c.LON";
	$sql = "Select c.TA_ID, c.LAT, c.LON, count(*) AS cnt From ( Select DISTINCT(a.wd_id) From (SELECT a.wd_id, a.wd_skill From wd_skill a Union ALL SELECT a.wd_id, b.skill FROM wd_team_data a INNER Join m_team_skill b ON a.team_ID = b.team_ID) a WHERE a.wd_skill like '%$search_text%') a Inner Join wd_db b ON a.wd_id = b.wd_id INNER Join add_location c ON b.add_code = c.TA_ID Group By c.TA_ID, c.LAT, c.LON";

	include "connectionDb.php";
	$res = $conn->query(trim($sql));

	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$get_data_sql = "Select a.n_name, a.gen From wd_db a Where a.add_code = '" . $row['TA_ID'] . "' AND a.wd_id in ( Select DISTINCT(a.wd_id) From (SELECT a.wd_id, a.wd_skill From wd_skill a Union ALL SELECT a.wd_id, b.skill FROM wd_team_data a INNER Join m_team_skill b ON a.team_ID = b.team_ID) a WHERE a.wd_skill like '%$search_text%')";
		$res_x = $conn->query(trim($get_data_sql));
		$inside_name = "";
		$flg = 0;
		while ($row_x = $res_x->fetch_assoc()) {
			if ($flg) {
				$inside_name = $inside_name . ",";
			}
			$inside_name = $inside_name . " " . $row_x['n_name'] . "(" . $row_x['gen'] . ")";
			$flg = 1;
		}
		$row['name'] = $inside_name;
		$data_Array[] = $row;
	}
	mysqli_close($conn);
	echo json_encode($data_Array);
}

// F=28
function get_wd_skill_list()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "SELECT DISTINCT(a.skill) AS skill FROM ( Select wd_skill as skill From wd_skill UNION ALL Select skill From m_team_skill) a Order By a.skill";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F=29
function get_year_for_select()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Select DISTINCT(YEAR(a.add_date)) AS YR From wd_case a ORDER BY a.add_date DESC";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F=30
function get_crp_for_map()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}

	if ($map_pub_check_value == "0") {
		$sql = "SELECT a.PROVINCE_NAME, IFNULL(b.CNT, 0) as cnt FROM add_provinces a LEFT JOIN ( Select d.PROVINCE_ID, d.PROVINCE_NAME, COUNT(d.PROVINCE_ID) AS CNT from wd_case a Inner Join case_ofd_info b ON a.case_id = b.case_id Inner Join add_amphures c ON b.ofd_address_code = c.AMPHUR_CODE Inner Join add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID Where YEAR(a.add_date) = $select_year Group By d.PROVINCE_ID) b ON a.PROVINCE_ID = b.PROVINCE_ID";
	} else {
		$sql = "SELECT a.PROVINCE_NAME, IFNULL(b.CNT, 0) as cnt FROM add_provinces a LEFT JOIN ( Select d.PROVINCE_ID, d.PROVINCE_NAME, COUNT(d.PROVINCE_ID) AS CNT from wd_case a Inner Join case_ofd_info b ON a.case_id = b.case_id Inner Join add_amphures c ON b.ofd_address_code = c.AMPHUR_CODE Inner Join add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID Where YEAR(a.add_date) = $select_year AND a.Status = 5 Group By d.PROVINCE_ID) b ON a.PROVINCE_ID = b.PROVINCE_ID";
	}

	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F=31
function get_case_total_sum()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	//$sql = "SELECT MAIN.YM , REPORT.new AS NEW_CASE , REPORT.stop AS STOP_CASE , REPORT.ending AS PENDING_CASE , MAIN.TOTAL_POST , IFNULL(NEW_POST.CNT, 0) AS COUNT_POST_NEW_CASE , IFNULL(UPDATE_POST.CNT, 0) AS COUNT_UPDATE_CASE , IFNULL(TOTAL_EP.CNT, 0) AS COUNT_EP , MAIN.TOTAL_POST - (IFNULL(NEW_POST.CNT, 0) + IFNULL(UPDATE_POST.CNT, 0)) AS COUNT_OTHER_POST , IFNULL(LIKE_CNT.like_cnt ,0) AS LIKE_COUNT , IFNULL(FOLLOW_CNT.cnt ,0) AS FOLLOW_CNT , IFNULL(Impressions.value ,0) AS Impressions , IFNULL(Impressions_Person.value ,0) AS Impressions_Person , IFNULL(Engagements.value ,0) AS Engagements , IFNULL(Engagements_person.value ,0) AS Engagements_person FROM ( Select EXTRACT(Year_Month FROM pub_time) AS YM, COUNT(post_id) AS TOTAL_POST From system_page_all_pub Group By EXTRACT(Year_Month FROM pub_time)) MAIN Left Join (Select EXTRACT(Year_Month FROM pub_time) AS YM, count(a.case_id) AS CNT From case_pub_info a Inner Join system_page_all_pub b ON a.pub_url = b.post_id Where a.pub_type = 'page_WD_post' AND b.pub_time IN (Select z.pub_time From ( Select a.case_id, MIN(b.pub_time) as pub_time from case_pub_info a Inner Join system_page_all_pub b ON a.pub_url = b.post_id Where a.pub_type = 'page_WD_post' Group By a.case_id) z ) Group By EXTRACT(Year_Month FROM pub_time)) NEW_POST ON MAIN.YM = NEW_POST.YM LEFT JOIN (Select EXTRACT(Year_Month FROM pub_time) AS YM, count(a.case_id) AS CNT From case_pub_info a Inner Join system_page_all_pub b ON a.pub_url = b.post_id Where a.pub_type = 'page_WD_post' AND b.pub_time NOT IN (Select z.pub_time From ( Select a.case_id, MIN(b.pub_time) as pub_time from case_pub_info a Inner Join system_page_all_pub b ON a.pub_url = b.post_id Where a.pub_type = 'page_WD_post' Group By a.case_id) z ) Group By EXTRACT(Year_Month FROM pub_time)) UPDATE_POST ON MAIN.YM = UPDATE_POST.YM LEFT JOIN (Select EXTRACT(Year_Month FROM pub_time) AS YM, Count(a.post_id) AS CNT From case_episode a Inner Join system_page_all_pub b ON a.post_id = b.post_id Group By EXTRACT(Year_Month FROM pub_time)) TOTAL_EP ON MAIN.YM = TOTAL_EP.YM LEFT JOIN (Select EXTRACT(Year_Month FROM time_stamp) AS YM, like_cnt from system_page_static Where time_stamp IN (Select max(time_stamp) from system_page_static Group By EXTRACT(Year_Month FROM time_stamp))) LIKE_CNT ON MAIN.YM = LIKE_CNT.YM LEFT JOIN (Select EXTRACT(Year_Month FROM time_stmp) AS YM, cnt From static_page_follow Where time_stmp IN (Select MAX(time_stmp) From static_page_follow GROUP BY EXTRACT(Year_Month FROM time_stmp))) FOLLOW_CNT ON MAIN.YM = FOLLOW_CNT.YM LEFT JOIN (Select EXTRACT(Year_Month FROM data_date) AS YM, value From static_page_wm Where data_type = 'Monthly' AND f_name = 'page_impressions' Group By EXTRACT(Year_Month FROM data_date)) Impressions ON MAIN.YM = Impressions.YM LEFT JOIN (Select EXTRACT(Year_Month FROM data_date) AS YM, value From static_page_wm Where data_type = 'Monthly' AND f_name = 'page_impressions_unique' Group By EXTRACT(Year_Month FROM data_date)) Impressions_Person ON MAIN.YM = Impressions_Person.YM LEFT JOIN (Select EXTRACT(Year_Month FROM data_date) AS YM, value From static_page_wm Where data_type = 'Monthly' AND f_name = 'page_post_engagements' Group By EXTRACT(Year_Month FROM data_date)) Engagements ON MAIN.YM = Engagements.YM LEFT JOIN (Select EXTRACT(Year_Month FROM data_date) AS YM, value From static_page_wm Where data_type = 'Monthly' AND f_name = 'page_engaged_users' Group By EXTRACT(Year_Month FROM data_date)) Engagements_person ON MAIN.YM = Engagements_person.YM LEFT JOIN (Select CONCAT(year ,LPAD(MONTH, 2,0)) AS YM, a.* From case_summary_report a) REPORT ON MAIN.YM = REPORT.YM Where MAIN.YM LIKE '$select_year%' ORDER BY MAIN.YM";
	//$sql = "SELECT MAIN.ym, REPORT.new AS NEW_CASE, REPORT.stop AS STOP_CASE, REPORT.ending AS PENDING_CASE, MAIN.total_post, Ifnull(NEW_POST.cnt, 0) AS COUNT_POST_NEW_CASE , Ifnull(UPDATE_POST.cnt, 0) AS COUNT_UPDATE_CASE, Ifnull(TOTAL_EP.cnt, 0) AS COUNT_EP, MAIN.total_post - ( Ifnull(NEW_POST.cnt, 0) + Ifnull(UPDATE_POST.cnt, 0) ) AS COUNT_OTHER_POST, Ifnull(LIKE_CNT.like_cnt, 0) AS LIKE_COUNT, Ifnull(FOLLOW_CNT.cnt, 0) AS FOLLOW_CNT, Ifnull(Impressions.value, 0) AS Impressions, Ifnull(Impressions_Person.value, 0) AS Impressions_Person, Ifnull(Engagements.value, 0) AS Engagements, Ifnull(Engagements_person.value, 0) AS Engagements_person, Ifnull(IB.cnt_total, 0) AS CNT_TOTAL_IB, Ifnull(IB.qty_inbox, 0) AS QTY_INBOX, Ifnull(IB.not_qt, 0) AS NOT_QT, Ifnull(RES_IB.RESULT, 0) AS RES_IB FROM (SELECT Extract(year_month FROM pub_time) AS YM, Count(post_id) AS TOTAL_POST FROM system_page_all_pub GROUP BY Extract(year_month FROM pub_time)) MAIN LEFT JOIN (SELECT Extract(year_month FROM pub_time) AS YM, Count(a.case_id) AS CNT FROM case_pub_info a INNER JOIN system_page_all_pub b ON a.pub_url = b.post_id WHERE a.pub_type = 'page_WD_post' AND b.pub_time IN (SELECT z.pub_time FROM (SELECT a.case_id, Min(b.pub_time) AS pub_time FROM case_pub_info a INNER JOIN system_page_all_pub b ON a.pub_url = b.post_id WHERE a.pub_type = 'page_WD_post' GROUP BY a.case_id) z) GROUP BY Extract(year_month FROM pub_time)) NEW_POST ON MAIN.ym = NEW_POST.ym LEFT JOIN (SELECT Extract(year_month FROM pub_time) AS YM, Count(a.case_id) AS CNT FROM case_pub_info a INNER JOIN system_page_all_pub b ON a.pub_url = b.post_id WHERE a.pub_type = 'page_WD_post' AND b.pub_time NOT IN (SELECT z.pub_time FROM (SELECT a.case_id, Min(b.pub_time) AS pub_time FROM case_pub_info a INNER JOIN system_page_all_pub b ON a.pub_url = b.post_id WHERE a.pub_type = 'page_WD_post' GROUP BY a.case_id) z) GROUP BY Extract(year_month FROM pub_time)) UPDATE_POST ON MAIN.ym = UPDATE_POST.ym LEFT JOIN (SELECT Extract(year_month FROM pub_time) AS YM, Count(a.post_id) AS CNT FROM case_episode a INNER JOIN system_page_all_pub b ON a.post_id = b.post_id GROUP BY Extract(year_month FROM pub_time)) TOTAL_EP ON MAIN.ym = TOTAL_EP.ym LEFT JOIN (SELECT Extract(year_month FROM time_stamp) AS YM, like_cnt FROM system_page_static WHERE time_stamp IN (SELECT Max(time_stamp) FROM system_page_static GROUP BY Extract( year_month FROM time_stamp))) LIKE_CNT ON MAIN.ym = LIKE_CNT.ym LEFT JOIN (SELECT Extract(year_month FROM time_stmp) AS YM, cnt FROM static_page_follow WHERE time_stmp IN (SELECT Max(time_stmp) FROM static_page_follow GROUP BY Extract( year_month FROM time_stmp))) FOLLOW_CNT ON MAIN.ym = FOLLOW_CNT.ym LEFT JOIN (SELECT Extract(year_month FROM data_date) AS YM, value FROM static_page_wm WHERE data_type = 'Monthly' AND f_name = 'page_impressions' GROUP BY Extract(year_month FROM data_date)) Impressions ON MAIN.ym = Impressions.ym LEFT JOIN (SELECT Extract(year_month FROM data_date) AS YM, value FROM static_page_wm WHERE data_type = 'Monthly' AND f_name = 'page_impressions_unique' GROUP BY Extract(year_month FROM data_date)) Impressions_Person ON MAIN.ym = Impressions_Person.ym LEFT JOIN (SELECT Extract(year_month FROM data_date) AS YM, value FROM static_page_wm WHERE data_type = 'Monthly' AND f_name = 'page_post_engagements' GROUP BY Extract(year_month FROM data_date)) Engagements ON MAIN.ym = Engagements.ym LEFT JOIN (SELECT Extract(year_month FROM data_date) AS YM, value FROM static_page_wm WHERE data_type = 'Monthly' AND f_name = 'page_engaged_users' GROUP BY Extract(year_month FROM data_date)) Engagements_person ON MAIN.ym = Engagements_person.ym LEFT JOIN (SELECT Concat(year, Lpad(month, 2, 0)) AS YM, a.* FROM case_summary_report a) REPORT ON MAIN.ym = REPORT.ym LEFT JOIN (SELECT a.*, a.cnt_total - Ifnull(b.cnt_notq, 0) AS QTY_INBOX, Ifnull(b.cnt_notq, 0) AS NOT_QT FROM (SELECT Extract(year_month FROM a.created_time) AS YM, Count(DISTINCT ( a.from_id )) AS CNT_TOTAL FROM page_msg_detail a WHERE a.from_id <> '372488206116588'  GROUP BY Extract(year_month FROM a.created_time)) a LEFT JOIN (SELECT Extract(year_month FROM a.created_time) AS YM, Count(DISTINCT ( a.from_id )) AS CNT_notQ FROM page_msg_detail a WHERE a.from_id <> '372488206116588' AND a.from_id NOT IN (SELECT b.sender_id FROM case_inbox_msg a INNER JOIN page_msg b ON a.msg_id = b.msg_id) GROUP BY Extract( year_month FROM a.created_time)) b ON a.ym = b.ym) IB ON MAIN.ym = IB.ym LEFT JOIN (SELECT a.period AS YM, ROUND(a.result) AS result FROM page_msg_respond_time a Inner Join (Select a.period, max(a.time_stmp) as MAX_TIME From page_msg_respond_time a Group By a.period) b ON a.time_stmp = b.MAX_TIME) RES_IB ON MAIN.ym = RES_IB.ym WHERE MAIN.ym LIKE '$select_year%' ORDER BY MAIN.ym";
	//		$sql = "
	//		SELECT MAIN.ym,
	//       REPORT.new                                         AS NEW_CASE,
	//       REPORT.stop                                        AS STOP_CASE,
	//       REPORT.ending                                      AS PENDING_CASE,
	//       MAIN.total_post,
	//       Ifnull(NEW_POST.cnt, 0)                            AS COUNT_POST_NEW_CASE
	//       ,
	//       Ifnull(UPDATE_POST.cnt, 0)                         AS
	//       COUNT_UPDATE_CASE,
	//       Ifnull(TOTAL_EP.cnt, 0)                            AS COUNT_EP,
	//       MAIN.total_post - ( Ifnull(NEW_POST.cnt, 0)
	//                           + Ifnull(UPDATE_POST.cnt, 0) ) AS COUNT_OTHER_POST,
	//       Ifnull(LIKE_CNT.like_cnt, 0)                       AS LIKE_COUNT,
	//       Ifnull(FOLLOW_CNT.cnt, 0)                          AS FOLLOW_CNT,
	//       Ifnull(Impressions.value, 0)                       AS Impressions,
	//       Ifnull(Impressions_Person.value, 0)                AS Impressions_Person,
	//       Ifnull(Engagements.value, 0)                       AS Engagements,
	//       Ifnull(Engagements_person.value, 0)                AS Engagements_person,
	//       Ifnull(IB.cnt_total, 0)                            AS CNT_TOTAL_IB,
	//       Ifnull(IB.qty_inbox, 0)                            AS QTY_INBOX,
	//       Ifnull(IB.not_qt, 0)                               AS NOT_QT,
	//       Ifnull(RES_IB.result, 0)                           AS RES_IB,
	//	   Ifnull(GIB.CNT, 0)                           AS GIBCNT
	//FROM   (SELECT Extract(YEAR_MONTH FROM pub_time) AS YM,
	//               Count(post_id)                    AS TOTAL_POST
	//        FROM   system_page_all_pub
	//        GROUP  BY Extract(YEAR_MONTH FROM pub_time)) MAIN
	//       LEFT JOIN (SELECT Extract(YEAR_MONTH FROM pub_time) AS YM,
	//                         Count(a.case_id)                  AS CNT
	//                  FROM   case_pub_info a
	//                         INNER JOIN system_page_all_pub b
	//                                 ON a.pub_url = b.post_id
	//                  WHERE  a.pub_type = 'page_WD_post'
	//                         AND b.pub_time IN (SELECT z.pub_time
	//                                            FROM   (SELECT a.case_id,
	//                                                           Min(b.pub_time) AS
	//                                                           pub_time
	//                                                    FROM   case_pub_info a
	//                                           INNER JOIN system_page_all_pub b
	//                                                   ON a.pub_url = b.post_id
	//                                                    WHERE
	//                                           a.pub_type = 'page_WD_post'
	//                                                    GROUP  BY a.case_id) z)
	//                  GROUP  BY Extract(YEAR_MONTH FROM pub_time)) NEW_POST
	//              ON MAIN.ym = NEW_POST.ym
	//       LEFT JOIN (SELECT Extract(YEAR_MONTH FROM DZ.pub_time) AS YM,
	//                         Count(DZ.pub_url)                  AS CNT FROM (
	//SELECT a.pub_url, pub_time
	//                  FROM   case_pub_info a
	//                         INNER JOIN system_page_all_pub b
	//                                 ON a.pub_url = b.post_id
	//                  WHERE  a.pub_type = 'page_WD_post'
	//                         AND b.pub_time NOT IN (SELECT z.pub_time
	//                                                FROM   (SELECT a.case_id,
	//                                                               Min(b.pub_time)
	//                                                               AS
	//                                                               pub_time
	//                                                        FROM   case_pub_info a
	//                                               INNER JOIN system_page_all_pub b
	//                                                       ON a.pub_url = b.post_id
	//                                                        WHERE
	//                                               a.pub_type = 'page_WD_post'
	//                                                        GROUP  BY a.case_id) z)
	//         Group By a.pub_url, pub_time) DZ
	//         GROUP BY Extract(YEAR_MONTH FROM DZ.pub_time)) UPDATE_POST
	//              ON MAIN.ym = UPDATE_POST.ym
	//       LEFT JOIN (SELECT Extract(YEAR_MONTH FROM pub_time) AS YM,
	//                         Count(a.post_id)                  AS CNT
	//                  FROM   case_episode a
	//                         INNER JOIN system_page_all_pub b
	//                                 ON a.post_id = b.post_id
	//                  GROUP  BY Extract(YEAR_MONTH FROM pub_time)) TOTAL_EP
	//              ON MAIN.ym = TOTAL_EP.ym
	//       LEFT JOIN (SELECT Extract(YEAR_MONTH FROM time_stamp) AS YM,
	//                         like_cnt
	//                  FROM   system_page_static
	//                  WHERE  time_stamp IN (SELECT Max(time_stamp)
	//                                        FROM   system_page_static
	//                                        GROUP  BY Extract(
	//                                        YEAR_MONTH FROM time_stamp)))
	//                                                 LIKE_CNT
	//              ON MAIN.ym = LIKE_CNT.ym
	//       LEFT JOIN (SELECT Extract(YEAR_MONTH FROM time_stmp) AS YM,
	//                         cnt
	//                  FROM   static_page_follow
	//                  WHERE  time_stmp IN (SELECT Max(time_stmp)
	//                                       FROM   static_page_follow
	//                                       GROUP  BY Extract(
	//                                       YEAR_MONTH FROM time_stmp)))
	//                                                 FOLLOW_CNT
	//              ON MAIN.ym = FOLLOW_CNT.ym
	//       LEFT JOIN (SELECT Extract(YEAR_MONTH FROM data_date) AS YM,
	//                         value
	//                  FROM   static_page_wm
	//                  WHERE  data_type = 'Monthly'
	//                         AND f_name = 'page_impressions'
	//                  GROUP  BY Extract(YEAR_MONTH FROM data_date)) Impressions
	//              ON MAIN.ym = Impressions.ym
	//       LEFT JOIN (SELECT Extract(YEAR_MONTH FROM data_date) AS YM,
	//                         value
	//                  FROM   static_page_wm
	//                  WHERE  data_type = 'Monthly'
	//                         AND f_name = 'page_impressions_unique'
	//                  GROUP  BY Extract(YEAR_MONTH FROM data_date))
	//                 Impressions_Person
	//              ON MAIN.ym = Impressions_Person.ym
	//       LEFT JOIN (SELECT Extract(YEAR_MONTH FROM data_date) AS YM,
	//                         value
	//                  FROM   static_page_wm
	//                  WHERE  data_type = 'Monthly'
	//                         AND f_name = 'page_post_engagements'
	//                  GROUP  BY Extract(YEAR_MONTH FROM data_date)) Engagements
	//              ON MAIN.ym = Engagements.ym
	//       LEFT JOIN (SELECT Extract(YEAR_MONTH FROM data_date) AS YM,
	//                         value
	//                  FROM   static_page_wm
	//                  WHERE  data_type = 'Monthly'
	//                         AND f_name = 'page_engaged_users'
	//                  GROUP  BY Extract(YEAR_MONTH FROM data_date))
	//                 Engagements_person
	//              ON MAIN.ym = Engagements_person.ym
	//       LEFT JOIN (SELECT Concat(year, Lpad(month, 2, 0)) AS YM,
	//                         a.*
	//                  FROM   case_summary_report a) REPORT
	//              ON MAIN.ym = REPORT.ym
	//       LEFT JOIN (SELECT a.*,
	//                         a.cnt_total - Ifnull(b.cnt_notq, 0) AS QTY_INBOX,
	//                         Ifnull(b.cnt_notq, 0)               AS NOT_QT
	//                  FROM   (SELECT Extract(YEAR_MONTH FROM a.created_time) AS YM,
	//                                 Count(DISTINCT ( a.from_id ))           AS
	//                                 CNT_TOTAL
	//                          FROM   page_msg_detail a
	//                          WHERE  a.from_id <> '372488206116588'
	//                          GROUP  BY Extract(YEAR_MONTH FROM a.created_time)) a
	//                         LEFT JOIN (SELECT Extract(YEAR_MONTH FROM
	//                                                   a.created_time) AS
	//                                           YM,
	//                                           Count(DISTINCT ( a.from_id ))
	//                                           AS
	//                                           CNT_notQ
	//                                    FROM   page_msg_detail a
	//                                    WHERE  a.from_id <> '372488206116588'
	//                                           AND a.from_id NOT IN
	//                                               (SELECT b.sender_id
	//                                                FROM
	//                                               case_inbox_msg a
	//                                               INNER JOIN page_msg b
	//                                                       ON a.msg_id =
	//                                                          b.msg_id)
	//                                    GROUP  BY Extract(
	//                                    YEAR_MONTH FROM a.created_time))
	//                                   b
	//                                ON a.ym = b.ym) IB
	//              ON MAIN.ym = IB.ym
	//       LEFT JOIN (SELECT a.period        AS YM,
	//                         Round(a.result) AS result
	//                  FROM   page_msg_respond_time a
	//                         INNER JOIN (SELECT a.period,
	//                                            Max(a.time_stmp) AS MAX_TIME
	//                                     FROM   page_msg_respond_time a
	//                                     GROUP  BY a.period) b
	//                                 ON a.time_stmp = b.max_time) RES_IB
	//              ON MAIN.ym = RES_IB.ym
	//		LEFT JOIN (SELECT GPZ.YM,  COUNT(GPZ.MSG_ID) AS CNT FROM (SELECT az.YM, az.MSG_ID FROM (
	//			Select  concat(LEFT(a.case_id, 2) + 1957,MID(a.case_id, 3, 2)) AS YM, a.MSG_ID From case_inbox_msg a
	//			UNION ALL 
	//			SELECT z.YM, z.MSG_ID FROM case_inbox_update_recode z) az
	//			GROUP BY az.YM, az.MSG_ID) GPZ
	//			GROUP BY GPZ.YM) GIB ON MAIN.ym = GIB.ym
	//
	//
	//WHERE  MAIN.ym LIKE '$select_year%'
	//ORDER  BY MAIN.ym 
	//		";
	$sql = "Select * From case_summary_tbl  Where ym LIKE '$select_year%' Order by ym";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F=32
function export_post_static()
{
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
	$sql = "Select  SUBSTRING(a.msg, 1, 50) AS ข้อความ, IFNULL(c.case_id, ' ') AS CASE_ID             ";
	$sql = $sql . " , d.topic AS ชื่อเคส             ";
	$sql = $sql . " ,DATE_FORMAT(a.pub_time, '%e/%m/%Y')  AS วันที่โพส,             ";
	$sql = $sql . " b.post_impressions_unique AS Reach             ";
	$sql = $sql . " , b.post_engaged_users AS Engagement             ";
	$sql = $sql . " , b.Comment             ";
	$sql = $sql . " , b.Shared             ";
	$sql = $sql . " , b.post_reactions_like AS กดถูกใจ             ";
	$sql = $sql . " , b.post_reactions_love AS กดLove             ";
	$sql = $sql . " , b.post_reactions_haha AS กดขำ             ";
	$sql = $sql . " ,b.post_reactions_wow AS กดว๊าว             ";
	$sql = $sql . " , b.post_reactions_sorry AS กดเสียใจ             ";
	$sql = $sql . " , b.post_reactions_anger AS กดโกรธ             ";
	$sql = $sql . " , b.post_reactions_total AS Reactionรวม             ";
	$sql = $sql . " from system_page_all_pub a             ";
	$sql = $sql . " Left Join VW_All_post_static b ON a.post_id = b.post_id             ";
	$sql = $sql . " LEFT Join case_pub_info  c ON a.post_id = c.pub_url             ";
	$sql = $sql . " Left Join wd_case d ON c.case_id = d.case_id             ";

	$sql = $sql . " Where a.pub_time BETWEEN '$start_date' AND '$end_date'             ";
	$sql = $sql . " Order By a.pub_time";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);

	// Set Active Sheet = 0
	$objPHPExcel->setActiveSheetIndex(0);

	// Print_page Heder
	$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
	$objPHPExcel->getActiveSheet()->setCellValue("A1", "สถิติโพส");
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

	$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
	$objPHPExcel->getActiveSheet()->setCellValue("A2", "ระหว่างวันที่ " . $start_date . " ถึง " . $end_date);
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');
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
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, substr($row[$f_name], 0, 2) . '-' . substr($row[$f_name], 2, 2) . '-' . substr($row[$f_name], 4));
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


	// Save Excel 2007 file
	// File_name
	//$file_name = "test";
	$file_name = "files/WD_Post_data" . date('dmyH') . gen_rnd_str(4);
	$file_name .= ".xlsx";
	$objWriter = new Xlsx($objPHPExcel);
	$objWriter->save($file_name);
	echo '<button type="button" class="btn  btn-success pull-right" onclick="location.href=' . "'" . $file_name . "'" . '">Download</button>';
}


/* Old Function ==========================================================================================================================
	function export_post_static_2()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+/////]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
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
		
		
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Asia/Bangkok');

		require_once dirname(__FILE__) . '/plugins/Classes/PHPExcel.php';

		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		$styleArray = array(
			'font'  => array(
				'bold'  => true
				),
			  'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array(
				  'argb' => 'FFFFFFCC',
				),
			  ),
			);
			
			$styleBan = array(
			  'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
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
		$sql = "Select  SUBSTRING(a.msg, 1, 50) AS ข้อความ, IFNULL(c.case_id, ' ') AS CASE_ID             ";
		$sql = $sql." , d.topic AS ชื่อเคส             ";
		$sql = $sql." ,DATE_FORMAT(a.pub_time, '%e/%m/%Y')  AS วันที่โพส,             ";
		$sql = $sql . " b.post_impressions_unique AS Reach             ";
		$sql = $sql . " , b.post_engaged_users AS Engagement             ";
		$sql = $sql . " , b.Comment             ";
		$sql = $sql . " , b.Shared             ";
		$sql = $sql . " , b.post_reactions_like AS กดถูกใจ             ";
		$sql = $sql . " , b.post_reactions_love AS กดLove             ";
		$sql = $sql . " , b.post_reactions_haha AS กดขำ             ";
		$sql = $sql . " ,b.post_reactions_wow AS กดว๊าว             ";
		$sql = $sql . " , b.post_reactions_sorry AS กดเสียใจ             ";
		$sql = $sql . " , b.post_reactions_anger AS กดโกรธ             ";
		$sql = $sql . " , b.post_reactions_total AS Reactionรวม             ";
		$sql = $sql . " from system_page_all_pub a             ";
		$sql = $sql . " Left Join VW_All_post_static b ON a.post_id = b.post_id             ";
		$sql = $sql . " LEFT Join case_pub_info  c ON a.post_id = c.pub_url             ";
		$sql = $sql . " Left Join wd_case d ON c.case_id = d.case_id             ";
		
		$sql = $sql . " Where a.pub_time BETWEEN '$start_date' AND '$end_date'             ";
		$sql = $sql . " Order By a.pub_time";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		
		// Set Active Sheet = 0
		$objPHPExcel->setActiveSheetIndex(0);
		
		// Print_page Heder
		$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
		$objPHPExcel->getActiveSheet()->setCellValue("A1", "สถิติโพส");
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		
		$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
		$objPHPExcel->getActiveSheet()->setCellValue("A2", "ระหว่างวันที่ ".$start_date." ถึง ".$end_date);
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');
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
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum])->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFont()->setName('Leelawadee UI');
			array_push($tbl_f_all, $property->name);
			$i_colum ++;
		}
		// Print Data
		while ($row = $res->fetch_assoc()){
				$i_colum = 0;
				$i_row++;
				foreach ($tbl_f_all as $f_name) {
					
					if (validateDate($row[$f_name], 'Y-m-d'))
					{
						$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $row[$f_name]);
						$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getNumberFormat()->setFormatCode('yyyy-mm-dd');
					}
					else
					{
						if ($f_name == "CASE_ID")
						{
							$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , substr($row[$f_name],0, 2).'-'.substr($row[$f_name],2, 2).'-'.substr($row[$f_name],4));
						}
						else
						{
							$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $row[$f_name]);
							if (is_numeric($row[$f_name]) and ($f_name != "CASE_ID"))
							{
								$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getNumberFormat()->setFormatCode('#,##');
							}
						}
					}
					
					
					
					
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


		// Save Excel 2007 file
		// File_name
		//$file_name = "test";
		$file_name = "files/WD_Post_data".date('dmyH').gen_rnd_str(4);
		$file_name.= ".xlsx";
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save($file_name);
		echo '<button type="button" class="btn  btn-success pull-right" onclick="location.href='."'".$file_name."'".'">Download</button>';






	}

	
	*/

//export_case_report



function export_case_report()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$tbl_f_all = array();
	$monthTH = [null, 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
	$column = array();
	for ($i = 'a'; $i < 'zz'; $i++) {
		array_push($column, $i);
	}



	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	date_default_timezone_set('Asia/Bangkok');

	$objPHPExcel = new Spreadsheet();
	// Set document properties
	$objPHPExcel->getProperties()->setCreator("WD_System")
		->setLastModifiedBy("WD_System");

	// Query Data
	include "connectionDb.php";




	// Set Active Sheet = 0
	$objPHPExcel->setActiveSheetIndex(0);


	// Set All sprade sheet 
	$objPHPExcel
		->getActiveSheet()
		->getStyle('A1:CZ500')
		->getFill()
		->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
		->getStartColor()
		->setARGB('ffffff');


	// Print_page Heder
	$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
	$objPHPExcel->getActiveSheet()->setCellValue("A1", "ผลการดำเนินงานปฏิบัติการหมาเฝ้าบ้าน ");
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A1')
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);

	$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
	$objPHPExcel->getActiveSheet()->setCellValue("A2", "ปี " . $ex_year_th);
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A2')
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);

	$objPHPExcel->getActiveSheet()->mergeCells('A3:H3');
	$objPHPExcel->getActiveSheet()->setCellValue("A3", "ดึงข้อมูล ณ. วันที่ " . thai_date(date('U')) . " เวลา " . date('H:i'));
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setItalic(true);
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->getColor()->setARGB('FFAAAAAA');
	$objPHPExcel->getActiveSheet()->getStyle('A3')
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

	$target_cell_mr = 'A4:H4';
	$target_cell = 'A4';
	$objPHPExcel->getActiveSheet()->mergeCells($target_cell_mr);
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, "ภาพรวมโครงการรายปี " . $ex_year_th);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('B4C6E7');


	// FACEBOOK RESULT
	//$target_cell_mr = 'A4:H4';
	$target_cell = 'A5';
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, "FACEBOOK");
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	// Load LIKE data
	$sql = "SELECT lsz.LIKE_COUNT AS LAST_YEAR_CNT, crnt.LIKE_COUNT AS CURRENT_CNT FROM (Select z.LIKE_COUNT From case_summary_tbl z Where z.ym = '" . $ex_year_last . "12' ) lsz JOIN (Select z.LIKE_COUNT From case_summary_tbl z Where z.ym = (SELECT MAX(z.ym) FROM case_summary_tbl z WHERE z.ym LIKE '$ex_year%')) crnt";
	$res = $conn->query(trim($sql));
	$row   = mysqli_fetch_row($res);
	//$target_cell_mr = 'A4:H4';
	$target_cell = 'B6';
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, "Like : " . number_format($row[1]) . "(+" . number_format($row[1] - $row[0]) . ")");
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);


	// Load Follow data
	$sql = "SELECT lsz.FOLLOW_CNT AS LAST_YEAR_CNT, crnt.FOLLOW_CNT AS CURRENT_CNT FROM (Select z.FOLLOW_CNT From case_summary_tbl z Where z.ym = '" . $ex_year_last . "12' ) lsz JOIN (Select z.FOLLOW_CNT From case_summary_tbl z Where z.ym = (SELECT MAX(z.ym) FROM case_summary_tbl z WHERE z.ym LIKE '$ex_year%')) crnt";
	$res = $conn->query(trim($sql));
	$row   = mysqli_fetch_row($res);
	//$target_cell_mr = 'A4:H4';
	$target_cell = 'B7';
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, "Follow : " . number_format($row[1]) . "(+" . number_format($row[1] - $row[0]) . ")");
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);



	// Load Line data
	$sql = "SELECT ST.value AS BEGINNING, LS.value AS LAST FROM (
		Select a.value From line_static a 
		Where a.Cat_main = 'Followers' and a.Cat_sub_1 = 'followers'
		AND a.Date = '$ex_year-01-01') ST 
		JOIN (Select a.value From line_static a 
		Where a.Cat_main = 'Followers' and a.Cat_sub_1 = 'followers'
		AND a.Date = (Select  MAX(a.Date) From line_static a 
		Where a.Cat_main = 'Followers' and a.Cat_sub_1 = 'followers' AND YEAR(a.Date) = $ex_year)) LS
	";
	$res = $conn->query(trim($sql));


	//$target_cell_mr = 'A4:H4';

	$target_cell = 'A8';
	if (mysqli_num_rows($res) > 0) {
		$row   = mysqli_fetch_row($res);
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, "Line : " . number_format($row[1]) . "(+" . number_format($row[1] - $row[0]) . ")");
	} else {
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, "Line : ไม่มีข้อมูล");
	}

	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);


	// Blank For IG
	$target_cell = 'A9';
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, "IG : ");
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);



	$yr_jan = $ex_year . '01';
	$yr_dec = $ex_year . '12';

	// Load data Table 
	$sql = "SELECT ym AS 'เดือน', 
	AVG(Impressions) AS Reach
	,AVG(Impressions_Person) AS 'Reach User'
	,AVG(Engagements) AS 'Engagements'
	,AVG(Engagements_person) AS 'Engagement User'
	,AVG(Engagements_person) / AVG(Impressions_Person) AS 'สัดส่วน'
	, AVG(RES_IB) 'ความเร็วในการตอบ  (นาที)'
	,AVG(CNT_TOTAL_IB) AS 'Inboxทั้งหมด'
   FROM case_summary_tbl Where ym >= $yr_jan
   AND ym <= $yr_dec
   Group By ym
   
   UNION ALL
   SELECT 'ค่าเฉลี่ย'
	, AVG(Impressions) AS Reach
	,AVG(Impressions_Person) AS 'Reach User'
	,AVG(Engagements) AS 'Engagements'
	,AVG(Engagements_person) AS 'Engagement User'
	,AVG(Engagements_person) / AVG(Impressions_Person) AS 'สัดส่วน'
	,AVG(RES_IB) 'ความเร็วในการตอบ (นาที)'
	,AVG(CNT_TOTAL_IB) AS 'Inboxทั้งหมด'
   FROM case_summary_tbl Where ym >= $yr_jan
   AND ym <= $yr_dec
   Group By LEFT(ym, 4)";



	$res = $conn->query(trim($sql));

	// mergeCells Header Table 
	$target_cell_mr = 'A11:A12';
	$target_cell = 'A11';
	$objPHPExcel->getActiveSheet()->mergeCells($target_cell_mr);
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'เดือน');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);



	$target_cell_mr = 'B11:F11';
	$target_cell = 'B11';
	$objPHPExcel->getActiveSheet()->mergeCells($target_cell_mr);
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'สถิติ Facebook');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

	$target_cell_mr = 'G11:H11';
	$target_cell = 'G11';
	$objPHPExcel->getActiveSheet()->mergeCells($target_cell_mr);
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'Inbox');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


	// Print column Name
	$i_colum = 0;
	$i_row = 12;
	$tbl_f_all = array();
	while ($property = mysqli_fetch_field($res)) {
		$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $property->name);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->getStartColor()->setRGB('FFFFCC');
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setBold(true);
		//$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum])->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('TH SarabunPSK');
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setSize(16);

		array_push($tbl_f_all, $property->name);
		$i_colum++;
	}
	// Print Data
	while ($row = $res->fetch_assoc()) {
		$i_colum = 0;
		$i_row++;
		$summary_flg = 0;
		foreach ($tbl_f_all as $f_name) {
			if ($f_name == 'เดือน') {
				if ((int)substr($row[$f_name], -2) > 0) {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $monthTH[(int)substr($row[$f_name], -2)] . ' ' . $ex_year_th);
				} else {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, 'เฉลี่ยต่อเดือน');
					$summary_flg = 1;
				}
			} else if (validateDate($row[$f_name], 'Y-m-d')) {
				$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
				$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('yyyy-mm-dd');
			} else {
				if ($f_name == "CASE ID") {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, substr($row[$f_name], 0, 2) . '-' . substr($row[$f_name], 2, 2) . '-' . substr($row[$f_name], 4));
				} else {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
					if (is_numeric($row[$f_name]) and ($f_name != "CASE ID")) {
						if ($f_name == "สัดส่วน") {
							$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('0.0%;[Red]-0.0%');
						} else {
							$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('#,##');
						}
					}
				}
			}
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setSize(16);
			if ($summary_flg == 1) {
				$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setBold(true);
			}
			$i_colum++;
		}
	}

	// Border

	$objPHPExcel->getActiveSheet()->getStyle('A11:H' . (string)$i_row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle('G' . (string)($i_row + 1) . ':H' . (string)($i_row + 1))->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


	// Load GOOD IB 
	$i_row++;
	$target_cell = 'G' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'Inbox ที่เป็นประโยชน์');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);

	$sql = "SELECT SUM(GIBCNT) AS GIBCNT FROM case_summary_tbl Where ym >= $yr_jan AND ym <= $yr_dec ";
	$res = $conn->query(trim($sql));
	$row   = mysqli_fetch_row($res);
	//$target_cell_mr = 'A4:H4';
	$target_cell = 'H' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, number_format($row[0]));
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$i_row++;
	$i_row++;


	// ================================ CASE =================================================
	$target_cell = 'A' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'สรุปเคส');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);



	// Load data Table 
	$sql = "SELECT 'ปี $ex_year_th' AS ''
	, ZM.BG AS 'ยกยอดมาจากปีที่แล้ว'
	, ZM.NEW AS 'เข้าใหม่'
	, ZM.STOP AS 'ยุติ'
	, ZM.PUB AS 'ลงเพจ'
	, ZM.BG + ZM.NEW - ZM.STOP - ZM.PUB AS 'คงค้าง'
	FROM (SELECT * FROM (
	Select bg AS BG
	From case_summary_report Where year = $ex_year 
	AND MONTH = 1) a
	JOIN (
	Select SUM(new) AS 'NEW'
	, SUM(STOP) AS 'STOP'
	, SUM(pub) AS 'PUB'
	From case_summary_report Where year = $ex_year 
	AND MONTH >= 1
	AND MONTH <= 12
	Group By YEAR
	Order By year, month) b) ZM";



	$res = $conn->query(trim($sql));
	// Print column Name
	$i_colum = 0;
	$i_row++;
	$tbl_f_all = array();

	$start_bdr = 'A' . (string)$i_row;


	while ($property = mysqli_fetch_field($res)) {
		//$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $tbl_f[$property->name]);
		$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $property->name);
		//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->getStartColor()->setRGB('FFFFCC');
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setSize(16);
		//$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum])->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('TH SarabunPSK');
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
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, substr($row[$f_name], 0, 2) . '-' . substr($row[$f_name], 2, 2) . '-' . substr($row[$f_name], 4));
				} else {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
					if (is_numeric($row[$f_name]) and ($f_name != "CASE_ID")) {
						$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('#,##');
					}
				}
			}




			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setSize(16);

			//if ($row['wd_status'] == "Banned")
			//{
			//	$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleBan);
			//}
			$i_colum++;
		}
	}

	$end_bdr = 'F' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->getStyle($start_bdr . ':' . $end_bdr)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


	$i_row++;
	$i_row++;
	// ================================ Post =================================================
	$target_cell = 'A' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'สรุปโพสในศูนย์ปฏิบัติการหมาเฝ้าบ้าน');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);




	// Load data Table 
	$sql = "SELECT 'ปี $ex_year_th' AS ปี, SUM(COUNT_POST_NEW_CASE) AS 'โพสเคสใหม่'
	,SUM(COUNT_UPDATE_CASE) AS 'โพสเคสUpdate'
	,CONCAT(SUM(COUNT_POST_NEW_CASE) +SUM(COUNT_UPDATE_CASE), ' (', SUM(COUNT_EP), ' EP)') AS 'รวมโพสเคส'
	,SUM(COUNT_OTHER_POST) AS 'โพสอื่นๆ'
	 ,SUM(total_post) AS 'รวมโพสทั้งหมด'
   FROM case_summary_tbl Where ym >= $ex_ymbg
   AND ym <= $ex_ymed
   Group By LEFT(ym, 4)";



	$res = $conn->query(trim($sql));
	// Print column Name
	$i_colum = 0;
	$i_row++;
	$i_row++;
	$tbl_f_all = array();
	$start_bdr = 'A' . (string)($i_row - 1);
	while ($property = mysqli_fetch_field($res)) {
		$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $property->name);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->getStartColor()->setRGB('FFFFCC');
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('TH SarabunPSK');
		array_push($tbl_f_all, $property->name);
		$i_colum++;
	}

	$objPHPExcel->getActiveSheet()->mergeCells('B' . (string)($i_row - 1) . ':D' . (string)($i_row - 1));
	$target_cell = 'B' . (string)($i_row - 1);
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'โพสเกี่ยวกับเคสที่ตรวจสอบ');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);





	$objPHPExcel->getActiveSheet()->mergeCells('E' . (string)($i_row - 1) . ':E' . (string)($i_row));
	$target_cell = 'E' . (string)($i_row - 1);
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'โพสอื่นๆ');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


	$objPHPExcel->getActiveSheet()->mergeCells('F' . (string)($i_row - 1) . ':F' . (string)($i_row));
	$target_cell = 'F' . (string)($i_row - 1);
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'รวมโพสทั้งหมด');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);




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
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, substr($row[$f_name], 0, 2) . '-' . substr($row[$f_name], 2, 2) . '-' . substr($row[$f_name], 4));
				} else {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
					if (is_numeric($row[$f_name]) and ($f_name != "CASE_ID")) {
						$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('#,##');
					}
				}
			}




			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setSize(16);

			//if ($row['wd_status'] == "Banned")
			//{
			//	$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleBan);
			//}
			$i_colum++;
		}
	}

	$end_bdr = 'F' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->getStyle($start_bdr . ':' . $end_bdr)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

	//$objPHPExcel->getActiveSheet()->mergeCells('ฤ' . (string)($i_row - 1) . ':A' . (string)($i_row));
	$i_row++;
	$target_cell = 'A' . (string)($i_row);
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, '*EP = โพส EPISODE ที่ลงเพจ');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(10);




	// Event Summary ======================================================================
	$i_row++;
	$i_row++;
	$target_cell = 'A' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'การจัดกิจกรรมและการจัดอบรม  ' . $ex_year_th);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);





	$sql = "Select a.Training_Start, a.Training_End, CONCAT('ชื่อกิจกรรม : ', a.Training_subject) AS sjb, CONCAT('สถานที่ : ', a.location) AS location,  CONCAT('ผู้เข้าร่วม : ', b.CNT) as cnt From m_training_sjb a
	Inner Join (Select a.Training_ID, COUNT(a.wd_id) AS CNT From wd_training a 
	Group By a.Training_ID) b ON a.Training_ID = b.Training_ID
	Where YEAR(a.Training_Start) = $ex_year
	Order By a.Training_Start";
	$res = $conn->query(trim($sql));

	$i_row++;
	$target_cell_mr = 'B' . (string)$i_row . ':C' . (string)$i_row;
	$target_cell = 'B' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->mergeCells($target_cell_mr);
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'วันที่');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

	$target_cell = 'D' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'รายละเอียด');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);



	$i_row++;
	$target_cell = 'A' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'ภายใน  ' . mysqli_num_rows($res) . '  ครั้ง');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);


	$tbl_f_all = array();

	while ($property = mysqli_fetch_field($res)) {
		array_push($tbl_f_all, $property->name);
		$i_colum++;
	}

	while ($row = $res->fetch_assoc()) {
		$i_colum = 1;

		foreach ($tbl_f_all as $f_name) {
			if ($f_name == 'location') {
				$i_colum--;
				$i_row++;
			}
			if ($f_name == 'cnt') {
				$i_colum--;
				$i_row++;
			}
			if (validateDate($row[$f_name], 'Y-m-d')) {
				//$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
				$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, thai_date_non_dow(date_format(date_create($row[$f_name]), 'U')));
				//$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('yyyy-mm-dd');
			} else {
				if ($f_name == "CASE_ID") {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, substr($row[$f_name], 0, 2) . '-' . substr($row[$f_name], 2, 2) . '-' . substr($row[$f_name], 4));
				} else {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
					if (is_numeric($row[$f_name]) and ($f_name != "CASE_ID")) {
						$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('#,##');
					}
				}
			}
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setSize(16);
			//}
			$i_colum++;
		}
		$i_row++;
	}

	$i_row++;
	$i_row++;
	$target_cell = 'A' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'ภายนอก               ครั้ง');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);



	$i_row += 20;

	// ================================ Best Case =================================================
	$i_row++;
	$i_row++;
	$target_cell = 'A' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'เรื่องเด่น ปี ' . $ex_year_th);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$i_row++;
	/*
	$sql = "SELECT AAA.case_id    AS 'CASE_ID',
	AAA.topic      AS 'topic',
	AAA.reach,
	AAA.engegement,
	BBB.pub_url    AS 'POST_URL',
	BBB.reach      AS 'Reach_POST',
	BBB.engegement AS 'engegement_POST'
FROM   (SELECT a.case_id,
			a.topic,
			Sum(CASE
				  WHEN e.f_name = 'post_engaged_users' THEN e.value
				  ELSE 0
				end) AS engegement,
			Sum(CASE
				  WHEN e.f_name = 'post_impressions_unique' THEN e.value
				  ELSE 0
				end) AS reach
	 FROM   wd_case a
			INNER JOIN case_pub_info b
					ON a.case_id = b.case_id
			INNER JOIN case_ofd_info c
					ON a.case_id = c.case_id
			INNER JOIN add_amphures d
					ON c.ofd_address_code = d.amphur_code
			INNER JOIN static_post e
					ON b.pub_url = e.post_id
			INNER JOIN add_geography f
					ON d.geo_id = f.geo_id
	 WHERE  e.data_type = 1
			AND f_name IN ( 'post_engaged_users', 'post_impressions_unique' )
			AND Year(a.add_date) = $ex_year
			AND EXTRACT( YEAR_MONTH FROM a.add_date ) BETWEEN $ex_ymbg AND $ex_ymed
	 GROUP  BY a.case_id,
			   a.topic,
			   f.geo_name
	 ORDER  BY reach DESC
	 LIMIT  5) AAA
	INNER JOIN (SELECT a.case_id,
					   b.pub_url,
					   Sum(e.value) AS value,
					   Sum(CASE
							 WHEN e.f_name = 'post_engaged_users' THEN
							 e.value
							 ELSE 0
						   end)     AS engegement,
					   Sum(CASE
							 WHEN e.f_name = 'post_impressions_unique' THEN
							 e.value
							 ELSE 0
						   end)     AS reach
				FROM   wd_case a
					   INNER JOIN case_pub_info b
							   ON a.case_id = b.case_id
					   INNER JOIN static_post e
							   ON b.pub_url = e.post_id
				WHERE  e.data_type = 1
					   AND f_name IN ( 'post_engaged_users',
									   'post_impressions_unique' )
					   AND Year(a.add_date) = $ex_year
					   AND EXTRACT( YEAR_MONTH FROM a.add_date ) BETWEEN $ex_ymbg AND $ex_ymed
				GROUP  BY a.case_id,
						  b.pub_url
				ORDER  BY a.case_id) BBB
			ON AAA.case_id = BBB.case_id ";
	*/


	$sql = " SELECT AAA.case_id    AS 'CASE_ID',
	AAA.topic      AS 'topic',
	AAA.reach,
	AAA.engegement,
	BBB.pub_url    AS 'POST_URL',
	BBB.reach      AS 'Reach_POST',
	BBB.engegement AS 'engegement_POST',
    SUBSTRING(BBB.msg, 1, 50) as msg,
    BBB.pub_time
FROM   (SELECT a.case_id,
			a.topic,
			Sum(CASE
				  WHEN e.f_name = 'post_engaged_users' THEN e.value
				  ELSE 0
				end) AS engegement,
			Sum(CASE
				  WHEN e.f_name = 'post_impressions_unique' THEN e.value
				  ELSE 0
				end) AS reach
	 FROM   wd_case a
			INNER JOIN case_pub_info b
					ON a.case_id = b.case_id
			INNER JOIN case_ofd_info c
					ON a.case_id = c.case_id
			INNER JOIN add_amphures d
					ON c.ofd_address_code = d.amphur_code
			INNER JOIN static_post e
					ON b.pub_url = e.post_id
			INNER JOIN add_geography f
					ON d.geo_id = f.geo_id
	 WHERE  e.data_type = 1
			AND f_name IN ( 'post_engaged_users', 'post_impressions_unique' )
			AND Year(a.add_date) = $ex_year
			AND EXTRACT( YEAR_MONTH FROM a.add_date ) BETWEEN $ex_ymbg AND $ex_ymed
	 GROUP  BY a.case_id,
			   a.topic,
			   f.geo_name
	 ORDER  BY reach DESC
	 LIMIT  5) AAA
	INNER JOIN (SELECT a.case_id,
					   b.pub_url,
                	f.msg,
                f.pub_time, 
					   Sum(e.value) AS value,
					   Sum(CASE
							 WHEN e.f_name = 'post_engaged_users' THEN
							 e.value
							 ELSE 0
						   end)     AS engegement,
					   Sum(CASE
							 WHEN e.f_name = 'post_impressions_unique' THEN
							 e.value
							 ELSE 0
						   end)     AS reach
				FROM   wd_case a
					   INNER JOIN case_pub_info b
							   ON a.case_id = b.case_id
					   INNER JOIN static_post e
							   ON b.pub_url = e.post_id
                 	Inner Join system_page_all_pub f 
                ON b.pub_url = f.post_id
				WHERE  e.data_type = 1
					   AND f_name IN ( 'post_engaged_users',
									   'post_impressions_unique' )
					   AND Year(a.add_date) = $ex_year
					   AND EXTRACT( YEAR_MONTH FROM a.add_date ) BETWEEN $ex_ymbg AND $ex_ymed
				GROUP  BY a.case_id,
						  b.pub_url
				
                , f.msg
				ORDER  BY a.case_id, f.pub_time) BBB
			ON AAA.case_id = BBB.case_id
		ORDER BY AAA.reach DESC, BBB.pub_time
	";


	$res = $conn->query(trim($sql));


	$target_cell = 'A' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'Case ID');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$target_cell = 'B' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'เรื่อง');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$target_cell = 'C' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'Facebook Link');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$target_cell = 'D' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'ข้อความ');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$target_cell = 'E' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'Reach');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

	$target_cell = 'F' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'Engagement');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

	$target_cell = 'G' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'วันที่โพส');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);




	$i_row++;
	$temp_case_id = "";
	while ($row = $res->fetch_assoc()) {
		$i_colum = 1;

		if ($row['CASE_ID'] <> $temp_case_id) {
			$temp_case_id = $row['CASE_ID'];

			$target_cell = 'A' . (string)$i_row;
			$objPHPExcel->getActiveSheet()->setCellValue($target_cell, substr($row['CASE_ID'], 0, 2) . '-' . substr($row['CASE_ID'], 2, 2) . '-' . substr($row['CASE_ID'], 4));
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('DDDDDD');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);


			$target_cell_mr = '';
			$target_cell = 'B' . (string)$i_row;
			$objPHPExcel->getActiveSheet()->mergeCells('B' . (string)$i_row . ':D' . (string)$i_row);
			$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['topic']);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('DDDDDD');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);

			//$target_cell = 'C' . (string)$i_row;
			//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('DDDDDD');
			//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);

			$target_cell = 'E' . (string)$i_row;
			$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['reach']);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('DDDDDD');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getNumberFormat()->setFormatCode('#,##');

			$target_cell = 'F' . (string)$i_row;
			$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['engegement']);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('DDDDDD');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getNumberFormat()->setFormatCode('#,##');

			$target_cell = 'G' . (string)$i_row;
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('DDDDDD');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getNumberFormat()->setFormatCode('#,##');
			$i_row++;
		}
		$target_cell = 'C' . (string)$i_row;
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, "[Link]");
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getCell($target_cell)->getHyperlink()->setUrl('https://www.facebook.com/Watchdog.ACT/posts/' . $row['POST_URL']);



		$target_cell = 'D' . (string)$i_row;
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['msg'] . "...");
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);

		$target_cell = 'E' . (string)$i_row;
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['Reach_POST']);
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getNumberFormat()->setFormatCode('#,##');

		$target_cell = 'F' . (string)$i_row;
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['engegement_POST']);
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getNumberFormat()->setFormatCode('#,##');

		$target_cell = 'G' . (string)$i_row;
		//$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['pub_time']);
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, thai_date_non_dow(date_format(date_create($row['pub_time']), 'U')));
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)
			->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);





		$i_row++;
	}

	// Check By Gov =======================================================================================================================
	$i_row++;
	$i_row++;
	$target_cell = 'A' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'เคสถูกตรวจสอบจากหน่วยงานรัฐ ปี' . $ex_year_th);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);



	// Header -----------------------------------------------------------------------
	$i_row++;
	$target_cell = 'A' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'Case ID');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$target_cell = 'B' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'เรื่อง');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$target_cell = 'C' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'เข้าสู่ระบบ');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);


	$target_cell = 'D' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'หน่วยงานที่เข้าตรวจสอบ');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$target_cell = 'E' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'วันที่เข้าตรวจสอบ');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);


	// Detail ---------------------------------------------------------------------------------

	$sql = "Select a.case_id, a.topic, a.add_date, b.gov_dev_name, c.s_name, c.name, b.investigate_date From wd_case a 
	Inner Join case_gv_check b ON a.case_id = b.case_id
	Inner Join m_gov_check c ON b.gc_id = c.gc_id
	Where  EXTRACT( YEAR_MONTH FROM a.add_date )  BETWEEN $ex_ymbg AND $ex_ymed
	Order By a.case_id, b.investigate_date";

	$res = $conn->query(trim($sql));
	$i_row++;
	$temp_case_id = "";
	while ($row = $res->fetch_assoc()) {
		$i_colum = 1;

		if ($row['case_id'] <> $temp_case_id) {
			$temp_case_id = $row['case_id'];

			$target_cell = 'A' . (string)$i_row;
			$objPHPExcel->getActiveSheet()->setCellValue($target_cell, substr($row['case_id'], 0, 2) . '-' . substr($row['case_id'], 2, 2) . '-' . substr($row['case_id'], 4));
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);


			//$target_cell_mr = '';
			$target_cell = 'B' . (string)$i_row;
			//$objPHPExcel->getActiveSheet()->mergeCells('B' . (string)$i_row . ':D' . (string)$i_row);
			$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['topic']);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);

			//$target_cell = 'C' . (string)$i_row;
			//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('DDDDDD');
			//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);

			$target_cell = 'C' . (string)$i_row;
			$objPHPExcel->getActiveSheet()->setCellValue($target_cell, thai_date_non_dow(date_format(date_create($row['add_date']), 'U')));
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
		}

		$target_cell = 'D' . (string)$i_row;
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['s_name'] . "-" . $row['gov_dev_name']);
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);

		$target_cell = 'E' . (string)$i_row;
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, thai_date_non_dow(date_format(date_create($row['investigate_date']), 'U')));
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);





		$i_row++;
	}

	// Summary Case Type ====================================================================================================================
	
	

	$i_row++;
	$i_row++;
	$target_cell = 'A' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'สรุปเคสรายปีแยกตามประเภทการทุจริต');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	

	$sql = "SELECT z.crp_type AS 'ประเภทการทุจริต',
		z.count_case - (z.on_page+z.stop_case) AS 'กำลังดำเนินการ',
		z.stop_case AS 'ยุติ',
		z.on_page AS 'ลงเพจ',
		z.count_case AS 'รวม'
		FROM (Select 
		a.crp_id, 
		a.crp_type, 
		sum(
			case when b.status = 5 then 1 else 0 end
		) as on_page, 
		sum(
			case when b.status = 4 then 1 else 0 end
		) as stop_case, 
		count(a.case_id) as count_case 
		From 
		case_crp_type_data a 
		Inner Join wd_case b ON a.case_id = b.case_id 
		WHERE 
		EXTRACT( YEAR_MONTH FROM b.add_date )  BETWEEN $ex_ymbg AND $ex_ymed
		Group By 
		a.crp_type, 
		a.crp_id 
		Order By 
		a.crp_id) z";
	$res = $conn->query(trim($sql));
	// Print column Name
	$i_colum = 0;
	$i_row++;
	$tbl_f_all = array();

	$start_bdr = 'A' . (string)$i_row;

	// Print header ========================
	while ($property = mysqli_fetch_field($res)) {
		//$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $tbl_f[$property->name]);
		$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $property->name);
		//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->getStartColor()->setRGB('FFFFCC');
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setSize(16);
		//$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum])->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('TH SarabunPSK');
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
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, substr($row[$f_name], 0, 2) . '-' . substr($row[$f_name], 2, 2) . '-' . substr($row[$f_name], 4));
				} else {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
					if (is_numeric($row[$f_name]) and ($f_name != "CASE_ID")) {
						$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('#,##');
					}
				}
			}




			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setSize(16);

			//if ($row['wd_status'] == "Banned")
			//{
			//	$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleBan);
			//}
			$i_colum++;
		}
	}

	$end_bdr = 'E' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->getStyle($start_bdr . ':' . $end_bdr)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);




	// Summary Member  =======================================================================================================================
	$i_row++;
	$i_row++;
	$target_cell = 'A' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'สรุปจำนวนสมาชิกหมาเฝ้าบ้าน');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$i_row++;
	$target_cell = 'A' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, '**สรุปจำนวน ณ เวลาที่ดึงข้อมูล');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(10);




	// Load data Table 
	$sql = "SELECT a.geo_name AS 'ภาค',
COALESCE(a.cnt_active, 0) AS 'Active',
       COALESCE(b.cnt_idle, 0)  AS 'บ่อพัก',
       COALESCE(d.cnt_upper, 0) AS 'ชั้นลอย',
       COALESCE(c.cnt_other, 0) AS 'คัดออกจากศูนย์',
       COALESCE(b.cnt_idle, 0) + COALESCE(d.cnt_upper, 0)  +  COALESCE(c.cnt_other, 0) AS 'รวม'
FROM   (SELECT b.geo_name,
               Count(*) AS cnt_active
        FROM   wd_db a
               INNER JOIN all_address b
                       ON a.add_code = b.dis_code
        WHERE  a.status = 1
        GROUP  BY b.geo_name) a
       LEFT JOIN (SELECT b.geo_name,
                         Count(*) AS cnt_idle
                  FROM   wd_db a
                         INNER JOIN all_address b
                                 ON a.add_code = b.dis_code
                  WHERE  a.status = 2
                  GROUP  BY b.geo_name) b
              ON a.geo_name = b.geo_name
       LEFT JOIN (SELECT b.geo_name,
                         Count(*) AS cnt_other
                  FROM   wd_db a
                         INNER JOIN all_address b
                                 ON a.add_code = b.dis_code
                  WHERE  a.status NOT IN ( 1, 2, 5 )
                  GROUP  BY b.geo_name) c
              ON a.geo_name = c.geo_name
       LEFT JOIN (SELECT b.geo_name,
                         Count(*) AS cnt_upper
                  FROM   wd_db a
                         INNER JOIN all_address b
                                 ON a.add_code = b.dis_code
                  WHERE  a.status = 5
                  GROUP  BY b.geo_name) d
              ON a.geo_name = d.geo_name
              
UNION ALL


SELECT 'รวม' AS '',
		SUM(a.cnt_active),
       SUM(COALESCE(b.cnt_idle, 0))  AS cnt_idle,
       SUM(COALESCE(d.cnt_upper, 0)) AS cnt_upper,
       SUM(COALESCE(c.cnt_other, 0)) AS cnt_other,
       SUM(COALESCE(b.cnt_idle, 0) + COALESCE(d.cnt_upper, 0)  +  COALESCE(c.cnt_other, 0)) AS 'รวม'
FROM   (SELECT b.geo_name,
               Count(*) AS cnt_active
        FROM   wd_db a
               INNER JOIN all_address b
                       ON a.add_code = b.dis_code
        WHERE  a.status = 1
        GROUP  BY b.geo_name) a
       LEFT JOIN (SELECT b.geo_name,
                         Count(*) AS cnt_idle
                  FROM   wd_db a
                         INNER JOIN all_address b
                                 ON a.add_code = b.dis_code
                  WHERE  a.status = 2
                  GROUP  BY b.geo_name) b
              ON a.geo_name = b.geo_name
       LEFT JOIN (SELECT b.geo_name,
                         Count(*) AS cnt_other
                  FROM   wd_db a
                         INNER JOIN all_address b
                                 ON a.add_code = b.dis_code
                  WHERE  a.status NOT IN ( 1, 2, 5 )
                  GROUP  BY b.geo_name) c
              ON a.geo_name = c.geo_name
       LEFT JOIN (SELECT b.geo_name,
                         Count(*) AS cnt_upper
                  FROM   wd_db a
                         INNER JOIN all_address b
                                 ON a.add_code = b.dis_code
                  WHERE  a.status = 5
                  GROUP  BY b.geo_name) d
              ON a.geo_name = d.geo_name";



	$res = $conn->query(trim($sql));
	// Print column Name
	$i_colum = 0;
	$i_row++;
	$tbl_f_all = array();

	$start_bdr = 'A' . (string)$i_row;


	while ($property = mysqli_fetch_field($res)) {
		//$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $tbl_f[$property->name]);
		$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $property->name);
		//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->getStartColor()->setRGB('FFFFCC');
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setSize(16);
		//$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum])->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('TH SarabunPSK');
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
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, substr($row[$f_name], 0, 2) . '-' . substr($row[$f_name], 2, 2) . '-' . substr($row[$f_name], 4));
				} else {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
					if (is_numeric($row[$f_name]) and ($f_name != "CASE_ID")) {
						$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('#,##');
					}
				}
			}




			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setSize(16);

			//if ($row['wd_status'] == "Banned")
			//{
			//	$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleBan);
			//}
			$i_colum++;
		}
	}

	$end_bdr = 'F' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->getStyle($start_bdr . ':' . $end_bdr)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);







	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);

	// Rename worksheet
	$objPHPExcel->getActiveSheet()->setTitle('ปี ' . $ex_year_th);

	// =========================================================================== Monthly Case  ===========================================================================
	$objWorkSheet = $objPHPExcel->createSheet(1); //Setting index when creating
	// Set Active Sheet = 1
	$objPHPExcel->setActiveSheetIndex(1);

	// Query Data
	//include "connectionDb.php";

	$sheet_name  = $monthTH[(int)$ex_mn_st] . '-' . $monthTH[(int)$ex_mn_en] . ' ' . $ex_year_th;
	$objPHPExcel->getActiveSheet()->setTitle($sheet_name);

	// Set All sprade sheet 
	$objPHPExcel
		->getActiveSheet()
		->getStyle('A1:CZ500')
		->getFill()
		->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
		->getStartColor()
		->setARGB('ffffff');


	// Print_page Heder
	$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
	$objPHPExcel->getActiveSheet()->setCellValue("A1", "ผลการดำเนินงานปฏิบัติการหมาเฝ้าบ้าน ");
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A1')
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);

	$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
	$objPHPExcel->getActiveSheet()->setCellValue("A2",  $sheet_name);
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A2')
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);

	$objPHPExcel->getActiveSheet()->mergeCells('A3:H3');
	$objPHPExcel->getActiveSheet()->setCellValue("A3", "ดึงข้อมูล ณ. วันที่ " . thai_date(date('U')) . " เวลา " . date('H:i'));
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setItalic(true);
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->getColor()->setARGB('FFAAAAAA');
	$objPHPExcel->getActiveSheet()->getStyle('A3')
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

	$target_cell_mr = 'A4:H4';
	$target_cell = 'A4';
	$objPHPExcel->getActiveSheet()->mergeCells($target_cell_mr);
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, "ภาพรวมโครงการ " . $sheet_name);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('B4C6E7');


	// FACEBOOK RESULT
	//$target_cell_mr = 'A4:H4';
	$target_cell = 'A5';
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, "FACEBOOK");
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	// Load LIKE data
	if ($ex_mn_st == '01') {
		$sql = "SELECT lsz.LIKE_COUNT AS LAST_YEAR_CNT, crnt.LIKE_COUNT AS CURRENT_CNT FROM (Select z.LIKE_COUNT From case_summary_tbl z Where z.ym = '" . $ex_year_last . "12' ) lsz JOIN (Select z.LIKE_COUNT From case_summary_tbl z Where z.ym = (SELECT MAX(z.ym) FROM case_summary_tbl z WHERE z.ym LIKE '$ex_yrmn_en%')) crnt";
	} else {
		$sql = "SELECT lsz.LIKE_COUNT AS LAST_YEAR_CNT, crnt.LIKE_COUNT AS CURRENT_CNT FROM (Select z.LIKE_COUNT From case_summary_tbl z Where z.ym = '" . (string)($ex_yrmn_st - 1) . "' ) lsz JOIN (Select z.LIKE_COUNT From case_summary_tbl z Where z.ym = (SELECT MAX(z.ym) FROM case_summary_tbl z WHERE z.ym LIKE '$ex_yrmn_en%')) crnt";
	}
	$res = $conn->query(trim($sql));
	$row   = mysqli_fetch_row($res);
	//$target_cell_mr = 'A4:H4';
	$target_cell = 'B6';
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, "Like : " . number_format($row[1]) . "(+" . number_format($row[1] - $row[0]) . ")");
	//$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $sql);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);


	// Load Follow data
	if ($ex_mn_st == '01') {
		$sql = "SELECT lsz.FOLLOW_CNT AS LAST_YEAR_CNT, crnt.FOLLOW_CNT AS CURRENT_CNT FROM (Select z.FOLLOW_CNT From case_summary_tbl z Where z.ym = '" . $ex_year_last . "12' ) lsz JOIN (Select z.FOLLOW_CNT From case_summary_tbl z Where z.ym = (SELECT MAX(z.ym) FROM case_summary_tbl z WHERE z.ym LIKE '$ex_yrmn_en%')) crnt";
	} else {
		$sql = "SELECT lsz.FOLLOW_CNT AS LAST_YEAR_CNT, crnt.FOLLOW_CNT AS CURRENT_CNT FROM (Select z.FOLLOW_CNT From case_summary_tbl z Where z.ym = '" . (string)($ex_yrmn_st - 1) . "' ) lsz JOIN (Select z.FOLLOW_CNT From case_summary_tbl z Where z.ym = (SELECT MAX(z.ym) FROM case_summary_tbl z WHERE z.ym LIKE '$ex_yrmn_en%')) crnt";
	}
	//$sql = "SELECT lsz.FOLLOW_CNT AS LAST_YEAR_CNT, crnt.FOLLOW_CNT AS CURRENT_CNT FROM (Select z.FOLLOW_CNT From case_summary_tbl z Where z.ym = '" . $ex_year_last . "12' ) lsz JOIN (Select z.FOLLOW_CNT From case_summary_tbl z Where z.ym = (SELECT MAX(z.ym) FROM case_summary_tbl z WHERE z.ym LIKE '$ex_year%')) crnt";
	$res = $conn->query(trim($sql));
	$row   = mysqli_fetch_row($res);
	//$target_cell_mr = 'A4:H4';
	$target_cell = 'B7';
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, "Follow : " . number_format($row[1]) . "(+" . number_format($row[1] - $row[0]) . ")");
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);



	// Load Line data
	if ($ex_yrmn_en == date_format(date_create(), 'Ym')) {
		$sql = "SELECT ST.value AS BEGINNING, LS.value AS LAST FROM (
			Select a.value From line_static a 
			Where a.Cat_main = 'Followers' and a.Cat_sub_1 = 'followers'
			AND a.Date = '$ex_year-$ex_mn_st-01') ST 
			JOIN (Select a.value From line_static a 
			Where a.Cat_main = 'Followers' and a.Cat_sub_1 = 'followers'
			AND a.Date =  (Select MAX(a.Date) From line_static a 
		Where a.Cat_main = 'Followers' and a.Cat_sub_1 = 'followers')) LS
		";
	} else {
		$sql = "SELECT ST.value AS BEGINNING, LS.value AS LAST FROM (
			Select a.value From line_static a 
			Where a.Cat_main = 'Followers' and a.Cat_sub_1 = 'followers'
			AND a.Date = '$ex_year-$ex_mn_st-01') ST 
			JOIN (Select a.value From line_static a 
			Where a.Cat_main = 'Followers' and a.Cat_sub_1 = 'followers'
			AND a.Date = '$ex_year-" . (string)($ex_mn_st + 1) . "-01') LS
		";
	}




	$res = $conn->query(trim($sql));


	//$target_cell_mr = 'A4:H4';

	$target_cell = 'A8';
	if (mysqli_num_rows($res) > 0) {
		$row   = mysqli_fetch_row($res);
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, "Line : " . number_format($row[1]) . "(+" . number_format($row[1] - $row[0]) . ")");
	} else {
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, "Line : ไม่มีข้อมูล");
	}

	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);


	// Blank For IG
	$target_cell = 'A9';
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, "IG : ");
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);



	$yr_jan = $ex_year . '01';
	$yr_dec = $ex_year . '12';

	// Load data Table 
	$sql = "SELECT ym AS 'เดือน', 
	AVG(Impressions) AS Reach
	,AVG(Impressions_Person) AS 'Reach User'
	,AVG(Engagements) AS 'Engagements'
	,AVG(Engagements_person) AS 'Engagement User'
	,AVG(Engagements_person) / AVG(Impressions_Person) AS 'สัดส่วน'
	, AVG(RES_IB) 'ความเร็วในการตอบ  (นาที)'
	,AVG(CNT_TOTAL_IB) AS 'Inboxทั้งหมด'
   FROM case_summary_tbl Where ym >= $ex_yrmn_st
   AND ym <= $ex_yrmn_en
   Group By ym
   
   UNION ALL
   SELECT 'ค่าเฉลี่ย'
	, AVG(Impressions) AS Reach
	,AVG(Impressions_Person) AS 'Reach User'
	,AVG(Engagements) AS 'Engagements'
	,AVG(Engagements_person) AS 'Engagement User'
	,AVG(Engagements_person) / AVG(Impressions_Person) AS 'สัดส่วน'
	,AVG(RES_IB) 'ความเร็วในการตอบ (นาที)'
	,AVG(CNT_TOTAL_IB) AS 'Inboxทั้งหมด'
   FROM case_summary_tbl Where ym >= $ex_yrmn_st
   AND ym <= $ex_yrmn_en
   Group By LEFT(ym, 4)";



	$res = $conn->query(trim($sql));

	// mergeCells Header Table 
	$target_cell_mr = 'A11:A12';
	$target_cell = 'A11';
	$objPHPExcel->getActiveSheet()->mergeCells($target_cell_mr);
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'เดือน');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);



	$target_cell_mr = 'B11:F11';
	$target_cell = 'B11';
	$objPHPExcel->getActiveSheet()->mergeCells($target_cell_mr);
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'สถิติ Facebook');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

	$target_cell_mr = 'G11:H11';
	$target_cell = 'G11';
	$objPHPExcel->getActiveSheet()->mergeCells($target_cell_mr);
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'Inbox');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


	// Print column Name
	$i_colum = 0;
	$i_row = 12;
	$tbl_f_all = array();
	while ($property = mysqli_fetch_field($res)) {
		$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $property->name);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->getStartColor()->setRGB('FFFFCC');
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setBold(true);
		//$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum])->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('TH SarabunPSK');
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setSize(16);

		array_push($tbl_f_all, $property->name);
		$i_colum++;
	}
	// Print Data
	while ($row = $res->fetch_assoc()) {
		$i_colum = 0;
		$i_row++;
		$summary_flg = 0;
		foreach ($tbl_f_all as $f_name) {
			if ($f_name == 'เดือน') {
				if ((int)substr($row[$f_name], -2) > 0) {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $monthTH[(int)substr($row[$f_name], -2)] . ' ' . $ex_year_th);
				} else {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, 'เฉลี่ยต่อเดือน');
					$summary_flg = 1;
				}
			} else if (validateDate($row[$f_name], 'Y-m-d')) {
				$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
				$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('yyyy-mm-dd');
			} else {
				if ($f_name == "CASE ID") {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, substr($row[$f_name], 0, 2) . '-' . substr($row[$f_name], 2, 2) . '-' . substr($row[$f_name], 4));
				} else {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
					if (is_numeric($row[$f_name]) and ($f_name != "CASE ID")) {
						if ($f_name == "สัดส่วน") {
							$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('0.0%;[Red]-0.0%');
						} else {
							$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('#,##');
						}
					}
				}
			}
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setSize(16);
			if ($summary_flg == 1) {
				$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setBold(true);
			}
			$i_colum++;
		}
	}

	// Border

	$objPHPExcel->getActiveSheet()->getStyle('A11:H' . (string)$i_row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle('G' . (string)($i_row + 1) . ':H' . (string)($i_row + 1))->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


	// Load GOOD IB 
	$i_row++;
	$target_cell = 'G' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'Inbox ที่เป็นประโยชน์');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);

	$sql = "SELECT SUM(GIBCNT) AS GIBCNT FROM case_summary_tbl Where ym >= $ex_yrmn_st AND ym <= $ex_yrmn_en ";
	$res = $conn->query(trim($sql));
	$row   = mysqli_fetch_row($res);
	//$target_cell_mr = 'A4:H4';
	$target_cell = 'H' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, number_format($row[0]));
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$i_row++;
	$i_row++;


	// ================================ CASE =================================================
	$target_cell = 'A' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'สรุปเคส');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);



	// Load data Table 
	$sql = "Select CONCAT(zz.year, LPAD(zz.month, 2, 0)) AS 'เดือน'
	, zz.bg AS 'ยกยอดมาจากเดือนก่อนหน้า'
	, IFNULL(zz.new, 0)  AS 'เข้าใหม่'
	, IFNULL(zz.stop, 0) AS 'ยุติ'
	, IFNULL(zz.pub, 0)  AS 'ลงเพจ'
	, zz.ending  AS 'คงค้าง'
	From  case_summary_report zz
	Where zz.year = $ex_year
	AND zz.month >= $ex_mn_st
	AND zz.month <= $ex_mn_en
	Order By zz.month";



	$res = $conn->query(trim($sql));
	// Print column Name
	$i_colum = 0;
	$i_row++;
	$tbl_f_all = array();

	$start_bdr = 'A' . (string)$i_row;


	while ($property = mysqli_fetch_field($res)) {
		//$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $tbl_f[$property->name]);
		$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $property->name);
		//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->getStartColor()->setRGB('FFFFCC');
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setSize(16);
		//$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum])->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('TH SarabunPSK');
		array_push($tbl_f_all, $property->name);
		$i_colum++;
	}
	// Print Data
	while ($row = $res->fetch_assoc()) {
		$i_colum = 0;
		$i_row++;
		foreach ($tbl_f_all as $f_name) {

			if (validateDate($row[$f_name], 'yyyymm')) {
				$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
				$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('yyyy-mm-dd');
			} else {
				if ($f_name == "เดือน") {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $monthTH[(int)substr($row[$f_name], -2)] . ' ' . $ex_year_th);
				} else {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
					if (is_numeric($row[$f_name]) and ($f_name != "CASE_ID")) {
						$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('#,##');
					}
				}
			}




			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setSize(16);

			//if ($row['wd_status'] == "Banned")
			//{
			//	$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleBan);
			//}
			$i_colum++;
		}
	}




	$sql = "SELECT '$sheet_name' AS 'SUB_TOTAL'
	, ZM.BG 
	, ZM.NEW 
	, ZM.STOP 
	, ZM.PUB 
	, ZM.BG + ZM.NEW - ZM.STOP - ZM.PUB  AS TOTAL
	FROM (SELECT * FROM (
	Select bg AS BG
	From case_summary_report Where year = $ex_year 
	AND MONTH = $ex_mn_st) a
	JOIN (
	Select SUM(new) AS 'NEW'
	, SUM(STOP) AS 'STOP'
	, SUM(pub) AS 'PUB'
	From case_summary_report Where year = $ex_year 
	AND MONTH >= $ex_mn_st
	AND MONTH <= $ex_mn_en
	Group By YEAR
	Order By year, month) b) ZM";



	$res = $conn->query(trim($sql));
	// Print column Name
	$i_colum = 0;
	$tbl_f_all = array();
	while ($property = mysqli_fetch_field($res)) {
		array_push($tbl_f_all, $property->name);
	}
	// Print Data
	while ($row = $res->fetch_assoc()) {
		$i_colum = 0;
		$i_row++;
		foreach ($tbl_f_all as $f_name) {

			if (validateDate($row[$f_name], 'yyyymm')) {
				$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
				$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('yyyy-mm-dd');
			} else {
				if ($f_name == "เดือน") {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $monthTH[(int)substr($row[$f_name], -2)] . ' ' . $ex_year_th);
				} else {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
					if (is_numeric($row[$f_name]) and ($f_name != "CASE_ID")) {
						$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('#,##');
					}
				}
			}




			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setSize(16);

			//if ($row['wd_status'] == "Banned")
			//{
			//	$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleBan);
			//}
			$i_colum++;
		}
	}
	$end_bdr = 'F' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->getStyle($start_bdr . ':' . $end_bdr)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


	$i_row++;
	$i_row++;
	// ================================ Post =================================================
	$target_cell = 'A' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'สรุปโพสในศูนย์ปฏิบัติการหมาเฝ้าบ้าน');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);




	// Load data Table 
	$sql = "SELECT ym AS เดือน, SUM(COUNT_POST_NEW_CASE) AS 'โพสเคสใหม่'
	,SUM(COUNT_UPDATE_CASE) AS 'โพสเคสUpdate'
	,CONCAT(SUM(COUNT_POST_NEW_CASE) +SUM(COUNT_UPDATE_CASE), ' (', SUM(COUNT_EP), ' EP)') AS 'รวมโพสเคส'
	,SUM(COUNT_OTHER_POST) AS 'โพสอื่นๆ'
	 ,SUM(total_post) AS 'รวมโพสทั้งหมด'
   FROM case_summary_tbl Where ym >= $ex_yrmn_st
   AND ym <= $ex_yrmn_en
   Group By ym
   
UNION ALL 
SELECT '$sheet_name' AS ปี, SUM(COUNT_POST_NEW_CASE) AS 'โพสเคสใหม่'
	,SUM(COUNT_UPDATE_CASE) AS 'โพสเคสUpdate'
	,CONCAT(SUM(COUNT_POST_NEW_CASE) +SUM(COUNT_UPDATE_CASE), ' (', SUM(COUNT_EP), ' EP)') AS 'รวมโพสเคส'
	,SUM(COUNT_OTHER_POST) AS 'โพสอื่นๆ'
	 ,SUM(total_post) AS 'รวมโพสทั้งหมด'
   FROM case_summary_tbl Where ym >= $ex_yrmn_st
   AND ym <= $ex_yrmn_en
   Group By LEFT(ym, 4)";



	$res = $conn->query(trim($sql));
	// Print column Name
	$i_colum = 0;
	$i_row++;
	$i_row++;
	$tbl_f_all = array();
	$start_bdr = 'A' . (string)($i_row - 1);
	while ($property = mysqli_fetch_field($res)) {
		$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $property->name);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->getStartColor()->setRGB('FFFFCC');
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setBold(true);

		$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('TH SarabunPSK');
		array_push($tbl_f_all, $property->name);
		$i_colum++;
	}

	$objPHPExcel->getActiveSheet()->mergeCells('B' . (string)($i_row - 1) . ':D' . (string)($i_row - 1));
	$target_cell = 'B' . (string)($i_row - 1);
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'โพสเกี่ยวกับเคสที่ตรวจสอบ');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);





	$objPHPExcel->getActiveSheet()->mergeCells('E' . (string)($i_row - 1) . ':E' . (string)($i_row));
	$target_cell = 'E' . (string)($i_row - 1);
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'โพสอื่นๆ');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


	$objPHPExcel->getActiveSheet()->mergeCells('F' . (string)($i_row - 1) . ':F' . (string)($i_row));
	$target_cell = 'F' . (string)($i_row - 1);
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'รวมโพสทั้งหมด');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);




	// Print Data
	while ($row = $res->fetch_assoc()) {
		$i_colum = 0;
		$i_row++;
		foreach ($tbl_f_all as $f_name) {

			if (validateDate($row[$f_name], 'Y-m-d')) {
				$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
				$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('yyyy-mm-dd');
			} else {
				if (($f_name == "เดือน") and is_numeric($row[$f_name])) {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $monthTH[(int)substr($row[$f_name], -2)] . ' ' . $ex_year_th);
				} else {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
					if (is_numeric($row[$f_name]) and ($f_name != "เดือน")) {
						$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('#,##');
					}
				}
			}
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setSize(16);

			//if ($row['wd_status'] == "Banned")
			//{
			//	$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleBan);
			//}
			$i_colum++;
		}
	}

	$end_bdr = 'F' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->getStyle($start_bdr . ':' . $end_bdr)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

	//$objPHPExcel->getActiveSheet()->mergeCells('ฤ' . (string)($i_row - 1) . ':A' . (string)($i_row));
	$i_row++;
	$target_cell = 'A' . (string)($i_row);
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, '*EP = โพส EPISODE ที่ลงเพจ');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(10);






	// ================================ Best Case =================================================
	$i_row++;
	$i_row++;
	$target_cell = 'A' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'เรื่องเด่น ' . $sheet_name);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$i_row++;
	/*
	$sql = "SELECT AAA.case_id    AS 'CASE_ID',
	AAA.topic      AS 'topic',
	AAA.reach,
	AAA.engegement,
	BBB.pub_url    AS 'POST_URL',
	BBB.reach      AS 'Reach_POST',
	BBB.engegement AS 'engegement_POST'
FROM   (SELECT a.case_id,
			a.topic,
			Sum(CASE
				  WHEN e.f_name = 'post_engaged_users' THEN e.value
				  ELSE 0
				end) AS engegement,
			Sum(CASE
				  WHEN e.f_name = 'post_impressions_unique' THEN e.value
				  ELSE 0
				end) AS reach
	 FROM   wd_case a
			INNER JOIN case_pub_info b
					ON a.case_id = b.case_id
			INNER JOIN case_ofd_info c
					ON a.case_id = c.case_id
			INNER JOIN add_amphures d
					ON c.ofd_address_code = d.amphur_code
			INNER JOIN static_post e
					ON b.pub_url = e.post_id
			INNER JOIN add_geography f
					ON d.geo_id = f.geo_id
	 WHERE  e.data_type = 1
			AND f_name IN ( 'post_engaged_users', 'post_impressions_unique' )
			AND Year(a.add_date) = $ex_year
			AND EXTRACT( YEAR_MONTH FROM a.add_date ) BETWEEN $ex_yrmn_st AND $ex_yrmn_en
	 GROUP  BY a.case_id,
			   a.topic,
			   f.geo_name
	 ORDER  BY reach DESC
	 LIMIT  5) AAA
	INNER JOIN (SELECT a.case_id,
					   b.pub_url,
					   Sum(e.value) AS value,
					   Sum(CASE
							 WHEN e.f_name = 'post_engaged_users' THEN
							 e.value
							 ELSE 0
						   end)     AS engegement,
					   Sum(CASE
							 WHEN e.f_name = 'post_impressions_unique' THEN
							 e.value
							 ELSE 0
						   end)     AS reach
				FROM   wd_case a
					   INNER JOIN case_pub_info b
							   ON a.case_id = b.case_id
					   INNER JOIN static_post e
							   ON b.pub_url = e.post_id
				WHERE  e.data_type = 1
					   AND f_name IN ( 'post_engaged_users',
									   'post_impressions_unique' )
					   AND Year(a.add_date) = $ex_year
					   AND EXTRACT( YEAR_MONTH FROM a.add_date ) BETWEEN $ex_yrmn_st AND $ex_yrmn_en
				GROUP  BY a.case_id,
						  b.pub_url
				ORDER  BY a.case_id) BBB
			ON AAA.case_id = BBB.case_id ";


	$res = $conn->query(trim($sql));


	$target_cell = 'A' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'Case ID');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$target_cell = 'B' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'เรื่อง');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$target_cell = 'C' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'Facebook Link');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);


	$target_cell = 'D' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'Reach');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$target_cell = 'E' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'Engagement');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);




	$i_row++;
	$temp_case_id = "";
	while ($row = $res->fetch_assoc()) {
		$i_colum = 1;

		if ($row['CASE_ID'] <> $temp_case_id) {
			$temp_case_id = $row['CASE_ID'];

			$target_cell = 'A' . (string)$i_row;
			$objPHPExcel->getActiveSheet()->setCellValue($target_cell, substr($row['CASE_ID'], 0, 2) . '-' . substr($row['CASE_ID'], 2, 2) . '-' . substr($row['CASE_ID'], 4));
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('DDDDDD');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);


			$target_cell_mr = '';
			$target_cell = 'B' . (string)$i_row;
			$objPHPExcel->getActiveSheet()->mergeCells('B' . (string)$i_row . ':C' . (string)$i_row);
			$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['topic']);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('DDDDDD');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);

			//$target_cell = 'C' . (string)$i_row;
			//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('DDDDDD');
			//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);

			$target_cell = 'D' . (string)$i_row;
			$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['reach']);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('DDDDDD');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getNumberFormat()->setFormatCode('#,##');

			$target_cell = 'E' . (string)$i_row;
			$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['engegement']);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('DDDDDD');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getNumberFormat()->setFormatCode('#,##');
			$i_row++;
		}
		$target_cell = 'C' . (string)$i_row;

		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, "[Link]");
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getCell($target_cell)->getHyperlink()->setUrl('https://www.facebook.com/Watchdog.ACT/posts/' . $row['POST_URL']);

		$target_cell = 'D' . (string)$i_row;
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['Reach_POST']);
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getNumberFormat()->setFormatCode('#,##');

		$target_cell = 'E' . (string)$i_row;
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['engegement_POST']);
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getNumberFormat()->setFormatCode('#,##');




		$i_row++;
	}


	*/


	$sql = " SELECT AAA.case_id    AS 'CASE_ID',
	AAA.topic      AS 'topic',
	AAA.reach,
	AAA.engegement,
	BBB.pub_url    AS 'POST_URL',
	BBB.reach      AS 'Reach_POST',
	BBB.engegement AS 'engegement_POST',
    SUBSTRING(BBB.msg, 1, 50) as msg,
    BBB.pub_time
FROM   (SELECT a.case_id,
			a.topic,
			Sum(CASE
				  WHEN e.f_name = 'post_engaged_users' THEN e.value
				  ELSE 0
				end) AS engegement,
			Sum(CASE
				  WHEN e.f_name = 'post_impressions_unique' THEN e.value
				  ELSE 0
				end) AS reach
	 FROM   wd_case a
			INNER JOIN case_pub_info b
					ON a.case_id = b.case_id
			INNER JOIN case_ofd_info c
					ON a.case_id = c.case_id
			INNER JOIN add_amphures d
					ON c.ofd_address_code = d.amphur_code
			INNER JOIN static_post e
					ON b.pub_url = e.post_id
			INNER JOIN add_geography f
					ON d.geo_id = f.geo_id
	 WHERE  e.data_type = 1
			AND f_name IN ( 'post_engaged_users', 'post_impressions_unique' )
			AND Year(a.add_date) = $ex_year
			AND EXTRACT( YEAR_MONTH FROM a.add_date ) BETWEEN $ex_yrmn_st AND $ex_yrmn_en
	 GROUP  BY a.case_id,
			   a.topic,
			   f.geo_name
	 ORDER  BY reach DESC
	 LIMIT  5) AAA
	INNER JOIN (SELECT a.case_id,
					   b.pub_url,
                	f.msg,
                f.pub_time, 
					   Sum(e.value) AS value,
					   Sum(CASE
							 WHEN e.f_name = 'post_engaged_users' THEN
							 e.value
							 ELSE 0
						   end)     AS engegement,
					   Sum(CASE
							 WHEN e.f_name = 'post_impressions_unique' THEN
							 e.value
							 ELSE 0
						   end)     AS reach
				FROM   wd_case a
					   INNER JOIN case_pub_info b
							   ON a.case_id = b.case_id
					   INNER JOIN static_post e
							   ON b.pub_url = e.post_id
                 	Inner Join system_page_all_pub f 
                ON b.pub_url = f.post_id
				WHERE  e.data_type = 1
					   AND f_name IN ( 'post_engaged_users',
									   'post_impressions_unique' )
					   AND Year(a.add_date) = $ex_year
					   AND EXTRACT( YEAR_MONTH FROM a.add_date ) BETWEEN $ex_yrmn_st AND $ex_yrmn_en
				GROUP  BY a.case_id,
						  b.pub_url
				
                , f.msg
				ORDER  BY a.case_id, f.pub_time) BBB
			ON AAA.case_id = BBB.case_id
		ORDER BY AAA.reach DESC, BBB.pub_time
	";


	$res = $conn->query(trim($sql));


	$target_cell = 'A' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'Case ID');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$target_cell = 'B' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'เรื่อง');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$target_cell = 'C' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'Facebook Link');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$target_cell = 'D' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'ข้อความ');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$target_cell = 'E' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'Reach');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

	$target_cell = 'F' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'Engagement');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

	$target_cell = 'G' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'วันที่โพส');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);




	$i_row++;
	$temp_case_id = "";
	while ($row = $res->fetch_assoc()) {
		$i_colum = 1;

		if ($row['CASE_ID'] <> $temp_case_id) {
			$temp_case_id = $row['CASE_ID'];

			$target_cell = 'A' . (string)$i_row;
			$objPHPExcel->getActiveSheet()->setCellValue($target_cell, substr($row['CASE_ID'], 0, 2) . '-' . substr($row['CASE_ID'], 2, 2) . '-' . substr($row['CASE_ID'], 4));
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('DDDDDD');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);


			$target_cell_mr = '';
			$target_cell = 'B' . (string)$i_row;
			$objPHPExcel->getActiveSheet()->mergeCells('B' . (string)$i_row . ':D' . (string)$i_row);
			$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['topic']);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('DDDDDD');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);

			//$target_cell = 'C' . (string)$i_row;
			//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('DDDDDD');
			//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);

			$target_cell = 'E' . (string)$i_row;
			$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['reach']);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('DDDDDD');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getNumberFormat()->setFormatCode('#,##');

			$target_cell = 'F' . (string)$i_row;
			$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['engegement']);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('DDDDDD');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getNumberFormat()->setFormatCode('#,##');

			$target_cell = 'G' . (string)$i_row;
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('DDDDDD');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getNumberFormat()->setFormatCode('#,##');
			$i_row++;
		}
		$target_cell = 'C' . (string)$i_row;
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, "[Link]");
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getCell($target_cell)->getHyperlink()->setUrl('https://www.facebook.com/Watchdog.ACT/posts/' . $row['POST_URL']);



		$target_cell = 'D' . (string)$i_row;
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['msg'] . "...");
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);

		$target_cell = 'E' . (string)$i_row;
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['Reach_POST']);
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getNumberFormat()->setFormatCode('#,##');

		$target_cell = 'F' . (string)$i_row;
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['engegement_POST']);
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getNumberFormat()->setFormatCode('#,##');

		$target_cell = 'G' . (string)$i_row;
		//$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['pub_time']);
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, thai_date_non_dow(date_format(date_create($row['pub_time']), 'U')));
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)
			->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);





		$i_row++;
	}


	// Check By Gov =======================================================================================================================
	$i_row++;
	$i_row++;
	$target_cell = 'A' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'เคสถูกตรวจสอบจากหน่วยงานรัฐ ' . $sheet_name);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);



	// Header -----------------------------------------------------------------------
	$i_row++;
	$target_cell = 'A' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'Case ID');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$target_cell = 'B' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'เรื่อง');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$target_cell = 'C' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'เข้าสู่ระบบ');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);


	$target_cell = 'D' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'หน่วยงานที่เข้าตรวจสอบ');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);

	$target_cell = 'E' . (string)$i_row;
	$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'วันที่เข้าตรวจสอบ');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('FFFFCC');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
	$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);


	// Detail ---------------------------------------------------------------------------------

	$sql = "Select a.case_id, a.topic, a.add_date, b.gov_dev_name, c.s_name, c.name, b.investigate_date From wd_case a 
Inner Join case_gv_check b ON a.case_id = b.case_id
Inner Join m_gov_check c ON b.gc_id = c.gc_id
Where  EXTRACT( YEAR_MONTH FROM a.add_date )  BETWEEN $ex_yrmn_st AND $ex_yrmn_en
Order By a.case_id, b.investigate_date";

	$res = $conn->query(trim($sql));
	$i_row++;
	$temp_case_id = "";
	while ($row = $res->fetch_assoc()) {
		$i_colum = 1;

		if ($row['case_id'] <> $temp_case_id) {
			$temp_case_id = $row['case_id'];

			$target_cell = 'A' . (string)$i_row;
			$objPHPExcel->getActiveSheet()->setCellValue($target_cell, substr($row['case_id'], 0, 2) . '-' . substr($row['case_id'], 2, 2) . '-' . substr($row['case_id'], 4));
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);


			//$target_cell_mr = '';
			$target_cell = 'B' . (string)$i_row;
			//$objPHPExcel->getActiveSheet()->mergeCells('B' . (string)$i_row . ':D' . (string)$i_row);
			$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['topic']);
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);

			//$target_cell = 'C' . (string)$i_row;
			//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFill()->getStartColor()->setRGB('DDDDDD');
			//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			//$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);

			$target_cell = 'C' . (string)$i_row;
			$objPHPExcel->getActiveSheet()->setCellValue($target_cell, thai_date_non_dow(date_format(date_create($row['add_date']), 'U')));
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
			$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
		}

		$target_cell = 'D' . (string)$i_row;
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, $row['s_name'] . "-" . $row['gov_dev_name']);
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);

		$target_cell = 'E' . (string)$i_row;
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, thai_date_non_dow(date_format(date_create($row['investigate_date']), 'U')));
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);





		$i_row++;
	}


		// Summary Case Type ====================================================================================================================
	
	

		$i_row++;
		$i_row++;
		$target_cell = 'A' . (string)$i_row;
		$objPHPExcel->getActiveSheet()->setCellValue($target_cell, 'สรุปเคสปตามระเภทการทุจริต '. $sheet_name);
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setName('TH SarabunPSK');
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle($target_cell)->getFont()->setBold(true);
	
		
	
		$sql = "SELECT z.crp_type AS 'ประเภทการทุจริต',
			z.count_case - (z.on_page+z.stop_case) AS 'กำลังดำเนินการ',
			z.stop_case AS 'ยุติ',
			z.on_page AS 'ลงเพจ',
			z.count_case AS 'รวม'
			FROM (Select 
			a.crp_id, 
			a.crp_type, 
			sum(
				case when b.status = 5 then 1 else 0 end
			) as on_page, 
			sum(
				case when b.status = 4 then 1 else 0 end
			) as stop_case, 
			count(a.case_id) as count_case 
			From 
			case_crp_type_data a 
			Inner Join wd_case b ON a.case_id = b.case_id 
			WHERE 
			EXTRACT( YEAR_MONTH FROM b.add_date )  BETWEEN $ex_yrmn_st AND $ex_yrmn_en
			Group By 
			a.crp_type, 
			a.crp_id 
			Order By 
			a.crp_id) z";
		$res = $conn->query(trim($sql));
		// Print column Name
		$i_colum = 0;
		$i_row++;
		$tbl_f_all = array();
	
		$start_bdr = 'A' . (string)$i_row;
	
		// Print header ========================
		while ($property = mysqli_fetch_field($res)) {
			//$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $tbl_f[$property->name]);
			$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $property->name);
			//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFill()->getStartColor()->setRGB('FFFFCC');
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setSize(16);
			//$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum])->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('TH SarabunPSK');
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
						$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, substr($row[$f_name], 0, 2) . '-' . substr($row[$f_name], 2, 2) . '-' . substr($row[$f_name], 4));
					} else {
						$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
						if (is_numeric($row[$f_name]) and ($f_name != "CASE_ID")) {
							$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('#,##');
						}
					}
				}
	
	
	
	
				$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('TH SarabunPSK');
				$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setSize(16);
	
				//if ($row['wd_status'] == "Banned")
				//{
				//	$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleBan);
				//}
				$i_colum++;
			}
		}
	
		$end_bdr = 'E' . (string)$i_row;
		$objPHPExcel->getActiveSheet()->getStyle($start_bdr . ':' . $end_bdr)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);





	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);





	// =========================================================================== SAVE DATA  ===========================================================================
	$objPHPExcel->setActiveSheetIndex(0);
	$file_name = "files/สรุปข้อมูลเคส_" . date('dmyH') . gen_rnd_str(4);
	$file_name .= ".xlsx";
	$objWriter = new Xlsx($objPHPExcel);
	$objWriter->save($file_name);
	echo '<button type="button" class="btn btn-box-tool" onclick="location.href=' . "'" . $file_name . "'" . '"> <i class="fa fa-file-excel-o"></i> Download Excel</button>';


	// Disconnect DB
	mysqli_close($conn);
}


// F=34
function get_line_follow_graph()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	include "connectionDb.php";

	$sql = "Select aa.date as data_date,
	aa.Value AS like_cnt,
	bb.Value - aa.Value AS value
	From (SELECT a.Value, Date From line_static a 
	Where a.Cat_main = 'Followers' AND a.Cat_sub_1 = 'followers'
	AND YEAR(a.Date) = 2021
	Order By a.Date) aa
	Inner Join (SELECT a.Value, DATE_SUB(Date, INTERVAL 1 DAY) as date From line_static a 
	Where a.Cat_main = 'Followers' AND a.Cat_sub_1 = 'followers'
	AND YEAR(a.Date) = 2021
	Order By a.Date) bb 
	ON aa.date = bb.date
	";

	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();

	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F=35
function get_sex_graph()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	include "connectionDb.php";

	$sql = "Select a.Cat_sub_2, a.Value From line_static a 
	Where a.Cat_main = 'Demographic' AND a.Cat_sub_1 = 'gender' AND a.Date = (SELECT MAX(a.Date) FROM line_static a 
	Where a.Cat_main = 'Demographic' AND a.Cat_sub_1 = 'gender')
	";

	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();

	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F=36
function get_OS_type()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	include "connectionDb.php";

	$sql = "Select a.Cat_sub_2, a.Value From line_static a 
	Where a.Cat_main = 'Demographic' AND a.Cat_sub_1 = 'appType' AND a.Date = (SELECT MAX(a.Date) FROM line_static a 
	Where a.Cat_main = 'Demographic' AND a.Cat_sub_1 = 'appType')
    Order By a.Cat_sub_2
	";

	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();

	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F=37
function get_age()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	include "connectionDb.php";

	$sql = "Select a.Cat_sub_2, a.Value From line_static a 
	Where a.Cat_main = 'Demographic' AND a.Cat_sub_1 = 'age' AND a.Date = (SELECT MAX(a.Date) FROM line_static a 
	Where a.Cat_main = 'Demographic' AND a.Cat_sub_1 = 'age')
    Order By a.Cat_sub_2
	";

	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();

	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F=38
function get_line_location_data()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	include "connectionDb.php";

	$sql = "Select a.Cat_sub_2, a.Value From line_static a 
	Where a.Cat_main = 'Demographic' AND a.Cat_sub_1 = 'area' AND a.Date = (SELECT MAX(a.Date) FROM line_static a 
	Where a.Cat_main = 'Demographic' AND a.Cat_sub_1 = 'area')
    Order By a.Cat_sub_2
	";

	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();

	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}


//============================ MAIN =========================================================
switch ($f) {
	case 1: {
			get_like_count_data();
			break;
		}

	case 2: {
			get_current_title_desc();
			break;
		}

	case 3: {
			get_data_max_min_avg();
			break;
		}

	case 4: {
			get_page_heatmap_data();
			break;
		}

	case 5: {
			get_gender_fan_daily();
			break;
		}

	case 6: {
			get_best_post();
			break;
		}
	case 7: {
			get_lasted_post();
			break;
		}
	case 8: {
			get_post_static();
			break;
		}
	case 9: {
			get_post_static_chart();
			break;
		}
	case 10: {
			get_current_title_desc_v2();
			break;
		}
	case 11: {
			get_relate_case_list();
			break;
		}
	case 12: {
			get_monthly_graph_data();
			break;
		}
	case 13: {
			get_case_static_by_crp_type();
			break;
		}
	case 14: {
			export_excel_page_static();
			break;
		}
	case 15: {
			get_table_case_summary();
			break;
		}
	case 16: {
			get_table_case_summary_detail();
			break;
		}
	case 17: {
			get_like_count_chart();
			break;
		}
	case 18: {
			get_follow_count_chart();
			break;
		}

	case 19: {
			get_crp_list_by_type();
			break;
		}

	case 20: {
			get_case_main_static();
			break;
		}

	case 21: {
			get_chart_data_member_occ_type();
			break;
		}

	case 22: {
			get_chart_data_member_sex();
			break;
		}

	case 23: {
			get_chart_data_new_member();
			break;
		}
	case 24: {
			get_chart_data_member_status();
			break;
		}
	case 25: {
			get_current_active_location();
			break;
		}
	case 26: {
			get_current_active_location_name();
			break;
		}
	case 27: {
			get_wd_skill_location();
			break;
		}
	case 28: {
			get_wd_skill_list();
			break;
		}
	case 29: {
			get_year_for_select();
			break;
		}
	case 30: {
			get_crp_for_map();
			break;
		}
	case 31: {
			get_case_total_sum();
			break;
		}
	case 32: {
			export_post_static();
			break;
		}
	case 33: {
			export_case_report();
			break;
		}
	case 34: {
			get_line_follow_graph();
			break;
		}
	case 35: {
			get_sex_graph();
			break;
		}
	case 36: {
			get_OS_type();
			break;
		}
	case 37: {
			get_age();
			break;
		}
	case 38: {
			get_line_location_data();
			break;
		}
}
