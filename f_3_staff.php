<?php

	// Add for PHPSpreadsheet : 2020-12-27
	require_once("plugins/PHPSpreadsheet/autoload.php");

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	use PhpOffice\PhpSpreadsheet\IOFactory;


	// ======== Get Var ========
	$f = $_POST['f'];

	if (isset($_POST['p1']) )
	{
		$p1 = $_POST['p1'];
	}
	if (isset($_POST['p2']) )
	{
		$p2 = $_POST['p2'];
	}
	if (isset($_POST['p3']) )
	{
		$p3 = $_POST['p3'];
	}
	if (isset($_POST['p4']) )
	{
		$p4 = $_POST['p4'];
	}
	if (isset($_POST['p5']) )
	{
		$p5 = $_POST['p5'];
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
	function thai_date($time){
		global $thai_day_arr,$thai_month_arr;
		$thai_date_return="วัน".$thai_day_arr[date("w",$time)];
		$thai_date_return.= "ที่ ".date("j",$time);
		$thai_date_return.=" ".$thai_month_arr[date("n",$time)];
		$thai_date_return.= " ".(date("Y",$time)+543);
		return $thai_date_return;
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

	function validateDate($date, $format = 'Y-m-d H:i:s')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}

	
	// ======== Function ========
	// 1
	function add_new_staff()
	{
		foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$Ins_sql = "INSERT INTO `staff`(`Name`, `stf_ID`, `stf_pass`, `admin_level`, `active`) VALUES ('$ns_name','$ns_id',sha('$ns_pass'),$ns_level,1)";
		include "connectionDb.php";
		if(!$conn->query($Ins_sql))
		{
			$chk_result_insert .= "Error Insert user data!!";
			exit();
		}
		
		$get_ID = "Select key_ID from staff where stf_ID = '$ns_id'";
		$res = $conn->query(trim($get_ID));
		$row = $res->fetch_assoc();
		$key_ID = $row['key_ID'];
		
		$ins_det = "INSERT INTO `staff_detail`(`key_ID`, `Name`, `s_name`, `nick_name`, `Position`) VALUES ('$key_ID','$ns_name','$ns_sname','$ns_nickname','$ns_position')";
		if(!$conn->query($ins_det))
		{
			$chk_result_insert .= "Error Insert user data!!";
			exit();
		}
		
		//insert staff Config
		$ins_config = "Insert Into staff_config (key_id) values ('$key_ID')";
		if(!$conn->query($ins_config))
		{
			$chk_result_insert .= "Error Insert user config!!";
			exit();
		}
		
		//insert default staff img
		$ins_config = "Insert Into staff_img value ($key_ID, 'default.png')";
		if(!$conn->query($ins_config))
		{
			$chk_result_insert .= "Error Insert user img!!";
			exit();
		}
		
		mysqli_close($conn);
	}
	
	// F=2
	function check_avilable_ID ($check_ID)
	{
		include "connectionDb.php";
		$get_ID = "Select key_ID from staff where stf_ID = '$check_ID'";
		$res = $conn->query(trim($get_ID));
		if (($res->num_rows) == 1)
		{
			echo '<BIG><font color="#f56954"><i class="fa fa-close"></i> มีผู้ใช้งาน ID นี้แล้ว</font></BIG>';
		}
		else
		{
			echo "";
		}
		mysqli_close($conn);
	}
	
	// F=3
	function check_all_user_list()
	{
		include "connectionDb.php";
		$get_ID = "SELECT * FROM staff ORDER BY active DESC ";
		$res = $conn->query(trim($get_ID));
		echo '<option selected disabled>== เลือก Staff ==</option>';
		while ($row = $res->fetch_assoc()){
			echo "<option value='".$row['key_ID']."'>".$row['stf_ID']." - ".$row['Name']."</option>";
		}
		mysqli_close($conn);
	}
	
	// F=4
	function load_staff_data($staff_KID)
	{
		$get_sql = "SELECT a.key_ID, a.stf_ID, a.Name, a.admin_level, a.active, b.s_name, b.nick_name, b.Position FROM staff a Inner Join staff_detail b ON a.key_ID = b.key_ID Where a.key_ID = $staff_KID ";
		include "connectionDb.php";
		$res = $conn->query(trim($get_sql));
		$row = $res->fetch_assoc();
		$data = array();
		foreach($row as $key => $value)
		{
			$data[$key] = $value;
		}
		echo json_encode($data);
		mysqli_close($conn);
		
	}
	
	// F=5
	function change_password($kid, $password)
	{
		include "connectionDb.php";
		$SQL = "UPDATE staff set stf_pass = sha('$password') Where key_ID = $kid";
		if(!$conn->query($SQL))
		{
			echo ("<font color='#f56954'><big>Error!!</big></font>");
			exit();
		}
		echo ("<font color='#00a65a'><big>เปลี่ยนรหัสผ่านสำเร็จ</big></font>");
		
		
		
		mysqli_close($conn);
	}
	
	
	// F=6
	function update_staff_info()
	{
		foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		// Get Key ID
		include "connectionDb.php";
		$sql = "Select key_ID from staff where stf_ID = '$ed_id'";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		$kid = $row['key_ID'];
		
		// Update Name 1
		$sql = "update staff set name = '$ed_name' Where key_ID = $kid";
		$conn->query($sql);
		
		// Update Name 2
		$sql = "update staff_detail set name = '$ed_name' Where key_ID = $kid";
		$conn->query($sql);
		
		// Active Update
		$sql = "update staff set active = $ed_active Where key_ID = $kid";
		$conn->query($sql);
		
		// admin Level
		$sql = "update staff set admin_level = $ed_level Where key_ID = $kid";
		$conn->query($sql);
		
		//update Sname
		$sql = "update staff_detail set s_name = '$ed_sname' Where key_ID = $kid";
		$conn->query($sql);
		
		//update nickname
		$sql = "update staff_detail set nick_name = '$ed_nickname' Where key_ID = $kid";
		$conn->query($sql);
		
		//update Position
		$sql = "update staff_detail set Position = '$ed_position' Where key_ID = $kid";
		$conn->query($sql);
		
		echo $ed_active;
		
		mysqli_close($conn);
	}
	
	// F=7
	function check_all_team_list()
	{
		include "connectionDb.php";
		$get_ID = "Select * From m_wd_team Order By team_id";
		$res = $conn->query(trim($get_ID));
		echo '<option selected disabled>== เลือก Team ==</option>';
		while ($row = $res->fetch_assoc()){
			echo "<option value='".$row['team_ID']."'>".$row['team_name']."</option>";
		}
		mysqli_close($conn);
	}
	
	// F=8
	function get_Max_Team_ID()
	{
		include "connectionDb.php";
		//$get_ID = "SELECT max(team_ID) + 1 as max_id From m_wd_team";
		//$res = $conn->query(trim($get_ID));
		//$row = $res->fetch_assoc();
		echo "ID อัตโนมัติ";
		mysqli_close($conn);
	}
	
	// F=9
	function add_new_team($name, $des, $skill)
	{
		include "connectionDb.php";
		$ins_sql = "Insert Into m_wd_team(team_name, team_des) value ('$name', '$des')";
		$conn->query($ins_sql);
		
		$get_ID = "Select max(team_ID) as max_ID From m_wd_team";
		$res = $conn->query(trim($get_ID));
		$row = $res->fetch_assoc();
		$id = $row['max_ID'];
		
		$skill_arr =  (explode(",",$skill));
		//echo $skill_arr[0];
		if ($skill_arr[0] != '0')
		{
			$skill_cnt_chk = 0 ;
			$ins_skill  = "";
			foreach ($skill_arr as $skill_list)
			{
				if ($skill_cnt_chk == 0)
				{
					$ins_skill = $ins_skill."Insert Into m_team_skill value('$id', '$skill_list')";
				}
				else 
				{
					$ins_skill = $ins_skill.",('$id', '$skill_list')";
				}
				$skill_cnt_chk = 1;
			}
		}
		$conn->query($ins_skill);
		mysqli_close($conn);
		echo "OK";
	}
	
	
	// f = 10
	function load_team_data($team_id)
	{
		include "connectionDb.php";
		$sql = "Select * From m_wd_team WHERE team_id = $team_id";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		$data = array();
		foreach($row as $key => $value)
		{
			$data[$key] = $value;
		}
		
		// Get skill
		$sql = "SELECT * from m_team_skill Where team_ID = $team_id";
		$res = $conn->query(trim($sql));
		$all_skill_data = "";
		$skill_list_cnt = 0;
		while ($row = $res->fetch_assoc()){
			if ($skill_list_cnt == 1)
			{
				$all_skill_data .= ",";
			}
			$all_skill_data .= $row['skill'];
			$skill_list_cnt = 1;
		}
		$data['all_skill'] = $all_skill_data;
		
		// Get Member
		$sql = "SELECT * from wd_team_data Where team_ID = $team_id";
		$res = $conn->query(trim($sql));
		$all_member_data = "";
		$member_list_cnt = 0;
		while ($row = $res->fetch_assoc()){
			if ($member_list_cnt == 1)
			{
				$all_member_data .= ",";
			}
			$all_member_data .= $row['wd_id'];
			$member_list_cnt = 1;
		}
		$data['all_member'] = $all_member_data;
		
		// Close connection
		mysqli_close($conn);
		
		echo json_encode($data);
	}

	// f = 11
	function delete_team($team_id)
	{
		include "connectionDb.php";
		
		$sql = "DELETE From m_wd_team WHERE team_ID = $team_id";
		$conn->query($sql);
		
		$sql = "DELETE From m_team_skill WHERE team_ID = $team_id";
		$conn->query($sql);
		
		$sql = "DELETE From wd_team_data WHERE team_ID = $team_id";
		$conn->query($sql);
		
		
		// Close connection
		mysqli_close($conn);
	}
	
	// F =12
	function load_wd_info($wd_id)
	{
		// Connect to MySQL Database
		include "connectionDb.php";
		$sql = "Select a.wd_id, a.gen, a.name, a.s_name, a.n_name, a.soc_fb from wd_db a WHERE a.wd_id = '$wd_id'"; 
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		$row = $res->fetch_assoc();
		echo $row['name']." ".$row['s_name']." (".$row['n_name'].") รุ่น ".$row['gen'] ;
	}
	
	// F = 13 
	function update_team($team_id, $team_name, $team_desc, $team_skill, $team_member)
	{
		include "connectionDb.php";
		
		// Update name
		$update_sql = "Update m_wd_team Set team_name = '$team_name' Where team_ID = $team_id";
		$conn->query($update_sql);
		
		// Update Desc
		$update_sql = "Update m_wd_team Set team_des = '$team_desc' Where team_ID = $team_id";
		$conn->query($update_sql);
		
		// Update Skill
		$sql = "DELETE From m_team_skill WHERE team_ID = $team_id";  // Delete All first
		$conn->query($sql);
		$skill_arr =  (explode(",",$team_skill));
		//echo $skill_arr[0];
		if ($skill_arr[0] != '0')
		{
			$skill_cnt_chk = 0 ;
			$ins_skill  = "";
			foreach ($skill_arr as $skill_list)
			{
				if ($skill_cnt_chk == 0)
				{
					$ins_skill = $ins_skill."Insert Into m_team_skill value('$team_id', '$skill_list')";
				}
				else 
				{
					$ins_skill = $ins_skill.",('$team_id', '$skill_list')";
				}
				$skill_cnt_chk = 1;
			}
		}
		$conn->query($ins_skill);
		
		// Update Member
		$sql = "DELETE From wd_team_data WHERE team_ID = $team_id";
		$conn->query($sql);
		$member_arr =  (explode(",",$team_member));
		//echo $skill_arr[0];
		if (trim($member_arr[0]) != '')
		{
			$member_cnt_chk = 0 ;
			$ins_member  = "";
			foreach ($member_arr as $member_list)
			{
				if ($member_cnt_chk == 0)
				{
					$ins_member = $ins_member."Insert Into wd_team_data value('$team_id', '$member_list')";
				}
				else 
				{
					$ins_member = $ins_member.",('$team_id', '$member_list')";
				}
				$member_cnt_chk = 1;
			}
		}
		$conn->query($ins_member);
		
		mysqli_close($conn);
	}
	
	// F=14
	function get_max_gen()
	{
		// Connect to MySQL Database
		include "connectionDb.php";
		$sql = "Select max(gen_code) as max_gen From m_training_sjb Where gen_code <> 0"; 
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		$row = $res->fetch_assoc();
		$new_gen = $row['max_gen'] + 1;
		$new_gen_text = "อบรมเชิงปฏิบัติการ รุ่นที่ ".$new_gen;
		
		// Prepare data
		$data = array();
		$data['new_gen'] = $new_gen;
		$data['new_gen_text'] = $new_gen_text;
		
		
		echo json_encode($data);
		
	}
	
	// F=15
	function save_new_training ()
	{
		foreach ($_POST as $key => $value)
			{
				//$data[htmlspecialchars($key)] = htmlspecialchars($value);
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
				//echo $key . ":" . $value . "\n";
			}
		include "connectionDb.php";
		$ins_sql = "INSERT INTO m_training_sjb(Training_subject, Training_type, location, Training_Start, Training_End, gen_code, training_spc) VALUES ('$tr_name', '$tr_type', '$tr_location', '$start_date', '$end_date', $new_gen, '$tr_spc')";
		$conn->query($ins_sql);
		mysqli_close($conn);
	}
	
	// F=16
	function get_training_list()
	{
		include "connectionDb.php";
		$get_ID = "Select Training_ID, Training_subject, Training_type, location From m_training_sjb Order By gen_code DESC, Training_ID DESC ";
		$res = $conn->query(trim($get_ID));
		echo '<option selected disabled>== เลือก การอบรม ==</option>';
		$temp_tr_type = "";
		while ($row = $res->fetch_assoc()){
			if ($temp_tr_type != $row['Training_type'])
			{
				$temp_tr_type = $row['Training_type'];
				echo '<option disabled><B>'.$temp_tr_type.'</B></option>';
			}
			echo "<option value='".$row['Training_ID']."'>	&nbsp;	&nbsp;	&nbsp;	&nbsp;".$row['Training_subject']." - ".$row['location']."</option>";
		}
		mysqli_close($conn);
	}

	// F=17
	function get_training_info()
	{
		foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			//echo $key . ":" . $value . "\n";
		}
		include "connectionDb.php";
		$sql = "SELECT * FROM `m_training_sjb` WHERE `Training_ID` = $tr_target";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		$row = $res->fetch_assoc();
		
		// Prepare data
		$data = array();
		$data['Training_subject'] = $row['Training_subject'];
		$data['location'] = $row['location'];
		$data['training_spc'] = $row['training_spc'];
		$data['Training_type'] = $row['Training_type'];
		$data['Training_Start'] = date("d/m/Y", strtotime($row['Training_Start']));;
		$data['Training_End'] = date("d/m/Y", strtotime($row['Training_End']));;
		
		
		echo json_encode($data);
	}
	
	
	// F = 18
	function update_training_info()
	{
		foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			//echo $key . ":" . $value . "\n";
		}
		include "connectionDb.php";
		$sql = "UPDATE m_training_sjb SET location = '$tr_location', Training_Start = '$start_date', Training_End = '$end_date', Training_type = '$tr_type', training_spc = '$tr_spc_ed' WHERE Training_ID = $tr_target";
		$conn->query($sql);
		mysqli_close($conn);
	}
	
	// F=19
	function get_training_list_table()
	{
		foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			//echo $key . ":" . $value . "\n";
		}
		include "connectionDb.php";
		$sql = "Select a.wd_id,b.gen, b.name, b.s_name, b.n_name, b.sex, b.tel, b.tel_2, d.PROVINCE_NAME From wd_training a Inner Join wd_db b ON a.wd_id = b.wd_id INNER Join add_districts c ON b.add_code = c.DISTRICT_CODE Inner Join add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID Where a.Training_ID = $tr_target Order By a.wd_id";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		
		$wd_id = "";
		$gen = "";
		$name = "";
		$s_name = "";
		$n_name = "";
		$sex = "";
		$tel = "";
		$prov = "";
		
		$tr_cnt = 0;
		while ($row = $res->fetch_assoc()){
			if ($tr_cnt == 1)
			{
				$wd_id .= "-,-";
				$gen .= "-,-";
				$name .= "-,-";
				$s_name .= "-,-";
				$n_name .= "-,-";
				$sex .= "-,-";
				$tel .= "-,-";
				$prov .= "-,-";
			}
			$wd_id .= $row['wd_id'];
			$gen .= $row['gen'];
			$name .= $row['name'];
			$s_name .= $row['s_name'];
			$n_name .= $row['n_name'];
			$sex .= $row['sex'];
			$tel .= $row['tel'];
			if (trim($row['tel_2']) != "")
			{
				$tel .= ", " . $row['tel_2'];
			}
			$prov .= $row['PROVINCE_NAME'];
			
			$tr_cnt = 1;
			
			
		}
		$data = array();
		$data['wd_id'] = $wd_id;
		$data['gen'] = $gen;
		$data['name'] = $name;
		$data['s_name'] = $s_name;
		$data['n_name'] = $n_name;
		$data['sex'] = $sex;
		$data['tel'] = $tel;
		$data['prov'] = $prov;
		
		echo json_encode($data);
		
	}
	
	
	// F=20
	function dl_excel_file_tr()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$tbl_f = array(
			"wd_id" => "รหัส",
			"name" => "ชื่อ",
			"s_name" => "นามสกุล",
			"n_name" => "ชื่อเล่น",
			"sex" => "เพศ",
			"wd_status" => "สถานะ",
			"gen" => "รุ่น",
			"birthday" => "วดป เกิด",
			"age" => "อายุ",
			"occ" => "อาชีพ",
			"occ_type" => "ประเภทอาชีพ",
			"occ_add" => "สถานที่ทำงาน",
			"education" => "สถานศึกษา",
			"address" => "ที่อยู่",
			"dis_name" => "ตำบล",
			"aum_name" => "อำเภอ",
			"prv_name" => "จังหวัด",
			"zip_code" => "รหัสไปรษณี",
			"geo_name" => "ภาค",
			"tel" => "เบอร์โทร",
			"tel_2" => "เบอร์โทรสำรอง",
			"email" => "อีเมล์",
			"soc_fb" => "Facebook",
			"soc_fb_2" => "Facebook2",
			"soc_line" => "Line",
			"soc_twitter" => "Twitter",
			"remark" => "หมายเหตุ"
		);
		
		$tbl_f_all = array();

		$column = array();
		for ($i = 'a'; $i < 'zz'; $i++) 
		{
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
		$sql = "SELECT a.wd_id , a.name , a.s_name , a.n_name , (Case WHEN a.sex = 0 THEN 'ชาย' WHEN a.sex = 1 THEN 'หญิง' END) AS sex , (Case WHEN a.status = 1 THEN 'Active' WHEN a.status = 2 THEN 'Non-Active' WHEN a.status = 3 THEN 'Banned' END) AS wd_status , a.gen ,CONCAT( DATE_FORMAT( a.birthday , '%d' ), '/', DATE_FORMAT( a.birthday , '%m' ) , '/', DATE_FORMAT( a.birthday , '%Y' ) +543) AS birthday, d.age , a.occ , c.occ_type , a.occ_add , a.education , a.address , b.dis_name , b.aum_name , b.prv_name , b.zip_code , b.geo_name , a.tel, a.tel_2 , a.email , a.soc_fb, a.soc_fb_2 , a.soc_line , a.soc_twitter , a.remark From wd_db a INNER Join all_address b ON a.add_code = b.dis_code INNER JOIN m_occ_type c ON a.occ_type = c.id INNER Join wd_cal_age d ON a.wd_id = d.wd_id Where a.wd_id in (Select a.wd_id from wd_training a WHERE a.Training_ID = $tr_target) ORDER By a.wd_id";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);

		// Set Active Sheet = 0
		$objPHPExcel->setActiveSheetIndex(0);

		// Print_page Heder
		$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
		$objPHPExcel->getActiveSheet()->setCellValue("A1", $tr_name);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		
		$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
		$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ".thai_date(date('U'))." เวลา ".date('H:i'));
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setItalic(true);

		// Print column Name
		$i_colum = 0;
		$i_row = 4;
		while ($property = mysqli_fetch_field($res)) {
			$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $tbl_f[$property->name]);
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
			$i_colum = 0;
			$i_row++;
			foreach ($tbl_f_all as $f_name) {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $row[$f_name]);
					$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFont()->setName('Leelawadee UI');
					
					if ($row['wd_status'] == "Banned")
					{
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleBan);
					}
					
					if ($row['wd_status'] == "คัดออกจากศูนย์")
					{
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleeject);
					}
					$i_colum++;
				}
				
		}
		/*
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
				if ($f_name == "CASE ID")
				{
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , substr($row[$f_name],0, 2).'-'.substr($row[$f_name],2, 2).'-'.substr($row[$f_name],4));
				}
				else
				{
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $row[$f_name]);
					if (is_numeric($row[$f_name]) and ($f_name != "CASE ID"))
					{
						$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getNumberFormat()->setFormatCode('#,##');
					}
				}
			}
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFont()->setName('Leelawadee UI');
			$i_colum++;
			}

		}
		

		}*/

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('ข้อมูลสมาชิกหมา');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		$file_name = "files/ข้อมูลสมาชิกหมา(อบรม)_".date('dmyH').gen_rnd_str(4);
		$file_name.= ".xlsx";
		$objWriter = new Xlsx($objPHPExcel);
		$objWriter->save($file_name);
		echo '<button type="button" class="btn btn-box-tool" onclick="location.href='."'".$file_name."'".'"> <i class="fa fa-file-excel-o"></i> Download Excel</button>';


	}


	/* OLD FUnction ===========================================================================================
	function dl_excel_file_tr_2()
	{
		foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+////]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			//echo $key . ":" . $value . "\n";
		}
		$tbl_f = array(
			"wd_id" => "รหัส",
			"name" => "ชื่อ",
			"s_name" => "นามสกุล",
			"n_name" => "ชื่อเล่น",
			"sex" => "เพศ",
			"wd_status" => "สถานะ",
			"gen" => "รุ่น",
			"birthday" => "วดป เกิด",
			"age" => "อายุ",
			"occ" => "อาชีพ",
			"occ_type" => "ประเภทอาชีพ",
			"occ_add" => "สถานที่ทำงาน",
			"education" => "สถานศึกษา",
			"address" => "ที่อยู่",
			"dis_name" => "ตำบล",
			"aum_name" => "อำเภอ",
			"prv_name" => "จังหวัด",
			"zip_code" => "รหัสไปรษณี",
			"geo_name" => "ภาค",
			"tel" => "เบอร์โทร",
			"tel_2" => "เบอร์โทรสำรอง",
			"email" => "อีเมล์",
			"soc_fb" => "Facebook",
			"soc_fb_2" => "Facebook2",
			"soc_line" => "Line",
			"soc_twitter" => "Twitter",
			"remark" => "หมายเหตุ"
		);
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
		$sql = "SELECT a.wd_id , a.name , a.s_name , a.n_name , (Case WHEN a.sex = 0 THEN 'ชาย' WHEN a.sex = 1 THEN 'หญิง' END) AS sex , (Case WHEN a.status = 1 THEN 'Active' WHEN a.status = 2 THEN 'Non-Active' WHEN a.status = 3 THEN 'Banned' END) AS wd_status , a.gen ,CONCAT( DATE_FORMAT( a.birthday , '%d' ), '/', DATE_FORMAT( a.birthday , '%m' ) , '/', DATE_FORMAT( a.birthday , '%Y' ) +543) AS birthday, d.age , a.occ , c.occ_type , a.occ_add , a.education , a.address , b.dis_name , b.aum_name , b.prv_name , b.zip_code , b.geo_name , a.tel, a.tel_2 , a.email , a.soc_fb, a.soc_fb_2 , a.soc_line , a.soc_twitter , a.remark From wd_db a INNER Join all_address b ON a.add_code = b.dis_code INNER JOIN m_occ_type c ON a.occ_type = c.id INNER Join wd_cal_age d ON a.wd_id = d.wd_id Where a.wd_id in (Select a.wd_id from wd_training a WHERE a.Training_ID = $tr_target) ORDER By a.wd_id";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		
		// Set Active Sheet = 0
		$objPHPExcel->setActiveSheetIndex(0);
		
		// Print_page Heder
		$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
		$objPHPExcel->getActiveSheet()->setCellValue("A1", $tr_name);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		
		$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
		$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ".thai_date(date('U'))." เวลา ".date('H:i'));
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setItalic(true);
		
		// Print column Name
		$i_colum = 0;
		$i_row = 4;
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
					
					if ($row['wd_status'] == "Banned")
					{
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleBan);
					}
					$i_colum++;
				}
				
		}

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('ข้อมูลสมาชิกหมา');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		// Save Excel 2007 file
		// File_name
		//$file_name = "test";
		$file_name = "files/WD_data_".date('dmyH').gen_rnd_str(4);
		$file_name.= ".xlsx";
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save($file_name);
		echo '<button type="button" class="btn btn-success btn-flat" onclick="location.href='."'".$file_name."'".'">Download</button>';
		//exec($file_name);
	}
	 OLD Function ===================================================================== */
	
	//F=21
	function add_tr_wd()
	{
		foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			//echo $key . ":" . $value . "\n";
		}
		include "connectionDb.php";
		//$sql = "UPDATE m_training_sjb SET location = '$tr_location', Training_Start = '$start_date', Training_End = '$end_date' WHERE Training_ID = $tr_target";
		//$conn->query($sql);
		$sql = "Select * From wd_training Where wd_id = '$tr_wd_id' And Training_ID = $tr_target";
		$res = $conn->query(trim($sql));
		if (($res->num_rows) == 0)
		{
			$sql = "Insert Into wd_training value ('$tr_wd_id', $tr_target)";
			$conn->query($sql);
			echo "0";
		}
		else
		{
			echo "1";
		}
		mysqli_close($conn);
	}
	
	
	// F=22
	function delete_tr_wd()
	{
		foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			//echo $key . ":" . $value . "\n";
		}
		
		include "connectionDb.php";
		
		$sql = "DELETE From wd_training WHERE wd_id = '$target' and Training_ID = $tr_id_target";
		$conn->query($sql);
		
		// Close connection
		mysqli_close($conn);
	}
	
	// F=23
	function load_yearly_target()
	{
		$current_year = date("Y");
		$tr_like_cnt = "0";
		$tr_pub_post = "0";
		$tr_dmg = "0";
		$tr_mem_add = "0";
		
		
		include "connectionDb.php";
		$sql = "SELECT * FROM `m_yearly_target` Where year = '$current_year'";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		
		if ($res->num_rows == 1 )
		{
			$row = $res->fetch_assoc();
			
			$tr_like_cnt = $row['like_cnt_target'];
			$tr_pub_post = $row['pub_post_cnt'];
			$tr_dmg = $row['dmg_target'];
			$tr_mem_add = $row['new_member'];
		}
		
		$data['current_year'] = $current_year;
		$data['tr_like_cnt'] = $tr_like_cnt;
		$data['tr_pub_post'] = $tr_pub_post;
		$data['tr_dmg'] = $tr_dmg;
		$data['tr_mem_add'] = $tr_mem_add;
		
		echo json_encode($data);

	}
	
	// F=24
	function save_yearly_target()
	{
		foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			//echo $key . ":" . $value . "\n";
		}
		
		include "connectionDb.php";
		// Delete Current yearly target 
		$sql = "DELETE From m_yearly_target WHERE year = $tr_year";
		$conn->query($sql);
		
		// add new yearly target 
		$sql = "Insert Into m_yearly_target value ($tr_year, $tr_like_cnt, $tr_pub_post, $tr_dmg, $tr_mem_add)";
		$conn->query($sql);
		
		// Close connection
		mysqli_close($conn);
	}
	
	
	
	
	// F=25
	function get_team_table()
	{
		foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			//echo $key . ":" . $value . "\n";
		}
		
		include "connectionDb.php";
		$sql = "Select a.team_ID, a.team_name, c.team_type_id, c.team_type_desc From m_wd_team a Inner Join m_wd_team_type_data b ON a.team_ID = b.team_id Inner Join m_wd_team_type c ON b.team_type_id = c.team_type_id ORDER By c.team_type_id";
		$res = $conn->query(trim($sql));
		
		
		
		$team_ID = "";
		$team_name = "";
		$team_type_ID = "";
		$team_type_desc = "";
		$cnt = 0;
		
		
		while ($row = $res->fetch_assoc()){
			
			if ($cnt != 0)
			{
				$team_ID .= "-,-";
				$team_name .= "-,-";
				$team_type_ID .= "-,-";
				$team_type_desc .= "-,-";
				
			}
			
			switch($row['team_type_id'])
			{
				case 1 :
				{
					$team_type_desc .= '<span class="label label-primary">'.$row['team_type_desc']."<span>";
					break;
				}
				
				case 2 :
				{
					$team_type_desc .= '<span class="label label-success">'.$row['team_type_desc']."<span>";
					break;
				}
				
				case 3 :
				{
					$team_type_desc .= '<span class="label label-danger">'.$row['team_type_desc']."<span>";
					break;
				}
			}
			
			
			$team_ID .= $row['team_ID'];
			$team_name .= $row['team_name'];
			$team_type_ID .= $row['team_type_id'];
			
			$cnt = 1;
		}
		
		
		
		
		$data['team_ID'] = $team_ID;
		$data['team_name'] = $team_name;
		$data['team_type_ID'] = $team_type_ID;
		$data['team_type_desc'] = $team_type_desc;
		
		echo json_encode($data);
		mysqli_close($conn);
	}
	
	// F=26
	function get_team_table_list()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		include "connectionDb.php";
		$sql = "SELECT b.wd_id, b.name, b.s_name, b.n_name, b.gen, d.PROVINCE_NAME, b.soc_fb, b.soc_fb_2 FROM `wd_team_data` a Inner Join wd_db b ON a.wd_id = b.wd_id INNER Join add_districts c ON b.add_code = c.DISTRICT_CODE INNER Join add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID WHERE a.team_ID = $team_target ORDER BY b.wd_id";
		$res = $conn->query(trim($sql));
		
		
		
		$wd_id = "";
		$wd_name = "";
		$wd_n_name = "";
		$wd_gen = "";
		$wd_prov = "";
		$wd_fb = "";
		$cnt = 0;
		
		
		while ($row = $res->fetch_assoc()){
			
			if ($cnt != 0)
			{
				$wd_id .= "-,-";
				$wd_name .= "-,-";
				$wd_n_name .= "-,-";
				$wd_gen .= "-,-";
				$wd_prov .= "-,-";
				$wd_fb .= "-,-";
				
			}
			$wd_id .= trim($row['wd_id']);
			$wd_name .= trim($row['name'])." ". trim($row['s_name']);
			$wd_n_name .= trim($row['n_name']);
			$wd_gen .= trim($row['gen']);
			$wd_prov .= trim($row['PROVINCE_NAME']);
			$wd_fb .= trim($row['soc_fb']);
			
			if (trim($row['soc_fb_2']) != "")
			{
				$wd_fb .= ", ".trim($row['soc_fb_2']);
			}
			$cnt = 1;
		}
		
		
		
		$data = array();
		$data['wd_id'] = $wd_id;
		$data['wd_name'] = $wd_name;
		$data['wd_n_name'] = $wd_n_name;
		$data['wd_gen'] = $wd_gen;
		$data['wd_prov'] = $wd_prov;
		$data['wd_fb'] = $wd_fb;
		
		echo json_encode($data);
		
		
		mysqli_close($conn);
	}
	
	// F=27
	function get_team_info()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		include "connectionDb.php";
		$sql = "Select a.*, c.team_type_desc from m_wd_team a Inner Join m_wd_team_type_data b ON a.team_ID = b.team_id INNER Join m_wd_team_type c ON b.team_type_id = c.team_type_id where a.team_ID = $team_target";
		//echo $sql;
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		
		echo json_encode($row);
		
		
		mysqli_close($conn);
	}
	
	// F=28
	function get_team_skill()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		include "connectionDb.php";
		// Get skill
		$sql = "SELECT * from m_team_skill Where team_ID = $team_target";
		$res = $conn->query(trim($sql));
		$all_skill_data = "";
		$skill_list_cnt = 0;
		while ($row = $res->fetch_assoc()){
			if ($skill_list_cnt == 1)
			{
				$all_skill_data .= ",";
			}
			$all_skill_data .= $row['skill'];
			$skill_list_cnt = 1;
		}
		
		echo $all_skill_data;
		
		
		mysqli_close($conn);
	}
	
	// F=29
	function add_team_member()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		include "connectionDb.php";
		// Get skill
		$sql = "Insert Into wd_team_data value ($team_target, '$wd_id')";
		$conn->query(trim($sql));
		mysqli_close($conn);
	}
	
	// F=30
	function delete_team_member()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		include "connectionDb.php";
		// Get skill
		$sql = "Delete from wd_team_data where team_ID = $team_target and wd_id = '$wd_id'";
		$conn->query(trim($sql));
		mysqli_close($conn);
	}
	
	// F=31
	function update_team_skill()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		include "connectionDb.php";
		// Update Skill
		$sql = "DELETE From m_team_skill WHERE team_ID = $team_target";  // Delete All first
		$conn->query($sql);
		$skill_arr =  (explode(",",$team_skill));
		//echo $skill_arr[0];
		if ($skill_arr[0] != '')
		{
			$skill_cnt_chk = 0 ;
			$ins_skill  = "";
			foreach ($skill_arr as $skill_list)
			{
				if ($skill_cnt_chk == 0)
				{
					$ins_skill = $ins_skill."Insert Into m_team_skill value('$team_target', '$skill_list')";
				}
				else 
				{
					$ins_skill = $ins_skill.",('$team_target', '$skill_list')";
				}
				$skill_cnt_chk = 1;
			}
			$conn->query($ins_skill);
		}
		
		mysqli_close($conn);
	}
	
	// F=32
	function get_team_type()
	{
		include "connectionDb.php";
		$get_ID = "SELECT * FROM `m_wd_team_type` Order By team_type_id";
		$res = $conn->query(trim($get_ID));
		//echo '<option selected disabled>== เลือก Staff ==</option>';
		while ($row = $res->fetch_assoc()){
			echo "<option value='".$row['team_type_id']."'>".$row['team_type_desc']."</option>";
		}
		mysqli_close($conn);
	}
	
	// F=33
	function add_new_team_v2()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		include "connectionDb.php";
		$ins_sql = "Insert Into m_wd_team(team_name, team_des) value ('$team_name', '$team_desc')";
		$conn->query($ins_sql);
		//echo $ins_sql;
		
		$get_ID = "Select max(team_ID) as max_ID From m_wd_team";
		$res = $conn->query(trim($get_ID));
		$row = $res->fetch_assoc();
		$id = $row['max_ID'];
		
		
		$sql = "Insert Into m_wd_team_type_data value ($id, $team_type)";
		$conn->query($sql);
		
		echo $id;
		mysqli_close($conn);
		//echo $id;
	}
	
	
	function load_team_data_v2()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		include "connectionDb.php";
		$sql = "Select a.team_name, a.team_des, b.team_type_id FROM m_wd_team a Inner Join m_wd_team_type_data b ON a.team_ID = b.team_id Where a.team_ID = $team_id";
		//echo $sql;
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		
		echo json_encode($row);
		mysqli_close($conn);
	}
	
	//F=35
	function update_team_v2()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		include "connectionDb.php";
		$ins_sql = "Update m_wd_team SET team_name = '$edt_team_name', team_des = '$edt_team_desc' WHERE team_ID = $team_id";
		$conn->query($ins_sql);
		
		
		$sql = "Update m_wd_team_type_data a SET a.team_type_id = $edt_team_type WHERE a.team_id = $team_id";
		$conn->query($sql);
		
		echo $team_id;
		
		mysqli_close($conn);
	}
	
	// f = 11
	function delete_team_v2()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		include "connectionDb.php";
		
		$sql = "DELETE From m_wd_team WHERE team_ID = $team_id";
		$conn->query($sql);
		
		$sql = "DELETE From m_team_skill WHERE team_ID = $team_id";
		$conn->query($sql);
		
		$sql = "DELETE From wd_team_data WHERE team_ID = $team_id";
		$conn->query($sql);
		
		$sql = "DELETE From m_wd_team_type_data WHERE team_ID = $team_id";
		$conn->query($sql);
		
		
		// Close connection
		mysqli_close($conn);
	}
	
	
	// F=37
	function get_team_sex_cnt()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		$sql = "SELECT IFNULL(b.cnt, 0) as cnt FROM m_sex a LEFT JOIN (Select c.sex, count(c.sex) as cnt From m_wd_team a Inner Join wd_team_data b ON a.team_ID = b.team_ID Inner Join wd_db c ON b.wd_id = c.wd_id WHERE a.team_ID = $team_id GROUP BY c.sex ) b ON a.sex_id = b.sex";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		
		$cnt_data = "";
		$cnt = 0;
		while ($row = $res->fetch_assoc()){
			if ($cnt == 1)
			{
				$cnt_data .= ",";
			}
			$cnt_data .= $row['cnt'];
			$cnt = 1;
		}
		
		echo $cnt_data;
		mysqli_close($conn);
	}
	
	// F=38
	function get_team_occ_cnt()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		$sql = "Select a.id, a.occ_type, IFNULL(b.cnt, 0) as cnt From m_occ_type a Left JOIN (SELECT c.id, c.occ_type, COUNT(c.occ_type) as cnt From wd_team_data a INNER Join wd_db b ON a.wd_id = b.wd_id INNER JOIN m_occ_type c ON b.occ_type = c.id Where a.team_ID = $team_id Group By c.occ_type,  c.id  ) b ON a.id = b.id ";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		
		$cnt_data = "";
		$label = "";
		$cnt = 0;
		while ($row = $res->fetch_assoc()){
			if ($cnt == 1)
			{
				$cnt_data .= "-,-";
				$label .= "-,-";
			}
			$cnt_data .= $row['cnt'];
			$label .= $row['occ_type'];
			$cnt = 1;
		}
		
		$data = array();
		$data['cnt_data'] = $cnt_data;
		$data['label'] = $label;
		
		echo json_encode($data);
		mysqli_close($conn);
	}
	
	
	// F=39
	function get_team_geo_data()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		$sql = "SELECT a.GEO_NAME, IFNULL(b.cnt, '-') as cnt FROM add_geography a LEFT Join (Select d.GEO_ID, count(d.GEO_ID) as cnt From wd_team_data a INNER Join wd_db b ON a.wd_id = b.wd_id INNER Join add_districts c ON b.add_code = c.DISTRICT_CODE INNER JOIN add_geography d ON c.GEO_ID = d.GEO_ID WHERE a.team_ID = $team_id GROUP By d.GEO_ID) b ON a.GEO_ID = b.GEO_ID ";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		echo '<Table class="table table-striped"><TR><TH>ภูมิภาค</TH><TH>สมาชิก</TH></TR>';
		while ($row = $res->fetch_assoc()){
			echo 	"<TR>";
			echo 	"<TD>".$row['GEO_NAME']."</TD>";
			echo 	"<TD>".$row['cnt']."</TD>";
			echo 	"<TR>";
			
		}
		
		echo "</Table>";
		
		
		mysqli_close($conn);
	}
	
	// F=40
	function get_staff_info_profile()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select a.key_ID, a.Name, b.s_name, b.nick_name, b.Position, c.img From staff a Inner Join staff_detail b ON a.key_ID = b.key_ID INNER Join staff_img c ON a.key_ID = c.key_ID WHERE a.key_ID = '$staff_ID'";
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
	function update_staff_user_profile_img()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		$sql = "update staff_img SET img = '$img' Where key_ID = $staff_ID";
		
		include "connectionDb.php";
		$conn->query($sql);
		mysqli_close($conn);		
	}
	
	// F=42
	function new_change_password()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		include "connectionDb.php";
		$SQL = "UPDATE staff set stf_pass = sha('$new_pw') Where key_ID = $staff_ID";
		if(!$conn->query($SQL))
		{
			echo ("<font color='#f56954'><big>Error!!</big></font>");
			exit();
		}
		echo ("<font color='#00a65a'><big>เปลี่ยนรหัสผ่านสำเร็จ</big></font>");
		
		
		
		mysqli_close($conn);
	}
	
	// F=43
	function add_new_event()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		include "connectionDb.php";
		$SQL = "Insert Into m_event_list(`event_name`, `Training_ID`, `event_type`, `start`, `end`, `active`) Values ('$event_name', $tr_id_target, $event_type, '$event_start', '$event_end', 1)";
		if(!$conn->query($SQL))
		{
			exit();
		}
		mysqli_close($conn);
	}
	
	// F=44
	function get_event_list()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "SELECT * FROM m_event_list Where Training_ID = $tr_id_target AND active = 1 Order by start";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	//F=45
	function deactive_event()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		include "connectionDb.php";
		$SQL = "Update m_event_list Set active = 0 Where event_id = $del_target";
		if(!$conn->query($SQL))
		{
			exit();
		}
		mysqli_close($conn);
	}
	
	// F=46
	function get_event_hdr()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		//$sql = "SELECT a.event_name, a.start, a.end, b.Training_subject, b.location FROM m_event_list a Inner Join m_training_sjb b ON a.Training_ID = b.Training_ID Where a.event_id = $event_id";
		$sql = "SELECT a.event_name, a.start, a.end, b.Training_subject, b.location, c.count_join_wd FROM m_event_list a Inner Join m_training_sjb b ON a.Training_ID = b.Training_ID Inner Join (Select a.event_id, count(b.wd_id) as count_join_wd From m_event_list a INNER Join wd_training b ON a.Training_ID = b.Training_ID Where a.event_id = $event_id ) c ON a.event_id = c.event_id Where a.event_id = $event_id";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
			
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		mysqli_close($conn);	
		echo json_encode($data_Array);
	}
	
	
	// F=47
	function get_event_table_detail()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		//$sql = "SELECT a.event_id, b.Training_ID, c.wd_id, d.name, d.s_name, d.n_name, d.gen, d.tel, d.tel_2, e.time_stmp FROM m_event_list a Inner Join m_training_sjb b ON a.Training_ID = b.Training_ID Inner Join wd_training c ON b.Training_ID = c.Training_ID INNER Join wd_db d ON c.wd_id = d.wd_id Left Join m_event_data e ON a.event_id = e.event_id AND c.wd_id = e.wd_id where a.event_id = $event_id Order by d.gen, d.wd_id";
		$sql = "SELECT a.event_id, b.Training_ID, c.wd_id, d.name, d.s_name, d.n_name, d.gen, d.tel, d.tel_2, e.time_stmp FROM m_event_list a Inner Join m_training_sjb b ON a.Training_ID = b.Training_ID Inner Join wd_training c ON b.Training_ID = c.Training_ID INNER Join wd_db d ON c.wd_id = d.wd_id Left Join (Select * From m_event_data a Where a.event_id = $event_id Group By a.wd_id, a.event_id) e ON a.event_id = e.event_id AND c.wd_id = e.wd_id where a.event_id = $event_id Order by d.gen, d.wd_id";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	// F=48
	function add_option_for_vote()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		include "connectionDb.php";
		$SQL = "Insert into m_vote_option_for_event(event_id, value) values ($current_target_add_event, '$new_vote')";
		if(!$conn->query($SQL))
		{
			exit();
		}
		mysqli_close($conn);
	}
	
	function load_vote_list_data()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql= "Select * FROM m_vote_option_for_event a Where a.event_id = $current_target_add_event order by value";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	// F=50
	function delete_option()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		include "connectionDb.php";
		$SQL = "delete FROM m_vote_option_for_event Where vote_id = $del_target";
		if(!$conn->query($SQL))
		{
			exit();
		}
		mysqli_close($conn);
	}
	
	// F=51
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
	// F=52
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
	// F=53
	function get_eva_result()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		//$sql = "SELECT option_value_1, count(option_value_1) as cnt FROM m_event_data WHERE event_id = $event_id Group BY option_value_1";
		$sql = "Select a.option_value_1 as item_data, round(avg(CONVERT(a.option_value_2, SIGNED INTEGER)), 2) as average, max(CONVERT(a.option_value_2, SIGNED INTEGER)) as max, min(CONVERT(a.option_value_2, SIGNED INTEGER)) as min, STD(CONVERT(a.option_value_2, SIGNED INTEGER)) as SD From m_event_data a Where a.event_id = $event_id AND a.option_value_1 <> 'ข้อเสนอแนะ' Group By a.option_value_1 Order by a.option_value_1";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	// F=54
	function get_eva_comment()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "SELECT b.n_name, b.gen, b.wd_img, a.option_value_2  as msg From m_event_data a Inner Join wd_db b ON a.wd_id = b.wd_id Where a.event_id = $event_id AND a.option_value_1 = 'ข้อเสนอแนะ' AND TRIM(a.option_value_2) <> ''";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	
	
	// F=55
	function dl_excel_file_team()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$tbl_f = array(
			"wd_id" => "รหัส",
			"name" => "ชื่อ",
			"s_name" => "นามสกุล",
			"n_name" => "ชื่อเล่น",
			"sex" => "เพศ",
			"wd_status" => "สถานะ",
			"gen" => "รุ่น",
			"birthday" => "วดป เกิด",
			"age" => "อายุ",
			"occ" => "อาชีพ",
			"occ_type" => "ประเภทอาชีพ",
			"occ_add" => "สถานที่ทำงาน",
			"education" => "สถานศึกษา",
			"address" => "ที่อยู่",
			"dis_name" => "ตำบล",
			"aum_name" => "อำเภอ",
			"prv_name" => "จังหวัด",
			"zip_code" => "รหัสไปรษณี",
			"geo_name" => "ภาค",
			"tel" => "เบอร์โทร",
			"tel_2" => "เบอร์โทรสำรอง",
			"email" => "อีเมล์",
			"soc_fb" => "Facebook",
			"soc_fb_2" => "Facebook2",
			"soc_line" => "Line",
			"soc_twitter" => "Twitter",
			"remark" => "หมายเหตุ"
		);
		
		$tbl_f_all = array();

		$column = array();
		for ($i = 'a'; $i < 'zz'; $i++) 
		{
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
		//$sql = "SELECT a.wd_id , a.name , a.s_name , a.n_name , (Case WHEN a.sex = 0 THEN 'ชาย' WHEN a.sex = 1 THEN 'หญิง' END) AS sex , (Case WHEN a.status = 1 THEN 'Active' WHEN a.status = 2 THEN 'Non-Active' WHEN a.status = 3 THEN 'Banned' END) AS wd_status , a.gen ,CONCAT( DATE_FORMAT( a.birthday , '%d' ), '/', DATE_FORMAT( a.birthday , '%m' ) , '/', DATE_FORMAT( a.birthday , '%Y' ) +543) AS birthday, d.age , a.occ , c.occ_type , a.occ_add , a.education , a.address , b.dis_name , b.aum_name , b.prv_name , b.zip_code , b.geo_name , a.tel, a.tel_2 , a.email , a.soc_fb, a.soc_fb_2 , a.soc_line , a.soc_twitter , a.remark From wd_db a INNER Join all_address b ON a.add_code = b.dis_code INNER JOIN m_occ_type c ON a.occ_type = c.id INNER Join wd_cal_age d ON a.wd_id = d.wd_id Where a.wd_id in (Select a.wd_id from wd_training a WHERE a.Training_ID = $tr_target) ORDER By a.wd_id";
		$sql = "Select b.* From wd_team_data a Inner Join (SELECT a.wd_id , a.name , a.s_name , a.n_name , (Case WHEN a.sex = 0 THEN 'ชาย' WHEN a.sex = 1 THEN 'หญิง' END) AS sex , (Case WHEN a.status = 1 THEN 'Active' WHEN a.status = 2 THEN 'Idle' WHEN a.status = 3 THEN 'Banned' WHEN a.status = 4 THEN 'คัดออกจากศูนย์' END) AS wd_status , a.gen ,CONCAT( DATE_FORMAT( a.birthday , '%d' ), '/', DATE_FORMAT( a.birthday , '%m' ) , '/', DATE_FORMAT( a.birthday , '%Y' ) +543) AS birthday, d.age , a.occ , c.occ_type , a.occ_add , a.education , a.address , b.dis_name , b.aum_name , b.prv_name , b.zip_code , b.geo_name , a.tel, a.tel_2 , a.email , a.soc_fb, a.soc_fb_2 , a.soc_line , a.soc_twitter , a.remark From wd_db a INNER Join all_address b ON a.add_code = b.dis_code INNER JOIN m_occ_type c ON a.occ_type = c.id INNER Join wd_cal_age d ON a.wd_id = d.wd_id ORDER By a.wd_id ) b ON a.wd_id = b.wd_id Where a.team_ID = $cur_team_id";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);

		// Set Active Sheet = 0
		$objPHPExcel->setActiveSheetIndex(0);

		// Print_page Heder
		$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
		$objPHPExcel->getActiveSheet()->setCellValue("A1", $cur_team_name);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		
		$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
		$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ".thai_date(date('U'))." เวลา ".date('H:i'));
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setItalic(true);

		// Print column Name
		$i_colum = 0;
		$i_row = 4;
		while ($property = mysqli_fetch_field($res)) {
			$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $tbl_f[$property->name]);
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
			$i_colum = 0;
			$i_row++;
			foreach ($tbl_f_all as $f_name) {
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $row[$f_name]);
					$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFont()->setName('Leelawadee UI');
					
					if ($row['wd_status'] == "Banned")
					{
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleBan);
					}
					
					if ($row['wd_status'] == "คัดออกจากศูนย์")
					{
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleeject);
					}
					$i_colum++;
				}
				
		}
		/*
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
				if ($f_name == "CASE ID")
				{
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , substr($row[$f_name],0, 2).'-'.substr($row[$f_name],2, 2).'-'.substr($row[$f_name],4));
				}
				else
				{
					$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $row[$f_name]);
					if (is_numeric($row[$f_name]) and ($f_name != "CASE ID"))
					{
						$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getNumberFormat()->setFormatCode('#,##');
					}
				}
			}
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFont()->setName('Leelawadee UI');
			$i_colum++;
			}

		}
		*/
		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('ข้อมูลสมาชิกหมา');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		$file_name = "files/ข้อมูลสมาชิกหมา(ทีม)_".date('dmyH').gen_rnd_str(4);
		$file_name.= ".xlsx";
		$objWriter = new Xlsx($objPHPExcel);
		$objWriter->save($file_name);
		//echo '<button type="button" class="btn btn-box-tool" onclick="location.href='."'".$file_name."'".'"> <i class="fa fa-file-excel-o"></i> Download Excel</button>';
		echo $file_name;
	}

	/* Old Function ============================================================
	function dl_excel_file_team_2()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+/////]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		$tbl_f = array(
			"wd_id" => "รหัส",
			"name" => "ชื่อ",
			"s_name" => "นามสกุล",
			"n_name" => "ชื่อเล่น",
			"sex" => "เพศ",
			"wd_status" => "สถานะ",
			"gen" => "รุ่น",
			"birthday" => "วดป เกิด",
			"age" => "อายุ",
			"occ" => "อาชีพ",
			"occ_type" => "ประเภทอาชีพ",
			"occ_add" => "สถานที่ทำงาน",
			"education" => "สถานศึกษา",
			"address" => "ที่อยู่",
			"dis_name" => "ตำบล",
			"aum_name" => "อำเภอ",
			"prv_name" => "จังหวัด",
			"zip_code" => "รหัสไปรษณี",
			"geo_name" => "ภาค",
			"tel" => "เบอร์โทร",
			"tel_2" => "เบอร์โทรสำรอง",
			"email" => "อีเมล์",
			"soc_fb" => "Facebook",
			"soc_fb_2" => "Facebook2",
			"soc_line" => "Line",
			"soc_twitter" => "Twitter",
			"remark" => "หมายเหตุ"
		);
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
			
			
		// Set document properties
		$objPHPExcel->getProperties()->setCreator("WD_System")
									 ->setLastModifiedBy("WD_System");
									 
		// Query Data
		include "connectionDb.php";
		//$sql = "SELECT a.wd_id , a.name , a.s_name , a.n_name , (Case WHEN a.sex = 0 THEN 'ชาย' WHEN a.sex = 1 THEN 'หญิง' END) AS sex , (Case WHEN a.status = 1 THEN 'Active' WHEN a.status = 2 THEN 'Idle' WHEN a.status = 3 THEN 'Banned' WHEN a.status = 4 THEN 'คัดออกจากศูนย์' END) AS wd_status , a.gen ,CONCAT( DATE_FORMAT( a.birthday , '%d' ), '/', DATE_FORMAT( a.birthday , '%m' ) , '/', DATE_FORMAT( a.birthday , '%Y' )  +543) AS birthday, d.age , a.occ , c.occ_type , a.occ_add , a.education , a.address , b.dis_name , b.aum_name , b.prv_name , b.zip_code , b.geo_name , a.tel, a.tel_2 , a.email , a.soc_fb, a.soc_fb_2 , a.soc_line , a.soc_twitter , a.remark From wd_db a INNER Join all_address b ON a.add_code = b.dis_code INNER JOIN m_occ_type c ON a.occ_type = c.id INNER Join wd_cal_age d ON a.wd_id = d.wd_id ORDER By a.wd_id";
		$sql = "Select b.* From wd_team_data a Inner Join (SELECT a.wd_id , a.name , a.s_name , a.n_name , (Case WHEN a.sex = 0 THEN 'ชาย' WHEN a.sex = 1 THEN 'หญิง' END) AS sex , (Case WHEN a.status = 1 THEN 'Active' WHEN a.status = 2 THEN 'Idle' WHEN a.status = 3 THEN 'Banned' WHEN a.status = 4 THEN 'คัดออกจากศูนย์' END) AS wd_status , a.gen ,CONCAT( DATE_FORMAT( a.birthday , '%d' ), '/', DATE_FORMAT( a.birthday , '%m' ) , '/', DATE_FORMAT( a.birthday , '%Y' ) +543) AS birthday, d.age , a.occ , c.occ_type , a.occ_add , a.education , a.address , b.dis_name , b.aum_name , b.prv_name , b.zip_code , b.geo_name , a.tel, a.tel_2 , a.email , a.soc_fb, a.soc_fb_2 , a.soc_line , a.soc_twitter , a.remark From wd_db a INNER Join all_address b ON a.add_code = b.dis_code INNER JOIN m_occ_type c ON a.occ_type = c.id INNER Join wd_cal_age d ON a.wd_id = d.wd_id ORDER By a.wd_id ) b ON a.wd_id = b.wd_id Where a.team_ID = $cur_team_id";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		
		// Set Active Sheet = 0
		$objPHPExcel->setActiveSheetIndex(0);
		
		// Print_page Heder
		$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
		$objPHPExcel->getActiveSheet()->setCellValue("A1", $cur_team_name);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		
		$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
		$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ".thai_date(date('U'))." เวลา ".date('H:i'));
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setItalic(true);
		
		// Print column Name
		$i_colum = 0;
		$i_row = 4;
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
					
					if ($row['wd_status'] == "Banned")
					{
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleBan);
					}
					
					if ($row['wd_status'] == "คัดออกจากศูนย์")
					{
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleeject);
					}
					$i_colum++;
				}
				
		}

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('ข้อมูลสมาชิกหมา');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		// Save Excel 2007 file
		// File_name
		//$file_name = "test";
		$file_name = "files/WD_team_".$cur_team_name."_".date('dmyH').gen_rnd_str(2);
		$file_name.= ".xlsx";
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save($file_name);
		//exec($file_name);
		//echo '<button type="button" class="btn btn-success btn-flat" onclick="location.href='."'".$file_name."'".'">Download</button>';
		echo $file_name;
	}
	Old Function ==================================================== */

	// F=56
	function load_yearly_target_2()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select * From m_yearly_target_2 Where year = $tr_year ";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}

	// 57
	function update_yearly_target()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		// Delete Current Value
		include "connectionDb.php";
		$SQL = "Delete From m_yearly_target_2 Where year = $tr_year AND target_type = '$target_type'";
		if(!$conn->query($SQL))
		{
			exit();
		}

		// Update New value
		$SQL = "Insert Into  m_yearly_target_2 value($tr_year, '$target_type', $target_value)";
		if(!$conn->query($SQL))
		{
			exit();
		}

		mysqli_close($conn);
	}
	
	// 58
	function get_qr_code_for_access_app()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		// Delete Current Value
		include "connectionDb.php";
		// Check is Exist ot not
		$chk_sql = "Select * From staff_access_code a Where a.Stf_id = '$staff_ID' AND a.expire >= CURRENT_DATE()";
		$res = $conn->query(trim($chk_sql));
		if (mysqli_num_rows($res) == 0)
		{
			// Generate QR 
			$Token = gen_rnd_str(8);
			$crt_sql = "Insert Into staff_access_code value('$staff_ID', '$Token', DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL 2 YEAR))";
			if(!$conn->query($crt_sql))
			{
				exit();
			}
			$res = $conn->query(trim($chk_sql));
			$data_Array = array();
		}
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		mysqli_close($conn);
		echo json_encode($data_Array);
		
		
	}
	
	
	
	
	
	
	//============================ MAIN =========================================================
	switch($f)
	{
		case 1 :
		{
			add_new_staff();
			break;
		}
		
		case 2 :
		{
			check_avilable_ID($p1);
			break;
		}
		
		case 3 :
		{
			check_all_user_list();
			break;
		}
		case 4 :
		{
			load_staff_data($p1);
			break;
		}
		
		case 5 :
		{
			change_password($p1, $p2);
			break;
		}
		
		case 6 :
		{
			update_staff_info();
			break;
		}
		
		case 7 :
		{
			check_all_team_list();
			break;
		}
		case 8 :
		{
			get_Max_Team_ID();
			break;
		}
		case 9 :
		{
			add_new_team($p1, $p2, $p3);
			break;
		}
		
		case 10 :
		{
			load_team_data($p1);
			break;
		}
		
		case 11:
		{
			delete_team($p1);
			break;
		}
		case 12:
		{
			load_wd_info($p1);
			break;
		}
		case 13:
		{
			update_team($p1,$p2,$p3,$p4,$p5);
			break;
		}
		case 14:
		{
			get_max_gen();
			break;
		}
		
		case 15:
		{
			save_new_training();
			break;
		}
		
		case 16:
		{
			get_training_list();
			break;
		}
		case 17:
		{
			get_training_info();
			break;
		}
		
		case 18:
		{
			update_training_info();
			break;
		}
		case 19:
		{
			get_training_list_table();
			break;
		}
		
		case 20:
		{
			dl_excel_file_tr();
			break;
		}
		
		case 21:
		{
			add_tr_wd();
			break;
		}
		
		case 22:
		{
			delete_tr_wd();
			break;
		}
		
		case 23:
		{
			load_yearly_target();
			break;
		}
		
		case 24:
		{
			save_yearly_target();
			break;
		}
		case 25:
		{
			get_team_table();
			break;
		}
		case 26:
		{
			get_team_table_list();
			break;
		}
		case 27:
		{
			get_team_info();
			break;
		}
		
		case 28:
		{
			get_team_skill();
			break;
		}
		case 29:
		{
			add_team_member();
			break;
		}
		case 30:
		{
			delete_team_member();
			break;
		}
		
		case 31:
		{
			update_team_skill();
			break;
		}
		
		case 32:
		{
			get_team_type();
			break;
		}
		
		case 33:
		{
			add_new_team_v2();
			break;
		}
		
		case 34:
		{
			load_team_data_v2();
			break;
		}
		
		case 35:
		{
			update_team_v2();
			break;
		}
		
		case 36:
		{
			delete_team_v2();
			break;
		}
		case 37:
		{
			get_team_sex_cnt();
			break;
		}
		
		case 38:
		{
			get_team_occ_cnt();
			break;
		}
		
		case 39:
		{
			get_team_geo_data();
			break;
		}
		case 40:
		{
			get_staff_info_profile();
			break;
		}
		
		case 41:
		{
			update_staff_user_profile_img();
			break;
		}
		
		case 42:
		{
			new_change_password();
			break;
		}
		case 43:
		{
			add_new_event();
			break;
		}
		case 44:
		{
			get_event_list();
			break;
		}
		case 45:
		{
			deactive_event();
			break;
		}
		
		case 46:
		{
			get_event_hdr();
			break;
		}
		
		case 47:
		{
			get_event_table_detail();
			break;
		}
		
		case 48:
		{
			add_option_for_vote();
			break;
		}
		case 49:
		{
			load_vote_list_data();
			break;
		}
		case 50:
		{
			delete_option();
			break;
		}
		case 51:
		{
			get_vote_result_table();
			break;
		}
		case 52:
		{
			get_vote_result_chart();
			break;
		}
		case 53:
		{
			get_eva_result();
			break;
		}
		case 54:
		{
			get_eva_comment();
			break;
		}
		case 55:
		{
			dl_excel_file_team();
			break;
		}
		case 56:
		{
			load_yearly_target_2();
			break;
		}
		case 57:
		{
			update_yearly_target();
			break;
		}
		
		case 58:
		{
			get_qr_code_for_access_app();
			break;
		}
		
		









	}
?>