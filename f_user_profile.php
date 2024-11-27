<?php

	// ======== Get Var ========
	if (isset($_GET['f']) )
	{
		$f = $_GET['f'];
	}
	if (isset($_POST['f']) )
	{
		$f = $_POST['f'];
	}
	if (isset($_GET['p1']) )
	{
		$p1 = $_GET['p1'];
	}
	if (isset($_GET['p2']) )
	{
		$p2 = $_GET['p2'];
	}
	if (isset($_GET['p3']) )
	{
		$p3 = $_GET['p3'];
	}
	// ================ Global Function =============================
	$thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
	$thai_month_arr=array(
		"0"=>"",
		"1"=>"มกราคม",
		"2"=>"กุมภาพันธ์",
		"3"=>"มีนาคม",
		"4"=>"เมษายน",
		"5"=>"พฤษภาคม",
		"6"=>"มิถุนายน", 
		"7"=>"กรกฎาคม",
		"8"=>"สิงหาคม",
		"9"=>"กันยายน",
		"10"=>"ตุลาคม",
		"11"=>"พฤศจิกายน",
		"12"=>"ธันวาคม"                 
	);
	
	$thai_month_arr_shot=array(
		"0"=>"",
		"1"=>"ม.ค.",
		"2"=>"ก.พ.",
		"3"=>"มี.ค.",
		"4"=>"ม.ย.",
		"5"=>"พ.ค.",
		"6"=>"มิ.ย.", 
		"7"=>"ก.ค.",
		"8"=>"ส.ค.",
		"9"=>"ก.ย.",
		"10"=>"ต.ค.",
		"11"=>"พ.ย.",
		"12"=>"ธ.ค."                 
	);
	function thai_date($time){
		global $thai_day_arr,$thai_month_arr;
		$thai_date_return="วัน".$thai_day_arr[date("w",$time)];
		$thai_date_return.= "ที่ ".date("j",$time);
		$thai_date_return.=" ".$thai_month_arr[date("n",$time)];
		$thai_date_return.= " ".(date("Y",$time)+543);
		return $thai_date_return;
	}
	
	function thai_date_non_dow($time){
		global $thai_day_arr,$thai_month_arr;
		//$thai_date_return = "วัน".$thai_day_arr[date("w",$time)];
		$thai_date_return = "";
		$thai_date_return.= date("j",$time);
		$thai_date_return.=" ".$thai_month_arr[date("n",$time)];
		$thai_date_return.= " ".(date("Y",$time)+543);
		return $thai_date_return;
	}
	
	function thai_date_short_date($time){
		global $thai_day_arr,$thai_month_arr_shot;
		//$thai_date_return = "วัน".$thai_day_arr[date("w",$time)];
		$thai_date_return = "";
		$thai_date_return.= date("j",$time);
		$thai_date_return.=" ".$thai_month_arr_shot[date("n",$time)];
		$thai_date_return.= " ".(date("Y",$time)+543);
		return $thai_date_return;
	}
	
	function cal_post_level($reach_value)
	{
		$star = 1.0;
		if ($reach_value > 10000) {$star = $star  + 0.5;}
		if ($reach_value > 30000) {$star = $star  + 0.5;}
		if ($reach_value > 50000) {$star = $star  + 0.5;}
		if ($reach_value > 65000) {$star = $star  + 0.5;}
		if ($reach_value > 100000) {$star = $star  + 0.5;}
		if ($reach_value > 200000) {$star = $star  + 0.5;}
		if ($reach_value > 500000) {$star = $star  + 0.5;}
		if ($reach_value > 1000000) {$star = $star  + 0.5;}
		return $star;
	}
	
	function gen_rnd_str($length = 10) {
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
	function check_password()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		//$sql = "Select a.wd_id From wd_access_code a  Inner Join wd_db b ON a.wd_id = b.wd_id Where a.token = '$token' AND a.expire > current_timestamp() AND gen = '$password'";
		$sql = "Select a.wd_id From wd_access_code a  Inner Join wd_access_password b ON a.wd_id = b.wd_id Where a.token = '$token' AND a.expire > current_timestamp() AND b.pwd = '$password'";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		
		if(mysqli_num_rows($res) == 1)
		{
			$row = $res->fetch_assoc();
			echo $row['wd_id'];
		}
		
		else
		{
			echo "";
		}
	}
	
// F=2
function get_wd_data()
{
	foreach ($_POST as $key => $value)
	{
		//$data[htmlspecialchars($key)] = htmlspecialchars($value);
		$a = htmlspecialchars($key) ;
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		//echo $key . ":" . $value . "\n";
	}
	//echo $post_data;
	$data = array();
	
	include "connectionDb.php";
	
	// Get basic information
	$sql = "SELECT * FROM `wd_db` WHERE wd_id = '$post_data'";
	$res = $conn->query(trim($sql));
	$row = $res->fetch_assoc();
	$data = $row;
	
	// Age Calculation
	$age = date_diff(date_create($row['birthday']), date_create('now'))->y;
	$data['age'] = $age;
	
	switch ($row['status']) {
		case 1:
			$status_string = '<small class="label bg-green">Active WatchDog</small>';
			break;
		case 2:
			$status_string = '<small class="label bg-yellow">บ่อพัก</small>';
			break;
		case 3:
			$status_string = '<small class="label bg-red">BANNED</small>';
			break;
		case 4:
			$status_string = '<small class="label bg-red">คัดออกจากศูนย์</small>';
			break;
		case 5:
			$status_string = '<small class="label bg-blue">ชั้นลอย</small>';
			break;
		default:
			$status_string = '<small class="label bg-red">NON STATUS</small>';
	} 
	$data['status_string'] = $status_string;
	
	
	switch ($row['sex']) {
		case 0:
			$sex_text = '<font color="#bbbbbb"><i class="fa fa-mars"></i></font>';
			break;
		case 1:
			$sex_text = '<font color="#bbbbbb"><i class="fa fa-venus"></i></font>';
			break;
	} 
	$data['sex_text'] = $sex_text;
	
	mysqli_close($conn);
	echo json_encode($data);
}

// F=3
function get_wd_basic_data()
{
foreach ($_POST as $key => $value)
{
	//$data[htmlspecialchars($key)] = htmlspecialchars($value);
	$a = htmlspecialchars($key) ;
	$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
	//echo $key . ":" . $value . "\n";
}
//echo $post_data;
$data = array();

include "connectionDb.php";

// Get basic information
$sql = "Select * From wd_db a Inner Join call_all_address2 b ON a.add_code = b.DISTRICT_CODE INNER JOIN m_occ_type c ON a.occ_type = c.id Where a.wd_id = '$post_data'";
$res = $conn->query(trim($sql));
$row = $res->fetch_assoc();
foreach($row as $key => $value)
{
	if (trim($value) == "")
	{
		$value = "-";
	}
	$$key = $value;
}
//$all_address_text = $row['address'] . " " . $row['DISTRICT_NAME']. " " . $row['AMPHUR_NAME']. " " . $row['PROVINCE_NAME']. " " . $row['zipcode'];
$all_address_text = " $address $DISTRICT_NAME $AMPHUR_NAME $PROVINCE_NAME $zipcode";
$data['all_address_text'] = $all_address_text;

$occ_text = "$occ ($occ_type)";
$data['occ_text'] = $occ_text;
$data['education'] = $education;


// Get Team Info
$sql = "Select team_name From wd_team_data a Inner Join m_wd_team b ON a.team_ID = b.team_ID Where a.wd_id = '$post_data'";
$res = $conn->query(trim($sql));
$team_data = "";
while ($row = $res->fetch_assoc())
{	
	$team_data .='<span class="label label-danger">'.$row['team_name'].'</span>	&nbsp;';
}
$data['team_data'] = $team_data;


// personal Skill information
$sql = "SELECT * From wd_skill Where wd_id = '$post_data'";
$res = $conn->query(trim($sql));
$personal_skill_data = "";
while ($row = $res->fetch_assoc())
{	
	$personal_skill_data .='<span class="label label-success">'.$row['wd_skill'].'</span>	&nbsp;';
}

$data['personal_skill_data'] = $personal_skill_data;

// Team Skill information
$sql = "Select a.*, b.team_name From m_team_skill a Inner Join m_wd_team b ON a.team_ID = b.team_ID WHERE a.team_ID in (Select a.team_ID From wd_team_data a Where a.wd_id = '$post_data')";
$res = $conn->query(trim($sql));
$team_skill_data = "";
while ($row = $res->fetch_assoc())
{	
	//$team_skill_data .='<span class="label label-info">'.$row['skill'].'('.$row['team_name'].')</span>	&nbsp;';
	$team_skill_data.='<div class="chip_2">'.$row['skill'].'('.$row['team_name'].')</div>';
	
}

$data['team_skill_data'] = $team_skill_data;




mysqli_close($conn);
echo json_encode($data);
}


// F=4
function get_timeline_data ()
	{
		foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			//echo $key . ":" . $value . "\n";
		}
		
		$sql = "Select * From (
Select a.wd_id , 11 as timeline_type , b.Training_subject   as activity , b.Training_End as activity_date , '' as url From wd_db a INNER Join m_training_sjb b ON a.gen = b.gen_code Where a.wd_id = '$post_data'
Union all
SELECT a.wd_id, 12 as timeline_type, b.Training_subject as detail, b.Training_End, '' as url FROM wd_training a Inner Join m_training_sjb b ON a.Training_ID = b.Training_ID Where a.wd_id = '$post_data' and b.gen_code = 0
Union all 
Select * From  wd_activity_log Where wd_id = '$post_data' 
Union all
Select a.name, 21 as timeline_type, b.topic as detail, a.snd_date, b.case_cnt_url From case_sender a Inner Join wd_case b ON a.case_id = b.case_id WHERE a.name = '$post_data'
Union all
Select a.wd_id, 22 as timeline_type, b.topic as detail, b.add_date, b.case_cnt_url as url From case_wd_support a Inner Join wd_case b ON a.case_id = b.case_id Where a.wd_id = '$post_data'
) a Order By activity_date, timeline_type";
		
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		
		$current_date = "";
		$current_year = "";
		while ($row = $res->fetch_assoc())
		{
			
			$year = date_format(date_create($row['activity_date']), 'Y') + 543;
			if ($current_year != $year)
			{
				$current_year = $year;
				echo "<li class='time-label'><span class='bg-gray'><B><i class='fa fa-flag'></i> $year</span></B></li>";
			}
			
			
			$current_date_temp = thai_date(date_format(date_create($row['activity_date']), 'U'));
			if ($current_date_temp != $current_date)
			{
				$current_date = $current_date_temp;
				echo "<li class='time-label'><span class='bg-blue'>$current_date</span></li>";
			}
			
			
			
			
			$timeline_type = $row['timeline_type'];
			switch($timeline_type)
			{
				case 11 :
				{
					$item_icon = "<i class='fa fa-lightbulb-o bg-blue'></i>";
					$item_text = "อบรม / ร่วมกิจกรรม";
					$item_text_detail = $row['activity'];
					break;
				}
				
				case 12 :
				{
					$item_icon = "<i class='fa fa-lightbulb-o bg-green'></i>";
					$item_text = "อบรม / ร่วมกิจกรรม";
					$item_text_detail = $row['activity'];
					break;
				}
				
				case 21 :
				{
					$item_icon = "<i class='fa  fa-send bg-maroon'></i>";
					$item_text = "ส่งเรื่อง";
					$item_text_detail = $row['activity'];
					break;
				}
				
				case 22 :
				{
					$item_icon = "<i class='fa fa-users bg-orange'></i>";
					$item_text = "รุม";
					$item_text_detail = $row['activity'];
					break;
				}
				
				case 91 :
				{
					$item_icon = "<i class='fa fa-times bg-red'></i>";
					$item_text = "โดนแบน";
					$item_text_detail = $row['activity'];
					break;
				}
				
				case 92 :
				{
					$item_icon = "<i class='fa fa-user-times bg-red'></i>";
					$item_text = "โดนคัดออกจากศูนย์";
					$item_text_detail = $row['activity'];
					break;
				}
				
				default :
				{
					$item_icon = "<i class='fa fa-thumb-tack bg-blue'></i>";
					$item_text = "....";
					$item_text_detail = "....";
					break;
				}
			}
				
				$button_link = "";
				if ($row['url'] != "")
				{
					$button_link = '<div class="timeline-footer"><a href="'.$row['url'].'" target="_blank" class="btn btn-primary btn-xs">Link</a></div>';
				}
				
				
				echo "<li>";
				echo $item_icon ;
				echo '<div class="timeline-item"><h3 class="timeline-header"><B>'.$item_text.'</B></h3>
							<div class="timeline-body">
								'.$item_text_detail.'
							</div>
							'.$button_link.'
					  </div>';
				
				
				echo "</li>";
		}
		echo '<li><i class="fa fa-clock-o bg-gray"></i></li>';
		
	}
	
	function get_wd_send_case_data()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select a.case_id, b.topic, b.t_sum,  a.snd_date, b.case_cnt_url, b.status From case_sender a INNER Join wd_case b ON a.case_id = b.case_id WHERE a.name = '$post_data' Order By a.snd_date DESC";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$row['print_case_id'] = substr($row['case_id'],0, 2).'-'.substr($row['case_id'],2, 2).'-'.substr($row['case_id'],4);
			$row['img'] = "img/wd_img/default.png";
			$row['post_link']  = "#";
			if ($row['status'] == "5")
			{
				$sql = "SELECT a.case_id, b.post_id, b.pub_time, c.img_src FROM case_pub_info a INNER Join system_page_all_pub b ON a.pub_url = b.post_id INNER Join system_page_all_pub_ojb_img c ON b.ojb_id = c.ojb_id Where a.case_id = '".$row['case_id']."' Order BY b.pub_time Limit 1";
				$resx = $conn->query(trim($sql));
				$row_img = $resx->fetch_assoc();
				if ($row_img['img_src'] != "")
				{
					$row['img'] = $row_img['img_src'];
					$row['post_link'] = "https://www.facebook.com/".$row_img['post_id'];
				}
				
			}
			$data_Array[] = $row;
		}
		mysqli_close($conn);		
		echo json_encode($data_Array);
	}
	
		// F=6
	function get_wd_support_case_data()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select a.case_id, b.topic, b.t_sum , b.case_cnt_url, b.status From case_wd_support a INNER Join wd_case b ON a.case_id = b.case_id WHERE a.wd_id = '$post_data' Order By a.case_id DESC";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$row['print_case_id'] = substr($row['case_id'],0, 2).'-'.substr($row['case_id'],2, 2).'-'.substr($row['case_id'],4);
			$row['img'] = "img/wd_img/default.png";
			$row['post_link']  = "#";
			if ($row['status'] == "5")
			{
				$sql = "SELECT a.case_id, b.post_id, b.pub_time, c.img_src FROM case_pub_info a INNER Join system_page_all_pub b ON a.pub_url = b.post_id INNER Join system_page_all_pub_ojb_img c ON b.ojb_id = c.ojb_id Where a.case_id = '".$row['case_id']."' Order BY b.pub_time Limit 1";
				$resx = $conn->query(trim($sql));
				$row_img = $resx->fetch_assoc();
				if ($row_img['img_src'] != "")
				{
					$row['img'] = $row_img['img_src'];
					$row['post_link'] = "https://www.facebook.com/".$row_img['post_id'];
				}
				
			}
			$data_Array[] = $row;
		}
		mysqli_close($conn);		
		echo json_encode($data_Array);
	}
	
	// F=7
	function get_wd_team_support_case_data()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select a.team_ID,b.case_id, b.topic, b.t_sum , b.case_cnt_url, b.status, c.team_name From wd_team_data a INNER Join case_team_support x ON a.team_ID = x.team_id Inner Join wd_case b ON x.case_id = b.case_id INNER Join m_wd_team c ON a.team_ID = c.team_ID where a.wd_id = '$post_data' Order By b.case_id DESC";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$row['print_case_id'] = substr($row['case_id'],0, 2).'-'.substr($row['case_id'],2, 2).'-'.substr($row['case_id'],4);
			$row['img'] = "img/wd_img/default.png";
			$row['post_link']  = "#";
			if ($row['status'] == "5")
			{
				$sql = "SELECT a.case_id, b.post_id, b.pub_time, c.img_src FROM case_pub_info a INNER Join system_page_all_pub b ON a.pub_url = b.post_id INNER Join system_page_all_pub_ojb_img c ON b.ojb_id = c.ojb_id Where a.case_id = '".$row['case_id']."' Order BY b.pub_time Limit 1";
				$resx = $conn->query(trim($sql));
				$row_img = $resx->fetch_assoc();
				if ($row_img['img_src'] != "")
				{
					$row['img'] = $row_img['img_src'];
					$row['post_link'] = "https://www.facebook.com/".$row_img['post_id'];
				}
				
			}
			$data_Array[] = $row;
		}
		mysqli_close($conn);		
		echo json_encode($data_Array);
	}
	
	
	// F=8
	function get_wd_score()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select * From wd_point Where wd_id = '$post_data'";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	//F=9
	function get_training_history()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select b.* From wd_training a  Inner Join m_training_sjb b ON a.Training_ID = b.Training_ID Where a.wd_id = '$post_data'  Order By b.Training_Start";
		//echo $sql;
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	// F=10
	function get_user_token_data()
	{
		//$main_server="127.0.0.1";
		$main_server="www.wdact.co";
		$main_url = "http://$main_server/WD_system/user_profile.php?token=";
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select * From wd_access_code Where wd_id = '$post_data' AND expire = (Select MAX(expire) From wd_access_code Where wd_id = '$post_data')";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$row = $res->fetch_assoc();
		echo $main_url.$row['token'];
	}
	
	//F=11
	function load_main_data_for_edit()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select * ,DATE_FORMAT(DATE_ADD(a.birthday, INTERVAL 543 YEAR), '%d%m%Y') as dob, DATE_FORMAT(DATE_ADD(a.birthday, INTERVAL 543 YEAR), '%Y-%m-%d') as dob2 From wd_db a Where a.wd_id = '$post_data'";
		//echo $sql;
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	
	// F=12
	
	function update_wd_main_data()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		$sql = "Update wd_db a SET";
		$sql = $sql . " a.name = '$user_name'";
		$sql = $sql . " , a.s_name = '$user_sirname'";
		$sql = $sql . " , a.n_name = '$user_nickname'";
		$sql = $sql . " , a.birthday = '$birthDate'";
		$sql = $sql . " , a.tel = '$user_tel_1'";
		$sql = $sql . " , a.tel_2 = '$user_tel_2'";
		$sql = $sql . " , a.email = '$user_email'";
		$sql = $sql . " , a.soc_fb = '$user_fb_1'";
		$sql = $sql . " , a.soc_fb_2 = '$user_fb_2'";
		$sql = $sql . " , a.soc_line = '$user_line'";
		$sql = $sql . " , a.soc_twitter = '$user_twister'";
		$sql = $sql . " Where wd_id = '$post_data'";
		
		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			mysqli_close($conn);		
			exit();
		}
		mysqli_close($conn);		
	}
	
	// F=13
	function get_address_for_select()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "SELECT a.DISTRICT_CODE, a.DISTRICT_NAME, b.AMPHUR_NAME, c.PROVINCE_NAME From add_districts a Inner Join add_amphures b ON a.AMPHUR_ID = b.AMPHUR_ID Inner Join add_provinces c ON a.PROVINCE_ID = c.PROVINCE_ID WHERE a.DISTRICT_NAME NOT LIKE '%*%'";
		//echo $sql;
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$row['address_text'] = trim($row['DISTRICT_NAME'])." ".trim($row['AMPHUR_NAME'])." ".trim($row['PROVINCE_NAME']);
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	function get_occ_type_for_select()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select * From m_occ_type Order By id";
		//echo $sql;
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	// F=15
	function load_main2_data_for_edit()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select * From wd_db Where wd_id = '$post_data'";
		//echo $sql;
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	
	// F=16
	function save_main_data_2()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		$sql = "Update wd_db a ";
		$sql = $sql . " SET a.address = '$new_address'";
		$sql = $sql . " , a.add_code = $new_address_code";
		$sql = $sql . " , a.education = '$new_education'";
		$sql = $sql . " , a.occ = '$new_occ'";
		$sql = $sql . " , a.occ_type = $new_occ_type";
		$sql = $sql . " , a.occ_add = '$new_occ_location'";
		$sql = $sql . " Where a.wd_id = '$post_data'";
		
		
		//echo $sql;
		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			mysqli_close($conn);		
			exit();
		}
		mysqli_close($conn);		
	}
	
	// F=18
	function get_and_print_skill()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select * From wd_skill Where wd_id = '$post_data'";
		//echo $sql;
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	function skill_del()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		//$sql = "Delete From WD_Skill Where wd_id = '$post_data' AND wd_skill =   '$target'  ";
		$sql = "Delete from wd_skill Where ranstr='$target'";
		//echo $sql;
		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			mysqli_close($conn);		
			exit();
		}
		mysqli_close($conn);		
	}
	
// F=20
function add_skill()
{
	foreach ($_POST as $key => $value)
	{
		$a = htmlspecialchars($key) ;
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$sql = "Insert Into wd_skill Value ('$post_data', '$target', '$post_data".gen_rnd_str(8)."')";
	
	include "connectionDb.php";
	if(!$conn->query($sql))
	{
		mysqli_close($conn);		
		exit();
	}
	mysqli_close($conn);		
}
// F=21
function update_staff_user_profile_img()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		sleep(2);
		//$sql = "update staff_img SET img = '$img' Where key_ID = $staff_ID";
		$sql = "Update wd_db set wd_img = '$img' Where wd_id = '$data'";
		include "connectionDb.php";
		$conn->query($sql);
		mysqli_close($conn);		
	}

	// F=22 load_event_now_lits
	function load_event_now_lits()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		//$sql = "SELECT a.wd_id, c.event_id, c.event_name, c.start, c.end, c.event_type, d.time_stmp FROM wd_training a Inner Join m_training_sjb b ON a.Training_ID = b.Training_ID Inner Join m_event_list c ON b.Training_ID = c.Training_ID left Join m_event_data d ON c.event_id = d.event_id and d.wd_id = '$post_data' Where a.wd_id = '$post_data' AND c.active = 1 AND (CURRENT_TIMESTAMP() Between c.start AND c.end)";
		$sql = "SELECT a.wd_id, c.event_id, c.event_name, c.start, c.end, c.event_type, d.time_stmp FROM wd_training a Inner Join m_training_sjb b ON a.Training_ID = b.Training_ID Inner Join m_event_list c ON b.Training_ID = c.Training_ID left Join (Select * From m_event_data a Where a.wd_id = '$post_data' Group By a.wd_id, a.event_id ) d ON c.event_id = d.event_id and d.wd_id = '$post_data' Where a.wd_id = '$post_data' AND c.active = 1 AND (CURRENT_TIMESTAMP() Between c.start AND c.end)";
		//echo $sql;
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);		
	}
	
	//F=23
	function check_in_event()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Insert Into m_event_data value ($val_1, '$val_2', '', '', '', CURRENT_TIMESTAMP())";
		include "connectionDb.php";
		$conn->query($sql);
		mysqli_close($conn);	
	}
	
	
	// F=24
	function load_event_vote_selection()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "SELECT value FROM m_vote_option_for_event a Where a.event_id = $vote_id Order by value";
		//echo $sql;
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);		
	}
	
	//F=25
	function vote_event()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Insert Into m_event_data value ($val_1, '$val_2', '$val_3', '$val_4', '', CURRENT_TIMESTAMP())";
		include "connectionDb.php";
		$conn->query($sql);
		mysqli_close($conn);	
	}
	
	//F=26
	function check_temp_pwd()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "SELECT temp_flg FROM wd_access_password Where wd_id = '$post_data'";
		//echo $sql;
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);	
	}
	
	// F=27
	function update_password()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Update wd_access_password a INNER JOIN wd_access_code b ON a.wd_id = b.wd_id SET a.pwd = '$data_1' , a.temp_flg = 'N' WHERE b.token = '$post_data' AND b.expire > current_timestamp()";
		include "connectionDb.php";
		$conn->query($sql);
		mysqli_close($conn);	
	}
	
	// F=28
	function get_address_for_select_2()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select c.DISTRICT_CODE, c.AMPHUR_ID, c.PROVINCE_ID From wd_access_code a INNER Join wd_db b ON a.wd_id = b.wd_id INNER Join add_districts c ON b.add_code = c.DISTRICT_CODE Where a.token = '$post_data'";
		//echo $sql;
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);	
	}
	
	// F=29
	function get_province_for_select()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select a.PROVINCE_ID, a.PROVINCE_NAME From add_provinces a INNER Join add_provinces_order b ON a.PROVINCE_NAME = b.province_name Order By b.No";
		//echo $sql;
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);	
	}
	
	// F=30
	function get_ampher_for_select()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select a.AMPHUR_ID, a.AMPHUR_NAME From add_amphures a WHERE a.AMPHUR_NAME NOT LIKE '%*%' AND a.PROVINCE_ID = $prov";
		//echo $sql;
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);	
	}
	
	// F=31
	function get_district_for_select()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select a.DISTRICT_CODE, a.DISTRICT_NAME From add_districts a WHERE a.DISTRICT_NAME NOT LIKE '%*%' AND a.AMPHUR_ID = $ampher";
		//echo $sql;
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);	
	}
	// F=32
	function get_event_hdr()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "SELECT a.event_name, a.start, a.end, b.Training_subject, b.location FROM m_event_list a Inner Join m_training_sjb b ON a.Training_ID = b.Training_ID INNER Join wd_training c ON b.Training_ID = c.Training_ID INNER Join wd_access_code d ON c.wd_id = d.wd_id Where a.event_id = $event_id AND d.token = '$token' AND d.expire > CURRENT_TIMESTAMP()";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
			
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		
		// Get count Join WD
		$sql = "SELECT count(c.wd_id) as count_join_wd FROM m_event_list a Inner Join m_training_sjb b ON a.Training_ID = b.Training_ID INNER Join wd_training c ON b.Training_ID = c.Training_ID Where a.event_id = $event_id";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		$data_Array[0]['count_join_wd'] = $row['count_join_wd'];
		mysqli_close($conn);	
		echo json_encode($data_Array);
	}
	
		// F=33
	function get_vote_result_table()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql= "SELECT a.value, IFNULL(b.cnt, 0) as cnt FROM m_vote_option_for_event a LEFT Join (SELECT option_value_1, count(option_value_1) as cnt FROM m_event_data WHERE event_id = $event_id Group BY option_value_1 ) b ON a.value = b.option_value_1 WHERE a.event_id = $event_id Order By a.value";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	// F=34
	function get_vote_result_chart()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "SELECT option_value_1, count(option_value_1) as cnt FROM m_event_data WHERE event_id = $event_id Group BY option_value_1";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	// F=35
	function get_pending_case_for_support()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "SELECT a.case_id, a.topic, a.t_sum , a.case_cnt_url, a.status FROM wd_case a WHERE a.status in (0, 1, 2, 3) Order By a.add_date DESC";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$row['print_case_id'] = substr($row['case_id'],0, 2).'-'.substr($row['case_id'],2, 2).'-'.substr($row['case_id'],4);
			$row['img'] = "img/wd_img/default.png";
			$row['post_link']  = "#";
			if ($row['status'] == "5")
			{
				$sql = "SELECT a.case_id, b.post_id, b.pub_time, c.img_src FROM case_pub_info a INNER Join system_page_all_pub b ON a.pub_url = b.post_id INNER Join system_page_all_pub_ojb_img c ON b.ojb_id = c.ojb_id Where a.case_id = '".$row['case_id']."' Order BY b.pub_time Limit 1";
				$resx = $conn->query(trim($sql));
				$row_img = $resx->fetch_assoc();
				if ($row_img['img_src'] != "")
				{
					$row['img'] = $row_img['img_src'];
					$row['post_link'] = "https://www.facebook.com/".$row_img['post_id'];
				}
				
			}
			$data_Array[] = $row;
		}
		mysqli_close($conn);		
		echo json_encode($data_Array);
	}
	
	// F=36
	function get_pending_type()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select a.job_type, count(a.case_id) as cnt From case_job_type a INNER Join wd_case b ON a.case_id = b.case_id Where b.status IN (0,1,2,3) Group By a.job_type";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	// F=37
	function get_pending_case_for_support_by_type()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "SELECT a.case_id, a.topic, a.t_sum , a.case_cnt_url, a.status FROM wd_case a Inner Join case_job_type b ON a.case_id = b.case_id WHERE a.status in (0, 1, 2, 3) AND b.job_type = '$target' Order By a.add_date DESC";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$row['print_case_id'] = substr($row['case_id'],0, 2).'-'.substr($row['case_id'],2, 2).'-'.substr($row['case_id'],4);
			$row['img'] = "img/wd_img/default.png";
			$row['post_link']  = "#";
			if ($row['status'] == "5")
			{
				$sql = "SELECT a.case_id, b.post_id, b.pub_time, c.img_src FROM case_pub_info a INNER Join system_page_all_pub b ON a.pub_url = b.post_id INNER Join system_page_all_pub_ojb_img c ON b.ojb_id = c.ojb_id Where a.case_id = '".$row['case_id']."' Order BY b.pub_time Limit 1";
				$resx = $conn->query(trim($sql));
				$row_img = $resx->fetch_assoc();
				if ($row_img['img_src'] != "")
				{
					$row['img'] = $row_img['img_src'];
					$row['post_link'] = "https://www.facebook.com/".$row_img['post_id'];
				}
				
			}
			$data_Array[] = $row;
		}
		mysqli_close($conn);		
		echo json_encode($data_Array);
	}
	
	// F=38
	function get_pending_crp()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select a.crp_id, a.crp_type, COUNT(a.case_id) as cnt From case_crp_type_data a Inner Join wd_case b ON a.case_id = b.case_id Where b.status IN (0,1,2,3) GROUP BY a.crp_id, a.crp_type ORDER By a.crp_id";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	// F=39
	function Load_pending_crp()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select a.case_id, a.topic, a.t_sum , a.case_cnt_url, a.status From wd_case a Inner Join case_crp_type_data b ON a.case_id = b.case_id Where a.status IN (0,1,2,3) AND b.crp_type = '$target' Order By a.case_id DESC";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$row['print_case_id'] = substr($row['case_id'],0, 2).'-'.substr($row['case_id'],2, 2).'-'.substr($row['case_id'],4);
			$row['img'] = "img/wd_img/default.png";
			$row['post_link']  = "#";
			if ($row['status'] == "5")
			{
				$sql = "SELECT a.case_id, b.post_id, b.pub_time, c.img_src FROM case_pub_info a INNER Join system_page_all_pub b ON a.pub_url = b.post_id INNER Join system_page_all_pub_ojb_img c ON b.ojb_id = c.ojb_id Where a.case_id = '".$row['case_id']."' Order BY b.pub_time Limit 1";
				$resx = $conn->query(trim($sql));
				$row_img = $resx->fetch_assoc();
				if ($row_img['img_src'] != "")
				{
					$row['img'] = $row_img['img_src'];
					$row['post_link'] = "https://www.facebook.com/".$row_img['post_id'];
				}
				
			}
			$data_Array[] = $row;
		}
		mysqli_close($conn);		
		echo json_encode($data_Array);
	}

	function load_PDPA_DATA()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select a.consent_id, a.consent_desc, b.consent_value From (Select za.consent_id, za.consent_desc From consent_master za
		Where za.consent_active = 1) a 
		LEFT Join (Select zb.consent_id, zb.consent_value From consent_data zb where zb.wd_id = '$MAIN_data') b ON a.consent_id = b.consent_id";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);		
	}

	// F=41
	function update_consent()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		// Delete current if exist

		
		

		include "connectionDb.php";
		$del_sql = "Delete from consent_data  Where consent_id = $consent_id AND wd_id = '$MAIN_data'";
		echo $del_sql;
		if(!$conn->query($del_sql))
		{
			mysqli_close($conn);		
			exit();
		}


		// Insert Data 
		$Ins_sql = "Insert Into consent_data VALUE ('$MAIN_data', $consent_id, $consent_value , CURRENT_TIMESTAMP())";
		if(!$conn->query($Ins_sql))
		{
			mysqli_close($conn);		
			exit();
		}
		mysqli_close($conn);	
	}
	

	//============================ MAIN =========================================================
	switch($f)
	{
		case 1 :
		{
			check_password();
			break;
		}
		case 2 :
		{
			get_wd_data();
			break;
		}
		case 3 :
		{
			get_wd_basic_data();
			break;
		}
		case 4 :
		{
			get_timeline_data();
			break;
		}
		case 5 :
		{
			get_wd_send_case_data();
			break;
		}
		case 6 :
		{
			get_wd_support_case_data();
			break;
		}
		case 7 :
		{
			get_wd_team_support_case_data();
			break;
		}
		case  8 :
		{
			get_wd_score();
			break;
		}
		case  9 :
		{
			get_training_history();
			break;
		}
		case  10 :
		{
			get_user_token_data();
			break;
		}
		
		case  11 :
		{
			load_main_data_for_edit();
			break;
		}
		case  12 :
		{
			update_wd_main_data();
			break;
		}
		
		case  13 :
		{
			get_address_for_select();
			break;
		}
		case  14 :
		{
			get_occ_type_for_select();
			break;
		}
		case  15 :
		{
			load_main2_data_for_edit();
			break;
		}
		case  16 :
		{
			save_main_data_2();
			break;
		}
		case  17 :
		{
			save_main_data_2();
			break;
		}
		case 18 :
		{
			get_and_print_skill();
			break;
		}
		case 19 :
		{
			skill_del();
			break;
		}
		case 20 :
		{
			add_skill();
			break;
		}
		case 21 :
		{
			update_staff_user_profile_img();
			break;
		}
		case 22 :
		{
			load_event_now_lits();
			break;
		}
		case 23 :
		{
			check_in_event();
			break;
		}
		case 24 :
		{
			load_event_vote_selection();
			break;
		}
		
		case 25 :
		{
			vote_event();
			break;
		}
		case 26 :
		{
			check_temp_pwd();
			break;
		}
		case 27 :
		{
			update_password();
			break;
		}
		
		case 28 :
		{
			get_address_for_select_2();
			break;
		}
		case 29 :
		{
			get_province_for_select();
			break;
		}
		case 30 :
		{
			get_ampher_for_select();
			break;
		}
		case 31 :
		{
			get_district_for_select();
			break;
		}
		case 32 :
		{
			get_event_hdr();
			break;
		}
		case 33:
		{
			get_vote_result_table();
			break;
		}
		case 34:
		{
			get_vote_result_chart();
			break;
		}
		case 35:
		{
			get_pending_case_for_support();
			break;
		}
		case 36:
		{
			get_pending_type();
			break;
		}
		case 37:
		{
			get_pending_case_for_support_by_type();
			break;
		}
		case 38:
		{
			get_pending_crp();
			break;
		}
		case 39:
		{
			Load_pending_crp();
			break;
		}
		case 40:
		{
			load_PDPA_DATA();
			break;
		}
		case 41:
		{
			update_consent();
			break;
		}
	
		









		
	}
?>