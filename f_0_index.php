<?php
// Add for PHPSpreadsheet : 2020-12-27
require_once("plugins/PHPSpreadsheet/autoload.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


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


// ======== Function ========
// F=1
function get_like_count_data()
{
	include "connectionDb.php";
	//$sql = "Select a.year, FORMAT(a.like_cnt_target, 0) as like_cnt_target, b.like_cnt as like_cnt , FORMAT((a.like_cnt_target-b.like_cnt), 0) as diff_cnt From m_yearly_target a INNER Join (SELECT * FROM `system_page_static`WHERE time_stamp = (select max(time_stamp) from system_page_static)) b WHERE a.year = YEAR(CURDATE()) ";
	$sql = "Select a.year, FORMAT(a.target, 0) as follow_cnt_target, b.follow_cnt as follow_cnt , FORMAT((a.target-b.follow_cnt), 0) as diff_cnt From m_yearly_target_2 a INNER Join (SELECT * FROM `system_page_static`WHERE time_stamp = (select max(time_stamp) from system_page_static)) b WHERE a.year = YEAR(CURDATE()) and a.target_type = 'Follow'";
	$res = $conn->query(trim($sql));
	$row = $res->fetch_assoc();
	$data = array();
	$data = $row;

	//$sql = "Select *, a.cnt_now - b.cnt_yst as diff_in_day from (Select DATE(time_stamp) as date_now, max(like_cnt) as cnt_now From system_page_static Group by DATE(time_stamp)) a Inner Join ( Select DATE_ADD(DATE(time_stamp), INTERVAL 1 DAY) as date_SB, max(like_cnt) as cnt_yst From system_page_static Group by DATE_ADD(DATE(time_stamp), INTERVAL 1 DAY)) b ON a.date_now = b.date_SB WHERE a.date_now = CURDATE() ORDER BY `a`.`date_now` DESC";
	$sql = "Select *, a.cnt_now - b.cnt_yst as diff_in_day from (Select DATE(time_stamp) as date_now, max(follow_cnt) as cnt_now From system_page_static Group by DATE(time_stamp)) a Inner Join ( Select DATE_ADD(DATE(time_stamp), INTERVAL 1 DAY) as date_SB, max(follow_cnt) as cnt_yst From system_page_static Group by DATE_ADD(DATE(time_stamp), INTERVAL 1 DAY)) b ON a.date_now = b.date_SB WHERE a.date_now = CURDATE() ORDER BY `a`.`date_now` DESC";
	$res = $conn->query(trim($sql));
	$row = $res->fetch_assoc();

	$data['today_plus'] = number_format($row['diff_in_day']);
	mysqli_close($conn);
	echo json_encode($data);
}

// F= 2
function get_post_to_public_data()
{
	include "connectionDb.php";
	$sql = "SELECT count(*) as pub_cnt FROM `wd_case` WHERE YEAR(add_date) = YEAR(CURDATE()) AND status = 5";
	$res = $conn->query(trim($sql));

	$row = $res->fetch_assoc();
	$data = array();
	$data['pub_cnt'] = $row['pub_cnt'];

	//$sql = "Select pub_post_cnt as target from m_yearly_target WHERE year = YEAR(CURDATE())";
	//$res = $conn->query(trim($sql));
	//$row = $res->fetch_assoc();

	//$data['target'] = $row['target'];

	//$data['percentage'] = round(($data['pub_cnt'] / $data['target']) * 100 , 1);

	mysqli_close($conn);
	echo json_encode($data);
}

// F=3
function get_new_member_data()
{
	include "connectionDb.php";
	$sql = "SELECT count(wd_id) as cnt FROM `wd_db` WHERE SUBSTRING(wd_id, 1, 2) = YEAR(CURDATE()) - 1957 ";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);

	$row = $res->fetch_assoc();
	//$data = array();
	//$data = $row;

	echo json_encode($row);
}


// F=4
function get_damage_data()
{
	include "connectionDb.php";
	$sql = "SELECT sum(ofd_dmg) as sum FROM `wd_case` WHERE YEAR(add_date) = YEAR(CURDATE()) and STATUS = 5  ";
	$res = $conn->query(trim($sql));
	$row = $res->fetch_assoc();


	$data['target'] = ($row['sum'] / 1000000);

	echo json_encode($data);


	mysqli_close($conn);
}

// F = 5
function search_data_from_sidebar()
{
	$search_text = $_POST['search_text'];
	$search_text = trim(str_replace("'", "", htmlspecialchars($search_text)));

	$sql = "Select * From (Select wd_id, concat_ws(' ', name , s_name, n_name, soc_fb, soc_fb_2) as q_data From wd_db ) a Inner Join wd_db b on a.wd_id = b.wd_id Where a.q_data like '%$search_text%' Order By b.status, b.gen LIMIT 10";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);

	if (mysqli_num_rows($res) == 0) {
		echo "ไม่พบข้อมูลที่ค้นหา";
	} else {
		while ($row = $res->fetch_assoc()) {

			$print_status = '<i class="fa fa-circle text-success"></i>';
			switch ($row['status']) {
				case 1: {
						$print_status = '<i class="fa fa-circle text-success"></i>';
						break;
					}
				case 2: {
						$print_status = '<i class="fa fa-circle text-warning"></i>';
						break;
					}
				case 3: {
						$print_status = '<i class="fa fa-circle text-danger"></i>';
						break;
					}
				case 4: {
						$print_status = '<i class="fa fa-circle text-danger"></i>';
						break;
					}
			}
			$fb_print_str = $row['soc_fb'];
			if (trim($row['soc_fb_2']) != "") {
				$fb_print_str = $row['soc_fb'] . ", " . $row['soc_fb_2'];
			}

			echo '<ul class="control-sidebar-menu">
						  <li>
							<a href="24_member_data.php?wd_id=' . $row['wd_id'] . '">
							  <i class="menu-icon"><img src="img/wd_img/' . $row['wd_img'] . '" height="30" width="30"  class="img-circle" alt="User Image"></i>
							  <div class="menu-info">
								<h4 class="control-sidebar-subheading">' . $print_status . '  ' . $row['n_name'] . ' รุ่น ' . $row['gen'] . '</h4>
								<p>' . $fb_print_str . '</p>
							  </div>
							</a>
						  </li>
						</ul>';
		}
	}
}


// F = 6
function search_case_from_sidebar()
{
	$search_text = $_POST['search_text'];
	$search_text = str_replace("-", "", trim(str_replace("'", "", htmlspecialchars($search_text))));

	//$sql = "Select * From ( Select DISTINCT(a.case_id) From ( Select a.case_id, concat_ws(' ',a.case_id, a.topic, a.t_sum, a.crp_name, b.ofd_name, c.AMPHUR_NAME , d.PROVINCE_NAME) as all_case_info From wd_case a Inner Join case_ofd_info b ON a.case_id = b.case_id INNER Join add_amphures c ON b.ofd_address_code = c.AMPHUR_CODE INNER Join add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID ) a WHERE a.all_case_info like '%$search_text%' ) a INNER Join wd_case b ON a.case_id = b.case_id INNER Join m_crp_type c ON b.crp_type = c.id Order By status, a.case_id LIMIT 10";
	//$sql = "Select * From (Select DISTINCT(a.case_id) From ( SELECT a.case_id, concat_ws(' ', a.case_id, a.topic, a.t_sum, a.note, b.ofd_name, b.ofd_type, c.job_type, d.AMPHUR_NAME, e.PROVINCE_NAME, f.ofd_name, f.ofd_pos, f.detail, g.crp_type) as all_case_info From wd_case a Inner Join case_ofd_info b ON a.case_id = b.case_id LEFT Join case_job_type c ON a.case_id = c.case_id INNER Join add_amphures d ON b.ofd_address_code = d.AMPHUR_CODE Inner Join add_provinces e ON d.PROVINCE_ID = e.PROVINCE_ID Left Join case_ofd_name f ON a.case_id = f.case_id INNER Join case_crp_type_data g ON a.case_id = g.case_id ) a Where a.all_case_info like '%$search_text%') a Inner Join wd_case b ON a.case_id = b.case_id Order By status, a.case_id LIMIT 10";
	$sql = "Select * From (Select DISTINCT(a.case_id) From ( SELECT a.case_id, concat_ws(' ', a.case_id, a.topic, a.t_sum, a.note, b.ofd_name, b.ofd_type, c.job_type, d.AMPHUR_NAME, e.PROVINCE_NAME, f.ofd_name, f.ofd_pos, f.detail, g.crp_type) as all_case_info From wd_case a Inner Join case_ofd_info b ON a.case_id = b.case_id LEFT Join case_job_type c ON a.case_id = c.case_id INNER Join add_amphures d ON b.ofd_address_code = d.AMPHUR_CODE Inner Join add_provinces e ON d.PROVINCE_ID = e.PROVINCE_ID Left Join case_ofd_name f ON a.case_id = f.case_id INNER Join case_crp_type_data g ON a.case_id = g.case_id ) a Where a.all_case_info like '%$search_text%') a Inner Join wd_case b ON a.case_id = b.case_id Inner Join m_crp_status c ON b.status = c.id Order By c.sort_id, a.case_id LIMIT 10";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);

	if (mysqli_num_rows($res) == 0) {
		echo "ไม่พบข้อมูลที่ค้นหา";
	} else {
		while ($row = $res->fetch_assoc()) {

			$status_string = "";
			switch ($row['status']) {
				case 0:
					$status_string = '<i class="menu-icon fa fa-sign-out bg-purple"></i>';
					break;
				case 1:
					$status_string = '<i class="menu-icon fa fa-check-square-o bg-blue"></i>';
					break;
				case 2:
					$status_string = '<i class="menu-icon fa fa-info bg-aqua"></i>';
					break;
				case 3:
					$status_string = '<i class="menu-icon fa fa-coffee bg-maroon"></i>';
					break;
				case 4:
					$status_string = '<i class="menu-icon fa fa-times bg-red"></i>';
					break;
				case 5:
					$status_string = '<i class="menu-icon fa fa-facebook bg-green"></i>';
					break;
				case 6:
					$status_string = '<i class="menu-icon fa fa-bookmark-o bg-yellow"></i>';
					break;
				case 7:
					$status_string = '<i class="menu-icon fa fa-book bg-green"></i>';
					break;
				case 8:
					$status_string = '<i class="menu-icon fa fa-book bg-yellow"></i>';
					break;
				default:
					$status_string = '<i class="menu-icon fa fa-times bg-red"></i>';
			}


			echo '<ul class="control-sidebar-menu">
						  <li>
							<a href="14_case_data.php?case_id=' . $row['case_id'] . '">
							' . $status_string . '
							  <div class="menu-info">
								<h4 class="control-sidebar-subheading">' . $row['topic'] . '</h4>
								<p></p>
							  </div>
							</a>
						  </li>
						</ul>';
		}
	}
}

// F = 7
function get_like_follow_chart()
{
	global $thai_month_arr_shot;
	//$sql = "Select a.*, b.fol_in_day From (Select a.date_now, a.cnt_now - b.cnt_yst as like_in_day from (Select DATE(time_stamp) as date_now, max(like_cnt) as cnt_now From system_page_static Group by DATE(time_stamp)) a Inner Join ( Select DATE_ADD(DATE(time_stamp), INTERVAL 1 DAY) as date_SB, max(like_cnt) as cnt_yst From system_page_static Group by DATE_ADD(DATE(time_stamp), INTERVAL 1 DAY)) b ON a.date_now = b.date_SB Where a.date_now > DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY `a`.`date_now`) a Inner Join (Select a.date_now, a.cnt_now - b.cnt_yst as fol_in_day from (Select DATE(time_stamp) as date_now, max(follow_cnt) as cnt_now From system_page_static Group by DATE(time_stamp)) a Inner Join ( Select DATE_ADD(DATE(time_stamp), INTERVAL 1 DAY) as date_SB, max(follow_cnt) as cnt_yst From system_page_static Group by DATE_ADD(DATE(time_stamp), INTERVAL 1 DAY)) b ON a.date_now = b.date_SB Where a.date_now > DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY `a`.`date_now`) b ON a.date_now = b.date_now";
	$sql = "SELECT f_name, value, data_date FROM `static_page` WHERE f_name = 'page_fan_adds_unique' AND data_date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() Order By data_date";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);

	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['date_now'] = date_format(date_create($row['data_date']), 'j ') . $thai_month_arr_shot[date_format(date_create($row['data_date']), 'n')];
		$data_Array[] = $row;
	}

	echo json_encode($data_Array);
}

// F = 8
function get_like_follow_graph()
{
	global $thai_month_arr_shot;
	$sql = "Select DATE(a.time_stamp) as date_now, max(a.like_cnt) as like_cnt, max(a.follow_cnt) as follow_cnt From system_page_static a WHERE a.time_stamp > DATE_SUB(NOW(), INTERVAL 90 DAY) GROUP by DATE(a.time_stamp)";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);

	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['date_now'] = date_format(date_create($row['date_now']), 'j ') . $thai_month_arr_shot[date_format(date_create($row['date_now']), 'n')];
		$data_Array[] = $row;
	}

	echo json_encode($data_Array);
}

// F = 9
function get_wip_case()
{
	//$sql = "Select a.case_id, a.status, a.priority, a.topic, a.case_cnt_url, a.case_folder_url From wd_case a WHERE a.status NOT IN  (4, 5) Order By a.case_id DESC";
	//$sql = "Select a.case_id , a.status , a.priority, a.case_cnt_url,  g.crp_status , a.topic , a.t_sum , a.case_folder_url , IFNULL(f.img_src, c.full_picture) AS img From wd_case a Inner Join m_crp_status g ON a.status = g.id Left Join case_group_post b ON a.case_id = b.case_id Left Join group_post_data c ON b.group_post_id = c.id Left Join case_pub_info d ON a.case_id = d.case_id Left Join system_page_all_pub e ON d.pub_url = e.post_id Left Join system_page_all_pub_ojb_img f ON e.ojb_id = f.ojb_id And d.pub_type = 'page_WD_post' Where a.status NOT IN (4, 5) Order By a.case_id DESC";
	$sql = "SELECT a.case_id, a.status, a.priority, a.case_cnt_url, g.crp_status, a.topic, a.t_sum, a.case_folder_url, IFNULL(b.img, 'img/wd_img/default.png') AS img FROM wd_case a INNER JOIN m_crp_status g ON a.status = g.id Left Join vw_case_img b ON a.case_id = b.case_id WHERE a.status NOT IN ( 4, 5 ) ORDER BY a.case_id DESC";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['case_id_show'] = substr($row['case_id'], 0, 2) . "-" . substr($row['case_id'], 2, 2) . "-" . substr($row['case_id'], 4, 3);
		$data_Array[] = $row;
	}

	echo json_encode($data_Array);
}

// F = 10
function get_wip_case_todo()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "SELECT a.case_id, a.status, a.priority, a.topic, a.case_cnt_url, a.case_folder_url FROM `case_operator` b  INNER Join wd_case a ON b.case_id = a.case_id WHERE b.stf_kid = $stf_kid AND a.status in (0, 1, 2, 3) Order By a.priority DESC";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['case_id_show'] = substr($row['case_id'], 0, 2) . "-" . substr($row['case_id'], 2, 2) . "-" . substr($row['case_id'], 4, 3);
		$data_Array[] = $row;
	}

	echo json_encode($data_Array);
}


// F = 11
function get_last_member()
{
	$sql = "Select a.wd_id, a.name, a.s_name, a.n_name, a.sex, a.wd_img From wd_db a WHERE a.status in (1, 2) Order By a.wd_id DESC Limit 8";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}

	echo json_encode($data_Array);
}

// F = 12
function get_geo_cnt_member()
{
	//$sql = "Select a.*, COALESCE(b.cnt_idle, 0) as cnt_idle, COALESCE(c.cnt_other, 0) as cnt_other From ( Select b.geo_name, count(*) as cnt_active From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 1 GROUP By b.geo_name ) a Left join ( Select b.geo_name, count(*) as cnt_idle From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 2 GROUP By b.geo_name ) b ON a.geo_name = b.geo_name Left join ( Select b.geo_name, count(*) as cnt_other From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status not in (1, 2) GROUP By b.geo_name ) c ON a.geo_name = c.geo_name";
	$sql = "Select a.*, COALESCE(b.cnt_idle, 0) as cnt_idle, COALESCE(d.cnt_upper, 0) as cnt_upper , COALESCE(c.cnt_other, 0) as cnt_other From ( Select b.geo_name, count(*) as cnt_active From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 1 GROUP By b.geo_name ) a Left join ( Select b.geo_name, count(*) as cnt_idle From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 2 GROUP By b.geo_name ) b ON a.geo_name = b.geo_name Left join ( Select b.geo_name, count(*) as cnt_other From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status not in (1, 2 ,5) GROUP By b.geo_name ) c ON a.geo_name = c.geo_name Left join ( Select b.geo_name, count(*) as cnt_upper From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 5 GROUP By b.geo_name ) d  ON a.geo_name = d.geo_name";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['total'] = $row['cnt_other'] + $row['cnt_idle'] + $row['cnt_active'];
		$data_Array[] = $row;
	}

	echo json_encode($data_Array);
}

// F = 13
function get_prov_cnt_member()
{
	//$sql = "Select a.*, COALESCE(b.cnt_idle, 0) as cnt_idle, COALESCE(c.cnt_other, 0) as cnt_other From ( Select b.prv_name, count(*) as cnt_active From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 1 GROUP By b.prv_name ) a Left join ( Select b.prv_name, count(*) as cnt_idle From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 2 GROUP By b.prv_name ) b ON a.prv_name = b.prv_name Left join ( Select b.prv_name, count(*) as cnt_other From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status not in (1, 2) GROUP By b.prv_name ) c ON a.prv_name = c.prv_name Order By a.cnt_active DESC LIMIT 10";
	$sql = "Select a.*, COALESCE(b.cnt_idle, 0) as cnt_idle, COALESCE(d.cnt_upper, 0) as cnt_upper, COALESCE(c.cnt_other, 0) as cnt_other From ( Select b.prv_name, count(*) as cnt_active From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 1 GROUP By b.prv_name ) a Left join ( Select b.prv_name, count(*) as cnt_idle From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 2 GROUP By b.prv_name ) b ON a.prv_name = b.prv_name Left join ( Select b.prv_name, count(*) as cnt_other From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status not in (1, 2 ,5) GROUP By b.prv_name ) c ON a.prv_name = c.prv_name Left join ( Select b.prv_name, count(*) as cnt_upper From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 5 GROUP By b.prv_name ) d ON a.prv_name = d.prv_name Order By a.cnt_active DESC LIMIT 10";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['total'] = $row['cnt_other'] + $row['cnt_idle'] + $row['cnt_active'];
		$data_Array[] = $row;
	}

	echo json_encode($data_Array);
}

// F = 14
function get_prov_cnt_member_all()
{

	//$sql = "Select a.*, COALESCE(b.cnt_idle, 0) as cnt_idle, COALESCE(c.cnt_other, 0) as cnt_other From ( Select b.prv_name, count(*) as cnt_active From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 1 GROUP By b.prv_name ) a Left join ( Select b.prv_name, count(*) as cnt_idle From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 2 GROUP By b.prv_name ) b ON a.prv_name = b.prv_name Left join ( Select b.prv_name, count(*) as cnt_other From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status not in (1, 2) GROUP By b.prv_name ) c ON a.prv_name = c.prv_name";
	$sql = "Select a.*, COALESCE(b.cnt_idle, 0) as cnt_idle, COALESCE(d.cnt_upper, 0) as cnt_upper, COALESCE(c.cnt_other, 0) as cnt_other From ( Select b.prv_name, count(*) as cnt_active From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 1 GROUP By b.prv_name ) a Left join ( Select b.prv_name, count(*) as cnt_idle From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 2 GROUP By b.prv_name ) b ON a.prv_name = b.prv_name Left join ( Select b.prv_name, count(*) as cnt_other From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status not in (1, 2 ,5) GROUP By b.prv_name ) c ON a.prv_name = c.prv_name Left join ( Select b.prv_name, count(*) as cnt_upper From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 5 GROUP By b.prv_name ) d ON a.prv_name = d.prv_name";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['total'] = $row['cnt_other'] + $row['cnt_idle'] + $row['cnt_active'];
		$data_Array[] = $row;
	}

	echo json_encode($data_Array);
}

// F = 15
function get_increase_member_month()
{
	global $thai_month_arr_shot;
	$sql = "Select a.month, COALESCE(b.cnt, 0) as count From (SELECT 1 AS MONTH UNION SELECT 2 AS MONTH UNION SELECT 3 AS MONTH UNION SELECT 4 AS MONTH UNION SELECT 5 AS MONTH UNION SELECT 6 AS MONTH UNION SELECT 7 AS MONTH UNION SELECT 8 AS MONTH UNION SELECT 9 AS MONTH UNION SELECT 10 AS MONTH UNION SELECT 11 AS MONTH UNION SELECT 12 AS MONTH) a Left Join ( Select MONTH(b.Training_End) as MONTH, YEAR(b.Training_End) as YEAR, count(*) as cnt From wd_db a Inner Join m_training_sjb b ON a.gen = b.gen_code WHERE YEAR(b.Training_End) = YEAR(CURRENT_DATE) Group BY MONTH(b.Training_End), YEAR(b.Training_End)) b ON a.MONTH = b.MONTH";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['month'] = $thai_month_arr_shot[$row['month']];
		$data_Array[] = $row;
	}

	echo json_encode($data_Array);
}

// F=16
function toggle_side_menu()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	include "connectionDb.php";

	$sql = "SELECT menu_collapse FROM staff_config WHERE key_id = $staff_key_id";
	$res = $conn->query(trim($sql));
	$row = $res->fetch_assoc();
	$new_menu_collapse = "0";
	if ($row['menu_collapse'] == "0") {
		$new_menu_collapse = "1";
	}

	$update_sql = "Update staff_config SET menu_collapse = $new_menu_collapse Where key_id = $staff_key_id";
	if (!$conn->query($update_sql)) {
		exit();
	}
	mysqli_close($conn);
}

//F = 17
function get_gender_fan_daily()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Select sub_name, value From static_page_detail WHERE main_name = 'page_impressions_by_age_gender_unique' AND data_date = '$target' ORDER By sub_name";

	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F=18
function get_page_data_from_range()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Select a.*, b.total_average, ((a.v_avg - b.total_average) / b.total_average) * 100 as diff From ( Select a.f_name, b.render_no, SUM(a.Value) as value, AVG(a.value) as V_avg, b.show_name, b.Unit, b.Icon, b.bg_color, b.Full_Desc From static_page a INNER Join m_field_desc b ON a.f_name = b.f_name WHERE ( a.data_date BETWEEN '$start' AND '$end') GROUP BY a.f_name, b.show_name, b.Unit, b.Icon, b.bg_color, b.Full_Desc, b.render_no ) a Inner Join (Select a.f_name, avg(a.value) as total_average From static_page a Where a.data_date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()  GROUP by a.f_name) b ON a.f_name = b.f_name Order By a.render_no";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['f_name_str'] = str_replace("_", " ", $row['f_name']);
		$row['value_str'] = number_format($row['value']);
		$row['avg_str'] = number_format($row['V_avg']);
		$row['diff_str'] = number_format(abs($row['diff']));
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

//F = 19
function get_staff_list()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Select a.key_ID, b.Name, b.nick_name From staff a Inner JOIN staff_detail b ON a.key_ID = b.key_ID WHERE a.active = 1 ORDER By a.key_ID";

	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

//F = 20
function add_new_task()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Insert Into task_mng_h (title, detail, start_dt, end_dt, kid, add_by,status) VALUES ('$task_name', '$task_detail', CURRENT_TIMESTAMP(), '$task_end', $handle_staff, $add_staff ,0)";

	include "connectionDb.php";
	if (!$conn->query($sql)) {
		echo  $conn->errno;
		exit();
	}
	mysqli_close($conn);
}

//F = 21
function get_pending_task_list()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Select * From (Select 'case' as type ,a.case_id , a.topic, a.t_sum , a.case_folder_url , a.case_cnt_url , a.finished_date , c.id as status_id , c.crp_status From wd_case a INNER Join case_operator b ON a.case_id = b.case_id INNER Join m_crp_status c ON a.status = c.id WHERE a.status not in (4, 5) AND b.stf_kid = $k_id UNION ALL Select a.type, a.task_id, a.title, a.detail ,  '' as fda, '' as fdb, date(a.end_dt), a.status , 'ทำข้อมูล' as status From task_mng_h a WHERE a.status = 0 AND a.kid = $k_id ) a ORDER By a.finished_date";

	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['finished_date_str'] = $row['finished_date'] . " 17:00";
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

//F = 22
function finished_task()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Update task_mng_h set status =  1 where task_id = $task_id";

	include "connectionDb.php";
	if (!$conn->query($sql)) {
		echo  $conn->errno;
		exit();
	}
	mysqli_close($conn);
}

//F = 23
function delete_task()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Delete from  task_mng_h  where task_id = $task_id";

	include "connectionDb.php";
	if (!$conn->query($sql)) {
		echo  $conn->errno;
		exit();
	}
	mysqli_close($conn);
}

// F=24-2
function download_excel_prov()
{
	/** Error reporting */
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	date_default_timezone_set('Asia/Bangkok');

	// Create Excel Lib
	$objPHPExcel = new Spreadsheet();
	$sheet = $objPHPExcel->getActiveSheet();

	// Create Array blank data 
	$tbl_f_all = array();
	$column = array();

	for ($i = 'a'; $i < 'zz'; $i++) {
		array_push($column, $i);
	}
	$objPHPExcel->getProperties()->setCreator("WD_System")
		->setLastModifiedBy("WD_System");

	$styleArray = array(
		'font'  => array(
			'bold'  => true
		),
		'fill' => array(
			//'type' => PHPExcel_Style_Fill::FILL_SOLID,
			'startcolor' => array(
				'argb' => 'FFFFFFCC',
			),
		),
	);

	$styleBan = array(
		'fill' => array(
			//'type' => PHPExcel_Style_Fill::FILL_SOLID,
			'startcolor' => array(
				'argb' => 'FFFFE6E6',
			),
		),
	);

	$styleeject = array(
		'fill' => array(
			//'type' => PHPExcel_Style_Fill::FILL_SOLID,
			'startcolor' => array(
				'argb' => 'fffff6f6',
			),
		),
	);

	$tbl_f = array(
		"geo_name" => "ภาค",
		"province_name" => "จังหวัด",
		"cnt_active" => "Active",
		"cnt_idle" => "Idel",
		"cnt_other" => "ออกจากศูนย์/แบน",
		"total" => "รวม"
	);


	// Start Sheet 1 -------------------------------------------------------------------------------------------------------

	// Echo Header
	$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
	$objPHPExcel->getActiveSheet()->setCellValue("A1", "จำนวนอาสาสมัครหมาเฝ้าบ้าน รายจังหวัด");
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

	// Echo Date time
	$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
	//$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ". date_format(date_create(), 'j F Y G:i'));
	$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : " . thai_date(date('U')) . " เวลา " . date('H:i'));
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setItalic(true);


	// Query Data
	include "connectionDb.php";
	$sql = "Select a.province_name, IFNULL(b.cnt_active, 0) as cnt_active, IFNULL(b.cnt_idle, 0) as cnt_idle, IFNULL(b.cnt_other, 0) as cnt_other, IFNULL(b.cnt_active + b.cnt_idle + b.cnt_other, 0) as total From add_provinces_order a Left Join ( Select a.*, COALESCE(b.cnt_idle, 0) as cnt_idle, COALESCE(c.cnt_other, 0) as cnt_other From ( Select b.prv_name, count(*) as cnt_active From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 1 GROUP By b.prv_name ) a Left join ( Select b.prv_name, count(*) as cnt_idle From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 2 GROUP By b.prv_name ) b ON a.prv_name = b.prv_name Left join ( Select b.prv_name, count(*) as cnt_other From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status not in (1, 2) GROUP By b.prv_name ) c ON a.prv_name = c.prv_name) b ON TRIM(a.province_name) = TRIM(b.prv_name) Order By a.No";
	$res = $conn->query(trim($sql));



	// Print column Name
	$i_colum = 0;
	$i_row = 5;
	while ($property = mysqli_fetch_field($res)) {
		$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $tbl_f[$property->name]);

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
			$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('Leelawadee UI');
			$i_colum++;
		}
	}
	// Set Sheet Name
	$objPHPExcel->getActiveSheet()->setTitle('รายจังหวัด');
	// End Sheet 1 -------------------------------------------------------------------------------------------------------



	// Start Sheet 2 -------------------------------------------------------------------------------------------------------
	$objWorkSheet = $objPHPExcel->createSheet(1); //Setting index when creating
	// Set Active Sheet = 1
	$objPHPExcel->setActiveSheetIndex(1);
	$tbl_f_all = array();
	// Echo Header
	$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
	$objPHPExcel->getActiveSheet()->setCellValue("A1", "จำนวนอาสาสมัครหมาเฝ้าบ้าน รายภาค");
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

	$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
	$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : " . thai_date(date('U')) . " เวลา " . date('H:i'));
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setItalic(true);


	// Query Data
	include "connectionDb.php";
	$sql = "Select a.*, COALESCE(b.cnt_idle, 0) as cnt_idle, COALESCE(c.cnt_other, 0) as cnt_other, a.cnt_active + b.cnt_idle + c.cnt_other as total From ( Select b.geo_name, count(*) as cnt_active From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 1 GROUP By b.geo_name ) a Left join ( Select b.geo_name, count(*) as cnt_idle From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 2 GROUP By b.geo_name ) b ON a.geo_name = b.geo_name Left join ( Select b.geo_name, count(*) as cnt_other From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status not in (1, 2) GROUP By b.geo_name ) c ON a.geo_name = c.geo_name";
	$res = $conn->query(trim($sql));



	// Print column Name
	$i_colum = 0;
	$i_row = 5;
	while ($property = mysqli_fetch_field($res)) {
		$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $tbl_f[$property->name]);

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
			$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('Leelawadee UI');
			$i_colum++;
		}
	}
	// Set Sheet Name
	$objPHPExcel->getActiveSheet()->setTitle('รายภาค');


	// End Sheet 2 -------------------------------------------------------------------------------------------------------

	$objPHPExcel->setActiveSheetIndex(0);
	$file_name = "files/สามาชิกตามภูมิภาค_" . date('dmyH') . gen_rnd_str(4);
	$file_name .= ".xlsx";
	$objWriter = new Xlsx($objPHPExcel);
	$objWriter->save($file_name);


	mysqli_close($conn);
	echo '<button type="button" class="btn btn-box-tool" onclick="location.href=' . "'" . $file_name . "'" . '"><i class="fa fa-file-excel-o"></i> Download Excel</button>';
}
/* OLD FUNCTION --------------------------------------------------------------------------------------------------

	// F=24
	function download_excel_prov_2()
	{
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
			"geo_name" => "ภาค",
			"province_name" => "จังหวัด",
			"cnt_active" => "Active",
			"cnt_idle" => "Idel",
			"cnt_other" => "ออกจากศูนย์/แบน",
			"total" => "รวม"
		);
		// Set document properties
		$objPHPExcel->getProperties()->setCreator("WD_System")
									 ->setLastModifiedBy("WD_System");
									 
		// Query Data
		include "connectionDb.php";
		//$sql = "Select a.*, COALESCE(b.cnt_idle, 0) as cnt_idle, COALESCE(c.cnt_other, 0) as cnt_other From ( Select b.prv_name, count(*) as cnt_active From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 1 GROUP By b.prv_name ) a Left join ( Select b.prv_name, count(*) as cnt_idle From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 2 GROUP By b.prv_name ) b ON a.prv_name = b.prv_name Left join ( Select b.prv_name, count(*) as cnt_other From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status not in (1, 2) GROUP By b.prv_name ) c ON a.prv_name = c.prv_name";
		$sql = "Select a.province_name, IFNULL(b.cnt_active, 0) as cnt_active, IFNULL(b.cnt_idle, 0) as cnt_idle, IFNULL(b.cnt_other, 0) as cnt_other, IFNULL(b.cnt_active + b.cnt_idle + b.cnt_other, 0) as total From add_provinces_order a Left Join ( Select a.*, COALESCE(b.cnt_idle, 0) as cnt_idle, COALESCE(c.cnt_other, 0) as cnt_other From ( Select b.prv_name, count(*) as cnt_active From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 1 GROUP By b.prv_name ) a Left join ( Select b.prv_name, count(*) as cnt_idle From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 2 GROUP By b.prv_name ) b ON a.prv_name = b.prv_name Left join ( Select b.prv_name, count(*) as cnt_other From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status not in (1, 2) GROUP By b.prv_name ) c ON a.prv_name = c.prv_name) b ON TRIM(a.province_name) = TRIM(b.prv_name) Order By a.No";
		$res = $conn->query(trim($sql));
		
		
		// Set Active Sheet = 0
		$objPHPExcel->setActiveSheetIndex(0);
		
		// Print_page Heder
		$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
		$objPHPExcel->getActiveSheet()->setCellValue("A1", "จำนวนอาสาสมัครหมาเฝ้าบ้าน รายจังหวัด");
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		
		$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
		$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ".thai_date(date('U'))." เวลา ".date('H:i'));
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(8);
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setItalic(true);
		
		// Print column Name
		$i_colum = 0;
		$i_row = 5;
		while ($property = mysqli_fetch_field($res)) {
			$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $tbl_f[$property->name]);
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
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $row[$f_name]);
					$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFont()->setName('Leelawadee UI');
					$i_colum++;
				}
				
		}

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('รายจังหวัด');
		$tbl_f_all = array();
		
		// Create New shheet for Geo ================================================================================
		$sql = "Select a.*, COALESCE(b.cnt_idle, 0) as cnt_idle, COALESCE(c.cnt_other, 0) as cnt_other, a.cnt_active + b.cnt_idle + c.cnt_other as total From ( Select b.geo_name, count(*) as cnt_active From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 1 GROUP By b.geo_name ) a Left join ( Select b.geo_name, count(*) as cnt_idle From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status = 2 GROUP By b.geo_name ) b ON a.geo_name = b.geo_name Left join ( Select b.geo_name, count(*) as cnt_other From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status not in (1, 2) GROUP By b.geo_name ) c ON a.geo_name = c.geo_name";
		$res = $conn->query(trim($sql));
		$objWorkSheet = $objPHPExcel->createSheet(1); //Setting index when creating
		// Set Active Sheet = 1
		$objPHPExcel->setActiveSheetIndex(1);
		
		// Print_page Heder
		$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
		$objPHPExcel->getActiveSheet()->setCellValue("A1", "จำนวนอาสาสมัครหมาเฝ้าบ้าน รายภาค");
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		
		$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
		//$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ". date_format(date_create(), 'j F Y G:i'));
		$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ".thai_date(date('U'))." เวลา ".date('H:i'));
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(8);
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setItalic(true);
		
		// Print column Name
		$i_colum = 0;
		$i_row = 5;
		while ($property = mysqli_fetch_field($res)) {
			$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $tbl_f[$property->name]);
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
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $row[$f_name]);
					$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFont()->setName('Leelawadee UI');
					$i_colum++;
				}
				
		}
		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('รายภาค');
		
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		// Save Excel 2007 file
		// File_name
		//$file_name = "test";
		$file_name = "files/WD_data_".date('dmyH').gen_rnd_str(4);
		//$file_name = "file\\AMO Incident Report"."_".gen_rnd_str(4);
		$file_name.= ".xlsx";
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save($file_name);
		//exec($file_name);
		//echo $file_name;
		mysqli_close($conn);
		//echo '<button type="button" class="btn btn-success btn-flat" onclick="location.href='."'".$file_name."'".'">Download</button>';
		echo '<button type="button" class="btn btn-box-tool" onclick="location.href='."'".$file_name."'".'"><i class="fa fa-file-excel-o"></i> Download Excel</button>';
	}
	------------------- END OLD Function -------------------------------------------------------*/

// F-25
function get_geo_chart_data()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Select b.geo_name, count(*) as value From wd_db a INNER Join all_address b ON a.add_code = b.dis_code Where a.status in (1) GROUP By b.geo_name";

	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F = 26
function get_top_member()
{
	$sql = "Select b.wd_id, b.name, b.s_name, b.n_name, b.sex, b.wd_img, a.point From ( Select wd_id, sum(point) as point From wd_point Group By wd_id) a  Inner Join wd_db b ON a.wd_id = b.wd_id Order By a.point DESC LIMIT 8";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}

	echo json_encode($data_Array);
}


// F = 27
function get_top_case_this_year()
{
	//$sql = "Select a.case_id, a.topic, c.ofd_name ,f.GEO_NAME, count(*) as CNT, sum(e.value) as Reach, h.img_src From wd_case a Inner Join case_pub_info b ON a.case_id = b.case_id Inner Join case_ofd_info c ON a.case_id = c.case_id Inner Join add_amphures d ON c.ofd_address_code = d.AMPHUR_CODE Inner Join static_post e ON b.pub_url = e.post_id Inner Join add_geography f ON d.GEO_ID = f.GEO_ID Inner Join system_page_all_pub g ON b.pub_url = g.post_id LEFT JOIN system_page_all_pub_ojb_img h ON g.ojb_id = h.ojb_id Where e.data_type = 1 And f_name = 'post_impressions_unique' AND a.add_date >= NOW() - INTERVAL 365 DAY Group By a.case_id, a.topic Order By Reach DESC LIMIT 8";
	$sql = "Select a.case_id, a.topic, c.ofd_name ,f.GEO_NAME, count(*) as CNT, sum(e.value) as Reach, h.img_src From wd_case a Inner Join case_pub_info b ON a.case_id = b.case_id Inner Join case_ofd_info c ON a.case_id = c.case_id Inner Join add_amphures d ON c.ofd_address_code = d.AMPHUR_CODE Inner Join static_post e ON b.pub_url = e.post_id Inner Join add_geography f ON d.GEO_ID = f.GEO_ID Inner Join system_page_all_pub g ON b.pub_url = g.post_id LEFT JOIN system_page_all_pub_ojb_img h ON g.ojb_id = h.ojb_id Where e.data_type = 1 And f_name = 'post_impressions_unique' AND h.img_src is not null AND h.img_src <> '' AND a.add_date >= NOW() - INTERVAL 365 DAY Group By a.case_id, a.topic Order By Reach DESC LIMIT 5";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['reach_no'] = number_format($row['Reach']);
		$row['case_id_show'] = substr($row['case_id'], 0, 2) . "-" . substr($row['case_id'], 2, 2) . "-" . substr($row['case_id'], 4, 3);
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

// F=28
function download_excel_best_case()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$tbl_f = array();
	$tbl_f_all = array();

	$column = array();
	for ($i = 'a'; $i < 'zz'; $i++) {
		array_push($column, $i);
	}

	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	date_default_timezone_set('Asia/Bangkok');

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

	//$sql = "SELECT a.case_id AS 'CASE ID', a.topic AS 'หัวข้อ', h.crp_status AS 'สถานะ', g.ofd_name AS 'หน่วยงาน', g.ofd_type AS 'ประเภทหน่วยงาน', g.org_type_name AS 'องค์กร', g.amphur_name AS 'อำเภอ', g.province_name AS 'จังหวัด', g.geo_name AS 'ภาค', a.crp_dmg_off AS 'มูลค่าโครงการ', a.ofd_dmg AS 'ความเสียหาย', Ifnull(b.total, '-') AS 'จำนวน EP', Ifnull(c.job_type, '-') AS 'ประเภทงาน', d.crp_type AS 'ประเด็นทุจริต' , Ifnull(e.engegement, '-') AS Engegement, Ifnull(e.reach, '-') AS Reach, a.add_date AS 'เข้าระบบ', Ifnull(Date(f.pubtime), '-') AS 'วันลงเพจ', Ifnull(f.count_post, '-') AS 'จำนวนโพส' FROM wd_case a LEFT JOIN count_episode b ON a.case_id = b.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.job_type) AS job_type FROM case_job_type a GROUP BY a.case_id) c ON a.case_id = c.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.crp_type) AS crp_type FROM case_crp_type_data a GROUP BY a.case_id) d ON a.case_id = d.case_id LEFT JOIN (SELECT a.case_id, Sum(e.value) AS value, Sum(CASE WHEN e.f_name = 'post_engaged_users' THEN e.value ELSE 0 end) AS engegement, Sum(CASE WHEN e.f_name = 'post_impressions_unique' THEN e.value ELSE 0 end) AS reach FROM wd_case a INNER JOIN case_pub_info b ON a.case_id = b.case_id INNER JOIN static_post e ON b.pub_url = e.post_id WHERE e.data_type = 1 AND f_name IN ( 'post_engaged_users', 'post_impressions_unique' ) AND Year(a.add_date) = $select_year GROUP BY a.case_id ORDER BY a.case_id) e ON a.case_id = e.case_id LEFT JOIN (SELECT a.case_id, Count(b.post_id) AS count_post, Min(b.pub_time) AS pubtime FROM case_pub_info a INNER JOIN system_page_all_pub b ON a.pub_url = b.post_id WHERE a.pub_type = 'page_WD_post' GROUP BY a.case_id) f ON a.case_id = f.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.ofd_name) AS ofd_name, Group_concat(DISTINCT a.ofd_type) AS ofd_type, Group_concat(DISTINCT e.org_type_name) AS org_type_name , Group_concat(DISTINCT b.amphur_name) AS AMPHUR_NAME, Group_concat(DISTINCT c.province_name) AS PROVINCE_NAME , Group_concat(DISTINCT d.geo_name) AS GEO_NAME FROM case_ofd_info a INNER JOIN add_amphures b ON a.ofd_address_code = b.amphur_code INNER JOIN add_provinces c ON b.province_id = c.province_id INNER JOIN add_geography d ON c.geo_id = d.geo_id INNER JOIN m_org_type e ON a.org_type_id = e.org_type_id GROUP BY a.case_id) g ON a.case_id = g.case_id INNER JOIN m_crp_status h ON a.status = h.id WHERE Year(a.add_date) = $select_year ORDER BY a.case_id";
	$sql = "Select a.case_id AS 'CASE ID', a.topic AS 'เรื่อง', c.ofd_name as 'หน่วยงาน' ,f.GEO_NAME as 'ภาค', count(*) as 'จำนวนโพส', sum(e.value) as Reach From wd_case a Inner Join case_pub_info b ON a.case_id = b.case_id Inner Join case_ofd_info c ON a.case_id = c.case_id Inner Join add_amphures d ON c.ofd_address_code = d.AMPHUR_CODE Inner Join static_post e ON b.pub_url = e.post_id Inner Join add_geography f ON d.GEO_ID = f.GEO_ID Where e.data_type = 1 And f_name = 'post_impressions_unique' AND a.add_date >= NOW() - INTERVAL 365 DAY Group By a.case_id, a.topic, f.GEO_NAME Order By a.case_id";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);

	// Set Active Sheet = 0
	$objPHPExcel->setActiveSheetIndex(0);

	// Print_page Heder
	$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
	$objPHPExcel->getActiveSheet()->setCellValue("A1", "สรุป Case ในระบบ ");
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

	$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
	$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : " . thai_date(date('U')) . " เวลา " . date('H:i'));
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');
	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setItalic(true);

	// Print column Name
	$i_colum = 0;
	$i_row = 4;
	while ($property = mysqli_fetch_field($res)) {
		$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $property->name);
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
				if ($f_name == "CASE ID") {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, substr($row[$f_name], 0, 2) . '-' . substr($row[$f_name], 2, 2) . '-' . substr($row[$f_name], 4));
				} else {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum] . (string)$i_row, $row[$f_name]);
					if (is_numeric($row[$f_name]) and ($f_name != "CASE ID")) {
						$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getNumberFormat()->setFormatCode('#,##');
					}
				}
			}
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum] . (string)$i_row)->getFont()->setName('Leelawadee UI');

			$i_colum++;
		}
	}

	// Rename worksheet
	$objPHPExcel->getActiveSheet()->setTitle('ข้อมูลเคส');
	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);


	$file_name = "files/ข้อมูลเคส_" . date('dmyH') . gen_rnd_str(4);
	$file_name .= ".xlsx";
	$objWriter = new Xlsx($objPHPExcel);
	$objWriter->save($file_name);
	echo '<button type="button" class="btn btn-box-tool" onclick="location.href=' . "'" . $file_name . "'" . '"> <i class="fa fa-file-excel-o"></i> Download Excel</button>';
}

// F = 29
function get_last_pub_case()
{
	//$sql = "SELECT a.* FROM ( Select a.case_id , a.status , a.priority, a.case_cnt_url,  g.crp_status , a.topic , a.t_sum , a.case_folder_url ,e.pub_time, IFNULL(f.img_src, c.full_picture) AS img From wd_case a Inner Join m_crp_status g ON a.status = g.id Left Join case_group_post b ON a.case_id = b.case_id Left Join group_post_data c ON b.group_post_id = c.id Left Join case_pub_info d ON a.case_id = d.case_id Left Join system_page_all_pub e ON d.pub_url = e.post_id Left Join system_page_all_pub_ojb_img f ON e.ojb_id = f.ojb_id And d.pub_type = 'page_WD_post' Where a.status IN (5) AND a.case_id IN ( Select DISTINCT(a.case_id) from wd_case a Inner Join case_pub_info b ON a.case_id = b.case_id Inner Join system_page_all_pub c ON b.pub_url = c.post_id Inner Join system_page_all_pub_ojb_img d ON c.ojb_id = d.ojb_id Where b.pub_type = 'page_WD_post' Order by c.pub_time DESC )) a Group By a.case_id  Order By a.pub_time DESC LIMIT 5";
	//$sql = "SELECT a.*, IFNULL(b.total, 0) as ep FROM ( Select a.case_id , a.status , a.priority, a.case_cnt_url,  g.crp_status , a.topic , a.t_sum , a.case_folder_url ,e.pub_time, IFNULL(f.img_src, c.full_picture) AS img From wd_case a Inner Join m_crp_status g ON a.status = g.id Left Join case_group_post b ON a.case_id = b.case_id Left Join group_post_data c ON b.group_post_id = c.id Left Join case_pub_info d ON a.case_id = d.case_id Left Join system_page_all_pub e ON d.pub_url = e.post_id Left Join system_page_all_pub_ojb_img f ON e.ojb_id = f.ojb_id And d.pub_type = 'page_WD_post' Where a.status IN (5) AND a.case_id IN ( Select DISTINCT(a.case_id) from wd_case a Inner Join case_pub_info b ON a.case_id = b.case_id Inner Join system_page_all_pub c ON b.pub_url = c.post_id Inner Join system_page_all_pub_ojb_img d ON c.ojb_id = d.ojb_id Where b.pub_type = 'page_WD_post' Order by c.pub_time DESC )) a left join count_episode b ON a.case_id = b.case_id Group By a.case_id  Order By a.pub_time DESC LIMIT 5";
	//$sql = "Select a.case_id, a.status, a.topic, b.img, min(d.pub_time) as pub_time, MAX(e.CNT_EP) AS ep From wd_case a Inner Join vw_case_img b ON a.case_id = b.case_id Inner Join case_pub_info c On a.case_id = c.case_id Inner Join system_page_all_pub d ON c.pub_url = d.post_id Inner Join (SELECT a.case_id, count(a.case_id) as CNT_EP FROM case_episode a Group By a.case_id) e ON a.case_id = e.case_id Where a.status = '5' AND c.pub_type = 'page_WD_post' Group By a.case_id, a.status, a.topic, b.img Order By d.pub_time DESC LIMIT 5";
	$sql = "SELECT a.case_id, a.status, a.topic, IFNULL(f.img_file, b.img) AS img, Min(d.pub_time) AS pub_time, Max(e.cnt_ep) AS ep FROM wd_case a INNER JOIN vw_case_img b ON a.case_id = b.case_id INNER JOIN case_pub_info c ON a.case_id = c.case_id INNER JOIN system_page_all_pub d ON c.pub_url = d.post_id INNER JOIN (SELECT a.case_id, Count(a.case_id) AS CNT_EP FROM case_episode a GROUP BY a.case_id) e ON a.case_id = e.case_id LEFT JOIN case_img f ON a.case_id = f.case_id WHERE a.status = '5' AND c.pub_type = 'page_WD_post' GROUP BY a.case_id, a.status, a.topic, IFNULL(f.img_file, b.img) ORDER BY d.pub_time DESC LIMIT 5";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['case_id_show'] = substr($row['case_id'], 0, 2) . "-" . substr($row['case_id'], 2, 2) . "-" . substr($row['case_id'], 4, 3);
		$data_Array[] = $row;
	}

	echo json_encode($data_Array);
}

// F = 30
function load_msg_data()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}

	if ($msg_id == "max") {
		$sql = "Select * From page_msg_detail a Left JOIN Page_MSG_Attached b ON a.MSG_DTL_ID = b.MSG_DTL_ID where a.msg_id = (SELECT msg_id from page_msg a where a.update_time = (SELECT max(update_time) from page_msg)) AND a.MSG <> 'Is this transaction complete?' Order By created_time";
	} else {
		$sql = "Select * From page_msg_detail a Left JOIN Page_MSG_Attached b ON a.MSG_DTL_ID = b.MSG_DTL_ID where a.msg_id = '$msg_id' AND a.MSG <> 'Is this transaction complete?' Order By created_time";
	}

	//$sql = "Select * From page_msg_detail where msg_id = 't_10210732064072035'";
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
function get_msg_contact_list()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}

	//$sql = "Select a.*,b.MSG From page_msg a Left Join (SELECT * FROM page_msg_detail z Group By z.MSG_ID Order By z.created_time DESC) b ON a.msg_id = b.msg_id Order By a.update_time DESC LIMIT 50";
	if ($target_search == "") {
		//$sql = "Select a.msg_id, a.sender_name, a.update_time, b.MSG From page_msg a Inner Join page_msg_detail b ON a.msg_id = b.MSG_ID and a.update_time = b.created_time Order By a.update_time DESC LIMIT 50";
		$sql = "Select a.msg_id, a.sender_name, a.update_time, b.MSG, c.msg_id as case_id, a.msg_link From page_msg a Inner Join page_msg_detail b ON a.msg_id = b.MSG_ID and a.update_time = b.created_time Left Join (Select DISTINCT(MSG_ID) as MSG_ID From case_inbox_msg) c ON a.msg_id = c.MSG_ID Order By a.update_time DESC LIMIT 50";
	} else {
		$sql = "Select a.msg_id, a.sender_name, a.update_time, b.MSG, c.msg_id as case_id , a.msg_link From page_msg a Inner Join page_msg_detail b ON a.msg_id = b.MSG_ID Left Join (Select DISTINCT(MSG_ID) as MSG_ID From case_inbox_msg) c ON a.msg_id = c.MSG_ID WHERE (a.sender_name like '%$target_search%' or b.MSG LIKE '%$target_search%') Group By a.msg_id Order By a.update_time DESC LIMIT 50";
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

// F=32
function msg_with_case()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}

	if ($msg_id == "max") {
		$sql = "Select * from case_inbox_msg a Where a.MSG_ID = (SELECT msg_id from page_msg a where a.update_time = (SELECT max(update_time) from page_msg))";
	} else {
		$sql = "Select * from case_inbox_msg a Where a.MSG_ID = '$msg_id'";
	}

	//$sql = "Select * From page_msg_detail where msg_id = 't_10210732064072035'";
	include "connectionDb.php";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$row['case_id_show'] = substr($row['case_id'], 0, 2) . "-" . substr($row['case_id'], 2, 2) . "-" . substr($row['case_id'], 4, 3);
		$data_Array[] = $row;
	}

	echo json_encode($data_Array);
}

// F = 33
function load_good_msg_for_select()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}

	$sql = "SELECT a.msg_id,
	a.sender_name,
	c.rnd_str
FROM   (SELECT a.msg_id,
			b.sender_name
	 FROM   (SELECT *
			 FROM   case_inbox_msg a
			 WHERE  LEFT(a.case_id, 4) < $p_case_id
					AND a.msg_id IN (SELECT DISTINCT( a.msg_id )
									 FROM   page_msg_detail a
									 WHERE  Extract(YEAR_MONTH FROM
													a.created_time)
											=
											'$p_case_YM')) a
			INNER JOIN page_msg b
					ON a.msg_id = b.msg_id
	 GROUP  BY a.msg_id,
			   b.sender_name) a
	LEFT JOIN case_inbox_update_recode c
		   ON a.msg_id = c.msg_id
			  AND c.ym = '$p_case_YM'
			  Order By a.msg_id ";


	include "connectionDb.php";

	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$data_Array = array();
	while ($row = $res->fetch_assoc()) {
		$data_Array[] = $row;
	}
	echo json_encode($data_Array);
}

//F = 34
function insert_good_msg()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Insert Into case_inbox_update_recode value('$p_case_YM', '$target_value', '$p_case_YM" . gen_rnd_str(10) . "', null)";

	include "connectionDb.php";
	if (!$conn->query($sql)) {
		echo  $conn->errno;
		exit();
	}
	mysqli_close($conn);
}

//F = 35
function del_good_msg()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Delete From case_inbox_update_recode where rnd_str = '$target_value'";

	include "connectionDb.php";
	if (!$conn->query($sql)) {
		echo  $conn->errno;
		exit();
	}
	mysqli_close($conn);
}


//F = 36
function updateMapStaffMember()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Delete From staff_member_map where key_ID = (Select key_id From staff a Where a.stf_ID = '$staff_key_id')";

	include "connectionDb.php";
	if (!$conn->query($sql)) {
		echo  $conn->errno;
		exit();
	}
	
	if ($wdID != "")
	{
		$sql = "Insert Into staff_member_map value ((Select key_id From staff a Where a.stf_ID = '$staff_key_id'), '$wdID', CURRENT_TIMESTAMP) ";

		include "connectionDb.php";
		if (!$conn->query($sql)) {
			echo  $conn->errno;
			exit();
		}
	}
	mysqli_close($conn);
}

// F = 37
function loadMapStaffMember()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Select * From staff_member_map where key_ID =  $staff_key_id";
	include "connectionDb.php";
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
			get_post_to_public_data();
			break;
		}

	case 3: {
			get_new_member_data();
			break;
		}

	case 4: {
			get_damage_data();
			break;
		}

	case 5: {
			search_data_from_sidebar();
			break;
		}

	case 6: {
			search_case_from_sidebar();
			break;
		}

	case 7: {
			get_like_follow_chart();
			break;
		}
	case 8: {
			get_like_follow_graph();
			break;
		}

	case 9: {
			get_wip_case();
			break;
		}

	case 10: {
			get_wip_case_todo();
			break;
		}

	case 11: {
			get_last_member();
			break;
		}

	case 12: {
			get_geo_cnt_member();
			break;
		}

	case 13: {
			get_prov_cnt_member();
			break;
		}

	case 14: {
			get_prov_cnt_member_all();
			break;
		}

	case 15: {
			get_increase_member_month();
			break;
		}

	case 16: {
			toggle_side_menu();
			break;
		}

	case 17: {
			get_gender_fan_daily();
			break;
		}
	case 18: {
			get_page_data_from_range();
			break;
		}

	case 19: {
			get_staff_list();
			break;
		}
	case 20: {
			add_new_task();
			break;
		}
	case 21: {
			get_pending_task_list();
			break;
		}

	case 22: {
			finished_task();
			break;
		}
	case 23: {
			delete_task();
			break;
		}

	case 24: {
			download_excel_prov();
			break;
		}

	case 25: {
			get_geo_chart_data();
			break;
		}

	case 26: {
			get_top_member();
			break;
		}
	case 27: {
			get_top_case_this_year();
			break;
		}
	case 28: {
			download_excel_best_case();
			break;
		}

	case 29: {
			get_last_pub_case();
			break;
		}

	case 30: {
			load_msg_data();
			break;
		}
	case 31: {
			get_msg_contact_list();
			break;
		}
	case 32: {
			msg_with_case();
			break;
		}
	case 33: {
			load_good_msg_for_select();
			break;
		}
	case 34: {
			insert_good_msg();
			break;
		}

	case 35: {
			del_good_msg();
			break;
		}
	case 36: {
			updateMapStaffMember();
			break;
		}
	case 37: {
			loadMapStaffMember();
			break;
		}
}
