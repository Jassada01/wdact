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
	
	function gen_rnd_num($length = 5) {
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
	function get_province_name()
	{
		// Connect to MySQL Database
		include "connectionDb.php";
		$sql = "Select a.PROVINCE_ID, a.PROVINCE_NAME from add_provinces a Inner Join add_provinces_order b ON a.PROVINCE_NAME = b.province_name Order By b.No";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		// Echo select header
		
		echo '<option selected disabled>== กรุณาเลือกจังหวัด ==</option>';
		
		while ($row = $res->fetch_assoc()){
			echo '<Option Value="'.$row['PROVINCE_ID'].'">'.$row['PROVINCE_NAME'].'</Option>';
		}
	}
	
	
	// 2
	function get_aumpher_name($province_ID, $add_amp_id)
	{
		// Connect to MySQL Database
		include "connectionDb.php";
		$sql = "Select AMPHUR_ID, AMPHUR_NAME from add_amphures WHERE PROVINCE_ID = $province_ID AND AMPHUR_NAME NOT LIKE '%*%' ORDER BY AMPHUR_ID";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		
		// Echo select header
		if ( $add_amp_id == 0)
		{
			echo '<option selected disabled>== กรุณาเลือกอำเภอ ==</option>';
		}
		else
		{
			echo '<option disabled>== กรุณาเลือกอำเภอ ==</option>';
		}
		
		
		while ($row = $res->fetch_assoc()){
			if ($add_amp_id == $row['AMPHUR_ID'])
			{
				echo '<Option Value="'.$row['AMPHUR_ID'].'" selected>'.$row['AMPHUR_NAME'].'</Option>';
			}
			else
			{
				echo '<Option Value="'.$row['AMPHUR_ID'].'">'.$row['AMPHUR_NAME'].'</Option>';
			}
			
		}
	}
	
	// 3
	function get_district_name($aumpher_ID, $district_id)
	{
		// Connect to MySQL Database
		include "connectionDb.php";
		$sql = "Select DISTRICT_CODE, DISTRICT_NAME, DISTRICT_ID from add_districts WHERE AMPHUR_ID = $aumpher_ID  AND DISTRICT_NAME NOT LIKE '%*%'";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		
		// Echo select header
		if ( $district_id == 0)
		{
			echo '<option selected disabled>== กรุณาเลือกตำบล ==</option>';
		}
		else
		{
			echo '<option disabled>== กรุณาเลือกตำบล ==</option>';
		}
		
		while ($row = $res->fetch_assoc()){
			if ($district_id == $row['DISTRICT_ID'])
			{
				echo '<Option Value="'.$row['DISTRICT_CODE'].'" selected>'.$row['DISTRICT_NAME'].'</Option>';
			}
			else
			{
				echo '<Option Value="'.$row['DISTRICT_CODE'].'">'.$row['DISTRICT_NAME'].'</Option>';
			}
		}
	}
	
	// 4
	function get_GEO_name($province_ID)
	{
		// Connect to MySQL Database
		include "connectionDb.php";
		$sql = "SELECT g.GEO_NAME From add_provinces p INNER JOIN add_geography g ON p.GEO_ID = g.GEO_ID WHERE p.PROVINCE_ID = $province_ID ";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		$row = $res->fetch_assoc();
		echo $row['GEO_NAME'];
	}
	
	// 5
	function get_zipcode($district_code)
	{
		// Connect to MySQL Database
		include "connectionDb.php";
		$sql = "SELECT zipcode From add_zipcodes WHERE district_code = $district_code";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		$row = $res->fetch_assoc();
		echo $row['zipcode'];
	}
	
	// 6
	function get_traing_list()
	{
		// Connect to MySQL Database
		include "connectionDb.php";
		$sql = "SELECT Training_subject, training_type, Training_ID FROM m_training_sjb ORDER BY Training_ID";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		
		echo '<option selected disabled>== เลือกการอบรม ==</option>';
		
		while ($row = $res->fetch_assoc()){
			echo '<Option Value="'.$row['Training_ID'].'">'.$row['Training_subject'].'</Option>';
		}
	}
	
	// 5
	function get_occ_type()
	{
		// Connect to MySQL Database
		include "connectionDb.php";
		$sql = "Select * from m_occ_type ORDER By id";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		
		echo '<option selected disabled>== เลือกกลุ่มอาชีพ ==</option>';
		
		while ($row = $res->fetch_assoc()){
			echo '<Option Value="'.$row['id'].'">'.$row['occ_type'].'</Option>';
		}
	}
	
	// 8
	function save_data()
	{
		$data=array();
		
		foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		// Change dob to sql
		$m_dob_arr = explode("/", $m_dob);
		$m_dob = ($m_dob_arr[2] - 543)."-".$m_dob_arr[1]."-".$m_dob_arr[0];
		$m_status = 1;
		if (isset($_POST['m_status']) )
		{
			$m_status = $_POST['m_status'];
		}
		
		
		$ins = "INSERT INTO `wd_db` (`wd_id`, `status`, `gen`, `name`, `s_name`, `n_name`, `birthday`, `sex`, `occ`, `occ_type`, `occ_add`, `education`, `address`, `add_code`, `tel`, `tel_2`, `email`, `soc_fb`,`soc_fb_2`, `soc_line`, `soc_twitter`, `wd_img`, `remark`) VALUES ('$m_id ', $m_status, $m_gen, '$m_name', '$m_sname', '$m_nickname', '$m_dob', $m_sex, '$m_occ', $m_occ_type, '$m_occ_loc', '$m_edu', '$m_add', $m_add_district, '$m_tel', '$m_tel_2','$m_email', '$m_facebook', '$m_facebook_2','$m_line', '$m_twitter', '$img', '$m_remark')";
		//echo $ins;
		// Connect to MySQL Database
		
		$chk_result_insert = "";
		include "connectionDb.php";
		if(!$conn->query($ins))
		{
			$chk_result_insert .= "Error Insert user data!!";
			exit();
		}
	
		
		//echo $skill_data;
		$m_skill_arr = explode("-,-", $skill_data);
		if (!((count($m_skill_arr) == 1) and $m_skill_arr[0] == ""))
		{
			$skill_cnt_chk = 0;
			$ins_skill = "";
			foreach ($m_skill_arr as $skill_list)
			{
				if ($skill_cnt_chk == 0)
				{
					$ins_skill = $ins_skill."Insert Into wd_skill value('$m_id', '$skill_list', '$m_id".gen_rnd_str(8)."')";
				}
				else 
				{
					$ins_skill = $ins_skill." ,('$m_id', '$skill_list', '$m_id".gen_rnd_str(8)."')";
				}
				$skill_cnt_chk = 1;
			}
			
			//echo $ins_skill;
			if(!$conn->query($ins_skill))
			{
				$chk_result_insert .= "Error!!";
				exit();
			}
			
		}
		
		//echo $skill_data;
		$m_traning_arr = explode("-,-", $traning_data);
		if (!((count($m_traning_arr) == 1) and $m_traning_arr[0] == ""))
		{
			$training_cnt_chk = 0;
			$ins_training = "";
			foreach ($m_traning_arr as $training_list)
			{
				if ($training_cnt_chk == 0)
				{
					$ins_training = $ins_training."Insert Into wd_training value('$m_id', $training_list)";
				}
				else 
				{
					$ins_training = $ins_training.",('$m_id', $training_list)";
				}
				$training_cnt_chk = 1;
			}
			
			//echo $ins_training;
			if(!$conn->query($ins_training))
			{
				$chk_result_insert .= "Error!!";
				exit();
			}
			
		}
		
		//Update _team list
		$m_team_arr = explode(",", $team_data);
		if (!((count($m_team_arr) == 1) and $m_team_arr[0] == ""))
		{
			$team_cnt_chk = 0;
			$ins = "";
			foreach ($m_team_arr as $team_id_list)
			{
				if ($team_cnt_chk == 0)
				{
					$ins = $ins."Insert Into wd_team_data value('$team_id_list', '$m_id')";
				}
				else 
				{
					$ins = $ins.",('$team_id_list', '$m_id')";
				}
				$team_cnt_chk = 1;
			}
			
			//echo $ins_skill;
			if(!$conn->query($ins))
			{
				$chk_result_insert .= "Error!!";
				exit();
			}
			
		}
		
		
		mysqli_close($conn);
		echo trim($chk_result_insert);
	}
	
	// F=9
	function check_m_id($m_id)
	{
		$query_sql = "Select count(*) as cnt From wd_db WHERE wd_id = '$m_id' ";
		include "connectionDb.php";
		$res = $conn->query(trim($query_sql));
		mysqli_close($conn);
		
		$row = $res->fetch_assoc();
		if ($row['cnt'] != 0)
		{
			echo "<font color='red'>รหัสซ้ำกับข้อมูลที่มีอยู่แล้ว</font>";
		}
	}
	
	
	// F=10
	function get_result_after_finish_save($m_id)
	{
		include "connectionDb.php";
		
		$sql = "Select a.*, b.DISTRICT_NAME, c.AMPHUR_NAME, d.PROVINCE_NAME, e.zipcode, f.GEO_NAME ,(Case WHEN a.sex = 0 THEN 'ชาย' WHEN a.sex = 1 THEN 'หญิง' END) AS sex_text ,g.occ_type from wd_db a INNER Join add_districts b ON a.add_code = b.DISTRICT_CODE INNER JOIN add_amphures c ON b.AMPHUR_ID = c.AMPHUR_ID INNER JOIN add_provinces d on b.PROVINCE_ID = d.PROVINCE_ID INNER JOIN add_zipcodes e ON b.DISTRICT_CODE = e.district_code INNER JOIN add_geography f ON d.GEO_ID = f.GEO_ID INNER JOIN m_occ_type g ON a.occ_type = g.id WHERE a.wd_id = '$m_id' ";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		//while($rowx = $res->fetch_assoc()){
		//	$columns[] = $rowx['Field'];
		//}
		foreach($row as $key => $value)
		{
			if (trim($value) == "")
			{
				$value = "-";
			}
			$$key = $value;
		}
		// Calculate Age
		$thai_date_text = thai_date(date_format(date_create($birthday), 'U'));
		$now = new DateTime();
		$interval = $now->diff(date_create($birthday));
		$age = $interval->y;
		
		// Create Status label
		switch ($status) {
			case 1:
				$status_string = '<small class="label bg-blue">Active WatchDog</small>';
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
		
		// Get skill
		$sql = "SELECT * From wd_skill Where Wd_id = '$m_id'";
		$res = $conn->query(trim($sql));
		$all_skill_data = "";
		while ($row = $res->fetch_assoc()){
			$all_skill_data .= " ".$row['wd_skill'];
		}
		
		mysqli_close($conn);

		//echo date_create_from_format('Y-m-d', $birthday);
		//echo  date_format(date_create($birthday), 'U');
		echo '
		<h5><B>ข้อมูลส่วนบุคคล</B></h5>
							<div class="row">
								<div class="col-sm-2">
								</div>
								<div class="col-sm-10">
									'.$status_string.'<Br>
									รหัส : '.$m_id.'	รุ่นที่ : '.$gen.' <Br>
									ชื่อ '.$name.' '.$s_name.'  ชื่อเล่น '.$n_name.'<Br>
									เกิด '.$thai_date_text.' อายุ '.$age.' ปี <Br>
									เพศ '.$sex_text.' 
								</div>
							</div>
							
							<hr>
							<h5><B>ที่อยู่</B></h5>
							<div class="row">
								<div class="col-sm-2">
								</div>
								<div class="col-sm-10">
									ที่อยู่ : '.$address.' <Br>
									'.$DISTRICT_NAME.' '.$AMPHUR_NAME.' '.$PROVINCE_NAME.' '.$zipcode.' <Br>
									โทร : '.$tel.' Email : '.$email.' <Br>
									Facebook : <a href="https://web.facebook.com/search/top/?q='.$soc_fb.'"  target="_blank">'.$soc_fb.'</a><Br>
									Line : '.$soc_line.'<Br>
									Twitter : '.$soc_twitter.' 
								</div>
							</div>
							
							<hr>
							<h5><B>อาชีพและการศึกษา</B></h5>
							<div class="row">
								<div class="col-sm-2">
								</div>
								<div class="col-sm-10">
									อาชีพ : '.$occ.' ('.$occ_type.') <Br>
									การศึกษา : '.$education.' <Br>
									ความเชียวชาญ : '.$all_skill_data.'
								</div>
							</div>
							
							<hr>
							<h5><B>หมายเหตุ</B></h5>
							<div class="row">
								<div class="col-sm-2">
								</div>
								<div class="col-sm-10">
									'.$remark.'
								</div>
							</div>
							<hr>
							<div class="btn-toolbar">
								<button type="button" class="btn btn-warning pull-right" onclick="window.location.href='."'".'22_member-edit.php?id='.$m_id.''."'".'"><i class="fa fa-fw fa-pencil"></i>แก้ไขเพิ่มเติม</button>
								<button type="button" class="btn btn-primary pull-right" onclick="window.location.href='."'".'20_member-add.php'."'".'"><i class="fa fa-fw fa-plus"></i> เพิ่มข้อมูลอาสาสมัครอื่น</button>
							</div>
';
	}
	
	
	// F=11
	function generate_code_for_new_member($m_gen)
	{
		include "connectionDb.php";
		$query_check = "SELECT count(*) as check_data FROM `m_training_sjb` Where gen_code = $m_gen ";
		$res = $conn->query(trim($query_check));
		$row = $res->fetch_assoc();
		
		if ($row['check_data'] == 1)
		{
			$query_sql = "Select IFNULL(max(CONVERT(substring(wd_id,6,3), UNSIGNED INTEGER)),0)as max_in_gen from wd_db Where gen = $m_gen  ";	
			$res = $conn->query(trim($query_sql));
			$row = $res->fetch_assoc();
			$new_id = sprintf('%03d',$row['max_in_gen'] + 1);
			
			$query_year = "Select (YEAR(Training_Start) + 543) as year From m_training_sjb WHERE gen_code = $m_gen";
			$res = $conn->query(trim($query_year));
			$row = $res->fetch_assoc();
			$year_id = substr((string)$row['year'], 2, 2);
			
			
			$gen_id =  sprintf('%03d',$m_gen);
			
			$id = $year_id.$gen_id.$new_id;
			echo $id;
		}
		else
		{
			echo "ไม่มีการอบรบรุ่น $m_gen";
		}
		
		
			
		//echo $row['max_in_gen'];
		
		mysqli_close($conn);
	}
	
	// F=12
	function get_member_data($m_id)
	{
		usleep(500000);
		include "connectionDb.php";
		//$sql = "SELECT * From wd_db a INNER JOIN add_districts b ON a.add_code = b.DISTRICT_CODE Where a.wd_id = '$m_id' ";
		$sql = "SELECT * ,DATE_FORMAT(DATE_ADD(a.birthday, INTERVAL 543 YEAR), '%d%m%Y') as dob From wd_db a INNER JOIN add_districts b ON a.add_code = b.DISTRICT_CODE Where a.wd_id = '$m_id'  ";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		$data = array();
		foreach($row as $key => $value)
		{
			$data[$key] = $value;
		}
		$data['wd_img'] = "img/wd_img/" . $data['wd_img'];
		
		// Get skill
		$sql = "SELECT * From wd_skill Where Wd_id = '$m_id'";
		$res = $conn->query(trim($sql));
		$all_skill_data = "";
		$skill_list_cnt = 0;
		while ($row = $res->fetch_assoc()){
			if ($skill_list_cnt == 1)
			{
				$all_skill_data .= ",";
			}
			$all_skill_data .= $row['wd_skill'];
			$skill_list_cnt = 1;
		}
		$data['all_skill'] = $all_skill_data;
		
		// Get traing subject
		//$sql = "SELECT * FROM wd_training WHERE wd_id = '$m_id'";
		$sql = "SELECT a.Training_ID, b.Training_subject FROM wd_training a Inner Join m_training_sjb b ON a.Training_ID = b.Training_ID Where a.wd_id = '$m_id'";
		$res = $conn->query(trim($sql));
		$all_training_data = "";
		$all_training_id = "";
		$training_list_cnt = 0;
		while ($row = $res->fetch_assoc()){
			if ($training_list_cnt == 1)
			{
				$all_training_data .= ",";
				$all_training_id .= ",";
			}
			$all_training_data .= $row['Training_subject'];
			$all_training_id .= $row['Training_ID'];
			$training_list_cnt = 1;
		}
		$data['all_training'] = $all_training_data;
		$data['all_training_id'] = $all_training_id;
		
		
		// Get team data
		$sql = "Select a.team_ID, b.team_name From wd_team_data a Inner Join m_wd_team b ON a.team_ID = b.team_ID Where a.wd_id = '$m_id'";
		$res = $conn->query(trim($sql));
		$all_team_data = "";
		$all_team_name = "";
		$team_list_cnt = 0;
		while ($row = $res->fetch_assoc()){
			if ($team_list_cnt == 1)
			{
				$all_team_data .= ",";
				$all_team_name .= ",";
			}
			$all_team_data .= $row['team_ID'];
			$all_team_name .= $row['team_name'];
			$team_list_cnt = 1;
		}
		$data['team_data'] = $all_team_data;
		$data['team_name'] = $all_team_name;
		
		// Close connection
		mysqli_close($conn);
		
		echo json_encode($data);
	}
	
	// F=13
	function update_data()
	{
		$m_id = $_POST['m_id'];
		include "connectionDb.php";
		
		// wd_db delete data
		$qry = "Delete From wd_db Where wd_id = '$m_id '";
		if(!$conn->query($qry))
		{
			$chk_result_insert .= "Error delete user data!!";
			exit();
		}
		
		// wd Skill delete data
		$qry = "Delete From wd_skill Where wd_id = '$m_id '";
		if(!$conn->query($qry))
		{
			$chk_result_insert .= "Error delete user data!!";
			exit();
		}
		
		// wd Skill delete data
		$qry = "Delete From wd_training Where wd_id = '$m_id '";
		if(!$conn->query($qry))
		{
			$chk_result_insert .= "Error delete user data!!";
			exit();
		}
		
		// wd team delete data
		$qry = "Delete From wd_team_data Where wd_id = '$m_id '";
		if(!$conn->query($qry))
		{
			$chk_result_insert .= "Error delete user data!!";
			exit();
		}
		mysqli_close($conn);
		save_data();
	}
	
	// F=14
	function get_status()
	{
		// Connect to MySQL Database
		include "connectionDb.php";
		$sql = "SELECT * FROM m_wd_status Order By render ";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
				
		while ($row = $res->fetch_assoc()){
			echo '<Option Value="'.$row['wd_status_id'].'">'.$row['wd_status_dec'].'</Option>';
		}
	}
	
	// F= 15
	function load_team_list()
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
	
	// F=16
	function get_team_skill($team_id)
	{
		//echo $team_id;
		include "connectionDb.php";
		$sql = "Select a.team_ID, a.skill, b.team_name From m_team_skill a Inner Join m_wd_team b ON a.team_ID = b.team_ID WHERE a.team_ID in ($team_id) ";
		$res = $conn->query(trim($sql));
		$all_skill_data = "";
		$skill_list_cnt = 0;
		while ($row = $res->fetch_assoc()){
			if ($skill_list_cnt == 1)
			{
				$all_skill_data .= ",";
			}
			$all_skill_data .= $row['skill']."(".$row['team_name'].")";
			$skill_list_cnt = 1;
		}
		
		echo $all_skill_data;
		
		mysqli_close($conn);
		
	}
	
	function dl_excel_file()
	{
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
		
		
		/** Error reporting */
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Asia/Bangkok');

		/** Include PHPExcel */
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
		$sql = "SELECT a.wd_id , a.name , a.s_name , a.n_name , (Case WHEN a.sex = 0 THEN 'ชาย' WHEN a.sex = 1 THEN 'หญิง' END) AS sex , (Case WHEN a.status = 1 THEN 'Active' WHEN a.status = 2 THEN 'Idle' WHEN a.status = 3 THEN 'Banned' WHEN a.status = 4 THEN 'คัดออกจากศูนย์' END) AS wd_status , a.gen ,CONCAT( DATE_FORMAT( a.birthday , '%d' ), '/', DATE_FORMAT( a.birthday , '%m' ) , '/', DATE_FORMAT( a.birthday , '%Y' )  +543) AS birthday, d.age , a.occ , c.occ_type , a.occ_add , a.education , a.address , b.dis_name , b.aum_name , b.prv_name , b.zip_code , b.geo_name , a.tel, a.tel_2 , a.email , a.soc_fb, a.soc_fb_2 , a.soc_line , a.soc_twitter , a.remark From wd_db a INNER Join all_address b ON a.add_code = b.dis_code INNER JOIN m_occ_type c ON a.occ_type = c.id INNER Join wd_cal_age d ON a.wd_id = d.wd_id ORDER By a.wd_id";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		
		// Set Active Sheet = 0
		$objPHPExcel->setActiveSheetIndex(0);
		
		// Print_page Heder
		$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
		$objPHPExcel->getActiveSheet()->setCellValue("A1", "ข้อมูลสมาชิกหมาเฝ้าบ้าน");
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
		$file_name = "files/WD_data_".date('dmyH').gen_rnd_str(4);
		$file_name.= ".xlsx";
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save($file_name);
		//exec($file_name);
		echo '<button type="button" class="btn btn-success btn-flat" onclick="location.href='."'".$file_name."'".'">Download</button>';
	}
	
	// F=18
	function ban_wd()
	{
		
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		include "connectionDb.php";
		// Get Remark temp
		$sql = "Select remark from wd_db Where wd_id = '$wd_id'";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		$update_date = date("d/m/").(string)(date("Y")+543);
		$remark = trim($row['remark']).", ".$update_date." : Ban ด้วยสาเหตุ ".$ban_reason;
		
		// Update Status
		$sql = "Update wd_db set status = 3, remark = '$remark'  Where wd_id = '$wd_id'";
		$conn->query(trim($sql));
		 
		 // Update Remark
		//$sql = "Update wd_db set remark = '$remark' Where wd_id = '$wd_id'";
		//$conn->query(trim($sql));
		
		
		// Insert  activity log
		$sql = "Insert Into  wd_activity_log value ('$wd_id', 91, 'Ban ด้วยสาเหตุ : $ban_reason', CURDATE(), '')";
		$conn->query(trim($sql));
		 // Update Remark		 
		//$get_ID = "Select * From m_wd_team Order By team_id";
		mysqli_close($conn);
		//echo $row['remark'];
		//echo $remark;
	}
	
	// F=19
	function get_gen_id()
	{
		foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			//echo $key . ":" . $value . "\n";
		}
		include "connectionDb.php";
		$sql = "SELECT Training_ID FROM `m_training_sjb` WHERE gen_code = $gen";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		$row = $res->fetch_assoc();
		
		// Prepare data
		$data = array();
		$data['Training_ID'] = $row['Training_ID'];
		echo json_encode($data);
	}
	
	
	// F=20
	function get_wd_data()
	{
		foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			//echo $key . ":" . $value . "\n";
		}
		//echo $wd_id;
		$data = array();
		
		include "connectionDb.php";
		
		// Get basic information
		$sql = "SELECT * FROM `wd_db` WHERE wd_id = '$wd_id'";
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
				$status_string = '<small class="label bg-yellow">Idle WatchDog</small>';
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
	
		// F=21
	function get_wd_basic_data()
	{
		foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			//echo $key . ":" . $value . "\n";
		}
		//echo $wd_id;
		$data = array();
		
		include "connectionDb.php";
		
		// Get basic information
		$sql = "Select * From wd_db a Inner Join call_all_address2 b ON a.add_code = b.DISTRICT_CODE INNER JOIN m_occ_type c ON a.occ_type = c.id Where a.wd_id = '$wd_id'";
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
		$sql = "Select team_name From wd_team_data a Inner Join m_wd_team b ON a.team_ID = b.team_ID Where a.wd_id = '$wd_id'";
		$res = $conn->query(trim($sql));
		$team_data = "";
		while ($row = $res->fetch_assoc())
		{	
			$team_data .='<span class="label label-danger">'.$row['team_name'].'</span>	&nbsp;';
		}
		$data['team_data'] = $team_data;
		
		
		// personal Skill information
		$sql = "SELECT * From wd_skill Where wd_id = '$wd_id'";
		$res = $conn->query(trim($sql));
		$personal_skill_data = "";
		while ($row = $res->fetch_assoc())
		{	
			$personal_skill_data .='<span class="label label-success">'.$row['wd_skill'].'</span>	&nbsp;';
		}
		
		$data['personal_skill_data'] = $personal_skill_data;
		
		// Team Skill information
		$sql = "Select a.*, b.team_name From m_team_skill a Inner Join m_wd_team b ON a.team_ID = b.team_ID WHERE a.team_ID in (Select a.team_ID From wd_team_data a Where a.wd_id = '$wd_id')";
		$res = $conn->query(trim($sql));
		$team_skill_data = "";
		while ($row = $res->fetch_assoc())
		{	
			$team_skill_data .='<span class="label label-info">'.$row['skill'].'('.$row['team_name'].')</span>	&nbsp;';
		}
		
		$data['team_skill_data'] = $team_skill_data;
		
		
		
		
		mysqli_close($conn);
		echo json_encode($data);
	}
	
	
	// F=22
	function kick_wd()
	{
		
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		
		include "connectionDb.php";
		// Get Remark temp
		$sql = "Select remark from wd_db Where wd_id = '$wd_id'";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		$update_date = date("d/m/").(string)(date("Y")+543);
		$remark = trim($row['remark']).", ".$update_date." : คัดออกจากศูนย์ ด้วยสาเหตุ ".$ban_reason;
		
		// Update Status
		$sql = "Update wd_db set status = 4, remark = '$remark' Where wd_id = '$wd_id'";
		$conn->query(trim($sql));
		 
		 // Update Remark
		//$sql = "Update wd_db set remark = '$remark' Where wd_id = '$wd_id'";
		//$conn->query(trim($sql));
		
		
		// Insert  activity log
		$sql = "Insert Into  wd_activity_log value ('$wd_id', 92, 'คัดออกจากศูนย์ ด้วยสาเหตุ : $ban_reason', CURDATE(), '')";
		$conn->query(trim($sql));
		
		 // Update Remark		 
		//$get_ID = "Select * From m_wd_team Order By team_id";
		mysqli_close($conn);
		//echo $row['remark'];
		//echo $remark;
	}
	
	// F=23
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
Select a.wd_id , 11 as timeline_type , b.Training_subject   as activity , b.Training_End as activity_date , '' as url From wd_db a INNER Join m_training_sjb b ON a.gen = b.gen_code Where a.wd_id = '$wd_id'
Union all
SELECT a.wd_id, 12 as timeline_type, b.Training_subject as detail, b.Training_End, '' as url FROM wd_training a Inner Join m_training_sjb b ON a.Training_ID = b.Training_ID Where a.wd_id = '$wd_id' and b.gen_code = 0
Union all 
Select * From  wd_activity_log Where wd_id = '$wd_id' 
Union all
Select a.name, 21 as timeline_type, b.topic as detail, a.snd_date, b.case_cnt_url From case_sender a Inner Join wd_case b ON a.case_id = b.case_id WHERE a.name = '$wd_id'
Union all
Select a.wd_id, 22 as timeline_type, b.topic as detail, b.add_date, b.case_cnt_url as url From case_wd_support a Inner Join wd_case b ON a.case_id = b.case_id Where a.wd_id = '$wd_id'
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
					$item_text = "เข้ารับการอบรม";
					$item_text_detail = "เข้ารับการอบรม ".$row['activity'];
					break;
				}
				
				case 12 :
				{
					$item_icon = "<i class='fa fa-lightbulb-o bg-green'></i>";
					$item_text = "เข้ารับการอบรม";
					$item_text_detail = "เข้ารับการอบรม ".$row['activity'];
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
	
	
	
	// F=24
	function member_json_data()
	{
		include "connectionDb.php";
		//$sql = "Select * From wd_db a Inner Join all_address b ON a.add_code = b.dis_code";
		$sql = "SELECT a.wd_id, a.gen, a.name, a.s_name, a.n_name, a.birthday, a.occ, c.occ_type, d.sex_desc, e.wd_status_dec , a.education, a.soc_fb, a.soc_fb_2, b.prv_name, b.geo_name From wd_db a INNER JOIN all_address b ON a.add_code = b.dis_code INNER JOIN m_occ_type c ON a.occ_type = c.id INNER Join m_sex d ON a.sex = d.sex_id INNER JOIN m_wd_status e ON a.status = e.wd_status_id Order By a.wd_id";
		$res = $conn->query(trim($sql));
		
		$data_Array = array();
		$occ_maxlenght = 30;
		while ($row = $res->fetch_array()){
			$data = [];
			$data[] = $row['wd_id'];
			//$data[] = $row['gen'];
			$data[] = sprintf("%02d", $row['gen']);
			$data[] = $row['name']." ".$row['s_name'];
			$data[] = $row['n_name'];
			
			// Cal age
			$age = date_diff(date_create($row['birthday']), date_create('now'))->y;
			$data[] = $age;
			
			// Trim occ
			//$occ = $row['occ_type'];
			//if (strlen($row['occ']) >= $occ_maxlenght)
			//{
			//		$occ = mb_substr($row['occ'], 0, $occ_maxlenght)."...";
			//}
			$data[] = $row['occ_type'];
			
			$data[] = $row['sex_desc'];
			$data[] = $row['wd_status_dec'];
			$data[] = $row['education'];
			$data[] = $row['prv_name'];
			$data[] = $row['geo_name'];
			
			// Facebook_create
			$fb_data = $row['soc_fb'];
			if (trim($row['soc_fb_2']) != "")
			{
				$fb_data .= ", ".$row['soc_fb_2'];
			}
			$data[] = $fb_data;
			$data_Array[] = $data;
		}
		echo json_encode($data_Array);
		
		mysqli_close($conn);
	}
	
	
	
	// F=25
	function get_wd_send_case_data()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select a.case_id, b.topic, b.t_sum,  a.snd_date, b.case_cnt_url, b.status From case_sender a INNER Join wd_case b ON a.case_id = b.case_id WHERE a.name = '$wd_id' Order By a.snd_date DESC";
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
	
	// F=26
	function get_wd_support_case_data()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select a.case_id, b.topic, b.t_sum , b.case_cnt_url, b.status From case_wd_support a INNER Join wd_case b ON a.case_id = b.case_id WHERE a.wd_id = '$wd_id' Order By a.case_id DESC";
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
	
	// F=27
	function get_wd_team_support_case_data()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select a.team_ID,b.case_id, b.topic, b.t_sum , b.case_cnt_url, b.status, c.team_name From wd_team_data a INNER Join case_team_support x ON a.team_ID = x.team_id Inner Join wd_case b ON x.case_id = b.case_id INNER Join m_wd_team c ON a.team_ID = c.team_ID where a.wd_id = '$wd_id' Order By b.case_id DESC";
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
	
	
	// F=29
	function get_wd_score()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select * From wd_point Where wd_id = '$wd_id'";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	function get_training_history()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select b.* From wd_training a  Inner Join m_training_sjb b ON a.Training_ID = b.Training_ID Where a.wd_id = '$wd_id'  Order By b.Training_Start";
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
	function get_user_token_data()
	{
		//$main_server="127.0.0.1";
		#$main_server="35.198.198.205";
		#$main_url = "http://$main_server/WD_system/user_profile.php?token=";
		$main_server="www.wdact.co";
		$main_url = "https://$main_server/WD_system/user_profile.php?token=";
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select * From wd_access_code Where wd_id = '$wd_id' AND expire = (Select MAX(expire) From wd_access_code Where wd_id = '$wd_id')";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$row = $res->fetch_assoc();
		echo $main_url.$row['token'];
		
		
	}
	
	function set_new_password_for_member()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		include "connectionDb.php";
		$rnd_num = gen_rnd_num();
		$sql = "Update wd_access_password SET pwd = '$rnd_num', temp_flg = 'Y' Where wd_id = '$wd_id'";
		$conn->query(trim($sql));
		echo $rnd_num;
		mysqli_close($conn);
	}
	
	//F=32
	function add_wd_to_bin()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		include "connectionDb.php";
		//$rnd_num = gen_rnd_num();
		//$sql = "Update wd_access_password SET pwd = '$rnd_num', temp_flg = 'Y' Where wd_id = '$wd_id'";
		$sql = "SELECT count(*) as cnt FROM `wd_trash` Where wd_id='$wd_id'";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()){
			if ($row['cnt']  == 1)
			{
				//$sql = "Insert into wd_trash Value('$wd_id', CURRENT_TIMESTAMP())";
				$sql = "Delete From wd_trash where wd_id='$wd_id'";
				$conn->query(trim($sql));
			}
			else
			{
				$sql = "Insert into wd_trash Value('$wd_id', CURRENT_TIMESTAMP())";
				$conn->query(trim($sql));
			}
		}
		
		mysqli_close($conn);
	}
	
	function check_trash_status()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		//$sql = "Select b.* From wd_training a  Inner Join m_training_sjb b ON a.Training_ID = b.Training_ID Where a.wd_id = '$wd_id'  Order By b.Training_Start";
		$sql = "SELECT count(*) as cnt FROM `wd_trash` Where wd_id='$wd_id'";
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
	
	//F=34
	function load_next_wd()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		#$sql = "Select a.wd_id From wd_db a Where a.wd_id > '$wd_id' AND a.status IN (1, 2) Limit 1";
		$sql = "Select a.wd_id From wd_db a Where a.wd_id > '$wd_id'  Limit 1";
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


	
	
	//============================ MAIN =========================================================
	switch($f)
	{
		case 1 :
		{
			get_province_name();
			break;
		}
		
		case 2 :
		{
			get_aumpher_name($p1, $p2);
			break;
		}
		
		case 3 :
		{
			get_district_name($p1, $p2);
			break;
		}
		  
		case 4 :
		{
			get_GEO_name($p1);
			break;
		}
		
		case 5 :
		{
			get_zipcode($p1);
			break;
		}
		
		case 6 :
		{
			get_traing_list();
			break;
		}
		
		case 7 :
		{
			get_occ_type();
			break;
		}
		
		case 8 :
		{
			save_data();
			break;
		}
		
		case 9 :
		{
			check_m_id($p1);
			break;
		}
		
		case 10 :
		{
			get_result_after_finish_save($p1);
			break;
		}
		case 11 :
		{
			generate_code_for_new_member($p1);
			//echo $p1;
			break;
		}
		case 12:
		{
			get_member_data($p1);
			//echo $p1;
			break;
		}
		
		case 13:
		{
			update_data();
			break;
		}
		
		case 14:
		{
			get_status();
			break;
		}
		case 15:
		{
			load_team_list();
			break;
		}
		
		case 16:
		{
			get_team_skill($p1);
			break;
		}
		
		case 17:
		{
			dl_excel_file();
			break;
		}
		case 18:
		{
			ban_wd();
			break;
		}
		case 19:
		{
			get_gen_id();
			break;
		}
		case 20:
		{
			get_wd_data();
			break;
		}
		
		case 21:
		{
			get_wd_basic_data();
			break;
		}
		case 22:
		{
			kick_wd();
			break;
		}
		
		case 23:
		{
			get_timeline_data();
			break;
		}
		
		case 24:
		{
			member_json_data();
			break;
		}
		case 25:
		{
			get_wd_send_case_data();
			break;
		}
		case 26:
		{
			get_wd_support_case_data();
			break;
		}
		case 27:
		{
			get_wd_team_support_case_data();
			break;
		}
		case 28:
		{
			get_wd_score();
			break;
		}
		case 29:
		{
			get_training_history();
			break;
		}
		case 30:
		{
			get_user_token_data();
			break;
		}
		case 31:
		{
			set_new_password_for_member();
			break;
		}
		case 32:
		{
			add_wd_to_bin();
			break;
		}
		case 33:
		{
			check_trash_status();
			break;
		}
		case 34:
		{
			load_next_wd();
			break;
		}
		
		
		

		
	}
?>