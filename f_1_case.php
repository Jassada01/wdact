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
		$thai_date_return = "วัน".$thai_day_arr[date("w",$time)];
		//$thai_date_return = "";
		$thai_date_return.= " ที่ ".date("j",$time);
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


	function download_case_img($case_id, $url, $type)
	{
		#load File
		$target_dir = "files/case_img/";
		$file_name =  gen_rnd_str() . ".jpg";
		$full_file_name = $target_dir . $file_name;
		file_put_contents( $full_file_name,file_get_contents($url));

		include "connectionDb.php";

		# count is 2 exist
		$cnt_sql = "Select * From case_img where case_id = '$case_id' AND attr_1 = '2'";
		$res = $conn->query(trim($cnt_sql));
		if (mysqli_num_rows($res) == 0)
		{
			#Delete Exist file name
			$del_sql = "Delete From case_img where case_id = '$case_id' ";
			if(!$conn->query($del_sql))
			{
				echo  $conn->errno;
				exit();
			}
			#save file to location
			$ins_sql = "Insert Into case_img value ('$case_id', '$full_file_name', CURRENT_TIMESTAMP, '$type', '$file_name')";
			if(!$conn->query($ins_sql))
			{
				echo  $conn->errno;
				exit();
			}
		}
		mysqli_close($conn);

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
		
		echo '<option selected disabled>== จังหวัด ==</option>';
		
		while ($row = $res->fetch_assoc()){
			echo '<Option Value="'.$row['PROVINCE_ID'].'">'.$row['PROVINCE_NAME'].'</Option>';
		}
	}
	
	
	// 2
	function get_aumpher_name($province_ID, $add_amp_id)
	{
		// Connect to MySQL Database
		include "connectionDb.php";
		$sql = "Select AMPHUR_CODE, AMPHUR_NAME from add_amphures WHERE PROVINCE_ID = $province_ID AND AMPHUR_NAME NOT LIKE '%*%' ORDER BY AMPHUR_ID";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		
		// Echo select header
		if ( $add_amp_id == 0)
		{
			echo '<option selected disabled>== อำเภอ ==</option>';
		}
		else
		{
			echo '<option disabled>== อำเภอ ==</option>';
		}
		
		
		while ($row = $res->fetch_assoc()){
			if ($add_amp_id == $row['AMPHUR_ID'])
			{
				echo '<Option Value="'.$row['AMPHUR_CODE'].'" selected>'.$row['AMPHUR_NAME'].'</Option>';
			}
			else
			{
				echo '<Option Value="'.$row['AMPHUR_CODE'].'">'.$row['AMPHUR_NAME'].'</Option>';
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
	function get_case_type($case_type)
	{
		// Connect to MySQL Database
		include "connectionDb.php";
		$sql = "Select * From m_crp_type ";
		$res = $conn->query(trim($sql));
		
		mysqli_close($conn);
		echo '<option selected disabled>== ประเภทการทุจริต ==</option>';
		
		while ($row = $res->fetch_assoc()){
			if ($case_type == $row['id'])
			{
				echo '<Option Value="'.$row['id'].'" selected>'.$row['crp_type'].'</Option>';
			}
			else
			{
				echo '<Option Value="'.$row['id'].'">'.$row['crp_type'].'</Option>';
			}
		}
		
		
	}
	
	
	// F=6
	function get_staff_list()
	{
		include "connectionDb.php";
		$get_ID = "Select a.key_ID, b.Name, b.nick_name From staff a Inner JOIN staff_detail b ON a.key_ID = b.key_ID WHERE a.active = 1 ORDER By a.key_ID";
		$res = $conn->query(trim($get_ID));
		echo '<option selected disabled>== เลือก Staff ==</option>';
		while ($row = $res->fetch_assoc()){
			//echo "<option value='".$row['key_ID']."'>".$row['Name']." ( ".$row['nick_name']." )</option>";
			echo "<option value='".$row['key_ID']."'>".$row['nick_name']."</option>";
		}
		mysqli_close($conn);
	}
	
	// F=7
	function get_all_Gen()
	{
		include "connectionDb.php";
		$get_ID = "SELECT DISTINCT(gen) From wd_db order by gen ";
		$res = $conn->query(trim($get_ID));
		echo '<option selected disabled>เลือกรุ่น</option>';
		while ($row = $res->fetch_assoc()){
			echo "<option value='".$row['gen']."'>รุ่นที่ ".$row['gen']."</option>";
		}
		mysqli_close($conn);
	}
	
	// F=8
	function get_name_in_gen($gen)
	{
		include "connectionDb.php";
		$get_ID = "SELECT wd_id, name, n_name From wd_db Where wd_db.gen = $gen and wd_db.status = 1 ORDER BY wd_db.n_name";
		$res = $conn->query(trim($get_ID));
		echo "<option selected disabled value='0'>เลือกสมาชิกหมา</option>";
		while ($row = $res->fetch_assoc()){
			echo "<option value='".$row['wd_id']."'>".$row['n_name']." - ".$row['name']."</option>";
		}
		mysqli_close($conn);
	}
	
	//F=9
	function add_case_data()
	{
		foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		// Input to system Date
		$create_date_arr = explode("/", $datepicker);
		$create_date = $create_date_arr[2]."-".$create_date_arr[1]."-".$create_date_arr[0];
		// Finished Date
		$create_date_arr = explode("/", $datepicker3);
		$finished_date = $create_date_arr[2]."-".$create_date_arr[1]."-".$create_date_arr[0];
		
		
		// Generate case ID
		include "connectionDb.php";
		$case_id = $c_ID;
		
		echo $case_id;
		// Ofd_dmg
		if (trim($ofd_dmg) == "")
		{
			$ofd_dmg = "0";
		}
		// Ofd_dmg2
		if (trim($ofd_dmg2) == "")
		{
			$ofd_dmg2 = "0";
		}
		
		
		// cannot_esiamate_dmg
		if ($cannot_esiamate_dmg == 'true')
		{
			$cannot_esiamate_dmg_c = "1";
		}
		else
		{
			$cannot_esiamate_dmg_c = "0";
		}
		
		// create INS SQL for main WD data
		$ins_sql = "Insert Into wd_case value ('$case_id', $c_priority, $c_status, '$c_name', '$c_summary', '$create_date', '$finished_date', '$c_note', '$c_fld_url', '$c_cnt_url', $cannot_esiamate_dmg_c, $ofd_dmg, $ofd_dmg2, $Input_staff, current_timestamp())";
		//echo $ins_sql ;
		if(!$conn->query(trim($ins_sql)))
		{
			echo  $conn->errno;
			exit();
		}
		
		
		// Create case name and location info
		$ofd_list_arr = explode("-,-", $ofd_list);
		$ofd_type_arr = explode("-,-", $ofd_type);
		$ofd_address_arr = explode("-,-", $ofd_address);
		$ofd_type_2_arr = explode("-,-", $ofd_type_2);
		if (!((count($ofd_list_arr) == 1) and $ofd_list_arr[0] == ""))
		{
			$cnt_chk = 0;
			$ins_sql = "";
			$i_cnt = 0;
			foreach ($ofd_list_arr as $ofd_list__data)
			{
				$ofd_type_data  = $ofd_type_arr [$i_cnt];
				$ofd_address_data  = $ofd_address_arr [$i_cnt];
				$ofd_type_2_data  = $ofd_type_2_arr [$i_cnt];
				
				if ($cnt_chk == 0)
				{
					$ins_sql = "INSERT INTO case_ofd_info VALUE ('$case_id', '$ofd_list__data','$ofd_type_2_data',  $ofd_type_data, '$ofd_address_data')";
				}
				else 
				{
					$ins_sql = $ins_sql." ,('$case_id', '$ofd_list__data','$ofd_type_2_data', $ofd_type_data, '$ofd_address_data')";
				}
				$cnt_chk = 1;
				$i_cnt +=1;
			}
			
			//echo $ins_sql;
			if(!$conn->query($ins_sql))
			{
				echo  $conn->errno;
				exit();
			}
		}
		
		
		
		
		// Insert Case crption type
		$case_ofd_real_id_arr = explode("-,-", $case_ofd_real_id_);
		$case_ofd_real_data_arr = explode("-,-", $case_ofd_real_data_);
		
		if (!((count($case_ofd_real_id_arr) == 1) and $case_ofd_real_id_arr[0] == ""))
		{
			$cnt_chk = 0;
			$ins_sql = "";
			$i_cnt = 0;
			foreach ($case_ofd_real_id_arr as $case_ofd_real_id)
			{
				$case_ofd_real_data = $case_ofd_real_data_arr[$i_cnt];
				$ran_str = $case_id.gen_rnd_str(5);
				if ($cnt_chk == 0)
				{
					$ins_sql = "INSERT INTO case_crp_type_data VALUE ('$case_id', $case_ofd_real_id, '$case_ofd_real_data', '$ran_str')";
				}
				else 
				{
					$ins_sql = $ins_sql." , ('$case_id', $case_ofd_real_id, '$case_ofd_real_data', '$ran_str')";
				}
				$cnt_chk = 1;
				$i_cnt +=1;
			}
			
			//echo $ins_sql;
			if(!$conn->query($ins_sql))
			{
				echo  $conn->errno;
				exit();
			}
		}
		
		// Create case operator data
		$staff_list_ar = explode("-,-", $staff_list_arr);
		if (!((count($staff_list_ar) == 1) and $staff_list_ar[0] == ""))
		{
			$cnt_chk = 0;
			$ins_sql = "";
			$i_cnt = 0;
			foreach ($staff_list_ar as $staff_list_data)
			{
				
				if ($cnt_chk == 0)
				{
					$ins_sql = "INSERT INTO case_operator VALUE ('$case_id', $staff_list_data)";
				}
				else 
				{
					$ins_sql = $ins_sql." , ('$case_id', $staff_list_data)";
				}
				$cnt_chk = 1;
				$i_cnt +=1;
			}
			
			//echo $ins_sql;
			if(!$conn->query($ins_sql))
			{
				echo  $conn->errno;
				exit();
			}
		}
		
		
		// Create case wd support
		$wd_join_ar = explode("-,-", $wd_join_arr);
		$wd_join_type_arx = explode("-,-", $wd_join_type_arr);
		if (!((count($wd_join_ar) == 1) and $wd_join_ar[0] == ""))
		{
			$cnt_chk = 0;
			$ins_sql = "";
			$i_cnt = 0;
			foreach ($wd_join_ar as $wd_join_data)
			{
				$wd_case_join_type_data  = $wd_join_type_arx[$i_cnt];
				if ($cnt_chk == 0)
				{
					$ins_sql = "INSERT INTO case_wd_support VALUE ('$case_id', '$wd_join_data', '$wd_case_join_type_data')";
				}
				else 
				{
					$ins_sql = $ins_sql." , ('$case_id', '$wd_join_data', '$wd_case_join_type_data')";
				}
				$cnt_chk = 1;
				$i_cnt +=1;
			}
			
			//echo $ins_sql;
			if(!$conn->query($ins_sql))
			{
				echo  $conn->errno;
				exit();
			}
		}

		// Create case team support
		$team_join_ar = explode("-,-", $team_join_arr);
		if (!((count($team_join_ar) == 1) and $team_join_ar[0] == ""))
		{
			$cnt_chk = 0;
			$ins_sql = "";
			$i_cnt = 0;
			foreach ($team_join_ar as $team_join_data)
			{
				
				if ($cnt_chk == 0)
				{
					$ins_sql = "INSERT INTO case_team_support VALUE ('$case_id', $team_join_data)";
				}
				else 
				{
					$ins_sql = $ins_sql." , ('$case_id', $team_join_data)";
				}
				$cnt_chk = 1;
				$i_cnt +=1;
			}
			
			//echo $ins_sql;
			if(!$conn->query($ins_sql))
			{
				echo  $conn->errno;
				exit();
			}
		}
		
		
		// Create  sender information
		$snd_list_ar = explode("-,-", $snd_list);
		$snd_type_ar = explode("-,-", $snd_type);
		$snd_date_ar = explode("-,-", $snd_date);
		$snd_line_ar = explode("-,-", $snd_line);
		$snd_mail_ar = explode("-,-", $snd_mail);
		$snd_tel_ar = explode("-,-", $snd_tel);
		// Add 2019-03-02
		$snd_occ_ar = explode("-,-", $snd_occ); 
		$snd_relate_ar = explode("-,-", $snd_relate); 
		$snd_note_ar = explode("-,-", $snd_note); 
		
		
		if (!((count($snd_list_ar) == 1) and $snd_list_ar[0] == ""))
		{
			$cnt_chk = 0;
			$ins_sql = "";
			$i_cnt = 0;
			foreach ($snd_list_ar as $snd_list__data)
			{
				$snd_type_data  = $snd_type_ar[$i_cnt];
				$snd_line_data  = $snd_line_ar[$i_cnt];
				$snd_mail_data  = $snd_mail_ar[$i_cnt];
				$snd_tel_data  = $snd_tel_ar[$i_cnt];
				
				// Create senddata data
				$snd_date_data_temp = explode("/", $snd_date_ar[$i_cnt]);
				$snd_date_data = $snd_date_data_temp[2]."-".$snd_date_data_temp[1]."-".$snd_date_data_temp[0];
				
				// Add 2019-03-02
				$snd_occ_data = $snd_occ_ar[$i_cnt];
				$snd_relate_data = $snd_relate_ar[$i_cnt];
				$snd_note_data = $snd_note_ar[$i_cnt];
				
				
				if ($cnt_chk == 0)
				{
					$ins_sql = "INSERT INTO case_sender VALUE ('$case_id', $snd_type_data, '$snd_list__data', '$snd_line_data', '$snd_mail_data', '$snd_tel_data', '$snd_occ_data', '$snd_relate_data', '$snd_note_data', '$snd_date_data')";
				}
				else 
				{
					$ins_sql = $ins_sql." ,('$case_id', $snd_type_data, '$snd_list__data', '$snd_line_data', '$snd_mail_data', '$snd_tel_data', '$snd_occ_data', '$snd_relate_data', '$snd_note_data', '$snd_date_data')";
				}
				$cnt_chk = 1;
				$i_cnt +=1;
			}
			
			//echo $ins_sql;
			if(!$conn->query($ins_sql))
			{
				echo  $conn->errno;
				exit();
			}
			
		}
		
		
		// Create ofd name 
		$ofd_name_arr = explode("-,-", $ofd_name_);
		$ofd_position_arr = explode("-,-", $ofd_position_);
		$ofd_name_detail_arr = explode("-,-", $ofd_name_detail_);
		
		if (!((count($ofd_name_arr) == 1) and $ofd_name_arr[0] == ""))
		{
			$cnt_chk = 0;
			$ins_sql = "";
			$i_cnt = 0;
			foreach ($ofd_name_arr as $ofd_name_data)
			{
				$ofd_position_data = $ofd_position_arr[$i_cnt];
				$ofd_name_detail_data = $ofd_name_detail_arr[$i_cnt];
				$ran_str = $case_id.gen_rnd_str(5);
				
				if ($cnt_chk == 0)
				{
					$ins_sql = "INSERT INTO case_ofd_name VALUE ('$case_id', '$ran_str', '$ofd_name_data', '$ofd_position_data', '$ofd_name_detail_data')";
				}
				else 
				{
					$ins_sql = $ins_sql.", ('$case_id', '$ran_str', '$ofd_name_data', '$ofd_position_data', '$ofd_name_detail_data')";
				}
				$cnt_chk = 1;
				$i_cnt +=1;
			}
			
			if(!$conn->query($ins_sql))
			{
				echo  $conn->errno;
				exit();
			}
		}
		
		
		// Create case job Type
		$c_case_job_type_arr = explode("-,-", $c_case_job_type_);
		
		if (!((count($c_case_job_type_arr) == 1) and $c_case_job_type_arr[0] == ""))
		{
			$cnt_chk = 0;
			$ins_sql = "";
			$i_cnt = 0;
			foreach ($c_case_job_type_arr as $case_job_type_data)
			{
				$ran_str = $case_id.gen_rnd_str(5);
				
				if ($cnt_chk == 0)
				{
					$ins_sql = "INSERT INTO case_job_type VALUE ('$case_id', '$case_job_type_data', '$ran_str')";
				}
				else 
				{
					$ins_sql = $ins_sql.", ('$case_id', '$case_job_type_data', '$ran_str')";
				}
				$cnt_chk = 1;
				$i_cnt +=1;
			}
			
			if(!$conn->query($ins_sql))
			{
				echo  $conn->errno;
				exit();
			}
		}
		$ran_str = $case_id.gen_rnd_str(5);
		//insert case in group ID
		if ($case_ingroup_id != "")
		{
			$sql = "Insert Into case_group_post value ('$case_id', '$case_ingroup_id', '$ran_str')";
			if(!$conn->query($sql))
			{
				echo  $conn->errno;
				exit();
			}


			// Load Picture scr
			$load_pic_sql = "SELECT a.full_picture FROM group_post_data a Where a.id ='$case_ingroup_id'";	
			$res = $conn->query(trim($load_pic_sql));	
			$data_Array = array();
			while ($row = $res->fetch_assoc()){
				$data_Array[] = $row;
			}
			$image_url = $data_Array[0]['full_picture'];
			download_case_img($case_id, $image_url, '1');
		}

		// Insert MSG IB      inb_msg_value
		if ($inb_msg_value != "")
		{
			$sql = "Insert Into case_inbox_msg value ('$case_id', '$inb_msg_value', '$ran_str', current_timestamp())";
			if(!$conn->query($sql))
			{
				echo  $conn->errno;
				exit();
			}
		}
		
		
		// Insert Case History
		$ins_sql = "Insert Into case_history Value ('$case_id', $c_status, 'เปิดเคสตรวจสอบทุจริต', '$c_cnt_url', $staff_key_id, CURRENT_TIMESTAMP(), '$ran_str ')";
		if(!$conn->query($ins_sql))
		{
			echo  $conn->errno;
			exit();
		}



		// Update Query search
		$upd_search = "call search_gen()";
		if(!$conn->query($upd_search))
		{
			echo  $conn->errno;
			exit();
		}
		mysqli_close($conn);
		



		
	}
	
	
	// F=10
	function query_data($case_id)
	{
		//$case_id = "6102002";
		$query_SQL = "SELECT a.*, b.AMPHUR_NAME, c.PROVINCE_NAME , d.crp_type as crp_type_desc FROM wd_case a INNER JOIN add_amphures b ON a.crp_add = b.AMPHUR_CODE INNER JOIN add_provinces c ON b.PROVINCE_ID = c.PROVINCE_ID INNER JOIN m_crp_type d ON a.crp_type = d.id WHERE a.case_id = '$case_id'  ";
		include "connectionDb.php";
		$res = $conn->query(trim($query_SQL));
		$row = $res->fetch_assoc();
		foreach($row as $key => $value)
		{
			if (trim($value) == "")
			{
				$value = "-";
			}
			$$key = $value;
		}
		
		
		
		switch ($priority) {
			case 0:
				$priority_string = '<small class="label bg-blue">ปกติ</small>';
				break;
			case 1:
				$priority_string = '<small class="label bg-yellow">มาก</small>';
				break;
			case 2:
				$priority_string = '<small class="label bg-red">มากที่สุด</small>';
				break;
			default:
				$priority_string = '<small class="label bg-red">error</small>';
		} 
		
		$urgent_text = "";
		if ($urgent == 1)
		{
			$urgent_text = '<small class="label bg-red">เร่งด่วน</small>';
		}
		if (trim($case_cnt_url) != "-")
		{
			$case_cnt_url = "<a href='$case_cnt_url' target='_blank'>Link<i class='fa fa-external-link-square '></i></a>";
		}
		
		$crp_lo_name = $crp_lo_name." อำเภอ$AMPHUR_NAME จังหวัด$PROVINCE_NAME";
		
		if ($crp_type == 7)
		{
			$crp_type_desc = $crp_type_desc."($crp_type_option)";
		}
		
		
		$sql_get_staff = "SELECT b.Name, b.nick_name, b.Position FROM case_operator a Inner Join staff_detail b ON a.stf_kid = b.key_ID Where a.case_id = '$case_id' Order By b.key_ID ";
		$res = $conn->query(trim($sql_get_staff));
		$print_staff = "";
		while ($row = $res->fetch_assoc()){
			$print_staff .= $row['nick_name']."-".$row['Name']."(".$row['Position'].")<BR>";
		}
		
		$print_submit_info ="";
		if ($submit_ID == "OTHER")
		{
			$print_submit_info = "บุคคลภายนอก<BR>";
			if (trim($submit_fb) != "-")
			{
				$print_submit_info .= "<a href='$submit_fb' target='_blank'>Link<i class='fa fa-external-link-square '></i></a>";
			}
		}
		else
		{
			$get_wd_info = "SELECT n_name, name, gen From wd_db WHERE wd_id = '$submit_ID'";
			$res = $conn->query(trim($get_wd_info));
			$row = $res->fetch_assoc();
			$print_submit_info = "สมาชิกหมาเฝ้าบ้าน<BR>".$row['n_name']." ".$row['name']." รุ่นที่". $row['gen'];
		}
		
		$status_string = "";
		switch ($status) {
			case 0:
				$status_string = 'เรื่องใหม่';
				break;
			case 1:
				$status_string = 'ทำข้อมูล';
				break;
			case 2:
				$status_string = 'รอข้อมูล';
				break;
			case 3:
				$status_string = 'ชะลอ';
				break;
			case 4:
				$status_string = 'ยุติ';
				break;
			case 5:
				$status_string = 'ลงเพจ';
				break;
			case 6:
				$status_string = 'สรุปข้อมูล';
				break;
			case 7:
				$status_string = 'รอตรวจต้นฉบับ';
				break;
			case 8:
				$status_string = 'เขียนต้นฉบับ';
				break;
			default:
				$status_string = 'Error!!';
		} 
		
		
		mysqli_close($conn);
		echo '<h5><B>ข้อมูลเบื้องต้นเคสต้น</B></h5>
			<div class="row">
				<div class="col-sm-2">
				</div>
				<div class="col-sm-10">
					'.$status_string.'<Br>
					<B>รหัสเคส : </B>'.$case_id.'<Br>
					<B>หัวข้อ : </B>'.$topic.'<Br>
					<B>summary : </B>'.$t_sum.'<Br>
					<B>ความสำคัญ :</B> '.$priority_string.$urgent_text.'<Br>
					<B>วันที่บันทึกข้อมูล :</B> '.thai_date(date_format(date_create($add_date), 'U')).'<Br>
					<B>ลิ้งในศูนย์ :</B> '.$case_cnt_url.'<Br>
					<B>Note :</B> '.$note.'
				</div>
			</div>
			
			<h5><B> หน่วยงานและผู้กระทำผิด</B></h5>
			<div class="row">
				<div class="col-sm-2">
				</div>
				<div class="col-sm-10">
					<B>หน่วยงาน :  </B>'.$crp_lo_name.'<br>
					<B>ชื่อผู้กระทำผิด : </B>'.$crp_name.'<br>
					<B>ประเภทการทุจริต : </B>'.$crp_type_desc.'<br>
					<B>วงเงินความเสียหาย : </B>'.number_format($crp_dmg).' บาท
				</div>
			</div>
			
			<h5><B>Staff ผู้ปฎิบัติงาน</B></h5>
			<div class="row">
				<div class="col-sm-2">
				</div>
				<div class="col-sm-10">
					'.$print_staff.'
				</div>
			</div>
			
			<h5><B>ผู้ให้ข้อมูล</B></h5>
			<div class="row">
				<div class="col-sm-2">
				</div>
				<div class="col-sm-10">
					'.$print_submit_info .'<Br> 
					วันที่ส่งข้อมูล : '.thai_date(date_format(date_create($submit_date), 'U')).'
				</div>
			</div>
			<div class="btn-toolbar">
				<button type="button" class="btn btn-primary pull-right"   data-dismiss="modal"><i class="fa fa-fw fa-close"></i> ปิด</button>
				<button type="button" class="btn btn-warning pull-right" onclick="window.location.href='."'".'11_case-edit.php?case_id='.$case_id.''."'".'"><i class="fa fa-fw fa-pencil"></i>แก้ไขเพิ่มเติม</button>
			</div>
		
		';
	}

	
	// F=11
	function get_case_data($case_id)
	{
		//usleep(500000);
		include "connectionDb.php";
		$data = array();
		
		// Query All data from WD_Case
		$query_SQL = "Select * From wd_case WHERE case_id = '$case_id'";
		$res = $conn->query(trim($query_SQL));
		$row = $res->fetch_assoc();
		foreach($row as $key => $value)
		{
			$data[$key] = $value;
		}
		
		// Get Diff_date
		$query_SQL = "Select DATEDIFF(finished_date, NOW()) as from_now, DATEDIFF(finished_date, add_date) as from_start From wd_case WHERE case_id = '$case_id'";
		$res = $conn->query(trim($query_SQL));
		$row = $res->fetch_assoc();
		foreach($row as $key => $value)
		{
			$data[$key] = $value;
			
		}
		$data['case_id'] = substr($data['case_id'], 0, 2)."-" . substr($data['case_id'], 2, 2)."-" . substr($data['case_id'], 4, 3);
		
		switch ($data['status']) {
		case 0:
			$data['status_text'] = 'เรื่องใหม่';
			break;
		case 1:
			$data['status_text'] = 'ทำข้อมูล';
			break;
		case 2:
			$data['status_text'] = 'รอข้อมูล';
			break;
		case 3:
			$data['status_text'] = 'ชะลอ';
			break;
		case 4:
			$data['status_text'] = 'ยุติ';
			break;
		case 5:
			$data['status_text'] = 'ลงเพจ';
			break;
		case 6:
			$data['status_text'] = 'สรุปข้อมูล';
			break;
		case 7:
			$data['status_text'] = 'รอตรวจต้นฉบับ';
			break;
		case 8:
			$data['status_text'] = 'เขียนต้นฉบับ';
			break;
		
		}
		
		

		switch ($data['priority']) {
		case 0:
			$data['priority_text'] = '<font color="green"><B>รอได้</B></font>';
			break;
		case 1:
			$data['priority_text'] = '<font color="green"><B><i class="fa fa-star"></i> ปกติ </B></font>';
			break;
		case 2:
			$data['priority_text'] = '<font color="orange"><B><i class="fa fa-star"></i> <i class="fa fa-star"></i> สำคัญ </B></font>';
			break;
		case 3:
			$data['priority_text'] = '<font color="red"><B><i class="fa fa-star"></i> <i class="fa fa-star"></i>  <i class="fa fa-star"></i> เร่งด่วน </B></font>';
			break;
		}
		
		
		
		
		$data['cannot_est_dmg_text'] = "";
		if ($data['cannot_est_dmg'] == 1)
		{
			$data['cannot_est_dmg_text'] = "ประเมินความเสียหายไม่ได้";
			$data['crp_dmg1'] = $data['crp_dmg_off'];
			$data['crp_dmg2'] = $data['ofd_dmg'];
			$data['crp_dmg_off'] = "N/A";
			$data['ofd_dmg'] = "N/A";
		}
		else
		{
			$data['crp_dmg1'] = $data['crp_dmg_off'];
			$data['crp_dmg2'] = $data['ofd_dmg'];
			$data['crp_dmg_off'] = number_format($data['crp_dmg_off']);
			$data['ofd_dmg'] = number_format($data['ofd_dmg']);
		}
		
		
		
		// Calculate date 
		if ($data['from_now'] < 0)
		{
			$data['from_now'] = 0;
		}
		
		$data['date_in'] = date("d/m/Y", strtotime($data['add_date']));
		$data['date_finished'] = date("d/m/Y", strtotime($data['finished_date']));
		$data['add_date_text'] = thai_date_non_dow(date_format(date_create($data['add_date']), 'U'));
		$data['finished_date_text'] = thai_date_non_dow(date_format(date_create($data['finished_date']), 'U'));
		
		if ($data['from_start'] <= 0 )
		{
			$data['remain_percentage'] = "100%";
		}
		else
		{
			$data['remain_percentage'] = round(((($data['from_start'] - $data['from_now']) * 100) / $data['from_start']), 2)."%";
		}
		//$data['remain_percentage'] = $data['from_now'];
		
		
		
		// Manage like
		if (trim($data['case_cnt_url']) == "")
		{
			$data['case_cnt_url'] = "#";
		}
		
		// Manage like
		if (trim($data['case_folder_url']) == "")
		{
			$data['case_folder_url'] = "#";
		}

		echo json_encode($data);
		
		mysqli_close($conn);
		
	}
	
	// F=12
	function update_status()
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
		$sql = "UPDATE wd_case a SET a.status = $status WHERE a.case_id = '$case_id' ";
		if(!$conn->query($sql))
		{
			echo  $conn->errno;
			exit();
		}

		$ran_str = $case_id.gen_rnd_str(5);
		// Insert Case History
		if ($status == 5)
		{
			$ins_sql = "Insert Into case_history Value ('$case_id', $status, '$detail', '$url', $staff_kid, '$selected_post_from_page_pub_time', '$ran_str')";
		}
		else
		{
			$ins_sql = "Insert Into case_history Value ('$case_id', $status, '$detail', '$url', $staff_kid, '$c_n_upd_time', '$ran_str')";
		}
		if(!$conn->query($ins_sql))
		{
			echo  $conn->errno;
			exit();
		}
		
		// Insert pub info if status == 5
		if ($status == 5)
		{
			// Update Pub Info
			$ins_sql = "Insert Into case_pub_info value ('$case_id', 'page_WD_post', '', '$url', '$ran_str')";
			if(!$conn->query($ins_sql))
			{
				echo  $conn->errno;
				exit();
			}
			
			
			// Update episode
			$ins_sql = "Insert Into case_episode value ('$case_id', '$url', '$ran_str')";
			if(!$conn->query($ins_sql))
			{
				echo  $conn->errno;
				exit();
			}


			# load case img
			// Load Picture scr
			$load_pic_sql = "Select b.img_src From system_page_all_pub a INNER Join system_page_all_pub_ojb_img b ON a.ojb_id = b.ojb_id Where a.post_id = '$url' ";	
			$res = $conn->query(trim($load_pic_sql));	
			$data_Array = array();
			while ($row = $res->fetch_assoc()){
				$data_Array[] = $row;
			}
			$image_url = $data_Array[0]['img_src'];
			download_case_img($case_id, $image_url, '2');


		}
		
		if ($status == 3)
		{
			// Insert Case status
			$sql = "UPDATE wd_case a SET a.finished_date = '$finished_date' WHERE a.case_id = '$case_id' ";
			if(!$conn->query($sql))
			{
				echo  $conn->errno;
				exit();
			}
		}

		// Update Query search
		$upd_search = "call search_gen()";
		if(!$conn->query($upd_search))
		{
			echo  $conn->errno;
			exit();
		}

		mysqli_close($conn);
		
	}
	
	// F=13
	function update_all_info ()
	{
			foreach ($_POST as $key => $value)
			{
				//$data[htmlspecialchars($key)] = htmlspecialchars($value);
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
				//echo $key . ":" . $value . "\n";
			}
			
			if (trim($ofd_dmg) == "")
			{
				$ofd_dmg = "0";
			}
			
			//$create_date = date_format(date_create($datepicker), 'd/m/Y');
			$create_date_arr = explode("/", $datepicker);
			$create_date = $create_date_arr[2]."-".$create_date_arr[1]."-".$create_date_arr[0];
			
			
			$data_submit_date_arr = explode("/", $datepicker2);
			$data_submit_date = $data_submit_date_arr[2]."-".$data_submit_date_arr[1]."-".$data_submit_date_arr[0];
			
			
			// Code month
			$create_code_month = substr($create_date_arr[2] + 543, 2, 4) . $create_date_arr[1];
			
			
			// Urgent code
			if ($check_urgent == 'true')
			{
				$urgent_c = "1";
			}
			else
			{
				$urgent_c = "0";
			}
			
			if ($sender_type == '0')
			{
				$submit_id = $snd_wd_id;
				$submit_fb = "";
			}
			
			else
			{
				$submit_id = "OTHER";
				$submit_fb = $c_snd_fb;
			}
			
			$c_priority = intval($c_priority);
			
			// Update General Data
			include "connectionDb.php";
			$update_sql = "UPDATE wd_case SET priority=$c_priority,urgent=$urgent_c,topic='$c_name',t_sum='$c_summary',note='$c_note',case_cnt_url='$c_cnt_url',crp_lo_name='$ofd_lo_name',crp_add=$ofd_add_aumpher,crp_name='$ofd_name',crp_n_position='$ofd_position',crp_type=$crp_type_c ,crp_type_option='$crp_type_oth',crp_dmg=$ofd_dmg,release_wd='$c_release_FB',release_other='$c_release_Other' WHERE case_id = '$c_ID'";
			if(!$conn->query($update_sql))
			{
				echo  $conn->errno;
				exit();
			}
			
			// Update info Data
			$update_sql = "UPDATE `case_info` SET `info1`='$info1',`info2`='$info2',`info3`='$info3',`info4`='$info4' WHERE case_id = '$c_ID'";
			if(!$conn->query($update_sql))
			{
				echo  $conn->errno;
				exit();
			}
		
		$case_id = $c_ID;
		
		
		
		// Delete Staff support
		$sql = "Delete From case_operator where case_id = '$case_id'";
		if(!$conn->query($sql))
			{
				echo  $conn->errno;
				exit();
			}
		
		// re insert Staff support
		$respons_staff_arr = explode("-,-", $respons_staff);
		if (!((count($respons_staff_arr) == 1) and $respons_staff_arr[0] == ""))
		{
			$staff_cnt_chk = 0;
			$ins_sql = "";
			foreach ($respons_staff_arr as $staff_list)
			{
				if ($staff_cnt_chk == 0)
				{
					$ins_sql = $ins_sql."Insert Into case_operator value('$case_id', $staff_list)";
				}
				else 
				{
					$ins_sql = $ins_sql.",('$case_id',$staff_list)";
				}
				$staff_cnt_chk = 1;
			}
			
			if(!$conn->query($ins_sql))
			{
				echo  $conn->errno;
				exit();
			}
		}
		
		
		// Delete wd support
		$sql = "Delete From case_wd_support where case_id = '$case_id'";
		if(!$conn->query($sql))
		{
			echo  $conn->errno;
			exit();
		}
	
		//update wd support;
		$support_wd_arr = explode("-,-", $support_wd);
		if (!((count($support_wd_arr) == 1) and $support_wd_arr[0] == ""))
		{
			$wd_cnt_chk = 0;
			$ins_sql = "";
			foreach ($support_wd_arr as $wd_support_list)
			{
				if ($wd_cnt_chk == 0)
				{
					$ins_sql = $ins_sql."Insert Into case_wd_support value('$case_id', '$wd_support_list')";
				}
				else 
				{
					$ins_sql = $ins_sql.",('$case_id','$wd_support_list')";
				}
				$wd_cnt_chk = 1;
			}
			if(!$conn->query($ins_sql))
			{
				echo  $conn->errno;
				exit();
			}
		}

		// Update Query search
		$upd_search = "call search_gen()";
		if(!$conn->query($upd_search))
		{
			echo  $conn->errno;
			exit();
		}
			
		mysqli_close($conn);
		
		query_data($c_ID);
	
	}
	
	// F=14
	function get_timeline_date ()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		//$sql = "SELECT a.*, b.Name, b.nick_name, c.img From case_history a INNER JOIN staff_detail b ON a.staff_kid = b.key_ID Inner Join staff_img c ON a.staff_kid = c.key_ID Where a.case_id = '$case_id' Order By a.time_stmp";
		$sql = "SELECT a.*, b.Name, b.nick_name, c.img, IFNULL(d.case_id, 0) as EP_CHK From case_history a INNER JOIN staff_detail b ON a.staff_kid = b.key_ID Inner Join staff_img c ON a.staff_kid = c.key_ID  Left Join case_episode d ON a.rnd_str = d.rnd_str Where a.case_id = '$case_id' Order By a.time_stmp";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		$page_id = "372488206116588";
		$count_EP = 0;
		$current_date = "";
		while ($row = $res->fetch_assoc()){
			$current_date_temp = thai_date(date_format(date_create($row['time_stmp']), 'U'));
			if ($current_date_temp != $current_date)
			{
				$current_date = $current_date_temp;
				echo "<li class='time-label'><span class='bg-blue'> $current_date </span></li>";
			}
			$status = $row['case_status'];
			// status type show
			switch($status)
			{
				case 0 :
				{
					$status_icon = "<i class='fa fa-thumb-tack bg-blue'></i>";
					$status_text = "บันทึกเรื่องใหม่";
					break;
				}
				case 1 :
				{
					$status_icon = "<i class='fa fa-users bg-aqua'></i>";
					$status_text = "ทำข้อมูล";
					break;
				}
				case 2 :
				{
					$status_icon = "<i class='fa fa-commenting bg-yellow'></i>";
					$status_text = "รอข้อมูล";
					break;
				}
				case 3 :
				{
					$status_icon = "<i class='fa fa-hand-stop-o bg-orange'></i>";
					$status_text = "ชะลอ";
					break;
				}
				case 4 :
				{
					$status_icon = "<i class='fa fa-ban bg-red'></i>";
					$status_text = "ยุติ";
					break;
				}
				case 5 :
				{
					$status_icon = "<i class='fa fa-facebook bg-green'></i>";
					$status_text = "ลงเพจ";
					break;
				}
				
				case 6 :
				{
					$status_icon = "<i class='fa fa-bookmark-o bg-yellow'></i>";
					$status_text = "สรุปข้อมูล";
					break;
				}
				
				case 7 :
				{
					$status_icon = "<i class='fa fa-book bg-green'></i>";
					$status_text = "	รอตรวจต้นฉบับ";
					break;
				}
				
				case 8 :
				{
					$status_icon = "<i class='fa fa-book bg-yellow'></i>";
					$status_text = "	เขียนต้นฉบับ";
					break;
				}
				
				
				case 11 :
				{
					$status_icon = "<i class='fa fa-bullhorn bg-maroon'></i>";
					$status_text = "ถูกเผยแพร่";
					break;
				}
				
				case 12 :
				{
					$status_icon = "<i class='fa fa-hand-o-right bg-navy'></i>";
					$status_text = "ถูกตรวจสอบ";
					break;
				}
				
				case 13 :
				{
					$status_icon = "<i class='fa fa-quote-left bg-yellow'></i>";
					$status_text = "ความเคลื่อนไหว";
					break;
				}
			}
				
			//$staff_name = $row["Name"]."(".$row["nick_name"].")";
			$staff_name = $row["nick_name"] ;
			
			$ep_str = "";
			if ($row["EP_CHK"] != "0")
			{
				$count_EP = $count_EP + 1;
				$ep_str = "<H4><span class='label label-success pull-right'>Episode  ".$count_EP."</span></H4>";
			}
			
			
			$button_link = "";
			if ($row['url'] != "")
			{
				if ($status == 5)
				{
					//$url = "https://www.facebook.com/".$page_id."_".$row['url'];
					$button_link  = "<div class='timeline-footer' id='timeline_facebook_panel' value = '".$row['url']."' style='padding: 5px; width: 100%; word-break: break-all; word-wrap: break-word;'></div>";
					
				}
				else
				{
					$url = $row['url'];
					$button_link = '<div class="timeline-footer"><a href="'.$url.'" target="_blank" class="btn btn-primary btn-xs">Link</a></div>';
				}
				
			}
			
			
			echo "<li>";
			echo $status_icon ;
			
			$show_time_text = date_format(date_create($row['time_stmp']), 'H:i');
			if ($show_time_text == "00:00")
			{
				$show_time_text = '<span class="time"><i id="delete_time_line_item" class="fa fa-times delete_time_line" value="'.$row['rnd_str'].'"></i>  </span>';
			}
			else 
			{
				$show_time_text = '<span class="time"><i class="fa fa-clock-o"></i> '.date_format(date_create($row['time_stmp']), 'H:i').'  <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="'.$row['rnd_str'].'"></i>  </span> ';
			}
			
			echo '<div class="timeline-item">'.$show_time_text.'<h3 class="timeline-header"><a><img class="img-circle img-bordered-sm" src="img/wd_img/'.$row['img'].'" height="42" width="42" ><span> '.$staff_name.' - </span>'.$status_text.'</a></h3>
						<div class="timeline-body">
							'.$row['detail'].'
						</div>
						'.$ep_str.$button_link.'
				  </div>';
			
			
			echo "</li>";
			
		}
		echo '<li><i class="fa fa-clock-o bg-gray"></i></li>';
		
		
		
	}
	
	// F = 15
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
	
	// F = 16
	function get_org_type()
	{
		include "connectionDb.php";
		$get_ID = "SELECT * FROM `m_org_type`";
		$res = $conn->query(trim($get_ID));
		echo '<option selected disabled>== เลือก ประเภทองค์กร ==</option>';
		while ($row = $res->fetch_assoc()){
			echo "<option value='".$row['org_type_id']."'>".$row['org_type_name']."</option>";
		}
		mysqli_close($conn);
	}
	
	
	// F=17 
	function get_ofd_name_list($case_id)
	{
		include "connectionDb.php";
		$sql = "Select a.ofd_name, a.ofd_type, b.org_type_name, c.AMPHUR_NAME, d.PROVINCE_NAME From case_ofd_info a Inner JOIN m_org_type b ON a.org_type_id = b.org_type_id INNER Join add_amphures c ON a.ofd_address_code = c.AMPHUR_CODE Inner Join add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID Where a.case_id = '$case_id' ";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		$cnt = 0;
		$ofd_name = "";
		$ofd_type = "";
		$ofd_location = "";
		$ofd_type_2 = "";
		
		while ($row = $res->fetch_assoc()){
			if ($cnt != 0)
			{
				$ofd_name .= "-,-";
				$ofd_type .= "-,-";
				$ofd_type_2 .= "-,-";
				$ofd_location .= "-,-";
			}
			$ofd_name .= $row['ofd_name'];
			$ofd_type .= $row['org_type_name'];
			$ofd_type_2 .= $row['ofd_type'];
			$ofd_location .= trim($row['AMPHUR_NAME'])." ".trim($row['PROVINCE_NAME']);
			$cnt = 1;
		}
		
		$data = array();
		$data['ofd_name'] = $ofd_name;
		$data['ofd_type'] = $ofd_type;
		$data['ofd_type_2'] = $ofd_type_2;
		$data['ofd_location'] = $ofd_location;
		
		echo json_encode($data);
	}
	
	// F = 18
	function g_case_sender($case_id)
	{
		include "connectionDb.php";
		$sql = "SELECT a.*, b.name as b_name, b.n_name, b.gen FROM case_sender a Left Join wd_db b ON a.name = b.wd_id where a.case_id = '$case_id'";
		//echo $sql;
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		$cnt = 0;
		
		$c_snd_type = "";
		$c_snd_name = "";
		$c_snd_line = "";
		$c_snd_email = "";
		$c_snd_tel= "";
		$c_snd_date= "";
		$c_snd_b_name= "";
		$c_snd_n_name= "";
		$c_snd_gen= "";
		//Add 2018-03-01
		$c_snd_occ= "";
		$c_snd_relate= "";
		$c_snd_note= "";
		
		while ($row = $res->fetch_assoc()){
			if ($cnt != 0)
			{
				$c_snd_type .= "-,-";
				$c_snd_name .= "-,-";
				$c_snd_line .= "-,-";
				$c_snd_email .= "-,-";
				$c_snd_tel .= "-,-";
				$c_snd_date .= "-,-";
				$c_snd_b_name .= "-,-";
				$c_snd_n_name .= "-,-";
				$c_snd_gen .= "-,-";
				$c_snd_occ .= "-,-";
				$c_snd_relate .= "-,-";
				$c_snd_note .= "-,-";
			}
			$c_snd_type .= $row['type'];
			$c_snd_name .= $row['name'];
			$c_snd_line .= $row['line'];
			$c_snd_email .= $row['email'];
			$c_snd_tel .=$row['tel'];
			$c_snd_date .= $row['snd_date'];
			$c_snd_b_name .= $row['b_name'];
			$c_snd_n_name .= $row['n_name'];
			$c_snd_gen .= $row['gen'];
			//Add 2018-03-01
			$c_snd_occ .= $row['occ'];
			$c_snd_relate .= $row['relate'];
			$c_snd_note .= $row['note'];
			
			
			$cnt = 1;
		}
		
		$data = array();
		$data['c_snd_type'] = $c_snd_type;
		$data['c_snd_name'] = $c_snd_name;
		$data['c_snd_line'] = $c_snd_line;
		$data['c_snd_email'] = $c_snd_email;
		$data['c_snd_tel'] = $c_snd_tel;
		$data['c_snd_date'] = $c_snd_date;
		$data['c_snd_b_name'] = $c_snd_b_name;
		$data['c_snd_n_name'] = $c_snd_n_name;
		$data['c_snd_gen'] = $c_snd_gen;
		//Add 2018-03-01
		$data['c_snd_occ'] = $c_snd_occ;
		$data['c_snd_relate'] = $c_snd_relate;
		$data['c_snd_note'] = $c_snd_note;
		
		echo json_encode($data);
	}
	
	
	// F = 19
	function get_team_support($case_id)
	{
		include "connectionDb.php";
		$sql = "SELECT a.team_id, b.team_name FROM case_team_support a Inner Join m_wd_team b ON a.team_id = b.team_ID Where a. case_id = '$case_id'";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		$cnt = 0;
		$support_team_id = "";
		$support_team_name = "";
		
		
		while ($row = $res->fetch_assoc()){
			if ($cnt != 0)
			{
				$support_team_id .= "-,-";
				$support_team_name .= "-,-";
			}
			$support_team_id .= $row['team_id'];
			$support_team_name .= $row['team_name'];
			$cnt = 1;
		}
		
		$data = array();
		$data['support_team_id'] = $support_team_id;
		$data['support_team_name'] = $support_team_name;
		
		echo json_encode($data);
		
	}
	
	// F=20
	function get_wd_support($case_id)
	{
		include "connectionDb.php";
		$sql = "SELECT b.wd_id, b.name , b.n_name, b.gen FROM case_wd_support a Left Join wd_db b ON a.wd_id = b.wd_id where a.case_id = '$case_id' order by b.gen";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		$cnt = 0;
		$support_wd_id = "";
		$support_wd_name = "";
		$support_wd_n_name = "";
		$support_wd_gen = "";
		
		
		while ($row = $res->fetch_assoc()){
			if ($cnt != 0)
			{
				$support_wd_id .= "-,-";
				$support_wd_name .= "-,-";
				$support_wd_n_name .= "-,-";
				$support_wd_gen .= "-,-";
			}
			$support_wd_id .= $row['wd_id'];
			$support_wd_name .= $row['name'];
			$support_wd_n_name .= $row['n_name'];
			$support_wd_gen .= $row['gen'];
			$cnt = 1;
		}
		
		$data = array();
		$data['support_wd_id'] = $support_wd_id;
		$data['support_wd_name'] = $support_wd_name;
		$data['support_wd_n_name'] = $support_wd_n_name;
		$data['support_wd_gen'] = $support_wd_gen;
		
		echo json_encode($data);
		
	}
	
	// F=21
	function get_staff_operator($case_id)
	{
		include "connectionDb.php";
		//$sql = "SELECT a.get_info_staff_id, b.Name, b.nick_name FROM wd_case a Inner Join staff_detail b ON a.get_info_staff_id = b.key_ID WHERE a.case_id = '$case_id'";
		$sql = "SELECT a.get_info_staff_id, b.Name, b.nick_name FROM wd_case a Inner Join staff_detail b ON a.get_info_staff_id = b.key_ID WHERE a.case_id = '$case_id' UNION ALL Select a.get_info_staff_id, b.name, b.n_name From wd_case a Inner Join wd_db b ON a.get_info_staff_id = b.wd_id Where a.case_id = '$case_id'";
		$res = $conn->query(trim($sql));
		$cnt = 0;
		$support_staff_type = "";
		$support_staff_id = "";
		$support_staff_name = "";
		$support_staff_n_name = "";
		
		
		while ($row = $res->fetch_assoc()){
			if ($cnt != 0)
			{
				$support_staff_type .= "-,-";
				$support_staff_id .= "-,-";
				$support_staff_name .= "-,-";
				$support_staff_n_name .= "-,-";
			}
			$support_staff_type .=  "0";
			$support_staff_id .= $row['get_info_staff_id'];
			$support_staff_name .= $row['Name'];
			$support_staff_n_name .= $row['nick_name'];
			$cnt = 1;
		}
		
		
		
		$sql = "SELECT a.stf_kid, b.Name, b.nick_name FROM case_operator a Inner Join staff_detail b ON a.stf_kid = b.key_ID WHERE a.case_id = '$case_id'";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		while ($row = $res->fetch_assoc()){
			if ($cnt != 0)
			{
				$support_staff_type .= "-,-";
				$support_staff_id .= "-,-";
				$support_staff_name .= "-,-";
				$support_staff_n_name .= "-,-";
			}
			$support_staff_type .=  "1";
			$support_staff_id .= $row['stf_kid'];
			$support_staff_name .= $row['Name'];
			$support_staff_n_name .= $row['nick_name'];
			$cnt = 1;
		}
		
		
		$data = array();
		$data['support_staff_type'] = $support_staff_type;
		$data['support_staff_id'] = $support_staff_id;
		$data['support_staff_name'] = $support_staff_name;
		$data['support_staff_n_name'] = $support_staff_n_name;
		
		echo json_encode($data);
		
	}
	
	// F=22
	function update_case_info()
	{
		foreach ($_POST as $key => $value)
			{
				//$data[htmlspecialchars($key)] = htmlspecialchars($value);
				$a = htmlspecialchars($key) ;
				//$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
				//echo $key . ":" . $value . "\n";
			}
			
			// Ofd_dmg
		if (trim($u_case_ofd_dmg) == "")
		{
			$u_case_ofd_dmg = "0";
		}
		// Ofd_dmg2
		if (trim($u_case_ofd_dmg2) == "")
		{
			$u_case_ofd_dmg2 = "0";
		}
		
		// Urgent code
		if ($u_case_urgent_check == 'true')
		{
			$u_case_urgent_check = "1";
		}
		else
		{
			$u_case_urgent_check = "0";
		}
		
		// cannot_esiamate_dmg
		if ($u_case_cannot_estimate_check == 'true')
		{
			$u_case_cannot_estimate_check = "1";
		}
		else
		{
			$u_case_cannot_estimate_check = "0";
		}
			
			$sql = "Update wd_case SET 
			topic  = '$u_case_name'
			, t_sum  = '$u_case_summary'
			, priority = $u_case_priority
			, note  = '$u_case_note'
			, cannot_est_dmg = $u_case_cannot_estimate_check
			, crp_dmg_off = $u_case_ofd_dmg
			, ofd_dmg = $u_case_ofd_dmg2
			WHERE case_id = '$case_id'";
			
			// Update General Data
			include "connectionDb.php";
			if(!$conn->query($sql))
			{
				exit();
			}

			// Update Query search
		$upd_search = "call search_gen()";
		if(!$conn->query($upd_search))
		{
			echo  $conn->errno;
			exit();
		}
			mysqli_close($conn);
			
	}
	
	// F=23
	function update_case_type()
	{
		foreach ($_POST as $key => $value)
			{
				//$data[htmlspecialchars($key)] = htmlspecialchars($value);
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
				//echo $key . ":" . $value . "\n";
			}
		$sql = "Update wd_case SET crp_type = $crp_type , crp_type_option = '$crp_option_name' WHERE case_id = '$case_id'";
		// Update case type
		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			exit();
		}
		// Update Query search
		$upd_search = "call search_gen()";
		if(!$conn->query($upd_search))
		{
			echo  $conn->errno;
			exit();
		}
		mysqli_close($conn);
		
	}
	
	// F=24
	function update_case_link()
	{
		foreach ($_POST as $key => $value)
			{
				//$data[htmlspecialchars($key)] = htmlspecialchars($value);
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
				//echo $key . ":" . $value . "\n";
			}
		$sql = "Update wd_case SET case_folder_url = '$case_wfd_url' WHERE case_id = '$case_id'";
		// Update case type
		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			exit();
		}
		// Update Query search
		$upd_search = "call search_gen()";
		if(!$conn->query($upd_search))
		{
			echo  $conn->errno;
			exit();
		}
		mysqli_close($conn);
	}
	
	
	// F=25
	function update_case_date()
	{
		foreach ($_POST as $key => $value)
			{
				//$data[htmlspecialchars($key)] = htmlspecialchars($value);
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
				//echo $key . ":" . $value . "\n";
			}
		$sql = "Update wd_case SET add_date   = '$start_date' , finished_date  = '$finished_date' WHERE case_id = '$case_id'";
		// Update case type
		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			exit();
		}
		// Update Query search
		$upd_search = "call search_gen()";
		if(!$conn->query($upd_search))
		{
			echo  $conn->errno;
			exit();
		}
		mysqli_close($conn);
	}
	
	// F=26
	function add_ofd_name()
	{
		foreach ($_POST as $key => $value)
			{
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			}
		$sql = "Insert Into case_ofd_info value ('$case_id', '$ofd_name', '$ofd_type_2', $ofd_type_id, $ofd_address_code)";
		// Update case type
		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			exit();
		}
		// Update Query search
		$upd_search = "call search_gen()";
		if(!$conn->query($upd_search))
		{
			echo  $conn->errno;
			exit();
		}
		mysqli_close($conn);
	}
	
	// F=27
	function delete_ofd_name()
	{
		foreach ($_POST as $key => $value)
			{
				//$data[htmlspecialchars($key)] = htmlspecialchars($value);
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
				//echo $key . ":" . $value . "\n";
			}
		//$sql = "Update wd_case SET add_date   = '$start_date' , finished_date  = '$finished_date' WHERE case_id = '$case_id'";
		$sql = "Delete From case_ofd_info Where case_id = '$case_id' and ofd_name = '$ofd_name'";
		//echo $sql;
		// Update case type
		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			exit();
		}
		// Update Query search
		$upd_search = "call search_gen()";
		if(!$conn->query($upd_search))
		{
			echo  $conn->errno;
			exit();
		}
		mysqli_close($conn);
	}
		// F=28
	function add_sender_name()
	{
		foreach ($_POST as $key => $value)
			{
				//$data[htmlspecialchars($key)] = htmlspecialchars($value);
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
				//echo $key . ":" . $value . "\n";
			}
		//$sql = "Update wd_case SET add_date   = '$start_date' , finished_date  = '$finished_date' WHERE case_id = '$case_id'";
		//$sql = "Delete From case_ofd_info Where case_id = '$case_id' and ofd_name = '$ofd_name'";
		$sql = "Insert Into case_sender value ('$case_id', $snd_type , '$snd_name', '$snd_line', '$snd_mail', '$snd_tel', '$snd_occ', '$snd_relate', '$snd_note', '$snd_date')";
		echo $sql;
		// Update case type
		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			exit();
		}
		mysqli_close($conn);
	}
	
	
	// F=29
	function delete_sender_name()
	{
		foreach ($_POST as $key => $value)
			{
				//$data[htmlspecialchars($key)] = htmlspecialchars($value);
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
				//echo $key . ":" . $value . "\n";
			}
		//$sql = "Update wd_case SET add_date   = '$start_date' , finished_date  = '$finished_date' WHERE case_id = '$case_id'";
		$sql = "Delete From case_sender Where case_id = '$case_id' and name = '$snd_name'";
		//echo $sql;
		// Update case type
		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			exit();
		}
		mysqli_close($conn);
	}
	
	
	// F=30
	function add_case_staff()
	{
		foreach ($_POST as $key => $value)
			{
				//$data[htmlspecialchars($key)] = htmlspecialchars($value);
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
				//echo $key . ":" . $value . "\n";
			}
		$sql = "SELECT * FROM case_operator where case_id = '$case_id' and stf_kid = $stf_kid";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		if (($res->num_rows) < 1)
		{
			$sql = "Insert Into case_operator value ('$case_id', $stf_kid)";
			if(!$conn->query($sql))
			{
				exit();
			}
		}
		//echo $res->num_rows;
		mysqli_close($conn);
		
	}
	
	// F = 31
	function delete_case_staff()
	{
		foreach ($_POST as $key => $value)
			{
				//$data[htmlspecialchars($key)] = htmlspecialchars($value);
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
				//echo $key . ":" . $value . "\n";
			}
		//$sql = "Update wd_case SET add_date   = '$start_date' , finished_date  = '$finished_date' WHERE case_id = '$case_id'";
		$sql = "Delete From case_operator Where case_id = '$case_id' and stf_kid = '$stf_kid'";
		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			exit();
		}
		mysqli_close($conn);
	}
	
	
	// F=32
	function add_team_support()
	{
		foreach ($_POST as $key => $value)
			{
				//$data[htmlspecialchars($key)] = htmlspecialchars($value);
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
				//echo $key . ":" . $value . "\n";
			}
		$sql = "Insert Into case_team_support value ('$case_id', $team_id)";
		// Update case type
		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			exit();
		}
		mysqli_close($conn);
	}
	
	// F=33
	function delete_team_support()
	{
		foreach ($_POST as $key => $value)
			{
				//$data[htmlspecialchars($key)] = htmlspecialchars($value);
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
				//echo $key . ":" . $value . "\n";
			}
		//$sql = "Update wd_case SET add_date   = '$start_date' , finished_date  = '$finished_date' WHERE case_id = '$case_id'";
		$sql = "Delete From case_team_support Where case_id = '$case_id' and team_id = '$team_id'";
		//echo $sql;
		// Update case type
		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			exit();
		}
		mysqli_close($conn);
	}
	
	// F=32
	function add_wd_support()
	{
		foreach ($_POST as $key => $value)
			{
				//$data[htmlspecialchars($key)] = htmlspecialchars($value);
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
				//echo $key . ":" . $value . "\n";
			}
		$sql = "Insert Into case_wd_support value ('$case_id', $wd_id, '$select_support_type_for_wd')";
		// Update case type
		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			exit();
		}
		mysqli_close($conn);
	}
	
	// F=35
	function delete_wd_support()
	{
		foreach ($_POST as $key => $value)
			{
				//$data[htmlspecialchars($key)] = htmlspecialchars($value);
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
				//echo $key . ":" . $value . "\n";
			}
		//$sql = "Update wd_case SET add_date   = '$start_date' , finished_date  = '$finished_date' WHERE case_id = '$case_id'";
		$sql = "Delete From case_wd_support Where case_id = '$case_id' and wd_id = '$wd_id'";
		//echo $sql;
		// Update case type
		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			exit();
		}
		mysqli_close($conn);
	}
	
	
	// F=36
	function add_pub_info()
	{
		foreach ($_POST as $key => $value)
			{
				//$data[htmlspecialchars($key)] = htmlspecialchars($value);
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
				//echo $key . ":" . $value . "\n";
			}
		include "connectionDb.php";
		// Insert into Pub Table
		$ran_str = $case_id.gen_rnd_str(5);
		$sql = "Insert Into case_pub_info Value ('$case_id', '$name', '$title', '$url', '$ran_str')";
		// Update case type
		if(!$conn->query($sql))
		{
			exit();
		}
		$detail_data = $name." : ".$title;
		// Insert into case History Table
		$sql = "Insert Into case_history value ('$case_id', 11, '$detail_data', '$url', $stf_kid, '$date 23:59:00', '$ran_str')";
		// Update case type
		if(!$conn->query($sql))
		{
			exit();
		}
		// Update Query search
		$upd_search = "call search_gen()";
		if(!$conn->query($upd_search))
		{
			echo  $conn->errno;
			exit();
		}
		mysqli_close($conn);	
	}
	
	// F=37
	function add_eff_info()
	{
		foreach ($_POST as $key => $value)
			{
				//$data[htmlspecialchars($key)] = htmlspecialchars($value);
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
				//echo $key . ":" . $value . "\n";
			}
		include "connectionDb.php";
		
		$detail_data = $name." : ".$detail;
		// Insert into case History Table
		$ran_str = $case_id.gen_rnd_str(5);
		$sql = "Insert Into case_history value ('$case_id', 12, '$detail_data', '$url', $stf_kid, '$date 23:59:00', '$ran_str')";
		// Update case type
		if(!$conn->query($sql))
		{
			exit();
		}

		// Insert case gove check list
		$sql = "Insert into case_gv_check value ('$case_id', $case_a_eff_type, '$name', '$date', CURRENT_TIMESTAMP, '$ran_str', NULL, NULL, NULL)";
		if(!$conn->query($sql))
		{
			exit();
		}
		// Update Query search
		$upd_search = "call search_gen()";
		if(!$conn->query($upd_search))
		{
			echo  $conn->errno;
			exit();
		}
		mysqli_close($conn);
			
			
	}
	
	
	// F=38
	function generate_case_id()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		//echo $case_add_date;
		// Input to system Date
		$create_date_arr = explode("/", $case_add_date);
		$create_date = $create_date_arr[2]."-".$create_date_arr[1]."-".$create_date_arr[0];
		
		
		// Generate case ID
		$create_code_month = substr($create_date_arr[2] + 543, 2, 4) . $create_date_arr[1];
		include "connectionDb.php";
		$query_sql = "Select IFNULL(max(CONVERT(substring(case_id,5,3), UNSIGNED INTEGER)),0)as max_in_month from wd_case Where case_id like '$create_code_month%' ";	
		$res = $conn->query(trim($query_sql));
		$row = $res->fetch_assoc();
		$case_id = $create_code_month . sprintf('%03d',$row['max_in_month'] + 1);
		$case_id = (string)$case_id;
		mysqli_close($conn);
		echo $case_id;
			
	}
	
	
	function check_duplicate_case_ID()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		include "connectionDb.php";
		$query_sql = "SELECT count(case_id) as cnt FROM wd_case WHERE case_id = '$check_case_id'";	
		$res = $conn->query(trim($query_sql));
		$row = $res->fetch_assoc();
		echo $row['cnt'];
		mysqli_close($conn);
		
	}
	
	// F=40
	function add_oth_pub()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		include "connectionDb.php";
		$ran_str = $case_id.gen_rnd_str(5);
		$sql = "Insert Into case_history value ('$case_id', 13, '$detail', '', $stf_kid, '$date 23:59:00', '$ran_str')";
		// Update case type
		if(!$conn->query($sql))
		{
			exit();
		}
		
		mysqli_close($conn);
		
		
	}
	
	// F=41
	function get_crp_type_data()
	{
		// Connect to MySQL Database
		include "connectionDb.php";
		$sql = "SELECT id, crp_type as label FROM `m_crp_type` ORDER BY `m_crp_type`.`id` ASC";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		// Echo select header
				$data_Array = array();
		while ($row = $res->fetch_assoc())
		{
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	//F=42
	function get_ofd_type_2()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		// Connect to MySQL Database
		include "connectionDb.php";
		$sql = "SELECT * FROM case_crp_type_data Where case_id = '$case_id'";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		// Echo select header
		$data_Array = array();
		while ($row = $res->fetch_assoc())
		{
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	//F=43
	function del_ofd_type_2()
	{
		foreach ($_POST as $key => $value)
			{
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			}
		include "connectionDb.php";
		$sql = "Delete From case_crp_type_data WHERE rnd_str = '$type_rnd_str'";

		if(!$conn->query($sql))
		{
			exit();
		}
		mysqli_close($conn);
	}
	
	//F=44
	function add_ofd_type_2()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
			
		$ran_str = $case_id.gen_rnd_str(5);
		include "connectionDb.php";
		$sql = "Insert Into case_crp_type_data value ('$case_id', $type_id, '$type_data', '$ran_str')";

		if(!$conn->query($sql))
		{
			exit();
		}
		// Update Query search
		$upd_search = "call search_gen()";
		if(!$conn->query($upd_search))
		{
			echo  $conn->errno;
			exit();
		}
		mysqli_close($conn);
	}
	
	//F=45
	function get_job_type()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		// Connect to MySQL Database
		include "connectionDb.php";
		$sql = "SELECT * FROM case_job_type Where case_id = '$case_id'";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		// Echo select header
		$data_Array = array();
		while ($row = $res->fetch_assoc())
		{
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	//F=46
	function add_job_type()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
			
		$ran_str = $case_id.gen_rnd_str(5);
		include "connectionDb.php";
		$sql = "Insert Into case_job_type value ('$case_id', '$case_job', '$ran_str')";

		if(!$conn->query($sql))
		{
			exit();
		}
		mysqli_close($conn);
	}
	
	//F=47
	function del_job_type()
	{
		foreach ($_POST as $key => $value)
			{
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			}
		include "connectionDb.php";
		$sql = "Delete From case_job_type WHERE rnd_str = '$type_rnd_str'";

		if(!$conn->query($sql))
		{
			exit();
		}
		mysqli_close($conn);
	}
	
	//F=48
	function get_ofd_person_list()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		// Connect to MySQL Database
		include "connectionDb.php";
		$sql = "SELECT * FROM case_ofd_name Where case_id = '$case_id'";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		// Echo select header
		$data_Array = array();
		while ($row = $res->fetch_assoc())
		{
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	//F=49
	function del_ofd_person()
	{
		foreach ($_POST as $key => $value)
			{
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			}
		include "connectionDb.php";
		$sql = "Delete From case_ofd_name WHERE rnd_str = '$type_rnd_str'";

		if(!$conn->query($sql))
		{
			exit();
		}
		// Update Query search
		$upd_search = "call search_gen()";
		if(!$conn->query($upd_search))
		{
			echo  $conn->errno;
			exit();
		}
		mysqli_close($conn);
	}
	
	//F=50
	function add_ofd_person()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
			
		$ran_str = $case_id.gen_rnd_str(5);
		include "connectionDb.php";
		$sql = "Insert Into case_ofd_name value ('$case_id', '$ran_str', '$ofd_name', '$ofd_pos', '$ofd_detail')";
		if(!$conn->query($sql))
		{
			exit();
		}
		mysqli_close($conn);
	}
	
	
	function get_avi_tag()
	{
		// Connect to MySQL Database
		include "connectionDb.php";
		$sql = "Select a.wd_id, a.gen, a.name, a.s_name, a.n_name, a.soc_fb, a.soc_fb_2 from wd_db a WHERE a.status in (1, 2) Order By a.wd_id";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		// Echo select header
		$data_Array = array();
		$temp_data = array();
		while ($row = $res->fetch_assoc())
		{
			//$temp_data['label'] = $row['name'].' '.$row['s_name'].'('.$row['n_name'].') : '.$row['soc_fb'].' '.$row['soc_fb_2'];
			$temp_data['label'] = $row['n_name'].' : '.$row['soc_fb'].' '.$row['soc_fb_2'];
			$temp_data['value'] = $row['wd_id'].' - '.$row['n_name'].' รุ่น '.$row['gen'];
			$temp_data['category'] = 'รุ่น '.$row['gen'];
			$data_Array[] = $temp_data;
		}
		echo json_encode($data_Array);
	}
	
	function get_avi_tag_with_staff()
	{
		// Connect to MySQL Database
		include "connectionDb.php";
		$sql = "SELECT a.key_ID, a.Name, b.s_name, b.nick_name From staff a Inner Join staff_detail b ON a.key_ID = b.key_ID Order By a.key_ID";
		$res = $conn->query(trim($sql));
		// Echo select header
		$data_Array = array();
		$temp_data = array();
		while ($row = $res->fetch_assoc())
		{
			$key_id = $row['key_ID'];
			$staff_name = $row['Name'];
			$staff_s_name = $row['s_name'];
			$staff_n_name = $row['nick_name'];
			
			//$temp_data['label'] = "$staff_name $staff_s_name ($staff_n_name)";
			//$temp_data['value'] = "$key_id";
			//$temp_data['value2'] = "$staff_name $staff_s_name ($staff_n_name)";
			$temp_data['label'] = "$staff_n_name";
			$temp_data['value'] = "$key_id";
			$temp_data['value2'] = "$staff_n_name";
			$temp_data['category'] = "Staff";
			$data_Array[] = $temp_data;
		}
		
		
		
		//$sql = "Select a.wd_id, a.gen, a.name, a.s_name, a.n_name, a.soc_fb, a.soc_fb_2 from wd_db a WHERE a.status = 1 Order By a.wd_id";
		$sql = "Select a.wd_id, a.gen, a.name, a.s_name, a.n_name, a.soc_fb, a.soc_fb_2 from wd_db a Inner Join wd_team_data b ON a.wd_id = b.wd_id AND b.team_ID = 1 WHERE a.status = 1 Order By a.wd_id		";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		while ($row = $res->fetch_assoc())
		{
			//$temp_data['label'] = $row['name'].' '.$row['s_name'].'('.$row['n_name'].') : '.$row['soc_fb'].' '.$row['soc_fb_2'];
			//$temp_data['value'] = $row['wd_id'];
			//$temp_data['value2'] = $row['name'].' '.$row['s_name'].'('.$row['n_name'].')';
			
			$temp_data['label'] = $row['n_name'].' : '.$row['soc_fb'].' '.$row['soc_fb_2'];
			$temp_data['value'] = $row['wd_id'];
			$temp_data['value2'] = $row['n_name'];
			$temp_data['category'] = 'รุ่น '.$row['gen'];
			$data_Array[] = $temp_data;
		}
		echo json_encode($data_Array);
	}
	
	// F=53
	function get_last_post_from_page()
	{
		include "connectionDb.php";
		$sql = "SELECT value FROM system_value WHERE value_key = 'token_page'";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		$page_token = $row['value'];
		
		shell_exec('python3 /usr/myPi/get_short_page_post.py');
		
		// Get new Image
		$sql = "Select distinct(a.ojb_id) From (Select ojb_id From system_page_all_pub Union all Select ojb_id From system_page_all_pub_temp) a where a.ojb_id not in (Select ojb_id From system_page_all_pub_ojb_img) and a.ojb_id <> ''";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc())
		{
			$target = $row['ojb_id'];
			$img_url = "https://graph.facebook.com/v7.0/$target?fields=picture&access_token=$page_token";
			$json = file_get_contents($img_url);
			$obj_img = json_decode($json);
			$picture = "img/wd_img/default.png";
			$picture = $obj_img->picture;
			$ins_sql = "Insert Into system_page_all_pub_ojb_img value ('$target', '$picture')";
			//echo $ins_sql;
			if(!$conn->query($ins_sql))
			{
				exit();
			}
			
		}
		
		mysqli_close($conn);
	}
	
	// F= 54
	function get_status_select_list()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		// Connect to MySQL Database
		include "connectionDb.php";
		
		$sql = "Select status from wd_case Where case_id='$case_id'";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		$current_status = $row['status'];
		//$current_status = $sql;
		
		$sql = "SELECT * FROM `m_crp_status` ORDER BY sort_id";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		// Echo select header
		$data_Array = array();
		while ($row = $res->fetch_assoc())
		{
			$row['current_status'] = $current_status;
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	//F=55
	function search_case_post()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		//$sql = "Select a.*, b.img_src From ( Select * From system_page_all_pub  Union ALL Select * From system_page_all_pub_temp Where post_id not in (Select post_id From system_page_all_pub)) a Left Join system_page_all_pub_ojb_img b ON a.ojb_id = b.ojb_id WHERE a.msg like '%$search%' Order By a.pub_time DESC LIMIT 5";
		$sql = "Select a.*, b.img_src From system_page_all_pub a Left Join system_page_all_pub_ojb_img b ON a.ojb_id = b.ojb_id WHERE a.msg like '%$search%' Order By a.pub_time DESC  LIMIT 5";
		// Connect to MySQL Database
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		// Echo select header
		$data_Array = array();
		
		while ($row = $res->fetch_assoc())
		{
			
			if (trim($row['img_src']) == "")
			{
				$picture = "img/wd_img/default.png";
			}
			else
			{
				$picture = $row['img_src'];
			}
			
			$row['img_data'] = $picture ;
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
		mysqli_close($conn);
	}
	
	//F=56
	function search_case_post_selected()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		$sql = "Select a.*, b.img_src From ( Select * From system_page_all_pub Union ALL Select * From system_page_all_pub_temp Where post_id not in (Select post_id From system_page_all_pub)) a Left Join system_page_all_pub_ojb_img b ON a.ojb_id = b.ojb_id WHERE a.post_id = '$target'";
		// Connect to MySQL Database
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		// Echo select header
		$data_Array = array();
		
		while ($row = $res->fetch_assoc())
		{
			
			if (trim($row['img_src']) == "")
			{
				$picture = "img/wd_img/default.png";
			}
			else
			{
				$picture = $row['img_src'];
			}
			
			$row['img_data'] = $picture ;
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
		mysqli_close($conn);
	}
	
	//F=57
	function delete_time_line_item_fnc()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		$sql = "Select * From case_history Where rnd_str = '$target'";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		
		$main_status = array("1", "2", "3", "4", "5", "6", "7", "8");
		//echo $row['case_status'];
		if ($row['case_status'] == "0") {
			echo 'ไม่สามารถลบ "บันทึกเรื่องใหม่" ได้';
		}
		else
		{
			if (in_array($row['case_status'], $main_status)) {
				if (is_numeric($case_id))
				{
					$sql = "Select * From case_history WHERE case_id = '$case_id' and time_stmp = (Select max(time_stmp) From case_history WHERE case_id = '$case_id' and rnd_str != '$target')";
					$res = $conn->query(trim($sql));
					$row = $res->fetch_assoc();
					$new_status =  $row['case_status'];
					
					// Update currnet status
					$sql = "Update wd_case SET status = $new_status  WHERE case_id = '$case_id'";
					if(!$conn->query($sql))
					{
						echo  $conn->errno;
						exit();
					}
				}
				
			}
			
			// Delete history
			$sql = "Delete From case_pub_info Where rnd_str = '$target'";
			if(!$conn->query($sql))
			{
				echo  $conn->errno;
				exit();
			}
			
			// Delete history
			$sql = "Delete From case_history Where rnd_str = '$target'";
			if(!$conn->query($sql))
			{
				echo  $conn->errno;
				exit();
			}
			
			// Delete case EPSD
			$sql = "Delete From case_episode Where rnd_str = '$target'";
			if(!$conn->query($sql))
			{
				echo  $conn->errno;
				exit();
			}

			// Delete case case_gv_check
			$sql = "Delete From case_gv_check Where ran_id = '$target'";
			if(!$conn->query($sql))
			{
				echo  $conn->errno;
				exit();
			}

			// Delete case sp_case_post_data
			$sql = "Delete From sp_case_post_data Where RAN_STR = '$target'";
			if(!$conn->query($sql))
			{
				echo  $conn->errno;
				exit();
			}
			// Delete case sp_case_post_data
			$sql = "Delete From page_post_type Where RAN_STR = '$target'";
			if(!$conn->query($sql))
			{
				echo  $conn->errno;
				exit();
			}
			
		}
		
		// Update Query search
		$upd_search = "call search_gen()";
		if(!$conn->query($upd_search))
		{
			echo  $conn->errno;
			exit();
		}
		
		mysqli_close($conn);
	}
		// F=58
	function pub_new_post()
	{
		sleep(3);
		foreach ($_POST as $key => $value)
			{
				//$data[htmlspecialchars($key)] = htmlspecialchars($value);
				$a = htmlspecialchars($key) ;
				$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
				//echo $key . ":" . $value . "\n";
			}
		include "connectionDb.php";
		// Insert into Pub Table
		$ran_str = $case_id.gen_rnd_str(5);
		$sql = "Insert Into case_pub_info value ('$case_id', 'page_WD_post', '', '$post_id', '$ran_str')";
		// Update case type
		if(!$conn->query($sql))
		{
			exit();
		}
		// Insert into case History Table
		$sql = "Insert Into case_history value ('$case_id', 5, '$detail', '$post_id', $stf_kid, '$date', '$ran_str')";
		// Update case type
		if(!$conn->query($sql))
		{
			exit();
		}
		
		if ($new_episode == 'true')
		{
			$sql = "Insert Into case_episode Value ('$case_id', '$post_id', '$ran_str')";
			if(!$conn->query($sql))
			{
				exit();
			}
		}
		
		
		mysqli_close($conn);	
	}
	
	
	//F= 59
	function load_post_data()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
			
		include "connectionDb.php";
		$sql = "SELECT value FROM system_value WHERE value_key = 'token_page'";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		
		
		$page_token = $row['value'];
		$page_id = "372488206116588";
		$post_id = $target;
		$target = $page_id."_".$target;
		$url = "https://graph.facebook.com/v9.0/$target/?fields=full_picture,shares,comments.limit(10),message&access_token=$page_token";
		$json = file_get_contents($url);
		$obj = json_decode($json);
		$message= $obj->message;
		if (isset($obj->full_picture))
		{
			$picture= $obj->full_picture;
		}
		else
		{
			$picture = "img/wd_img/default.png";
		}
		
		$shares= $obj->shares;
		
		
		$data_Array = array();
		$data_Array['message'] = $message;
		$data_Array['target_url'] = "https://www.facebook.com/".$target;
		
		$data_Array['picture'] = $picture;
		$data_Array['shares'] = number_format($shares->count);
		
		
		$url = "https://graph.facebook.com/v9.0/$target/comments?limit=1&summary=1&access_token=$page_token";
		$json = file_get_contents($url);
		$obj = json_decode($json);
		$comment= $obj->summary->total_count;
		$data_Array['comment'] = number_format($comment);
		
		$sql = "Select * From static_post WHERE post_id = '$post_id' AND time_stmp = (SELECT max(time_stmp) From static_post WHERE post_id = '$post_id')";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc())
		{
			$data_Array[$row['f_name']] = number_format($row['value']);
			if ($row['f_name'] == 'post_impressions_unique')
			{
				$data_Array['post_star'] = cal_post_level($row['value']);
			}
		}
		
		
		
		$sql = "SELECT pub_time From system_page_all_pub WHERE post_id = '$post_id'";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		$data_Array['pub_time'] = $row['pub_time'];
		echo json_encode($data_Array);
		
		mysqli_close($conn);	
	}
	
	// F=60
	//get_case_table_v2
	function get_case_table_v2()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		//$sql = "SELECT f_name, value FROM static_post Where data_type = 1 and post_id = '$post_id' and f_name not LIKE 'post_reactions_%'";
		$sql = "Select a.case_id, a.topic, b.ofd_name, d.PROVINCE_NAME, a.ofd_dmg as ofd_dmg , CONCAT(e.sort_id, ' - ', e.crp_status) as status From wd_case a Inner JOIN (Select * From case_ofd_info GROUP BY case_id) b ON a.case_id = b.case_id Inner JOIN add_amphures c ON b.ofd_address_code = c.AMPHUR_CODE Inner JOIN add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID INNER Join m_crp_status e ON a.status = e.id";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_array()){
			$row[0] = substr($row['case_id'], 0, 2)."-" . substr($row['case_id'], 2, 2)."-" . substr($row['case_id'], 4, 3);
			if ($row[4] > 0)
			{
				$row[4] = number_format($row[4]);
			}
		else
		{
			$row[4] = "-";
		}
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	// F=61
	function get_case_table_v3()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		//$sql = "";
		//$sql = "Select a.* From (Select a.case_id, a.topic, b.ofd_name, d.PROVINCE_NAME, a.ofd_dmg as ofd_dmg , CONCAT(e.sort_id, ' - ', e.crp_status) as status, a.add_date From wd_case a Inner JOIN (Select * From case_ofd_info GROUP BY case_id) b ON a.case_id = b.case_id Inner JOIN add_amphures c ON b.ofd_address_code = c.AMPHUR_CODE Inner JOIN add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID INNER Join m_crp_status e ON a.status = e.id ) a Inner Join ( Select DISTINCT(a.case_id) From wd_case a INNER JOIN case_ofd_info b ON a.case_id = b.case_id INNER JOIN add_amphures c ON b.ofd_address_code = c.AMPHUR_CODE INNER JOIN add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID LEFT JOIN case_job_type e ON a.case_id = e.job_type INNER JOIN case_crp_type_data f ON a.case_id = f.case_id WHERE a.status in ($status_target) AND a.case_id LIKE '%$sr_case_ID%' AND a.topic LIKE '%$sr_subject%' AND b.ofd_name LIKE '%$sr_ofd_name%' AND d.PROVINCE_NAME LIKE '%$sr_ofd_prov%' AND b.ofd_type LIKE '%$sr_ofd_type%' AND IFNULL(e.job_type, '') LIKE '%$sr_job_type%' AND f.crp_type LIKE '%$sr_crp_type%' ) b ON a.case_id = b.case_id";
		//$sql = "Select a.*, c.post_value, d.diff_date From (Select a.case_id, a.topic, b.ofd_name, d.PROVINCE_NAME, a.ofd_dmg as ofd_dmg , CONCAT(e.sort_id, ' - ', e.crp_status) as status From wd_case a Inner JOIN (Select * From case_ofd_info GROUP BY case_id) b ON a.case_id = b.case_id Inner JOIN add_amphures c ON b.ofd_address_code = c.AMPHUR_CODE Inner JOIN add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID INNER Join m_crp_status e ON a.status = e.id ) a Inner Join ( Select DISTINCT(a.case_id) From wd_case a INNER JOIN case_ofd_info b ON a.case_id = b.case_id INNER JOIN add_amphures c ON b.ofd_address_code = c.AMPHUR_CODE INNER JOIN add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID LEFT JOIN case_job_type e ON a.case_id = e.job_type INNER JOIN case_crp_type_data f ON a.case_id = f.case_id WHERE a.status in ($status_target) AND a.case_id LIKE '%$sr_case_ID%' AND a.topic LIKE '%$sr_subject%' AND b.ofd_name LIKE '%$sr_ofd_name%' AND d.PROVINCE_NAME LIKE '%$sr_ofd_prov%' AND b.ofd_type LIKE '%$sr_ofd_type%' AND IFNULL(e.job_type, '') LIKE '%$sr_job_type%' AND f.crp_type LIKE '%$sr_crp_type%' ) b ON a.case_id = b.case_id Left Join get_post_reach_data c ON a.case_id = c.case_id Left Join get_post_wip_time d ON a.case_id = d.case_id";
		$sql = "Select a.*, d.diff_date From (Select a.case_id, a.topic, b.ofd_name, d.PROVINCE_NAME, a.ofd_dmg as ofd_dmg , CONCAT(e.sort_id, ' - ', e.crp_status) as status From wd_case a Inner JOIN (Select * From case_ofd_info GROUP BY case_id) b ON a.case_id = b.case_id Inner JOIN add_amphures c ON b.ofd_address_code = c.AMPHUR_CODE Inner JOIN add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID INNER Join m_crp_status e ON a.status = e.id ) a Inner Join ( Select DISTINCT(a.case_id) From wd_case a INNER JOIN case_ofd_info b ON a.case_id = b.case_id INNER JOIN add_amphures c ON b.ofd_address_code = c.AMPHUR_CODE INNER JOIN add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID LEFT JOIN case_job_type e ON a.case_id = e.job_type INNER JOIN case_crp_type_data f ON a.case_id = f.case_id WHERE a.status in ($status_target) AND a.case_id LIKE '%$sr_case_ID%' AND a.topic LIKE '%$sr_subject%' AND b.ofd_name LIKE '%$sr_ofd_name%' AND d.PROVINCE_NAME LIKE '%$sr_ofd_prov%' AND b.ofd_type LIKE '%$sr_ofd_type%' AND IFNULL(e.job_type, '') LIKE '%$sr_job_type%' AND f.crp_type LIKE '%$sr_crp_type%' ) b ON a.case_id = b.case_id Left Join get_post_wip_time d ON a.case_id = d.case_id ";
		//echo $sql;
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_array()){
			$row[0] = substr($row['case_id'], 0, 2)."-" . substr($row['case_id'], 2, 2)."-" . substr($row['case_id'], 4, 3);
			if ($row[4] > 0)
			{
				$row[4] = number_format($row[4]);
			}
			else
			{
				$row[4] = "-";
			}
			
			if ($row[6] != null)
			{
				//$row[6] = cal_post_level($row[6]);
				$row[6] = $row[6];
			}
			
			
			
			
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
			
		//echo $sql;
		//echo json_encode($data_Array);
	}
	
	
	
		//F=62
	function get_pending_case()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		//$sql = "Select a.case_id, b.topic, b.t_sum , b.case_cnt_url, b.status From case_wd_support a INNER Join wd_case b ON a.case_id = b.case_id WHERE a.wd_id = '$wd_id' Order By a.case_id DESC";
		$sql = "Select a.case_id, a.topic, a.t_sum , a.case_cnt_url, a.status From wd_case a Where a.status not in (4, 5) Order By a.add_date DESC";
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
	
	
	// F=63
	function load_bf_case()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select case_id From wd_case Where case_id < '$case_id'  ORDER BY case_id DESC LIMIT 1";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	// F=64
	function load_next_case()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select case_id From wd_case Where case_id > '$case_id'  ORDER BY case_id LIMIT 1";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	// F=65
	function load_support_wd_v2()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select a.case_id, a.wd_id, b.name, a.support_type,  b.n_name, b.gen, b.wd_img From case_wd_support a INNER JOIN wd_db b ON a.wd_id = b.wd_id Where a.case_id = '$case_id'";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	// F=66
	function load_job_type_for_select()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "SELECT DISTINCT(Job_type) AS JOBTYPE From case_job_type ORDER BY Job_type";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	// F=67
	function load_job_ofd_for_select()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "SELECT DISTINCT(ofd_type) AS OFDTYPE From case_ofd_info WHERE ofd_type <> '' ORDER BY ofd_type";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	// F=68
	function getselect_support_type_for_wd()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "SELECT support_type From m_wd_support_type Where Active = 1 Order By id";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	// F69=load_group_post_data
	function load_group_post_data()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select * From group_post_data a where a.message like '%$search_text%' Order By a.created_time DESC LIMIT 5";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	// F70 = load_group_post_data
	function load_group_post_data_detail()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "SELECT * From case_group_post a Inner Join group_post_data b ON a.group_post_id = b.id Where a.case_id = '$case_id'";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	
	// F=71 save_new_post_with_case
	function save_new_post_with_case()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		include "connectionDb.php";
		// Step 1 Update wd_ case
		$sql = "Update wd_case a Set case_cnt_url = '$post_link' Where case_id = '$case_id'"; 
		if(!$conn->query($sql))
		{
			exit();
		}
		
		// Step 2 Update case_group_post
		// 2.1 Delete current 
		//$sql = "Delete From case_group_post where case_id = '$case_id'"; 
		//if(!$conn->query($sql))
		//{
		//	exit();
		//}
		
		// 2.2 add new
		$ran_str = $case_id.gen_rnd_str(5);
		$sql = "Insert into case_group_post value ('$case_id', '$post_id', '$ran_str')"; 
		if(!$conn->query($sql))
		{
			exit();
		}



		// Load Picture scr
		$load_pic_sql = "SELECT a.full_picture FROM group_post_data a Where a.id ='$post_id'";	
		$res = $conn->query(trim($load_pic_sql));	
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		$image_url = $data_Array[0]['full_picture'];
		download_case_img($case_id, $image_url, '1');
		mysqli_close($conn);	
	}
	
	// F=72 delete_post_with_case
	function delete_post_with_case()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		include "connectionDb.php";
		// Step 1 Update wd_ case
		$sql = "Update wd_case a Set case_cnt_url = '' Where case_id = '$case_id'"; 
		if(!$conn->query($sql))
		{
			exit();
		}
		
		// Step 2 Update case_group_post
		// 2.1 Delete current 
		$sql = "Delete From case_group_post where rnd_str = '$target'"; 
		if(!$conn->query($sql))
		{
			exit();
		}
		mysqli_close($conn);	
	}
	
	// F=73 load_case_hashtag
	function load_case_hashtag()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select a.case_id, b.Hashtag, b.type, b.rnd_str From case_pub_info a Inner Join hashtag_data b ON a.pub_url = b.Ojb_id Where a.pub_type = 'page_WD_post' AND b.type = 'page' AND a.case_id = '$case_id' AND b.active = '1' UNION ALL Select a.case_id, b.Hashtag, b.type, b.rnd_str From case_group_post a Inner Join hashtag_data b ON a.group_post_id = b.Ojb_id AND b.type = 'group' AND a.case_id = '$case_id' AND b.active = '1' UNION ALL SELECT a.Ojb_id As case_id, a.Hashtag, a.type, a.rnd_str FROM hashtag_data a Where a.Ojb_id  = '$case_id' AND a.type = 'manual' and a.active = 1";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}
	
	// F=74 delete_case_hashtag
	function delete_case_hashtag()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		include "connectionDb.php";
		// Step 1 Update wd_ Case Hash tag
		$sql = "Update hashtag_data SET active = '0' Where rnd_str = '$target'"; 
		if(!$conn->query($sql))
		{
			exit();
		}
		mysqli_close($conn);	
		
	}

	// F=75 add_case_msg
	function add_case_inbox_msg()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		include "connectionDb.php";
		// Step 1 Update wd_ Case Hash tag
		$ran_str = $case_id.gen_rnd_str(5);
		$sql = "Insert into case_inbox_msg value ('$case_id', '$MSG_ID', '$ran_str', CURRENT_TIMESTAMP())"; 
		if(!$conn->query($sql))
		{
			exit();
		}
		mysqli_close($conn);	
		
	}

	// F=76 load_map_msg_4_select
	function load_map_msg_4_select()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		// Step 1 Update wd_ Case Hash tag
		$sql = "Select a.MSG_ID, b.sender_name, a.time_stmp, b.msg_link From case_inbox_msg a Inner Join page_msg b ON a.MSG_ID = b.msg_id Where a.case_id = '$case_id' Order By a.time_stmp"; 
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);	
		
	}

	// F=77 delete_case_inbox_msg
	function delete_case_inbox_msg()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		include "connectionDb.php";
		// Step 1 Update wd_ Case Hash tag
		$ran_str = $case_id.gen_rnd_str(5);
		$sql = "Delete From case_inbox_msg Where case_id = '$case_id' AND MSG_ID = '$MSG_ID'"; 
		if(!$conn->query($sql))
		{
			exit();
		}
		mysqli_close($conn);	
		
	}


	// F=78 load_new_timeline
	function load_new_timeline()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		// Step 1 Update wd_ Case Hash tag
		$sql = "Select * From vw_case_timeline a Where a.case_id = '$case_id' Order By a.time_stmp"; 
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);	
	}

	// F=79
	function load_case_search_data()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		// Step 1 Update wd_ Case Hash tag
		//$sql = "Select a.case_id, a.topic, a.t_sum, a.add_date, c.ofd_name, b.IMG From wd_case a Left Join vw_case_img b ON a.case_id = b.case_id Left Join (Select a.case_id, b.ofd_name From wd_case a Left Join case_ofd_info b ON a.case_id = b.case_id Group By a.case_id) c ON a.case_id = c.case_id Order By a.add_date DESC "; 
		//$sql = "Select a.case_id , a.status , a.priority, a.case_cnt_url, g.crp_status , a.topic , a.t_sum , a.case_folder_url , IFNULL(IFNULL(f.img_src, c.full_picture), 'img/wd_img/default.png') AS img From wd_case a Inner Join m_crp_status g ON a.status = g.id Left Join case_group_post b ON a.case_id = b.case_id Left Join group_post_data c ON b.group_post_id = c.id Left Join case_pub_info d ON a.case_id = d.case_id Left Join system_page_all_pub e ON d.pub_url = e.post_id Left Join system_page_all_pub_ojb_img f ON e.ojb_id = f.ojb_id And d.pub_type = 'page_WD_post' Order By a.case_id DESC";
		//$sql = "Select a.case_id, a.topic, a.t_sum, a.add_date, IFNULL(IFNULL(b.IMG, c.IMG), 'img/wd_img/default.png') AS IMG From wd_case a Left Join ( Select a.case_id, c.img_src AS IMG From case_pub_info a Inner Join system_page_all_pub b ON a.pub_url = b.post_id Inner Join system_page_all_pub_ojb_img c ON b.ojb_id = c.ojb_id Where a.pub_type = 'page_WD_post' AND b.pub_time IN (Select MIN(b.pub_time) AS POST_TIME From case_pub_info a Inner Join system_page_all_pub b ON a.pub_url = b.post_id Where a.pub_type = 'page_WD_post' GROUP BY a.case_id )) b ON a.case_id = b.case_id LEFT JOIN (Select a.case_id, b.full_picture AS IMG From case_group_post a Inner Join group_post_data b ON a.group_post_id = b.id) c ON a.case_id = c.case_id Order By a.case_id DESC";
		//$sql = "Select a.case_id, a.topic, a.t_sum, a.add_date, a.status, d.crp_status, IFNULL(IFNULL(b.IMG, c.IMG), 'img/wd_img/default.png') AS IMG From wd_case a Left Join ( Select a.case_id, c.img_src AS IMG From case_pub_info a Inner Join system_page_all_pub b ON a.pub_url = b.post_id Inner Join system_page_all_pub_ojb_img c ON b.ojb_id = c.ojb_id Where a.pub_type = 'page_WD_post' AND b.pub_time IN (Select MIN(b.pub_time) AS POST_TIME From case_pub_info a Inner Join system_page_all_pub b ON a.pub_url = b.post_id Where a.pub_type = 'page_WD_post' GROUP BY a.case_id )) b ON a.case_id = b.case_id LEFT JOIN (Select a.case_id, b.full_picture AS IMG From case_group_post a Inner Join group_post_data b ON a.group_post_id = b.id) c ON a.case_id = c.case_id Inner Join m_crp_status d ON a.status = d.id Order By a.case_id DESC";
		//$sql = "Select a.case_id, a.topic, a.t_sum, a.add_date,d.ofd_name, d.PROVINCE_NAME, IFNULL(IFNULL(b.IMG, c.IMG), 'img/wd_img/default.png') AS IMG From wd_case a Left Join ( Select a.case_id, c.img_src AS IMG From case_pub_info a Inner Join system_page_all_pub b ON a.pub_url = b.post_id Inner Join system_page_all_pub_ojb_img c ON b.ojb_id = c.ojb_id Where a.pub_type = 'page_WD_post' AND b.pub_time IN (Select MIN(b.pub_time) AS POST_TIME From case_pub_info a Inner Join system_page_all_pub b ON a.pub_url = b.post_id Where a.pub_type = 'page_WD_post' GROUP BY a.case_id )) b ON a.case_id = b.case_id LEFT JOIN (Select a.case_id, b.full_picture AS IMG From case_group_post a Inner Join group_post_data b ON a.group_post_id = b.id) c ON a.case_id = c.case_id LEFT JOIN ( Select a.case_id, a.ofd_name, c.PROVINCE_NAME From case_ofd_info a Inner Join add_amphures b ON a.ofd_address_code = b.AMPHUR_CODE Inner Join add_provinces c ON b.PROVINCE_ID = c.PROVINCE_ID Group By a.case_id ) d ON a.case_id = d.case_id Order By a.case_id DESC";
		$sql = "Select a.case_id, a.topic, a.t_sum, a.add_date,d.ofd_name, a.status, d.PROVINCE_NAME,e.crp_status, IFNULL(IFNULL(b.IMG, c.IMG), 'img/wd_img/default.png') AS IMG From wd_case a Left Join ( Select a.case_id, c.img_src AS IMG From case_pub_info a Inner Join system_page_all_pub b ON a.pub_url = b.post_id Inner Join system_page_all_pub_ojb_img c ON b.ojb_id = c.ojb_id Where a.pub_type = 'page_WD_post' AND b.pub_time IN (Select MIN(b.pub_time) AS POST_TIME From case_pub_info a Inner Join system_page_all_pub b ON a.pub_url = b.post_id Where a.pub_type = 'page_WD_post' GROUP BY a.case_id )) b ON a.case_id = b.case_id LEFT JOIN (Select a.case_id, b.full_picture AS IMG From case_group_post a Inner Join group_post_data b ON a.group_post_id = b.id) c ON a.case_id = c.case_id LEFT JOIN ( Select a.case_id, a.ofd_name, c.PROVINCE_NAME From case_ofd_info a Inner Join add_amphures b ON a.ofd_address_code = b.AMPHUR_CODE Inner Join add_provinces c ON b.PROVINCE_ID = c.PROVINCE_ID Group By a.case_id ) d ON a.case_id = d.case_id Inner Join m_crp_status e ON a.status = e.id Order By a.case_id DESC";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$row['print_case_id'] = substr($row['case_id'],0, 2).'-'.substr($row['case_id'],2, 2).'-'.substr($row['case_id'],4);
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);	
	}

	// F=80
	function case_search_data_text()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		// 
		$search_target = str_replace("-", "", $search_target);
		//$sql = "Select a.case_id, a.topic, a.t_sum, a.add_date,d.ofd_name, a.status, d.PROVINCE_NAME,e.crp_status, IFNULL(IFNULL(b.IMG, c.IMG), 'img/wd_img/default.png') AS IMG From wd_case a Left Join ( Select a.case_id, c.img_src AS IMG From case_pub_info a Inner Join system_page_all_pub b ON a.pub_url = b.post_id Inner Join system_page_all_pub_ojb_img c ON b.ojb_id = c.ojb_id Where a.pub_type = 'page_WD_post' AND b.pub_time IN (Select MIN(b.pub_time) AS POST_TIME From case_pub_info a Inner Join system_page_all_pub b ON a.pub_url = b.post_id Where a.pub_type = 'page_WD_post' GROUP BY a.case_id )) b ON a.case_id = b.case_id LEFT JOIN (Select a.case_id, b.full_picture AS IMG From case_group_post a Inner Join group_post_data b ON a.group_post_id = b.id) c ON a.case_id = c.case_id LEFT JOIN ( Select a.case_id, a.ofd_name, c.PROVINCE_NAME From case_ofd_info a Inner Join add_amphures b ON a.ofd_address_code = b.AMPHUR_CODE Inner Join add_provinces c ON b.PROVINCE_ID = c.PROVINCE_ID Group By a.case_id ) d ON a.case_id = d.case_id Inner Join m_crp_status e ON a.status = e.id Order By a.case_id DESC";
		//$sql = "Select a.case_id, a.topic, a.t_sum, a.add_date,d.ofd_name, a.status, d.PROVINCE_NAME,e.crp_status, IFNULL(IFNULL(b.IMG, c.IMG), 'img/wd_img/default.png') AS IMG From wd_case a Left Join ( Select a.case_id, c.img_src AS IMG From case_pub_info a Inner Join system_page_all_pub b ON a.pub_url = b.post_id Inner Join system_page_all_pub_ojb_img c ON b.ojb_id = c.ojb_id Where a.pub_type = 'page_WD_post' AND b.pub_time IN (Select MIN(b.pub_time) AS POST_TIME From case_pub_info a Inner Join system_page_all_pub b ON a.pub_url = b.post_id Where a.pub_type = 'page_WD_post' GROUP BY a.case_id )) b ON a.case_id = b.case_id LEFT JOIN (Select a.case_id, b.full_picture AS IMG From case_group_post a Inner Join group_post_data b ON a.group_post_id = b.id) c ON a.case_id = c.case_id LEFT JOIN ( Select a.case_id, a.ofd_name, c.PROVINCE_NAME From case_ofd_info a Inner Join add_amphures b ON a.ofd_address_code = b.AMPHUR_CODE Inner Join add_provinces c ON b.PROVINCE_ID = c.PROVINCE_ID Group By a.case_id ) d ON a.case_id = d.case_id Inner Join m_crp_status e ON a.status = e.id Where a.case_id IN (Select DISTINCT(s.case_id) From ( Select a.case_id, CONCAT_WS(a.case_id, a.topic, a.t_sum, a.note, b.ofd_name, c.AMPHUR_NAME, d.PROVINCE_NAME, e.GEO_NAME, f.Hashtag, g.crp_type) AS case_data From wd_case a Left Join case_ofd_info b ON a.case_id = b.case_id Left Join add_amphures c ON b.ofd_address_code = c.AMPHUR_CODE Left Join add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID Left Join add_geography e ON e.GEO_ID = c.GEO_ID Left join case_hashtag f On a.case_id = f.case_id Left Join case_crp_type_data g ON a.case_id = g.case_id) s WHERE s.case_data LIKE '%$search_target%' Group By s.case_id) Order By a.case_id DESC";
		//$sql = "Select a.case_id, a.topic, a.t_sum, a.add_date, d.ofd_name, a.status, d.PROVINCE_NAME, e.crp_status, IFNULL(IFNULL(b.IMG, c.IMG), 'img/wd_img/default.png') AS IMG From wd_case a Left Join ( Select a.case_id, c.ojb_id , c.img_src AS IMG From case_pub_info a Inner Join system_page_all_pub b ON a.pub_url = b.post_id Inner Join system_page_all_pub_ojb_img c ON b.ojb_id = c.ojb_id Inner Join ( Select a.case_id, MIN(b.pub_time) AS POST_TIME From case_pub_info a Inner Join system_page_all_pub b ON a.pub_url = b.post_id Where a.pub_type = 'page_WD_post' GROUP BY a.case_id ) d ON a.case_id = d.case_id and b.pub_time = d.POST_TIME Where a.pub_type = 'page_WD_post' ) b ON a.case_id = b.case_id LEFT JOIN ( Select a.case_id, b.full_picture AS IMG From case_group_post a Inner Join group_post_data b ON a.group_post_id = b.id ) c ON a.case_id = c.case_id LEFT JOIN ( Select a.case_id, a.ofd_name, c.PROVINCE_NAME From case_ofd_info a Inner Join add_amphures b ON a.ofd_address_code = b.AMPHUR_CODE Inner Join add_provinces c ON b.PROVINCE_ID = c.PROVINCE_ID Group By a.case_id ) d ON a.case_id = d.case_id Inner Join m_crp_status e ON a.status = e.id Where a.case_id IN ( Select DISTINCT (s.case_id) From ( Select a.case_id, CONCAT_WS(a.case_id, a.topic, a.t_sum, a.note, b.ofd_name, c.AMPHUR_NAME, d.PROVINCE_NAME, e.GEO_NAME, f.Hashtag, g.crp_type) AS case_data From wd_case a Left Join case_ofd_info b ON a.case_id = b.case_id Left Join add_amphures c ON b.ofd_address_code = c.AMPHUR_CODE Left Join add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID Left Join add_geography e ON e.GEO_ID = c.GEO_ID Left join case_hashtag f On a.case_id = f.case_id Left Join case_crp_type_data g ON a.case_id = g.case_id ) s WHERE s.case_data LIKE '%$search_target%' Group By s.case_id ) Order By a.case_id DESC";
		$sql = "SELECT a.case_id,
		a.topic,
		a.t_sum,
		a.add_date,
		d.ofd_name,
		a.status,
		d.province_name,
		e.crp_status,
		Ifnull(Ifnull(b.img, c.img), 'img/wd_img/default.png') AS IMG
 FROM   wd_case a
		LEFT JOIN (SELECT a.case_id,
						  c.ojb_id,
						  c.img_src AS IMG
				   FROM   case_pub_info a
						  INNER JOIN system_page_all_pub b
								  ON a.pub_url = b.post_id
						  INNER JOIN system_page_all_pub_ojb_img c
								  ON b.ojb_id = c.ojb_id
						  INNER JOIN (SELECT a.case_id,
											 Min(b.pub_time) AS POST_TIME
									  FROM   case_pub_info a
											 INNER JOIN system_page_all_pub b
													 ON a.pub_url = b.post_id
									  WHERE  a.pub_type = 'page_WD_post'
									  GROUP  BY a.case_id) d
								  ON a.case_id = d.case_id
									 AND b.pub_time = d.post_time
				   WHERE  a.pub_type = 'page_WD_post') b
			   ON a.case_id = b.case_id
		LEFT JOIN (SELECT a.case_id,
						  b.full_picture AS IMG
				   FROM   case_group_post a
						  INNER JOIN group_post_data b
								  ON a.group_post_id = b.id) c
			   ON a.case_id = c.case_id
		LEFT JOIN (SELECT a.case_id,
						  a.ofd_name,
						  c.province_name
				   FROM   case_ofd_info a
						  INNER JOIN add_amphures b
								  ON a.ofd_address_code = b.amphur_code
						  INNER JOIN add_provinces c
								  ON b.province_id = c.province_id
				   GROUP  BY a.case_id) d
			   ON a.case_id = d.case_id
		INNER JOIN m_crp_status e
				ON a.status = e.id
 WHERE  a.case_id IN (Select DISTINCT(z.CASE_ID) From case_search_temp z where z.search_area like '%$search_target%')
 ORDER  BY a.case_id DESC ";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		$cnt = 0;
		while ($row = $res->fetch_assoc()){
			$cnt ++;
			$row['print_case_id'] = substr($row['case_id'],0, 2).'-'.substr($row['case_id'],2, 2).'-'.substr($row['case_id'],4);
			$data_Array[] = $row;
			if ($cnt == 2000)
			{
				break;
			}
		}
		echo json_encode($data_Array);	
	}

	// 81
	function load_ofd_name_2()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "SELECT * FROM case_ofd_info where case_id = '$case_id'";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);	
	}

	function load_attached_data()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		//$sql = "Select c.file_name, c.File_URL, d.ext From case_inbox_msg a Inner Join page_msg_detail b ON a.MSG_ID = b.MSG_ID Inner Join Page_MSG_Attached c ON b.MSG_DTL_ID = c.MSG_DTL_ID Left Join msg_attached_file_type d ON c.file_type = d.type WHere a.case_id = '$case_id'";
		//$sql = "Select c.file_name, c.File_URL, d.ext From case_inbox_msg a Inner Join page_msg_detail b ON a.MSG_ID = b.MSG_ID Inner Join Page_MSG_Attached c ON b.MSG_DTL_ID = c.MSG_DTL_ID Left Join msg_attached_file_type d ON c.file_type = d.type WHere a.case_id = '$case_id' Union All Select fileName, URL, fileType From case_firebase_img a WHere a.case_id = '$case_id' ";
		$sql = "Select fileName AS file_name, URL AS File_URL, fileType AS ext From case_firebase_img a WHere a.case_id = '$case_id'";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		//echo $sql;
		echo json_encode($data_Array);	
	}

	function load_case_data_v2 ()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		//$sql = "SELECT a.case_id, a.topic, a.t_sum, a.status, h.crp_status, a.add_date, a.crp_dmg_off, a.ofd_dmg, Ifnull(b.total, 0) AS count_ep, IFnull(c.job_type, '-') AS Job_Type, d.crp_type, IFNULL(e.engegement, 0) AS engegement , IFNULL( e.reach, 0) AS REACH, f.pubtime, ifnull(f.count_post, 0) as count_post , g.ofd_name, g.ofd_type, g.org_type_name, g.amphur_name, g.province_name, g.geo_name, i.img FROM wd_case a LEFT JOIN count_episode b ON a.case_id = b.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.job_type) AS job_type FROM case_job_type a GROUP BY a.case_id) c ON a.case_id = c.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.crp_type) AS crp_type FROM case_crp_type_data a GROUP BY a.case_id) d ON a.case_id = d.case_id LEFT JOIN (SELECT a.case_id, Sum(e.value) AS value, Sum(CASE WHEN e.f_name = 'post_engaged_users' THEN e.value ELSE 0 END) AS engegement, Sum(CASE WHEN e.f_name = 'post_impressions_unique' THEN e.value ELSE 0 END) AS reach FROM wd_case a INNER JOIN case_pub_info b ON a.case_id = b.case_id INNER JOIN static_post e ON b.pub_url = e.post_id WHERE e.data_type = 1 AND f_name IN ( 'post_engaged_users', 'post_impressions_unique' ) AND Year(a.add_date) = 2019 GROUP BY a.case_id ORDER BY a.case_id) e ON a.case_id = e.case_id LEFT JOIN (SELECT a.case_id, Count(b.post_id) AS count_post, Min(b.pub_time) AS pubtime FROM case_pub_info a INNER JOIN system_page_all_pub b ON a.pub_url = b.post_id WHERE a.pub_type = 'page_WD_post' GROUP BY a.case_id) f ON a.case_id = f.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.ofd_name) AS ofd_name, Group_concat(DISTINCT a.ofd_type) AS ofd_type, Group_concat(DISTINCT e.org_type_name) AS org_type_name , Group_concat(DISTINCT b.amphur_name) AS AMPHUR_NAME, Group_concat(DISTINCT c.province_name) AS PROVINCE_NAME , Group_concat(DISTINCT d.geo_name) AS GEO_NAME FROM case_ofd_info a INNER JOIN add_amphures b ON a.ofd_address_code = b.amphur_code INNER JOIN add_provinces c ON b.province_id = c.province_id INNER JOIN add_geography d ON c.geo_id = d.geo_id INNER JOIN m_org_type e ON a.org_type_id = e.org_type_id GROUP BY a.case_id) g ON a.case_id = g.case_id Inner Join m_crp_status h ON a.status = h.id Left Join vw_case_img i ON a.case_id = i.case_id WHERE Year(a.add_date) = 2019 ORDER BY a.case_id DESC";
		$sql = "SELECT a.case_id, a.topic, a.t_sum, a.status, h.crp_status, a.add_date, a.crp_dmg_off, a.ofd_dmg, Ifnull(b.total, 0) AS count_ep, IFnull(c.job_type, '-') AS Job_Type, d.crp_type, IFNULL(e.engegement, 0) AS engegement , IFNULL( e.reach, 0) AS REACH, f.pubtime, ifnull(f.count_post, 0) as count_post , g.ofd_name, g.ofd_type, g.org_type_name, g.amphur_name, g.province_name, g.geo_name, i.img FROM wd_case a LEFT JOIN count_episode b ON a.case_id = b.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.job_type) AS job_type FROM case_job_type a GROUP BY a.case_id) c ON a.case_id = c.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.crp_type) AS crp_type FROM case_crp_type_data a GROUP BY a.case_id) d ON a.case_id = d.case_id LEFT JOIN (SELECT a.case_id, Sum(e.value) AS value, Sum(CASE WHEN e.f_name = 'post_engaged_users' THEN e.value ELSE 0 END) AS engegement, Sum(CASE WHEN e.f_name = 'post_impressions_unique' THEN e.value ELSE 0 END) AS reach FROM wd_case a INNER JOIN case_pub_info b ON a.case_id = b.case_id INNER JOIN static_post e ON b.pub_url = e.post_id WHERE e.data_type = 1 AND f_name IN ( 'post_engaged_users', 'post_impressions_unique' ) AND Year(a.add_date) = $select_year GROUP BY a.case_id ORDER BY a.case_id) e ON a.case_id = e.case_id LEFT JOIN (SELECT a.case_id, Count(b.post_id) AS count_post, Min(b.pub_time) AS pubtime FROM case_pub_info a INNER JOIN system_page_all_pub b ON a.pub_url = b.post_id WHERE a.pub_type = 'page_WD_post' GROUP BY a.case_id) f ON a.case_id = f.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.ofd_name) AS ofd_name, Group_concat(DISTINCT a.ofd_type) AS ofd_type, Group_concat(DISTINCT e.org_type_name) AS org_type_name , Group_concat(DISTINCT b.amphur_name) AS AMPHUR_NAME, Group_concat(DISTINCT c.province_name) AS PROVINCE_NAME , Group_concat(DISTINCT d.geo_name) AS GEO_NAME FROM case_ofd_info a INNER JOIN add_amphures b ON a.ofd_address_code = b.amphur_code INNER JOIN add_provinces c ON b.province_id = c.province_id INNER JOIN add_geography d ON c.geo_id = d.geo_id INNER JOIN m_org_type e ON a.org_type_id = e.org_type_id GROUP BY a.case_id) g ON a.case_id = g.case_id Inner Join m_crp_status h ON a.status = h.id Left Join vw_case_img i ON a.case_id = i.case_id WHERE Year(a.add_date) = $select_year ORDER BY a.case_id DESC";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$row['print_case_id'] = substr($row['case_id'],0, 2).'-'.substr($row['case_id'],2, 2).'-'.substr($row['case_id'],4);
			$data_Array[] = $row;
		}
		//echo $sql;
		echo json_encode($data_Array);	
	}


	// F=84
	function dl_excel_file_case()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$tbl_f = array();
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
		//$sql = "SELECT a.case_id AS 'CASE ID', a.topic AS 'หัวข้อ', h.crp_status AS 'สถานะ', g.ofd_name AS 'หน่วยงาน', g.ofd_type AS 'ประเภทหน่วยงาน', g.org_type_name AS 'องค์กร', g.amphur_name AS 'อำเภอ', g.province_name AS 'จังหวัด', g.geo_name AS 'ภาค', a.crp_dmg_off AS 'มูลค่าโครงการ', a.ofd_dmg AS 'ความเสียหาย', Ifnull(b.total, '-') AS 'จำนวน EP', Ifnull(c.job_type, '-') AS 'ประเภทงาน', d.crp_type AS 'ประเด็นทุจริต' , Ifnull(e.engegement, '-') AS Engegement, Ifnull(e.reach, '-') AS Reach, a.add_date AS 'เข้าระบบ', Ifnull(Date(f.pubtime), '-') AS 'วันลงเพจ', Ifnull(f.count_post, '-') AS 'จำนวนโพส' FROM wd_case a LEFT JOIN count_episode b ON a.case_id = b.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.job_type) AS job_type FROM case_job_type a GROUP BY a.case_id) c ON a.case_id = c.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.crp_type) AS crp_type FROM case_crp_type_data a GROUP BY a.case_id) d ON a.case_id = d.case_id LEFT JOIN (SELECT a.case_id, Sum(e.value) AS value, Sum(CASE WHEN e.f_name = 'post_engaged_users' THEN e.value ELSE 0 end) AS engegement, Sum(CASE WHEN e.f_name = 'post_impressions_unique' THEN e.value ELSE 0 end) AS reach FROM wd_case a INNER JOIN case_pub_info b ON a.case_id = b.case_id INNER JOIN static_post e ON b.pub_url = e.post_id WHERE e.data_type = 1 AND f_name IN ( 'post_engaged_users', 'post_impressions_unique' ) AND Year(a.add_date) = $select_year GROUP BY a.case_id ORDER BY a.case_id) e ON a.case_id = e.case_id LEFT JOIN (SELECT a.case_id, Count(b.post_id) AS count_post, Min(b.pub_time) AS pubtime FROM case_pub_info a INNER JOIN system_page_all_pub b ON a.pub_url = b.post_id WHERE a.pub_type = 'page_WD_post' GROUP BY a.case_id) f ON a.case_id = f.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.ofd_name) AS ofd_name, Group_concat(DISTINCT a.ofd_type) AS ofd_type, Group_concat(DISTINCT e.org_type_name) AS org_type_name , Group_concat(DISTINCT b.amphur_name) AS AMPHUR_NAME, Group_concat(DISTINCT c.province_name) AS PROVINCE_NAME , Group_concat(DISTINCT d.geo_name) AS GEO_NAME FROM case_ofd_info a INNER JOIN add_amphures b ON a.ofd_address_code = b.amphur_code INNER JOIN add_provinces c ON b.province_id = c.province_id INNER JOIN add_geography d ON c.geo_id = d.geo_id INNER JOIN m_org_type e ON a.org_type_id = e.org_type_id GROUP BY a.case_id) g ON a.case_id = g.case_id INNER JOIN m_crp_status h ON a.status = h.id WHERE Year(a.add_date) = $select_year ORDER BY a.case_id";
		$sql = " SELECT a.case_id                    AS 'CASE ID',
					a.topic                      AS 'หัวข้อ',
					h.crp_status                 AS 'สถานะ',
					g.ofd_name                   AS 'หน่วยงาน',
					g.ofd_type                   AS 'ประเภทหน่วยงาน',
					g.org_type_name              AS 'องค์กร',
					g.amphur_name                AS 'อำเภอ',
					g.province_name              AS 'จังหวัด',
					g.geo_name                   AS 'ภาค',
					a.crp_dmg_off                AS 'มูลค่าโครงการ'
					,
					a.ofd_dmg                    AS
					'ความเสียหาย',
					Ifnull(b.total, '-')         AS 'จำนวน EP',
					Ifnull(c.job_type, '-')      AS 'ประเภทงาน',
					d.crp_type                   AS 'ประเด็นทุจริต'
					,
					Ifnull(e.engegement, '-')    AS Engegement,
					Ifnull(e.reach, '-')         AS Reach,
					a.add_date                   AS 'เข้าระบบ',
					Ifnull(Date(f.pubtime), '-') AS 'วันลงเพจ',
					Ifnull(f.count_post, '-')    AS 'จำนวนโพส',
					Ifnull(i.Gov_CHECK, '-') AS 'หน่วยงานเข้าตรวจสอบ'
			FROM   wd_case a
					LEFT JOIN count_episode b
						ON a.case_id = b.case_id
					LEFT JOIN (SELECT a.case_id,
									Group_concat(DISTINCT a.job_type) AS job_type
							FROM   case_job_type a
							GROUP  BY a.case_id) c
						ON a.case_id = c.case_id
					LEFT JOIN (SELECT a.case_id,
									Group_concat(DISTINCT a.crp_type) AS crp_type
							FROM   case_crp_type_data a
							GROUP  BY a.case_id) d
						ON a.case_id = d.case_id
					LEFT JOIN (SELECT a.case_id,
									Sum(e.value) AS value,
									Sum(CASE
											WHEN e.f_name = 'post_engaged_users' THEN e.value
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
									AND Year(a.add_date) = $select_year
							GROUP  BY a.case_id
							ORDER  BY a.case_id) e
						ON a.case_id = e.case_id
					LEFT JOIN (SELECT a.case_id,
									Count(b.post_id) AS count_post,
									Min(b.pub_time)  AS pubtime
							FROM   case_pub_info a
									INNER JOIN system_page_all_pub b
											ON a.pub_url = b.post_id
							WHERE  a.pub_type = 'page_WD_post'
							GROUP  BY a.case_id) f
						ON a.case_id = f.case_id
					LEFT JOIN (SELECT a.case_id,
									Group_concat(DISTINCT a.ofd_name)      AS ofd_name,
									Group_concat(DISTINCT a.ofd_type)      AS ofd_type,
									Group_concat(DISTINCT e.org_type_name) AS org_type_name
									,
									Group_concat(DISTINCT
									b.amphur_name)   AS AMPHUR_NAME,
									Group_concat(DISTINCT c.province_name) AS PROVINCE_NAME
									,
									Group_concat(DISTINCT
									d.geo_name)      AS GEO_NAME
							FROM   case_ofd_info a
									INNER JOIN add_amphures b
											ON a.ofd_address_code = b.amphur_code
									INNER JOIN add_provinces c
											ON b.province_id = c.province_id
									INNER JOIN add_geography d
											ON c.geo_id = d.geo_id
									INNER JOIN m_org_type e
											ON a.org_type_id = e.org_type_id
							GROUP  BY a.case_id) g
						ON a.case_id = g.case_id
					INNER JOIN m_crp_status h
							ON a.status = h.id
					Left Join ( Select a.case_id,  GROUP_CONCAT(b.s_name) AS Gov_CHECK  From case_gv_check a 
									Inner Join m_gov_check b ON a.gc_id = b.gc_id  
									GROUP By a.case_id  ) i ON a.case_id = i.case_id
			WHERE  Year(a.add_date) = $select_year
			ORDER  BY a.case_id ";
		
		$res = $conn->query(trim($sql));
		mysqli_close($conn);

		// Set Active Sheet = 0
		$objPHPExcel->setActiveSheetIndex(0);

		// Print_page Heder
		$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
		$objPHPExcel->getActiveSheet()->setCellValue("A1", "สรุป Case ปี ".$select_year);
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
			$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $property->name);
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

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('ข้อมูลเคส');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		$file_name = "files/ข้อมูลเคส_".date('dmyH').gen_rnd_str(4);
		$file_name.= ".xlsx";
		$objWriter = new Xlsx($objPHPExcel);
		$objWriter->save($file_name);
		echo '<button type="button" class="btn btn-box-tool" onclick="location.href='."'".$file_name."'".'"> <i class="fa fa-file-excel-o"></i> Download Excel</button>';

	}

	
	/* ======== OLD Function ===================================================== 
	function dl_excel_file_case_2()
	{
		foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+/////]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			//echo $key . ":" . $value . "\n";
		}
		$tbl_f = array();
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
		//$sql = "SELECT a.case_id, a.topic, a.t_sum, a.status, h.crp_status, a.add_date, a.crp_dmg_off, a.ofd_dmg, Ifnull(b.total, 0) AS count_ep, IFnull(c.job_type, '-') AS Job_Type, d.crp_type, IFNULL(e.engegement, 0) AS engegement , IFNULL( e.reach, 0) AS REACH, f.pubtime, ifnull(f.count_post, 0) as count_post , g.ofd_name, g.ofd_type, g.org_type_name, g.amphur_name, g.province_name, g.geo_name, i.img FROM wd_case a LEFT JOIN count_episode b ON a.case_id = b.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.job_type) AS job_type FROM case_job_type a GROUP BY a.case_id) c ON a.case_id = c.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.crp_type) AS crp_type FROM case_crp_type_data a GROUP BY a.case_id) d ON a.case_id = d.case_id LEFT JOIN (SELECT a.case_id, Sum(e.value) AS value, Sum(CASE WHEN e.f_name = 'post_engaged_users' THEN e.value ELSE 0 END) AS engegement, Sum(CASE WHEN e.f_name = 'post_impressions_unique' THEN e.value ELSE 0 END) AS reach FROM wd_case a INNER JOIN case_pub_info b ON a.case_id = b.case_id INNER JOIN static_post e ON b.pub_url = e.post_id WHERE e.data_type = 1 AND f_name IN ( 'post_engaged_users', 'post_impressions_unique' ) AND Year(a.add_date) = $select_year GROUP BY a.case_id ORDER BY a.case_id) e ON a.case_id = e.case_id LEFT JOIN (SELECT a.case_id, Count(b.post_id) AS count_post, Min(b.pub_time) AS pubtime FROM case_pub_info a INNER JOIN system_page_all_pub b ON a.pub_url = b.post_id WHERE a.pub_type = 'page_WD_post' GROUP BY a.case_id) f ON a.case_id = f.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.ofd_name) AS ofd_name, Group_concat(DISTINCT a.ofd_type) AS ofd_type, Group_concat(DISTINCT e.org_type_name) AS org_type_name , Group_concat(DISTINCT b.amphur_name) AS AMPHUR_NAME, Group_concat(DISTINCT c.province_name) AS PROVINCE_NAME , Group_concat(DISTINCT d.geo_name) AS GEO_NAME FROM case_ofd_info a INNER JOIN add_amphures b ON a.ofd_address_code = b.amphur_code INNER JOIN add_provinces c ON b.province_id = c.province_id INNER JOIN add_geography d ON c.geo_id = d.geo_id INNER JOIN m_org_type e ON a.org_type_id = e.org_type_id GROUP BY a.case_id) g ON a.case_id = g.case_id Inner Join m_crp_status h ON a.status = h.id Left Join vw_case_img i ON a.case_id = i.case_id WHERE Year(a.add_date) = $select_year ORDER BY a.case_id DESC";
		$sql = "SELECT a.case_id AS 'CASE ID', a.topic AS 'หัวข้อ', h.crp_status AS 'สถานะ', g.ofd_name AS 'หน่วยงาน', g.ofd_type AS 'ประเภทหน่วยงาน', g.org_type_name AS 'องค์กร', g.amphur_name AS 'อำเภอ', g.province_name AS 'จังหวัด', g.geo_name AS 'ภาค', a.crp_dmg_off AS 'มูลค่าโครงการ', a.ofd_dmg AS 'ความเสียหาย', Ifnull(b.total, '-') AS 'จำนวน EP', Ifnull(c.job_type, '-') AS 'ประเภทงาน', d.crp_type AS 'ประเด็นทุจริต' , Ifnull(e.engegement, '-') AS Engegement, Ifnull(e.reach, '-') AS Reach, a.add_date AS 'เข้าระบบ', Ifnull(Date(f.pubtime), '-') AS 'วันลงเพจ', Ifnull(f.count_post, '-') AS 'จำนวนโพส' FROM wd_case a LEFT JOIN count_episode b ON a.case_id = b.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.job_type) AS job_type FROM case_job_type a GROUP BY a.case_id) c ON a.case_id = c.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.crp_type) AS crp_type FROM case_crp_type_data a GROUP BY a.case_id) d ON a.case_id = d.case_id LEFT JOIN (SELECT a.case_id, Sum(e.value) AS value, Sum(CASE WHEN e.f_name = 'post_engaged_users' THEN e.value ELSE 0 end) AS engegement, Sum(CASE WHEN e.f_name = 'post_impressions_unique' THEN e.value ELSE 0 end) AS reach FROM wd_case a INNER JOIN case_pub_info b ON a.case_id = b.case_id INNER JOIN static_post e ON b.pub_url = e.post_id WHERE e.data_type = 1 AND f_name IN ( 'post_engaged_users', 'post_impressions_unique' ) AND Year(a.add_date) = $select_year GROUP BY a.case_id ORDER BY a.case_id) e ON a.case_id = e.case_id LEFT JOIN (SELECT a.case_id, Count(b.post_id) AS count_post, Min(b.pub_time) AS pubtime FROM case_pub_info a INNER JOIN system_page_all_pub b ON a.pub_url = b.post_id WHERE a.pub_type = 'page_WD_post' GROUP BY a.case_id) f ON a.case_id = f.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.ofd_name) AS ofd_name, Group_concat(DISTINCT a.ofd_type) AS ofd_type, Group_concat(DISTINCT e.org_type_name) AS org_type_name , Group_concat(DISTINCT b.amphur_name) AS AMPHUR_NAME, Group_concat(DISTINCT c.province_name) AS PROVINCE_NAME , Group_concat(DISTINCT d.geo_name) AS GEO_NAME FROM case_ofd_info a INNER JOIN add_amphures b ON a.ofd_address_code = b.amphur_code INNER JOIN add_provinces c ON b.province_id = c.province_id INNER JOIN add_geography d ON c.geo_id = d.geo_id INNER JOIN m_org_type e ON a.org_type_id = e.org_type_id GROUP BY a.case_id) g ON a.case_id = g.case_id INNER JOIN m_crp_status h ON a.status = h.id WHERE Year(a.add_date) = $select_year ORDER BY a.case_id";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		
		// Set Active Sheet = 0
		$objPHPExcel->setActiveSheetIndex(0);
		
		// Print_page Heder
		$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
		$objPHPExcel->getActiveSheet()->setCellValue("A1", "สรุป Case ปี ".$select_year);
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
					
					//if ($row['wd_status'] == "Banned")
					//{
					//	$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleBan);
					//}
					$i_colum++;
				}
				
		}

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('ข้อมูลเคส');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		// Save Excel 2007 file
		// File_name
		//$file_name = "test";
		$file_name = "files/WD_data_".date('dmyH').gen_rnd_str(4);
		$file_name.= ".xlsx";
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save($file_name);
		echo '<button type="button" class="btn btn-box-tool" onclick="location.href='."'".$file_name."'".'">Download</button>';
		//exec($file_name);
	}
	======== OLD Function ===================================================== */ 
	//F=85
	function load_select_cy_table()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		//$sql = "SELECT b.wd_id, b.n_name, b.gen FROM wd_team_data a INNER Join wd_db b ON a.wd_id = b.wd_id Where a.team_ID = 20 ORDER By b.wd_id";
		//$sql = "SELECT b.wd_id, b.n_name, b.gen, c.wd_id as exist_wd_id FROM wd_team_data a INNER Join wd_db b ON a.wd_id = b.wd_id Left Join case_wd_support c ON a.wd_id = c.wd_id And c.case_id='$case_id' Where a.team_ID = 20 ORDER By b.wd_id";
		
	 	$sql = " Select a.wd_id, a.n_name, a.gen, c.wd_id as exist_wd_id From (Select  b.wd_id, b.n_name, b.gen From wd_team_data a 
	 			INNER Join wd_db b ON a.wd_id = b.wd_id
	 			Where a.team_ID = 20
	 			Union All 
	 			Select a.key_ID as wd_id, b.nick_name, 0 From staff a 
	 			INNER Join staff_detail b ON a.key_ID = b.key_ID
	 			Where a.key_ID in (11, 28, 29, 14, 15, 16, 37, 39)
	 			AND active = 1) a 
	 			Left Join case_wd_support c ON a.wd_id = c.wd_id And c.case_id='$case_id' " ;
				
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		//echo $sql;
		echo json_encode($data_Array);	
	}

	//F=86
	function update_supprot_c_table_case()
	{

		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		include "connectionDb.php";

		// Initial Delete All
		$del_sql = "delete FROM case_wd_support Where support_type = 'ทีมสื่อสาร' and case_id = '$case_id'";
		//echo $del_sql;
		if(!$conn->query($del_sql))
		{
			exit();
		}

		$support_wd_arr = explode(",", $support_wd);
		if (!((count($support_wd_arr) == 1) and $support_wd_arr[0] == ""))
		{
			foreach ($support_wd_arr as $support_wd_arr_each)
			{
				echo $support_wd_arr_each;
				$ins_sql = "Insert Into case_wd_support value ('$case_id', '$support_wd_arr_each', 'ทีมสื่อสาร')";
				if(!$conn->query($ins_sql))
				{
					exit();
				}
				//echo "aa";
			}
		}

		

		mysqli_close($conn);	

	}
	
	// 87
	function load_google_drive_link()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		#$sql = "SELECT * FROM case_ofd_info where case_id = '$case_id'";
		$sql = "SELECT gg_folder_URL FROM google_drive_case_folder a Where a.case_id = '$case_id'";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);	
	}

	// F=88 load_hash_tag_for_select
	function load_hash_tag_for_select()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		#$sql = "SELECT * FROM case_ofd_info where case_id = '$case_id'";
		#$sql = "Select DISTINCT a.Hashtag AS Hashtag From case_hashtag a Order By a.Hashtag ";
		$sql = "
			Select DISTINCT(z.hashtag) as  hashtag From (SELECT a.case_id, 
				b.hashtag
			FROM   case_pub_info a 
				INNER JOIN hashtag_data b 
						ON a.pub_url = b.ojb_id 
			WHERE  a.pub_type = 'page_WD_post' 
				AND b.type = 'page' 
				AND b.active = '1' 
			UNION ALL 
			SELECT a.case_id, 
				b.hashtag
			FROM   case_group_post a 
				INNER JOIN hashtag_data b 
						ON a.group_post_id = b.ojb_id 
							AND b.type = 'group' 
							AND b.active = '1' 
			UNION ALL 
			SELECT a.ojb_id AS case_id, 
				a.hashtag
			FROM   hashtag_data a 
					WHERE  a.type = 'manual' 
       AND a.active = 1 )  z";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);	
	}

	// F=89 Add New hash tag insert_manual_hashtag
	function insert_manual_hashtag()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		include "connectionDb.php";
		// Step 1 Update wd_ Case Hash tag
		$ran_str = $case_id.gen_rnd_str(5);
		$new_hash_tag = str_replace("#", "", $new_hash_tag);
		$sql = "Insert Into hashtag_data Value ('$case_id', '$new_hash_tag', 'manual', 1, '$ran_str')"; 
		//echo $sql;
		if(!$conn->query($sql))
		{
			exit();
		}
		mysqli_close($conn);	
		
	}
	//load_eff_type
	// F=90
	function load_eff_type()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		#$sql = "SELECT * FROM case_ofd_info where case_id = '$case_id'";
		$sql = "SELECT * FROM m_gov_check ";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);	
	}

	// F=91
	function load_gov_check_case()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		#$sql = "SELECT * FROM case_ofd_info where case_id = '$case_id'";
  		//$sql = "SELECT a.s_name, a.name, b.case_id, b.gov_dev_name, b.investigate_date From m_gov_check a Left Join case_gv_check b ON a.gc_id = b.gc_id WHERE b.case_id = '$case_id' or b.case_id is null";
		//$sql = "Select a.s_name, a.name, b.case_id, b.gov_dev_name, b.investigate_date From m_gov_check a Left Join case_gv_check b ON b.case_id = '$case_id' AND a.gc_id = b.gc_id";
		$sql = "Select * From (Select a.gc_id, a.s_name, a.name, b.case_id, b.gov_dev_name, b.investigate_date From m_gov_check a Inner Join case_gv_check b ON a.gc_id = b.gc_id AND b.case_id = '$case_id' UNION ALL Select a.gc_id, a.s_name, a.name, NULL, NULL, NULL From m_gov_check a Where a.gc_id NOT IN (Select a.gc_id From m_gov_check a Inner Join case_gv_check b ON a.gc_id = b.gc_id AND b.case_id = '$case_id')) Z Order By Z.gc_id";
		  include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);	
	}

	//load_case_summary
	// F=92
	function load_case_summary()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = " SELECT a.iso_code   AS id, 
		a.province_name AS PROVINCE_NAME, 
		Ifnull(b.total_case, 0) AS value, 
		Ifnull(b.topic, '')     AS TOPIC 
 FROM   add_provinces_isocode a 
		LEFT JOIN (SELECT d.iso_code, 
						  d.province_name, 
						  Count(a.case_id) 
																   AS TOTAL_CASE, 
						  Group_concat(Concat(a.case_id, ' : ', LEFT(a.topic, 20) 
						  ) 
														 SEPARATOR 
																   ' \n ') AS 
						  topic 
				   FROM   wd_case a 
						  INNER JOIN case_ofd_info b 
								  ON a.case_id = b.case_id 
						  INNER JOIN add_amphures c 
								  ON b.ofd_address_code = c.amphur_code 
						  INNER JOIN add_provinces_isocode d 
								  ON c.province_id = d.province_id 
				   WHERE  a.case_id IN (SELECT a.case_id 
										FROM   case_analysis_data a 
										WHERE  a.ran_str = '$__RAN_STR' 
											   AND Year(a.add_date) = $select_year) 
				   GROUP  BY d.iso_code, 
							 d.province_name 
				   ORDER  BY a.case_id) b 
			   ON a.iso_code = b.iso_code ";
		//echo $sql;
		//exit();
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}


		

		echo json_encode($data_Array);	
	}

	// F=93
	function generate_hashtag_for_analysis()
	{
		//sleep(2);
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}

		$ran_str =  gen_rnd_str(15);
		$sql = " INSERT INTO case_analysis_data
		SELECT a.case_id, 
			b.add_date, 
			b.province_name, 
			b.iso_code, 
			'$ran_str' AS RAN_STR 
		FROM   (SELECT DISTINCT( z.case_id ) AS CASE_ID 
				FROM   (SELECT a.case_id, 
							b.hashtag 
						FROM   case_pub_info a 
							INNER JOIN hashtag_data b 
									ON a.pub_url = b.ojb_id 
						WHERE  a.pub_type = 'page_WD_post' 
							AND b.type = 'page' 
							AND b.active = '1' 
						UNION ALL 
						SELECT a.case_id, 
							b.hashtag 
						FROM   case_group_post a 
							INNER JOIN hashtag_data b 
									ON a.group_post_id = b.ojb_id 
										AND b.type = 'group' 
										AND b.active = '1' 
						UNION ALL 
						SELECT a.ojb_id AS case_id, 
							a.hashtag 
						FROM   hashtag_data a 
						WHERE  a.type = 'manual' 
							AND a.active = 1) z 
				WHERE  Replace(z.hashtag, '#', '') = '$target_tag') a 
			INNER JOIN (SELECT a.case_id, 
								Min(a.add_date)      AS add_date, 
								Min(d.province_name) AS PROVINCE_NAME, 
								Min(d.iso_code)      AS ISO_CODE 
						FROM   wd_case a 
								INNER JOIN case_ofd_info b 
										ON a.case_id = b.case_id 
								INNER JOIN add_amphures c 
										ON b.ofd_address_code = c.amphur_code 
								INNER JOIN add_provinces_isocode d 
										ON c.province_id = d.province_id 
						GROUP  BY a.case_id) b 
					ON a.case_id = b.case_id
		 ";
		
		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			exit();
		}


		// Insert HDR

		$sql_HDR = "Insert into case_analysis_data_hrd Value ('$ran_str', 'Tag : $target_tag')";
		if(!$conn->query($sql_HDR))
		{
			exit();
		}
		mysqli_close($conn);
		echo $ran_str;
	}


	// F=94 load_analysis_header
	function load_analysis_header()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "SELECT * FROM case_analysis_data_hrd Where RAN_STR='$RAN_STR'";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);	
	}
	

	// F=95 load_analysis_case_list
	function load_analysis_case_list()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "SELECT a.case_id, 
				a.status, 
				c.crp_status, 
				a.topic, 
				a.t_sum, 
				b.img 
		FROM   wd_case a 
				INNER JOIN vw_case_img b 
						ON a.case_id = b.case_id 
				INNER JOIN m_crp_status c 
						ON a.status = c.id 
		WHERE  a.case_id IN (SELECT a.case_id 
							FROM   case_analysis_data a 
							WHERE  a.ran_str = '$RAN_STR' 
									AND Year(a.add_date) = $select_year) 
		Group By a.case_id, 
				a.status, 
				c.crp_status, 
				a.topic, 
				a.t_sum, 
				b.img 
		ORDER  BY a.case_id DESC 
		
		";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$row['print_case_id'] = substr($row['case_id'],0, 2).'-'.substr($row['case_id'],2, 2).'-'.substr($row['case_id'],4);
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);	
	}

	//F = 96
	function load_jobtype_analyz()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}

		$ran_str =  gen_rnd_str(15);
		$sql = " INSERT INTO case_analysis_data
		SELECT a.case_id, 
			b.add_date, 
			b.province_name, 
			b.iso_code, 
			'$ran_str' AS RAN_STR 
		FROM   (Select DISTINCT(a.case_id) AS CASE_ID From case_job_type a 
		Where a.job_type = '$target_data') a 
			INNER JOIN (SELECT a.case_id, 
								Min(a.add_date)      AS add_date, 
								Min(d.province_name) AS PROVINCE_NAME, 
								Min(d.iso_code)      AS ISO_CODE 
						FROM   wd_case a 
								INNER JOIN case_ofd_info b 
										ON a.case_id = b.case_id 
								INNER JOIN add_amphures c 
										ON b.ofd_address_code = c.amphur_code 
								INNER JOIN add_provinces_isocode d 
										ON c.province_id = d.province_id 
						GROUP  BY a.case_id) b 
					ON a.case_id = b.case_id
		 ";
		
		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			exit();
		}


		// Insert HDR

		$sql_HDR = "Insert into case_analysis_data_hrd Value ('$ran_str', 'ประเภทงาน : $target_data')";
		if(!$conn->query($sql_HDR))
		{
			exit();
		}
		mysqli_close($conn);
		echo $ran_str;
	}

	//F = 97
	function load_crp_type_analyz()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}

		$ran_str =  gen_rnd_str(15);
		$sql = " INSERT INTO case_analysis_data
		SELECT a.case_id, 
			b.add_date, 
			b.province_name, 
			b.iso_code, 
			'$ran_str' AS RAN_STR 
		FROM   (Select DISTINCT(a.case_id) AS CASE_ID From case_crp_type_data a  Where a.crp_type = '$target_data') a 
			INNER JOIN (SELECT a.case_id, 
								Min(a.add_date)      AS add_date, 
								Min(d.province_name) AS PROVINCE_NAME, 
								Min(d.iso_code)      AS ISO_CODE 
						FROM   wd_case a 
								INNER JOIN case_ofd_info b 
										ON a.case_id = b.case_id 
								INNER JOIN add_amphures c 
										ON b.ofd_address_code = c.amphur_code 
								INNER JOIN add_provinces_isocode d 
										ON c.province_id = d.province_id 
						GROUP  BY a.case_id) b 
					ON a.case_id = b.case_id
			";
		
		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			exit();
		}


		// Insert HDR

		$sql_HDR = "Insert into case_analysis_data_hrd Value ('$ran_str', 'ประเภทการทุจริต : $target_data')";
		if(!$conn->query($sql_HDR))
		{
			exit();
		}
		mysqli_close($conn);
		echo $ran_str;
	}

	// F = 98
	function load_status_for_analyz()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "SELECT b.id, 
				b.crp_status, 
				Count(a.case_id) AS CNT 
		FROM   wd_case a 
				INNER JOIN m_crp_status b 
						ON a.status = b.id 
		WHERE  a.case_id IN (SELECT z.case_id 
							FROM   case_analysis_data z 
							WHERE  z.ran_str = '$RAN_STR' 
									AND Year(z.add_date) = $select_year) 
		GROUP  BY b.id, 
				b.crp_status 
		ORDER  BY b.sort_id 
		";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);	
	}

	// F=99
	function load_group_case_data_for_analy()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		$sql = " SELECT a.id, 
				a.full_picture, 
				Substring(a.message, 1, 100) AS MSG, 
				a.created_time, 
				a.type, 
				Ifnull(b.case_id, '-')       AS CASE_ID, 
				Ifnull(d.crp_status, '-')    AS STATUS_TEXT, 
				Ifnull(c.status, '-')        AS STATUS_CODE 
		FROM   group_post_data a 
				LEFT JOIN case_group_post b 
					ON a.id = b.group_post_id 
				LEFT JOIN wd_case c 
					ON b.case_id = c.case_id 
				LEFT JOIN m_crp_status d 
					ON c.status = d.id 
		WHERE  a.type = 'G' 
				AND b.case_id IN (SELECT z.case_id 
									FROM   case_analysis_data z 
									WHERE  z.ran_str = '$RAN_STR' 
											AND Year(z.add_date) = $select_year)
		ORDER  BY a.created_time DESC
				";

		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			//if ($row[''])
			if ($row['CASE_ID'] != '-')
			{
					$row['print_case_id'] = substr($row['CASE_ID'],0, 2).'-'.substr($row['CASE_ID'],2, 2).'-'.substr($row['CASE_ID'],4);
			}
			else
			{
				$row['print_case_id'] = '-';
			}
			
			$data_Array[] = $row;
		}
		//echo $sql;
		echo json_encode($data_Array);	
	}

	// F=100
	function load_page_post_case_data_for_analy()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		$sql = " SELECT c.ojb_id AS id
		, c.img_src as full_picture
		,  Substring(a.msg, 1, 100) AS MSG, a.pub_time as created_time, b.case_id AS CASE_ID
		, e.crp_status AS STATUS_TEXT
		, d.status AS STATUS_CODE From system_page_all_pub a 
		Inner Join case_pub_info b ON a.post_id = b.pub_url AND b.pub_type = 'page_WD_post'
		Inner Join system_page_all_pub_ojb_img c ON a.ojb_id = c.ojb_id
		Inner Join wd_case d ON b.case_id = d.case_id
		Inner Join m_crp_status e ON d.status = e.id
		WHERE b.case_id IN (SELECT z.case_id 
									 FROM   case_analysis_data z 
									 WHERE  z.ran_str = '$RAN_STR' 
											 AND Year(z.add_date) = $select_year)
											 Order By b.case_id
				";

		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			//if ($row[''])
			if ($row['CASE_ID'] != '-')
			{
					$row['print_case_id'] = substr($row['CASE_ID'],0, 2).'-'.substr($row['CASE_ID'],2, 2).'-'.substr($row['CASE_ID'],4);
			}
			else
			{
				$row['print_case_id'] = '-';
			}
			
			$data_Array[] = $row;
		}
		//echo $sql;
		echo json_encode($data_Array);	
	}

	// F=101
	function add_case_url()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}

		$ran_str =  $case_id.gen_rnd_str(10);
		$sql = "INSERT Into case_relate_url value ('$case_id', '$target_data', '$ran_str', CURRENT_TIMESTAMP())";
		
		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			exit();
		}
	}

	// F = 102
	function load_case_url ()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = "Select * From case_relate_url a Where a.CASE_ID = '$case_id'";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);	
	}
	// F=103
	function delete_case_url()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}

		$sql = "Delete From case_relate_url where rnd_id = '$target_data'";

		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			exit();
		}
	}


	// F=104
	function dl_excel_file_case_all()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$tbl_f = array();
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
		//$sql = "SELECT a.case_id AS 'CASE ID', a.topic AS 'หัวข้อ', h.crp_status AS 'สถานะ', g.ofd_name AS 'หน่วยงาน', g.ofd_type AS 'ประเภทหน่วยงาน', g.org_type_name AS 'องค์กร', g.amphur_name AS 'อำเภอ', g.province_name AS 'จังหวัด', g.geo_name AS 'ภาค', a.crp_dmg_off AS 'มูลค่าโครงการ', a.ofd_dmg AS 'ความเสียหาย', Ifnull(b.total, '-') AS 'จำนวน EP', Ifnull(c.job_type, '-') AS 'ประเภทงาน', d.crp_type AS 'ประเด็นทุจริต' , Ifnull(e.engegement, '-') AS Engegement, Ifnull(e.reach, '-') AS Reach, a.add_date AS 'เข้าระบบ', Ifnull(Date(f.pubtime), '-') AS 'วันลงเพจ', Ifnull(f.count_post, '-') AS 'จำนวนโพส' FROM wd_case a LEFT JOIN count_episode b ON a.case_id = b.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.job_type) AS job_type FROM case_job_type a GROUP BY a.case_id) c ON a.case_id = c.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.crp_type) AS crp_type FROM case_crp_type_data a GROUP BY a.case_id) d ON a.case_id = d.case_id LEFT JOIN (SELECT a.case_id, Sum(e.value) AS value, Sum(CASE WHEN e.f_name = 'post_engaged_users' THEN e.value ELSE 0 end) AS engegement, Sum(CASE WHEN e.f_name = 'post_impressions_unique' THEN e.value ELSE 0 end) AS reach FROM wd_case a INNER JOIN case_pub_info b ON a.case_id = b.case_id INNER JOIN static_post e ON b.pub_url = e.post_id WHERE e.data_type = 1 AND f_name IN ( 'post_engaged_users', 'post_impressions_unique' ) AND Year(a.add_date) = $select_year GROUP BY a.case_id ORDER BY a.case_id) e ON a.case_id = e.case_id LEFT JOIN (SELECT a.case_id, Count(b.post_id) AS count_post, Min(b.pub_time) AS pubtime FROM case_pub_info a INNER JOIN system_page_all_pub b ON a.pub_url = b.post_id WHERE a.pub_type = 'page_WD_post' GROUP BY a.case_id) f ON a.case_id = f.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.ofd_name) AS ofd_name, Group_concat(DISTINCT a.ofd_type) AS ofd_type, Group_concat(DISTINCT e.org_type_name) AS org_type_name , Group_concat(DISTINCT b.amphur_name) AS AMPHUR_NAME, Group_concat(DISTINCT c.province_name) AS PROVINCE_NAME , Group_concat(DISTINCT d.geo_name) AS GEO_NAME FROM case_ofd_info a INNER JOIN add_amphures b ON a.ofd_address_code = b.amphur_code INNER JOIN add_provinces c ON b.province_id = c.province_id INNER JOIN add_geography d ON c.geo_id = d.geo_id INNER JOIN m_org_type e ON a.org_type_id = e.org_type_id GROUP BY a.case_id) g ON a.case_id = g.case_id INNER JOIN m_crp_status h ON a.status = h.id WHERE Year(a.add_date) = $select_year ORDER BY a.case_id";
		$sql = " SELECT LEFT(a.case_id, 2) AS 'เคสปี',
		a.case_id AS 'CASE ID',
		a.topic AS 'หัวข้อ',
		h.crp_status AS 'สถานะ',
		g.ofd_name AS 'หน่วยงาน',
		g.ofd_type AS 'ประเภทหน่วยงาน',
		g.org_type_name AS 'องค์กร',
		g.amphur_name AS 'อำเภอ',
		g.province_name AS 'จังหวัด',
		g.geo_name AS 'ภาค',
		a.crp_dmg_off AS 'มูลค่าโครงการ' ,
		a.ofd_dmg AS 'ความเสียหาย',
		Ifnull(b.total, '-') AS 'จำนวน EP',
		Ifnull(c.job_type, '-') AS 'ประเภทงาน',
		d.crp_type AS 'ประเด็นทุจริต',
		K.Type AS 'แหล่งที่มา',
		Ifnull(e.engegement, '-') AS Engegement,
		Ifnull(e.reach, '-') AS Reach,
		a.add_date AS 'เข้าระบบ',
		Ifnull(Date(f.pubtime), '-') AS 'วันลงเพจ',
		Ifnull(f.count_post, '-') AS 'จำนวนโพส',
		Ifnull(J.cnt_pub, '-') AS 'เผยแพร่ผ่านสื่อ',
		Ifnull(i.Gov_CHECK, '-') AS 'หน่วยงานเข้าตรวจสอบ'
 FROM wd_case a
 LEFT JOIN count_episode b ON a.case_id = b.case_id
 LEFT JOIN
   (SELECT a.case_id,
		   Group_concat(DISTINCT a.job_type) AS job_type
	FROM case_job_type a GROUP  BY a.case_id) c ON a.case_id = c.case_id
 LEFT JOIN
   (SELECT a.case_id,
		   Group_concat(DISTINCT a.crp_type) AS crp_type
	FROM case_crp_type_data a GROUP  BY a.case_id) d ON a.case_id = d.case_id
 LEFT JOIN
   (SELECT a.case_id,
		   Sum(e.value) AS value,
		   Sum(CASE
				   WHEN e.f_name = 'post_engaged_users' THEN e.value
				   ELSE 0
			   END) AS engegement,
		   Sum(CASE
				   WHEN e.f_name = 'post_impressions_unique' THEN e.value
				   ELSE 0
			   END) AS reach
	FROM wd_case a
	INNER JOIN case_pub_info b ON a.case_id = b.case_id
	INNER JOIN static_post e ON b.pub_url = e.post_id
	WHERE e.data_type = 1
	  AND f_name IN ('post_engaged_users',
					 'post_impressions_unique') GROUP  BY a.case_id
	  ORDER  BY a.case_id) e ON a.case_id = e.case_id
 LEFT JOIN
   (SELECT a.case_id,
		   Count(b.post_id) AS count_post,
		   Min(b.pub_time) AS pubtime
	FROM case_pub_info a
	INNER JOIN system_page_all_pub b ON a.pub_url = b.post_id
	WHERE a.pub_type = 'page_WD_post' GROUP  BY a.case_id) f ON a.case_id = f.case_id
 LEFT JOIN
   (SELECT a.case_id,
		   Group_concat(DISTINCT a.ofd_name) AS ofd_name,
		   Group_concat(DISTINCT a.ofd_type) AS ofd_type,
		   Group_concat(DISTINCT e.org_type_name) AS org_type_name ,
		   Group_concat(DISTINCT b.amphur_name) AS AMPHUR_NAME,
		   Group_concat(DISTINCT c.province_name) AS PROVINCE_NAME ,
		   Group_concat(DISTINCT d.geo_name) AS GEO_NAME
	FROM case_ofd_info a
	INNER JOIN add_amphures b ON a.ofd_address_code = b.amphur_code
	INNER JOIN add_provinces c ON b.province_id = c.province_id
	INNER JOIN add_geography d ON c.geo_id = d.geo_id
	INNER JOIN m_org_type e ON a.org_type_id = e.org_type_id GROUP  BY a.case_id) g ON a.case_id = g.case_id
 INNER JOIN m_crp_status h ON a.status = h.id
 LEFT JOIN
   (SELECT a.case_id,
		   GROUP_CONCAT(b.s_name) AS Gov_CHECK
	FROM case_gv_check a
	INNER JOIN m_gov_check b ON a.gc_id = b.gc_id
	GROUP BY a.case_id) i ON a.case_id = i.case_id
 LEFT JOIN
   (SELECT a.case_id,
		   COUNT(a.case_id) AS cnt_pub
	FROM case_pub_info a
	WHERE a.pub_type <> 'page_WD_post'
	GROUP BY a.case_id) J ON J.case_id = a.case_id
 LEFT JOIN
   (SELECT ZSD.case_id,
		   GROUP_CONCAT(ZSD.Type) AS TYPE
	FROM
	  (SELECT a.case_id,
			  CASE
				  WHEN a.type = 1 THEN 'Inbox'
				  ELSE 'สมาชิกหมา'
			  END AS TYPE
	   FROM case_sender a) ZSD
	GROUP BY ZSD.case_id) K ON K.case_id = a.case_id
 ORDER  BY a.case_id";
		
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
		$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ".thai_date(date('U'))." เวลา ".date('H:i'));
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setItalic(true);

		// Print column Name
		$i_colum = 0;
		$i_row = 4;
		while ($property = mysqli_fetch_field($res)) {
			$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $property->name);
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

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('ข้อมูลเคส');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		$file_name = "files/ข้อมูลเคส_".date('dmyH').gen_rnd_str(4);
		$file_name.= ".xlsx";
		$objWriter = new Xlsx($objPHPExcel);
		$objWriter->save($file_name);
		echo '<button type="button" class="btn btn-box-tool" onclick="location.href='."'".$file_name."'".'"> <i class="fa fa-file-excel-o"></i> Download Excel</button>';

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
			get_case_type($p1);
			break;
		}
		
		case 6 :
		{
			get_staff_list();
			break;
		}
		
		case 7 :
		{
			get_all_Gen();
			break;
		}
		case 8 :
		{
			get_name_in_gen($p1);
			break;
		}
		case 9 :
		{
			add_case_data();
			break;
		}
		case 10 :
		{
			query_data($p1);
			break;
		}
		case 11:
		{
			get_case_data($p1);
			break;
		}
		
		case 12:
		{
			update_status();
			break;
		}
		
		case 13:
		{
			update_all_info();
			break;
		}
		case 14:
		{
			get_timeline_date();
			break;
		}
		case 15:
		{
			check_all_team_list($p1);
			break;
		}
		case 16:
		{
			get_org_type();
			break;
		}
		case 17:
		{
			get_ofd_name_list($p1);
			break;
		}
		case 18:
		{
			g_case_sender($p1);
			break;
		}
		case 19:
		{
			get_team_support($p1);
			break;
		}
		
		case 20:
		{
			get_wd_support($p1);
			break;
		}
		
		case 21:
		{
			get_staff_operator($p1);
			break;
		}
		
		case 22 :
		{
			update_case_info();
			break;
		}
		
		case 23 :
		{
			update_case_type();
			break;
		}
		
		case 24 :
		{
			update_case_link();
			break;
		}
		
		case 25 :
		{
			update_case_date();
			break;
		}
		
		case 26 :
		{
			add_ofd_name();
			break;
		}
		case 27 :
		{
			delete_ofd_name();
			break;
		}
		case 28 :
		{
			add_sender_name();
			break;
		}
		case 29 :
		{
			delete_sender_name();
			break;
		}
		case 30 :
		{
			add_case_staff();
			break;
		}
		
		case 31 :
		{
			delete_case_staff();
			break;
		}
		
		case 32 :
		{
			add_team_support();
			break;
		}
		
		case 33 :
		{
			delete_team_support();
			break;
		}
		
		case 34 :
		{
			add_wd_support();
			break;
		}
		
		case 35 :
		{
			delete_wd_support();
			break;
		}
		
		case 36 :
		{
			add_pub_info();
			break;
		}
		
		case 37 :
		{
			add_eff_info();
			break;
		}
		
		case 38 :
		{
			generate_case_id();
			break;
		}
		
		case 39 :
		{
			check_duplicate_case_ID();
			break;
		}
		
		case 40 :
		{
			add_oth_pub();
			break;
		}
		
		case 41 :
		{
			get_crp_type_data();
			break;
		}
		
		case 42 :
		{
			get_ofd_type_2();
			break;
		}
		
		case 43 :
		{
			del_ofd_type_2();
			break;
		}
		case 44 :
		{
			add_ofd_type_2();
			break;
		}
		case 45 :
		{
			get_job_type();
			break;
		}
		case 46 :
		{
			add_job_type();
			break;
		}
		case 47 :
		{
			del_job_type();
			break;
		}
		case 48 :
		{
			get_ofd_person_list();
			break;
		}
		case 49 :
		{
			del_ofd_person();
			break;
		}
		case 50 :
		{
			add_ofd_person();
			break;
		}
		
		case 51 :
		{
			get_avi_tag();
			break;
		}
		
		case 52 :
		{
			get_avi_tag_with_staff();
			break;
		}
		case 53 :
		{
			get_last_post_from_page();
			break;
		}
		case 54 :
		{
			get_status_select_list();
			break;
		}
		
		case 55 :
		{
			search_case_post();
			break;
		}
		
		case 56 :
		{
			search_case_post_selected();
			break;
		}
		
		case 57 :
		{
			delete_time_line_item_fnc();
			break;
		}
		case 58 :
		{
			pub_new_post();
			break;
		}
		
		case 59 :
		{
			load_post_data();
			break;
		}
		
		case 60 :
		{
			get_case_table_v2();
			break;
		}
		case 61 :
		{
			get_case_table_v3();
			break;
		}
		
		case 62 :
		{
			get_pending_case();
			break;
		}
		
		case 63 :
		{
			load_bf_case();
			break;
		}
		
		case 64 :
		{
			load_next_case();
			break;
		}
		
		case 65 :
		{
			load_support_wd_v2();
			break;
		}
		case 66 :
		{
			load_job_type_for_select();
			break;
		}
		case 67 :
		{
			load_job_ofd_for_select();
			break;
		}
		case 68 :
		{
			getselect_support_type_for_wd();
			break;
		}
		case 69 :
		{
			load_group_post_data();
			break;
		}
		case 70 :
		{
			load_group_post_data_detail();
			break;
		}
		case 71 :
		{
			save_new_post_with_case();
			break;
		}
		case 72 :
		{
			delete_post_with_case();
			break;
		}
		case 73 :
		{
			load_case_hashtag();
			break;
		}
		case 74 :
		{
			delete_case_hashtag();
			break;
		}
		case 75 :
		{
			add_case_inbox_msg();
			break;
		}
		case 76 :
		{
			load_map_msg_4_select();
			break;
		}
		case 77 :
		{
			delete_case_inbox_msg();
			break;
		}
		case 78 :
		{
			load_new_timeline();
			break;
		}
		case 79 :
		{
			load_case_search_data();
			break;
		}
		case 80 :
		{
			case_search_data_text();
			break;
		}
		case 81 :
		{
			load_ofd_name_2();
			break;
		}
		case 82 :
		{
			load_attached_data();
			break;
		}
		case 83 :
		{
			load_case_data_v2();
			break;
		}
		case 84 :
		{
			dl_excel_file_case();
			break;
		}
		case 85 :
		{
			load_select_cy_table();
			break;
		}
		case 86 :
		{
			update_supprot_c_table_case();
			break;
		}
		case 87 :
		{
			load_google_drive_link();
			break;
		}
		case 88 :
		{
			load_hash_tag_for_select();
			break;
		}
		case 89 :
		{
			insert_manual_hashtag();
			break;
		}
		case 90 :
		{
			load_eff_type();
			break;
		}
		case 91 :
		{
			load_gov_check_case();
			break;
		}

		case 92 :
		{
			load_case_summary();
			break;
		}
		case 93 :
		{
			generate_hashtag_for_analysis();
			break;
		}
		case 94 :
		{
			load_analysis_header();
			break;
		}
		case 95 :
		{
			load_analysis_case_list();
			break;
		}
		case 96 :
		{
			load_jobtype_analyz();
			break;
		}
		case 97 :
		{
			load_crp_type_analyz();
			break;
		}
		case 98 :
		{
			load_status_for_analyz();
			break;
		}
		case 99 :
		{
			load_group_case_data_for_analy();
			break;
		}
		case 100 :
		{
			load_page_post_case_data_for_analy();
			break;
		}
		case 101 :
		{
			add_case_url();
			break;
		}
		case 102 :
		{
			load_case_url();
			break;
		}
		case 103 :
		{
			delete_case_url();
			break;
		}
		case 104 :
		{
			dl_excel_file_case_all();
			break;
		}

		
		

		
	}
