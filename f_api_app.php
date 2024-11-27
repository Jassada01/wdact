<?php
header('Content-Type: text/html; charset=UTF-8');

// ======== Get Var ========
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





// Common Function ===========================================

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
function token_key()
{
	return "baFTc8tVBYMNXvATYRNuXFsUkNVqkLu7EwkySL4MRFuhWP47X5kqnbSeqNmAJa6Q";
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



// F = 1
function check_qr_code()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 //Query Data ==================
		 //$sql = "SELECT * FROM wd_access_code a Where a.token = '$wd_key' and a.expire >= CURRENT_DATE()";
		 $sql = "Select * From (
					Select a.*, 'Member' AS Type From wd_access_code a
					Union All 
					Select b.*, 'Staff' AS Type From staff_access_code b ) DZ
					Where DZ.token = '$wd_key' and DZ.expire >= CURRENT_DATE()";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		if (mysqli_num_rows($res) == 1)
		{
			// Create initial key 
			while ($row = $res->fetch_assoc()){
				$init_code = gen_rnd_str();
				$ins_sql = "Insert Into app_access_hash(user_code, user_type, init_key, create_date, expire_date, Active) Values('".$row['wd_id']."', '".$row['Type']."', '".$init_code."', CURRENT_TIMESTAMP(), DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL 2 YEAR), 1)";
				if(!$conn->query($ins_sql))
				{
					exit();
				}
			}
			
			$data['success'] = "success";
			$data['data']['init_key'] = $init_code;
		}
		else
		{
			$data['reason_code'] = 1;
		}
		mysqli_close($conn);
	 }
	 else
	 {
		$data['reason_code'] = 2;
	 }
	 $data_Array['RESULT'] = $data;
	// Insert system_page_static
	//echo '{"JSON":{"success":"success","reason_code":null,"data":[]}}';
	echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F = 2
function update_access_code()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 //Query Data ==================
		 $sql = "Update app_access_hash set hash_key = '$hash_key' WHERE init_key = '$init_key'";
		 
		include "connectionDb.php";
		if(!$conn->query($sql))
		{
			exit();
		}
		else
		{
			$data['success'] = "success";
		}
		mysqli_close($conn);
	 }
	 else
	 {
		$data['reason_code'] = 2;
	 }
	 $data_Array['RESULT'] = $data;
	 
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}


// F = 3
function check_active_hash_key()
{
	//sleep(3);
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 //Query Data ==================
		 $sql = "Select * From app_access_hash a 
					Where a.hash_key = '$hash_key' and a.Active = 1";
		 
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		if (mysqli_num_rows($res) == 1)
		{
			$temp_data_Array = array();
			$row = $res->fetch_assoc();
			$User_code =  $row['user_code'];
			if ($row['user_type'] == "Staff")
			{
				$q_sql = "SELECT a.key_ID AS USER_ID , a.nick_name AS NAME , a.Position AS POS, b.img AS IMG, 'Staff' as userType FROM staff_detail a  Inner Join staff_img b ON a.key_ID = b.key_ID WHERE a.key_ID  = $User_code";
			}
			else
			{
				$q_sql = "SELECT a.wd_id AS USER_ID, a.n_name AS NAME , Concat('รุ่น ', a.gen) AS POS, a.wd_img AS IMG,  'Member' as userType FROM  wd_db a where a.wd_id = '$User_code'";
			}
			$res2 = $conn->query(trim($q_sql));
			$row2 = $res2->fetch_assoc();
			
			$data['data'] = $row2;
			$data['success'] = "success";
			
		}
		else
		{
			$data['reason_code'] = 1;
		}
	 }
	 else
	 {
		$data['reason_code'] = 2;
	 }
	 
	mysqli_close($conn);
	 $data_Array['RESULT'] = $data;
	// Insert system_page_static
	//echo '{"JSON":{"success":"success","reason_code":null,"data":[]}}';
	echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F = 4
function Admin_dashboard_data()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		 // Query User Information
		 $sql = "Select * From app_access_hash a 
					Where a.hash_key = '$hash_key' and a.Active = 1";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		$User_code =  $row['user_code'];
		$q_sql = "SELECT a.key_ID AS USER_ID , a.nick_name AS NAME , a.Position AS POS, b.img AS IMG, 'Staff' AS userType FROM staff_detail a  Inner Join staff_img b ON a.key_ID = b.key_ID WHERE a.key_ID  = $User_code";
		$res2 = $conn->query(trim($q_sql));
		$row2 = $res2->fetch_assoc();
		$data['data']['userInfo'][] = $row2;
		
		 
		 //Query Data Last CASE ==================
		 $sql = "SELECT a.case_id,
					   a.status,
					   a.topic,
					   g.img_src AS img,
					   Min(d.pub_time)           AS pub_time,
					   Max(e.cnt_ep)             AS ep
				FROM   wd_case a
					   INNER JOIN vw_case_img b
							   ON a.case_id = b.case_id
					   INNER JOIN case_pub_info c
							   ON a.case_id = c.case_id
					   INNER JOIN system_page_all_pub d
							   ON c.pub_url = d.post_id
					   INNER JOIN (SELECT a.case_id,
                                   Count(a.case_id) AS CNT_EP
                                   FROM   case_episode a
                                   GROUP  BY a.case_id) e
							   ON a.case_id = e.case_id
					   LEFT JOIN case_img f
							  ON a.case_id = f.case_id
                       Inner JOIN system_page_all_pub_ojb_img g 
                       ON g.ojb_id = c.pub_url
				WHERE  a.status = '5'
					   AND c.pub_type = 'page_WD_post'
				GROUP  BY a.case_id,
						  a.status,
						  a.topic,
						  g.img_src
				ORDER  BY d.pub_time DESC
				LIMIT  5";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$row['case_id_show'] = substr($row['case_id'], 0, 2) . "-" . substr($row['case_id'], 2, 2) . "-" . substr($row['case_id'], 4, 3);
			//$row['img'] = 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Image_created_with_a_mobile_phone.png/800px-Image_created_with_a_mobile_phone.png?20130110144453';
			$data['data']['lastCase'][] = $row;
		}
		 
		 //system_page_all_pub_ojb_img
		 //Query Data BEST CASE ==================
		 $sql = "Select a.case_id, a.topic, c.ofd_name ,f.GEO_NAME, count(*) as CNT, sum(e.value) as Reach, h.img_src From wd_case a Inner Join case_pub_info b ON a.case_id = b.case_id Inner Join case_ofd_info c ON a.case_id = c.case_id Inner Join add_amphures d ON c.ofd_address_code = d.AMPHUR_CODE Inner Join static_post e ON b.pub_url = e.post_id Inner Join add_geography f ON d.GEO_ID = f.GEO_ID Inner Join system_page_all_pub g ON b.pub_url = g.post_id LEFT JOIN system_page_all_pub_ojb_img h ON g.ojb_id = h.ojb_id Where e.data_type = 1 And f_name = 'post_impressions_unique' AND h.img_src is not null AND h.img_src <> '' AND a.add_date >= NOW() - INTERVAL 365 DAY Group By a.case_id, a.topic Order By Reach DESC LIMIT 5";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$row['case_id_show'] = substr($row['case_id'], 0, 2) . "-" . substr($row['case_id'], 2, 2) . "-" . substr($row['case_id'], 4, 3);
			//$row['img_src'] = 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Image_created_with_a_mobile_phone.png/800px-Image_created_with_a_mobile_phone.png?20130110144453';
			//$row['topic'] = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
			$data['data']['bestCase'][] = $row;
		}
		
		// get_follow_cnt
		$sql="Select * From (SELECT follow_cnt FROM system_page_static WHERE time_stamp = (select max(time_stamp) from system_page_static)) A Join (SELECT count(*) as pub_cnt FROM wd_case WHERE YEAR(add_date) = YEAR(CURDATE()) AND status = 5) B";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['static_val'][] = $row;
		}
		
		// get WIP Case
		$sql="SELECT a.case_id,
				   a.status,
				   a.priority,
				   a.case_cnt_url,
				   g.crp_status,
				   a.topic,
				   a.t_sum,
				   'img/wd_img/default.png' AS img,
				   GROUP_CONCAT(e.PROVINCE_NAME) AS PROVINCE_NAME
			FROM   wd_case a
				   INNER JOIN m_crp_status g
						   ON a.status = g.id
				   LEFT JOIN vw_case_img b
						  ON a.case_id = b.case_id
				   Inner Join case_ofd_info c ON a.case_id = c.case_id
				   Inner Join add_amphures d ON c.ofd_address_code = d.AMPHUR_CODE
				   Inner Join add_provinces e ON d.PROVINCE_ID = e.PROVINCE_ID
			WHERE  a.status NOT IN ( 4, 5 )
			Group By a.case_id,
				   a.status,
				   a.priority,
				   a.case_cnt_url,
				   g.crp_status,
				   a.topic,
				   a.t_sum
			ORDER  BY a.case_id DESC";
		$res = $conn->query(trim($sql));
		// Get Total Remain
		$data['data']['case_in_wip_total']= mysqli_num_rows($res);
		
		$cnt_limit = 0;
		while ($row = $res->fetch_assoc()) {
			$row['case_id_show'] = substr($row['case_id'], 0, 2) . "-" . substr($row['case_id'], 2, 2) . "-" . substr($row['case_id'], 4, 3);
			$data['data']['case_in_wip'][] = $row;
			$cnt_limit++;
			if ($cnt_limit == 5)
			{
				break;
			}
		}
		
		// get_follow_cnt
		$sql="Select * From (SELECT follow_cnt FROM system_page_static WHERE time_stamp = (select max(time_stamp) from system_page_static)) A Join (SELECT count(*) as pub_cnt FROM wd_case WHERE YEAR(add_date) = YEAR(CURDATE()) AND status = 5) B";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['static_val'][] = $row;
		}
		
		// get Mem in geo  Case
		$sql="SELECT a.geo_name,
				   Coalesce(a.cnt_active, 0)  AS cnt_active,
				   Coalesce(b.cnt_idle, 0)    AS cnt_idle,
				   Coalesce(d.cnt_upper, 0)   AS cnt_upper,
				   Coalesce(c.cnt_other, 0)   AS cnt_other,
				   Coalesce(a.cnt_active, 0)
				   + Coalesce(b.cnt_idle, 0)
				   + Coalesce(d.cnt_upper, 0)
				   + Coalesce(c.cnt_other, 0) AS cnt_total
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
						  ON a.geo_name = d.geo_name  ";
		$res = $conn->query(trim($sql));
		$grand_total = [];
		$grand_total['geo_name'] = 'รวมทั้งหมด';
		$grand_total['cnt_active'] = 0;
		$grand_total['cnt_idle'] = 0;
		$grand_total['cnt_upper'] = 0;
		$grand_total['cnt_other'] = 0;
		$grand_total['cnt_total'] = 0;
		while ($row = $res->fetch_assoc()) {
			$data['data']['mem_geo_Data'][] = $row;
			$grand_total['cnt_active'] +=  $row['cnt_active'];
			$grand_total['cnt_idle'] +=   $row['cnt_idle'] ;
			$grand_total['cnt_upper'] +=   $row['cnt_upper'];
			$grand_total['cnt_other'] +=   $row['cnt_other'];
			$grand_total['cnt_total'] +=   $row['cnt_total'];
		}
		//$data['data']['mem_geo_Data'][] =$grand_total;
		
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}


// F = 5
function Admin_dashboard_data_WIPCASE_ALL()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		// get WIP Case
		$sql="SELECT a.case_id,
				   a.status,
				   a.priority,
				   a.case_cnt_url,
				   g.crp_status,
				   a.topic,
				   a.t_sum,
				   'img/wd_img/default.png' AS img,
				   GROUP_CONCAT(e.PROVINCE_NAME) AS PROVINCE_NAME
			FROM   wd_case a
				   INNER JOIN m_crp_status g
						   ON a.status = g.id
				   LEFT JOIN vw_case_img b
						  ON a.case_id = b.case_id
				   Inner Join case_ofd_info c ON a.case_id = c.case_id
				   Inner Join add_amphures d ON c.ofd_address_code = d.AMPHUR_CODE
				   Inner Join add_provinces e ON d.PROVINCE_ID = e.PROVINCE_ID
			WHERE  a.status NOT IN ( 4, 5 )
			Group By a.case_id,
				   a.status,
				   a.priority,
				   a.case_cnt_url,
				   g.crp_status,
				   a.topic,
				   a.t_sum
			ORDER  BY a.case_id DESC";
		$res = $conn->query(trim($sql));
		// Get Total Remain
		$data['data']['case_in_wip_total']= mysqli_num_rows($res);
		
		while ($row = $res->fetch_assoc()) {
			$row['case_id_show'] = substr($row['case_id'], 0, 2) . "-" . substr($row['case_id'], 2, 2) . "-" . substr($row['case_id'], 4, 3);
			$data['data']['case_in_wip'][] = $row;
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}



// F = 6
function Member_dashboard_data()
{
	//sleep(3);
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		 // Query User Information
		 $sql = "Select * From app_access_hash a 
					Where a.hash_key = '$hash_key' and a.Active = 1";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		$User_code =  $row['user_code'];
		//$q_sql = "SELECT a.key_ID AS USER_ID , a.nick_name AS NAME , a.Position AS POS, b.img AS IMG, 'Staff' AS userType FROM staff_detail a  Inner Join staff_img b ON a.key_ID = b.key_ID WHERE a.key_ID  = $User_code";
		$q_sql = "Select 
			  a.*, 
			  b.*, 
			  TIMESTAMPDIFF(
				YEAR, 
				a.birthday, 
				CURDATE()
			  ) AS age 
			From 
			  wd_db a 
			  Inner Join call_all_address2 b ON a.add_code = b.DISTRICT_CODE 
			  INNER JOIN m_occ_type c ON a.occ_type = c.id 
			Where 
			  a.wd_id = '$User_code'";
		$res2 = $conn->query(trim($q_sql));
		$row2 = $res2->fetch_assoc();
		$row2['all_address_text'] = trim($row2['address']) . " ต." . trim($row2['DISTRICT_NAME']). " อ." . trim($row2['AMPHUR_NAME']). " จ." . trim($row2['PROVINCE_NAME']). " " . trim($row2['zipcode']);
		//$row2['wd_img'] = 'http://35.247.145.219/WD_system/img/wd_img/'.$row2['wd_img'];
		$data['data']['userInfo'][] = $row2;
		
		// get Team
		$sql = "Select team_name From wd_team_data a Inner Join m_wd_team b ON a.team_ID = b.team_ID Where a.wd_id = '$User_code'";
		$res = $conn->query(trim($sql));
		$data['data']['Member_team'] = []; // Initial Create blank Data
		while ($row = $res->fetch_assoc()) {
			$data['data']['Member_team'][] = $row;
		}
		
		// get Skill
		$sql = "SELECT * From wd_skill Where wd_id = '$User_code'";
		$res = $conn->query(trim($sql));
		$data['data']['Member_skill_P'] = []; // Initial Create blank Data
		while ($row = $res->fetch_assoc()) {
			$data['data']['Member_skill_P'][] = $row;
		}
		
		// get Skill
		$sql = "Select a.*, b.team_name From m_team_skill a Inner Join m_wd_team b ON a.team_ID = b.team_ID WHERE a.team_ID in (Select a.team_ID From wd_team_data a Where a.wd_id = '$User_code')";
		$res = $conn->query(trim($sql));
		$data['data']['Member_skill_T'] = []; // Initial Create blank Data
		while ($row = $res->fetch_assoc()) {
			$data['data']['Member_skill_T'][] = $row;
		}
		
		
		$sql = "SELECT a.consent_id,
					   a.consent_desc,
					   b.consent_value
				FROM   (SELECT za.consent_id,
							   za.consent_desc
						FROM   consent_master za
						WHERE  za.consent_active = 1) a
					   LEFT JOIN (SELECT zb.consent_id,
										 zb.consent_value
								  FROM   consent_data zb
								  WHERE  zb.wd_id = '$User_code') b
							  ON a.consent_id = b.consent_id ";
		$res = $conn->query(trim($sql));
		$data['data']['Member_consent'] = []; // Initial Create blank Data
		while ($row = $res->fetch_assoc()) {
			$data['data']['Member_consent'][] = $row;
		}
		
		$sql = "SELECT a.wd_id,
				   c.event_id,
				   c.event_name,
				   c.start,
				   c.end,
				   c.event_type,
				   d.time_stmp
			FROM wd_training a
			INNER JOIN m_training_sjb b ON a.Training_ID = b.Training_ID
			INNER JOIN m_event_list c ON b.Training_ID = c.Training_ID
			LEFT JOIN
			  (SELECT *
			   FROM m_event_data a
			   WHERE a.wd_id = '$User_code'
			   GROUP BY a.wd_id,
						a.event_id) d ON c.event_id = d.event_id
			AND d.wd_id = '$User_code'
			WHERE a.wd_id = '$User_code'
			  AND c.active = 1
			  AND (CURRENT_TIMESTAMP() BETWEEN c.start AND c.end)
			  AND d.time_stmp is null";
		$res = $conn->query(trim($sql));
		$data['data']['Member_Event'] = []; // Initial Create blank Data
		while ($row = $res->fetch_assoc()) {
			$data['data']['Member_Event'][] = $row;
		}
		 
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F = 7
function Update_consent_member()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 
		 include "connectionDb.php";
		 // Query User Information
		 $sql = "Select * From app_access_hash a 
					Where a.hash_key = '$hash_key' and a.Active = 1";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		$User_code =  $row['user_code'];
		
		//print($consent_data);
	$resultConsent = json_decode($consent_data);
	$runID = 1;
	foreach ($resultConsent as $value) {
		
		// Delete =================================
		$del_sql = "Delete from consent_data  Where consent_id = $runID AND wd_id = '$User_code'";
		//print($del_sql);
		if(!$conn->query($del_sql))
		{
			exit();
		}
		// Insert =================================
		$res_inQuery = "0";
		if ($value == true)
		{
			$res_inQuery = "1";
		}
		/*
		$ins_sql = "Update consent_data 
			SET consent_value = $res_inQuery 
			, Last_update = CURRENT_TIMESTAMP()
			Where wd_id = '$User_code'
			AND consent_id = $runID";
			*/
		$Ins_sql = "Insert Into consent_data VALUE ('$User_code',$runID, $res_inQuery , CURRENT_TIMESTAMP())";
		//print($Ins_sql);
		if(!$conn->query($Ins_sql))
		{
			exit();
		}
		$runID++;
	}
		mysqli_close($conn);
		$data['success'] = "success";
	 }
	$data_Array['RESULT'] = $data;
	 
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
	
	//print_r ($obj);
}


// F = 8
function Update_Member_data()
{
	//sleep(1);
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		 // Query User Information
		
		$sql = "Update wd_db SET 
		status = $status
		, name = '$name'
		, s_name = '$s_name'
		, n_name = '$n_name'
		, birthday = '$birthday'
		, occ = '$occ'
		, address = '$address'
		, add_code = '$add_code'
		, tel = '$tel'
		, tel_2 = '$tel_2'
		, email = '$email'
		, soc_fb = '$soc_fb'
		, soc_fb_2 = '$soc_fb_2'
		, soc_line = '$soc_line'
		, soc_twitter = '$soc_twitter'
		, wd_img = '$wd_img'
		, remark = '$remark'

		Where wd_id = '$wd_id'";
		if(!$conn->query($sql))
		{
			exit();
		}
		
		mysqli_close($conn);
		$data['success'] = "success";
	 }
	$data_Array['RESULT'] = $data;
	 
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
	//print_r ($obj);
}
// F = 9
function Update_CheckIn()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		 // Query User Information
		 $sql = "Select * From app_access_hash a 
					Where a.hash_key = '$hash_key' and a.Active = 1";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		$User_code =  $row['user_code'];
		
		$sql = "Insert Into m_event_data value ($checkInID, '$User_code', '', '', '', CURRENT_TIMESTAMP())";
		if(!$conn->query($sql))
		{
			exit();
		}
		
		mysqli_close($conn);
		$data['success'] = "success";
	 }
	$data_Array['RESULT'] = $data;
	 
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
	
	//print_r ($obj);
}

// F = 10
function getAddressInitial()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		// all Data
		$sql="SELECT * FROM add_districts a Where a.DISTRICT_CODE = '$addressCode'";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['addressInfo'][] = $row;
			$DISTRICT_ID =  $row['DISTRICT_ID'];
			$AMPHUR_ID =  $row['AMPHUR_ID'];
			$PROVINCE_ID =  $row['PROVINCE_ID'];
		}
		
		// Get District For Select 
		$sql="SELECT a.DISTRICT_CODE, a.DISTRICT_NAME From add_districts a 
			Where a.AMPHUR_ID = $AMPHUR_ID
			Order By a.DISTRICT_ID";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['DistrictSelect'][] = $row;
		}
		
		// Get Aumpher For Select 
		$sql="Select a.AMPHUR_ID, a.AMPHUR_NAME From add_amphures a 
			Where a.PROVINCE_ID = $PROVINCE_ID
			AND a.AMPHUR_NAME NOT LIKE '%*%'
			Order By a.AMPHUR_ID";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['AumpherSelect'][] = $row;
		}
		
		// Get Province For Select 
		$sql="Select a.PROVINCE_ID, a.PROVINCE_NAME From add_provinces a 
			Inner Join add_provinces_order b ON a.PROVINCE_NAME = b.province_name
			Order By b.No";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['ProvinceSelect'][] = $row;
		}
		
		
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F = 11
function getAddressProvinceChange()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		// all Data
		/*
		$sql="SELECT * FROM add_districts a Where a.DISTRICT_CODE = '$addressCode'";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['addressInfo'][] = $row;
			$DISTRICT_ID =  $row['DISTRICT_ID'];
			$AMPHUR_ID =  $row['AMPHUR_ID'];
			$PROVINCE_ID =  $row['PROVINCE_ID'];
		}
		*/
		
		$AMPHUR_ID = "";
		$DISTRICT_ID = "";
		
		// Get Aumpher For Select 
		$sql="Select a.AMPHUR_ID, a.AMPHUR_NAME From add_amphures a 
			Where a.PROVINCE_ID = $PROVINCE_ID
			AND a.AMPHUR_NAME NOT LIKE '%*%'
			Order By a.AMPHUR_ID";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			if ($AMPHUR_ID == "")
			{
				$AMPHUR_ID =$row['AMPHUR_ID'];
				$data['data']['addressInfo']['AMPHUR_ID'] = $row['AMPHUR_ID'];
			}
			$data['data']['AumpherSelect'][] = $row;
		}
		
		
		// Get District For Select 
		$sql="SELECT a.DISTRICT_CODE, a.DISTRICT_NAME From add_districts a 
			Where a.AMPHUR_ID = $AMPHUR_ID
			Order By a.DISTRICT_ID";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			if ($DISTRICT_ID == "")
			{
				$DISTRICT_ID =$row['DISTRICT_CODE'];
				$data['data']['addressInfo']['DISTRICT_CODE'] = $row['DISTRICT_CODE'];
			}
			$data['data']['DistrictSelect'][] = $row;
		}
		
		
		
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}


// F = 12
function getAddressAumpherChange()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		
		$DISTRICT_ID = "";
		

		// Get District For Select 
		$sql="SELECT a.DISTRICT_CODE, a.DISTRICT_NAME From add_districts a 
			Where a.AMPHUR_ID = $AMPHUR_ID
			Order By a.DISTRICT_ID";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			if ($DISTRICT_ID == "")
			{
				$DISTRICT_ID =$row['DISTRICT_CODE'];
				$data['data']['addressInfo']['DISTRICT_CODE'] = $row['DISTRICT_CODE'];
			}
			$data['data']['DistrictSelect'][] = $row;
		}
		
		
		
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F = 13
function getMemberSnd_case()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 
		 include "connectionDb.php";
		  // Query User Information
		 $sql = "Select * From app_access_hash a 
					Where a.hash_key = '$hash_key' and a.Active = 1";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		$User_code =  $row['user_code'];
		
		// get send Case
		$sql="SELECT a.case_id,
			   b.topic,
			   b.t_sum,
			   a.snd_date,
			   b.case_cnt_url,
			   b.status, 
               c.crp_status
		FROM case_sender a
		INNER JOIN wd_case b ON a.case_id = b.case_id
        Inner Join m_crp_status c ON b.status = c.id
		WHERE a.name = '$User_code'
		ORDER BY a.snd_date DESC";
		$res = $conn->query(trim($sql));
		// Get Total Remain
		$data['data']['memsndCaseTotal']= mysqli_num_rows($res);
		$data['data']['memsndCase'] = array();

		while ($row = $res->fetch_assoc()) {
			$row['case_id_show'] = substr($row['case_id'], 0, 2) . "-" . substr($row['case_id'], 2, 2) . "-" . substr($row['case_id'], 4, 3);
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
			$data['data']['memsndCase'][] = $row;
		}
		
		
		// Get Support Case ---------------------------
		$sql="SELECT a.case_id,
				   b.topic,
				   b.t_sum,
				   b.case_cnt_url,
				   b.status, 
				   c.crp_status
			FROM   case_wd_support a
				   INNER JOIN wd_case b
						   ON a.case_id = b.case_id
						   Inner Join m_crp_status c ON b.status = c.id
			WHERE  a.wd_id = '$User_code'
			ORDER  BY a.case_id DESC ";
		$res = $conn->query(trim($sql));
		$data['data']['memsupCase'] = array();
		while ($row = $res->fetch_assoc()) {
			$row['case_id_show'] = substr($row['case_id'], 0, 2) . "-" . substr($row['case_id'], 2, 2) . "-" . substr($row['case_id'], 4, 3);
			$row['img'] = "img/wd_img/default.png";
			$row['post_link']  = "#";
			$data['data']['memsupCase'][] = $row;
		}
		
		
		// Get Activity Timeline---------------------------
		$sql="SELECT *
		FROM   (SELECT a.wd_id,
					   11                 AS timeline_type,
					   b.training_subject AS activity,
					   b.training_end     AS activity_date,
					   ''                 AS url
				FROM   wd_db a
					   INNER JOIN m_training_sjb b
							   ON a.gen = b.gen_code
				WHERE  a.wd_id = '$User_code'
				UNION ALL
				SELECT a.wd_id,
					   12                 AS timeline_type,
					   b.training_subject AS detail,
					   b.training_end,
					   ''                 AS url
				FROM   wd_training a
					   INNER JOIN m_training_sjb b
							   ON a.training_id = b.training_id
				WHERE  a.wd_id = '$User_code'
					   AND b.gen_code = 0
				UNION ALL
				SELECT *
				FROM   wd_activity_log
				WHERE  wd_id = '$User_code'
				UNION ALL
				SELECT a.name,
					   21      AS timeline_type,
					   b.topic AS detail,
					   a.snd_date,
					   b.case_cnt_url
				FROM   case_sender a
					   INNER JOIN wd_case b
							   ON a.case_id = b.case_id
				WHERE  a.name = '$User_code'
				UNION ALL
				SELECT a.wd_id,
					   22             AS timeline_type,
					   b.topic        AS detail,
					   b.add_date,
					   b.case_cnt_url AS url
				FROM   case_wd_support a
					   INNER JOIN wd_case b
							   ON a.case_id = b.case_id
				WHERE  a.wd_id = '$User_code') a
		ORDER  BY activity_date,
				  timeline_type  ";
		$res = $conn->query(trim($sql));
		$data['data']['memTimeline'] = array();
		while ($row = $res->fetch_assoc()) {
			switch($row['timeline_type'])
			{
				case 11 :
				{
					$row['event_desc'] = "อบรม / ร่วมกิจกรรม";
					break;
				}
				
				case 12 :
				{
					$row['event_desc'] = "อบรม / ร่วมกิจกรรม";
					break;
				}
				
				case 21 :
				{
					$row['event_desc'] = "ส่งเรื่อง";
					break;
				}
				
				case 22 :
				{
					$row['event_desc'] = "รุม";
					break;
				}
				
				case 91 :
				{
					$row['event_desc'] = "โดนแบน";
					break;
				}
				
				case 92 :
				{
					$row['event_desc'] = "โดนคัดออกจากศูนย์";
					break;
				}
				
				default :
				{
					$row['event_desc'] = "....";
					break;
				}
			}
			$data['data']['memTimeline'][] = $row;
		}
		
		
		// Get Support Case ---------------------------
		$sql="SELECT b.training_id,
				   b.training_subject,
				   b.training_type,
				   b.location,
				   b.training_start,
				   b.training_end
			FROM   wd_training a
				   INNER JOIN m_training_sjb b
						   ON a.training_id = b.training_id
			WHERE  a.wd_id = '$User_code'
			ORDER  BY b.training_start ";
		$res = $conn->query(trim($sql));
		$data['data']['memTraining'] = array();
		while ($row = $res->fetch_assoc()) {
			$data['data']['memTraining'][] = $row;
		}
		
		
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F = 14
function searchCaseAdmin()
{
	//sleep(3);
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 $offsetStart = 20 * $offset;
		 include "connectionDb.php";
		
		// Get District For Select 
		
		/*
		$sql="SELECT a.case_id,
				a.topic,
				a.t_sum,
				a.add_date,
				d.ofd_name,
				a.status,
				Trim(d.province_name) As province_name,
				e.crp_status,
				Ifnull(Ifnull(b.img, c.img), 'default.png') AS IMG
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
		 WHERE  a.case_id IN (Select DISTINCT(z.CASE_ID) From case_search_temp z where z.search_area like '%$searchText%')
		 ORDER  BY a.case_id DESC
		 LIMIT $offsetStart, 20";
		 */
		 
		 $sql="SELECT a.case_id,
				a.topic,
				a.t_sum,
				a.add_date,
				d.ofd_name,
				a.status,
				Trim(d.province_name) As province_name,
				e.crp_status,
				Ifnull(Ifnull(b.img, c.img), 'default.png') AS IMG
		 FROM   wd_case a
				LEFT JOIN (Select a.case_id, a.img AS IMG From vw_case_img a) b
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
		 WHERE  a.case_id IN (Select DISTINCT(z.CASE_ID) From case_search_temp z where z.search_area like '%$searchText%')
		 ORDER  BY a.case_id DESC
		 LIMIT $offsetStart, 20";
		 
		$data['data']['SearchResult'] = array();
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$row['case_id_show'] = substr($row['case_id'], 0, 2) . "-" . substr($row['case_id'], 2, 2) . "-" . substr($row['case_id'], 4, 3);
			$data['data']['SearchResult'][] = $row;
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F = 15
function updateMemberSkill()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 
		 include "connectionDb.php";
		 // Query User Information
		 $sql = "Select * From app_access_hash a 
					Where a.hash_key = '$hash_key' and a.Active = 1";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		$User_code =  $row['user_code'];
		
	$ResultskillData = explode(",",$skillData);
	print(gettype($ResultskillData));
	print_r($ResultskillData);
	// Delete =================================
	$del_sql = "DELETE From wd_skill Where wd_id = '$User_code'";
	//print($del_sql);
	if(!$conn->query($del_sql))
	{
		exit();
	}
	//echo $skillData;
	foreach ($ResultskillData as $value) {
		// Insert =================================
		if (trim($value) != "")
		{
			$ran_id = gen_rnd_str();
			$Ins_sql = "Insert Into wd_skill VALUE ('$User_code', '$value', '$ran_id')";
			//print($Ins_sql);
			if(!$conn->query($Ins_sql))
			{
				exit();
			}
		}
	}
		mysqli_close($conn);
		$data['success'] = "success";
	 }
	$data_Array['RESULT'] = $data;
	 
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
	
	//print_r ($obj);
}

// F = 16
function load_page_post()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		// get WIP Case
		$sql=" Select Z.id
			, Z.full_picture
			,  Substring(Z.msg, 1, 100) AS MSG
			, Z.created_time
			, GROUP_CONCAT(Z.CASE_ID) AS CASE_ID
			, IFNULL(Z.STATUS_TEXT, '') AS STATUS_TEXT
			, Z.STATUS_CODE
			, Z.post_type
			, IFNULL(Z.reach, '0') AS reach
			
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
			
			ORDER BY Z.created_time DESC";
		$res = $conn->query(trim($sql));
		// Get Total Remain
		$data['data']['allpostIntotal']= mysqli_num_rows($res);
		$data['data']['allpost'] = array();
		while ($row = $res->fetch_assoc()) { 
			if ($row['CASE_ID'] != '-') {
				if (strpos($row['CASE_ID'], ",")) {
					$row['print_case_id'] = $row['CASE_ID'];
				} else {
					$row['print_case_id'] = substr($row['CASE_ID'], 0, 2) . '-' . substr($row['CASE_ID'], 2, 2) . '-' . substr($row['CASE_ID'], 4);
				}
			} else {
				$row['print_case_id'] = '-';
			}
			$row['MSG'] = str_replace("\n\n", "\n", $row['MSG']);
			$row['MSG'] = str_replace("\n \n", "\n", $row['MSG']);
			//$row['MSG'] = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
			//$row['full_picture'] = 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Image_created_with_a_mobile_phone.png/800px-Image_created_with_a_mobile_phone.png?20130110144453';
			
			$data['data']['allpost'][] = $row;
		}
		// Add Post type for select;
		$sql="Select a.id, a.type_name From m_page_post_type_master a Where a.id > 1 Order By a.id_ORDER";
		 
		$data['data']['postTypeForSelect'] = array();
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['postTypeForSelect'][] = $row;
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

//F= 17
function load_post_data()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value)
	{
		$a = htmlspecialchars($key) ;
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	 if ($token_key == $token)
	 {
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
			$picture = "http://35.247.145.219/WD_system/img/wd_img/default.png";
		}
		
		
		
		
		$data_ArrayResult = array();
		$data_ArrayResult['post_reactions_like'] = '0';
		$data_ArrayResult['post_reactions_love'] = '0';
		$data_ArrayResult['post_reactions_haha'] = '0';
		$data_ArrayResult['post_reactions_sorry'] = '0';
		$data_ArrayResult['post_reactions_anger'] = '0';
		$data_ArrayResult['post_reactions_wow'] = '0';
		$data_ArrayResult['message']= '0';
		$data_ArrayResult['headmessage']= '0';
		$data_ArrayResult['target_url']= '0';
		$data_ArrayResult['picture']= '0';
		$data_ArrayResult['shares']= '0';
		$data_ArrayResult['comment']= '0';
		$data_ArrayResult['post_impressions']= '0';
		$data_ArrayResult['post_impressions_unique']= '0';
		$data_ArrayResult['post_star']= '0';
		$data_ArrayResult['post_impressions_viral']= '0';
		$data_ArrayResult['post_impressions_viral_unique']= '0';
		$data_ArrayResult['post_engaged_users']= '0';
		$data_ArrayResult['post_negative_feedback']= '0';
		$data_ArrayResult['post_negative_feedback_unique']= '0';
		$data_ArrayResult['post_engaged_fan']= '0';
		$data_ArrayResult['post_activity']= '0';
		$data_ArrayResult['post_clicks_unique']= '0';
		$data_ArrayResult['post_clicks']= '0';
		$data_ArrayResult['post_reactions_like']= '0';
		$data_ArrayResult['post_reactions_love']= '0';
		$data_ArrayResult['post_reactions_wow']= '0';
		$data_ArrayResult['post_reactions_haha']= '0';
		$data_ArrayResult['post_reactions_sorry']= '0';
		$data_ArrayResult['post_reactions_anger']= '0';
		$data_ArrayResult['post_reactions_total']= '0';
		$data_ArrayResult['pub_time']= '0';
		$data_ArrayResult['message'] = $message;
		$data_ArrayResult['message'] = str_replace("\n \n", "\n", $data_ArrayResult['message']);
		//$posHeader = strpos($data_ArrayResult['message'], "\n");
		$temp_message = strval($data_ArrayResult['message']);
		//$temp_message = substr("Hello world", 0, 2);
		//$data_ArrayResult['headmessagea'] = mb_strpos($temp_message, "\n");
		//$data_ArrayResult['headmessageb'] = gettype("Hello world");
		//echo strpos($data_ArrayResult['message'], "\n");
		$cutlenght = 35;
		if(mb_strpos($temp_message, "\n") !== false){
			if (mb_strpos($temp_message , "\n") > $cutlenght)
			{
				$data_ArrayResult['headmessage'] = mb_substr($temp_message , 0, $cutlenght)."...";
			}
			else
			{
				$data_ArrayResult['headmessage'] = mb_substr($temp_message , 0, mb_strpos($temp_message,"\n"));
			}
		} else{
			$data_ArrayResult['headmessage'] = mb_substr($temp_message , 0, $cutlenght)."...";
		}
		
		
		
		$data_ArrayResult['target_url'] = "https://www.facebook.com/".$target;
		
		$data_ArrayResult['picture'] = $picture;
		if ( isset($obj->shares))
		{
			$shares= $obj->shares;
			$data_ArrayResult['shares'] = $shares->count;
		}
		else
		{
			
			$data_ArrayResult['shares'] = 0;
		}
		
		$url = "https://graph.facebook.com/v9.0/$target/comments?limit=1&summary=1&access_token=$page_token";
		$json = file_get_contents($url);
		$obj = json_decode($json);
		$comment= $obj->summary->total_count;
		$data_ArrayResult['comment'] =$comment;
		
		$sql = "Select * From static_post WHERE post_id = '$post_id' AND time_stmp = (SELECT max(time_stmp) From static_post WHERE post_id = '$post_id')";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc())
		{
			//$data_ArrayResult[$row['f_name']] = number_format($row['value']);
			$data_ArrayResult[$row['f_name']] = $row['value'];
			if ($row['f_name'] == 'post_impressions_unique')
			{
				$data_ArrayResult['post_star'] = cal_post_level($row['value']);
			}
		}
		
		
		
		$sql = "SELECT pub_time From system_page_all_pub WHERE post_id = '$post_id'";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		$data_ArrayResult['pub_time'] = $row['pub_time'];
		$data['data'] = $data_ArrayResult;
		//echo json_encode($data_Array);
		
		mysqli_close($conn);
		$data['success'] = "success";
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F = 18
function updatePagePostType()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		 // Query User Information
		// INSERT POST TYPE
		$ran_str = gen_rnd_str();
		$ins_sql = "Insert Into page_post_type Value ('$post_id', $type_post, '$ran_str')";
		//echo $ins_sql;
		if (!$conn->query($ins_sql)) {
			echo  $conn->errno;
			exit();
		}
		mysqli_close($conn);
		$data['success'] = "success";
	 }
	$data_Array['RESULT'] = $data;
	 
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
	
	//print_r ($obj);
}

// F = 19
function loadChatlist()
{
	//sleep(3);
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		// Get District For Select 
		if (trim($search_text) == "")
		{
			$sql="Select 
			  a.msg_id, 
			  a.sender_name, 
			  a.update_time, 
			  b.MSG, 
			  c.msg_id as case_id, 
			  a.msg_link 
			From 
			  page_msg a 
			  Inner Join page_msg_detail b ON a.msg_id = b.MSG_ID 
			  and a.update_time = b.created_time 
			  Left Join (
				Select 
				  DISTINCT(MSG_ID) as MSG_ID 
				From 
				  case_inbox_msg
			  ) c ON a.msg_id = c.MSG_ID 
			Order By 
			  a.update_time DESC 
			LIMIT 
			  50;";
		}
		else
		{
			$sql = "Select 
					  a.msg_id, 
					  a.sender_name, 
					  a.update_time, 
					  b.MSG, 
					  c.msg_id as case_id, 
					  a.msg_link 
					From 
					  page_msg a 
					  Inner Join page_msg_detail b ON a.msg_id = b.MSG_ID 
					  Left Join (
						Select 
						  DISTINCT(MSG_ID) as MSG_ID 
						From 
						  case_inbox_msg
					  ) c ON a.msg_id = c.MSG_ID 
					WHERE 
					  (
						a.sender_name like '%$search_text%' 
						or b.MSG LIKE '%$search_text%'
					  ) 
					Group By 
					  a.msg_id 
					Order By 
					  a.update_time DESC 
					LIMIT 
					  50
					";
		}
		
		$res = $conn->query(trim($sql));
		$data['data']['msgList'] = array();
		while ($row = $res->fetch_assoc()) {
			$data['data']['msgList'][] = $row;
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F = 20
function loadChatDetail()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		// Get District For Select 
		/*
		$sql = "Select 
				  a.MSG_ID, 
				  a.MSG_DTL_ID, 
				  a.from_name, 
				  a.From_ID, 
				  a.MSG, 
				  UNIX_TIMESTAMP(a.created_time) * 1000 as created_time, 
				  b.Attach_ID, 
				  b.file_name, 
				  b.file_type, 
				  b.File_URL, 
				  b.Preview_url, 
				  b.File_size 
				From 
				  page_msg_detail a 
				  Left JOIN Page_MSG_Attached b ON a.MSG_DTL_ID = b.MSG_DTL_ID 
				where 
				  a.msg_id = '$msg_id' 
				  AND a.MSG <> 'Is this transaction complete?' 
				Order By 
				  created_time DESC";
				  
				*/  
		$sql = "			Select 
				  a.MSG_ID, 
				  a.MSG_DTL_ID, 
				  c.sender_name as from_name, 
				  a.From_ID, 
				  a.MSG, 
				  UNIX_TIMESTAMP(a.created_time) * 1000 as created_time, 
				  b.Attach_ID, 
				  b.file_name, 
				  b.file_type, 
				  b.File_URL, 
				  b.Preview_url, 
				  b.File_size 
				From 
				  page_msg_detail a 
				  Left JOIN Page_MSG_Attached b ON a.MSG_DTL_ID = b.MSG_DTL_ID 
                  Inner Join page_msg c ON a.MSG_ID = c.msg_id
				where 
				  a.msg_id = '$msg_id' 
				  AND a.MSG <> 'Is this transaction complete?' 
				Order By 
				  created_time DESC;";
				  
		$res = $conn->query(trim($sql));
		$data['data']['msgDetail'] = array();
		$tem_array = array();
		$tem_array_author = array();
		while ($row = $res->fetch_assoc()) {
			$tem_array = [];
			$tem_array_author = [];
			
			// Name 
			$tem_array_author['firstName'] = $row['from_name'];
			$tem_array_author['id'] = $row['From_ID'];
			$tem_array_author['lastName'] = "";
			$tem_array['author'] = $tem_array_author;
			
			$tem_array['createdAt'] = intval($row['created_time']);
			$tem_array['id'] = $row['MSG_DTL_ID'];
			$tem_array['status'] = 'seen';
			
			if ($row['file_type']  ==  null)
			{
				$tem_array['text'] = $row['MSG'];
				$tem_array['type'] = 'text';
			}
			else
			{
				if ($row['file_type'] == "image/jpeg")
				{
					$tem_array['type'] = 'image';
					$tem_array['uri'] = $row['File_URL'];;
					$tem_array['name'] = $row['file_name'];;
					$tem_array['size'] = intval($row['File_size']);
					$tem_array['height'] = 1280;
					$tem_array['width'] = 1920;
				}
				else
				{
					$tem_array['type'] = 'file';
					$tem_array['uri'] = $row['File_URL'];;
					$tem_array['name'] = $row['file_name'];;
					$tem_array['size'] = intval($row['File_size']);
				}
				
				
				
			}
			
			$data['data']['msgDetail'][] = $tem_array;
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F = 21
function loadCaseDetail()
{
	//sleep(1);
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		 
		// Get Core Infromation 
		$sql = "Select a.*, b.crp_status From wd_case a 
			INNER JOIN m_crp_status b ON a.status = b.id 
			Where a.case_id = '$case_id'";
		$res = $conn->query(trim($sql));
		$data['data']['coreCase'] = array();
		while ($row = $res->fetch_assoc()) {
			$data['data']['coreCase'][] = $row;
		}
		
		// Get Coruption Location 
		$sql = "Select 
			  a.ofd_name, 
			  a.ofd_type, 
			  b.org_type_name, 
			  TRIM(c.AMPHUR_NAME) AS AMPHUR_NAME, 
			  TRIM(d.PROVINCE_NAME) AS PROVINCE_NAME
			From 
			  case_ofd_info a 
			  Inner JOIN m_org_type b ON a.org_type_id = b.org_type_id 
			  INNER Join add_amphures c ON a.ofd_address_code = c.AMPHUR_CODE 
			  Inner Join add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID 
			Where 
			  a.case_id = '$case_id'";
		$res = $conn->query(trim($sql));
		$data['data']['caseOfdInfo'] = array();
		while ($row = $res->fetch_assoc()) {
			$data['data']['caseOfdInfo'][] = $row;
		}
		
		// Get Crp Type 
		$sql = "SELECT * FROM case_crp_type_data a Where a.case_id = '$case_id'";
		$res = $conn->query(trim($sql));
		$data['data']['caseCrpType'] = array();
		while ($row = $res->fetch_assoc()) {
			$data['data']['caseCrpType'][] = $row;
		}
		
		
		// Get Case Hash Tag
		$sql = "Select 
				  a.case_id, 
				  b.Hashtag, 
				  b.type, 
				  b.rnd_str 
				From 
				  case_pub_info a 
				  Inner Join hashtag_data b ON a.pub_url = b.Ojb_id 
				Where 
				  a.pub_type = 'page_WD_post' 
				  AND b.type = 'page' 
				  AND a.case_id = '$case_id' 
				  AND b.active = '1' 
				UNION ALL 
				Select 
				  a.case_id, 
				  b.Hashtag, 
				  b.type, 
				  b.rnd_str 
				From 
				  case_group_post a 
				  Inner Join hashtag_data b ON a.group_post_id = b.Ojb_id 
				  AND b.type = 'group' 
				  AND a.case_id = '$case_id' 
				  AND b.active = '1' 
				UNION ALL 
				SELECT 
				  a.Ojb_id As case_id, 
				  a.Hashtag, 
				  a.type, 
				  a.rnd_str 
				FROM 
				  hashtag_data a 
				Where 
				  a.Ojb_id = '$case_id' 
				  AND a.type = 'manual' 
				  and a.active = 1
				";
		$res = $conn->query(trim($sql));
		$data['data']['caseHashTag'] = array();
		while ($row = $res->fetch_assoc()) {
			$data['data']['caseHashTag'][] = $row;
		}
		
		// Get Job Type 
		$sql = "SELECT * FROM case_job_type Where case_id = '$case_id'";
		$res = $conn->query(trim($sql));
		$data['data']['caseJobType'] = array();
		while ($row = $res->fetch_assoc()) {
			$data['data']['caseJobType'][] = $row;
		}
		
		// Get OFD
		$sql = "SELECT * FROM case_ofd_name Where case_id = '$case_id'";
		$res = $conn->query(trim($sql));
		$data['data']['caseOfdName'] = array();
		while ($row = $res->fetch_assoc()) {
			$data['data']['caseOfdName'][] = $row;
		}
		
		// Get Case Image
		$sql = "SELECT * FROM vw_case_img Where case_id = '$case_id'";
		$res = $conn->query(trim($sql));
		$data['data']['caseImg'] = array();
		while ($row = $res->fetch_assoc()) {
			$data['data']['caseImg'][] = $row;
		}
		
		// Get Relate Link
		$sql = "Select * From case_relate_url Where case_id = '$case_id'";
		$res = $conn->query(trim($sql));
		$data['data']['caseRelateLink'] = array();
		while ($row = $res->fetch_assoc()) {
			$data['data']['caseRelateLink'][] = $row;
		}
		
		
		
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F = 22
function updateCaseCoreData()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		if ($key == "jsonData")
		{
			$$a = $value;
		}
		else
		{
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		$obj = json_decode($jsonData);
		
		$case_id =  $obj->case_id;
		$topic =  $obj->topic;
		$t_sum =  $obj->t_sum;
		$note =  $obj->note;
		$cannot_est_dmg =  $obj->cannot_est_dmg;
		$crp_dmg_off =  $obj->crp_dmg_off;
		$ofd_dmg =  $obj->ofd_dmg;
		$priority =  $obj->priority;
		
		$inssql = "UPDATE wd_case SET  topic = '$topic' 
					,t_sum = '$t_sum' 
					,note = '$note' 
					,priority = '$priority' 
					,cannot_est_dmg = '$cannot_est_dmg' 
					,crp_dmg_off = '$crp_dmg_off' 
					,ofd_dmg = '$ofd_dmg' 
					where case_id = '$case_id'";
		
		//echo $inssql;
		include "connectionDb.php";
		if(!$conn->query($inssql))
		{
			exit();
		}
		else
		{
			$data['success'] = "success";
		}
		mysqli_close($conn);
		
		//echo ($priority);
	 }
	$data_Array['RESULT'] = $data;
	 
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
	
	//print_r ($obj);
}

// F = 23
function loadCrpypeForSelect()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		// Get District For Select 
		//$sql="SELECT * FROM m_crp_type";
		$sql="SELECT a.*, b.case_id FROM m_crp_type a Left JOIN case_crp_type_data b ON a.id = b.crp_id AND b.case_id = '$case_id';";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['m_crp_type'][] = $row;
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F = 24
function updateCrpType()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		if ($key == "jsonData")
		{
			$$a = $value;
		}
		else
		{
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 
		 include "connectionDb.php";
		 // 1. Delete Process =======================
		 $delSQL = "DELETE From case_crp_type_data  Where case_id = '$case_id'";
		 //echo $delSQL;
		 if(!$conn->query($delSQL))
		{
			exit();
		}
		 
		$obj = json_decode($jsonData);
		//print_r($obj);
		foreach ($obj as $obj_s) {
			//print_r($obj_s->itemValue);
			$itemValue = $obj_s->itemValue;
			$itemDesc = $obj_s->itemDesc;
			
			$ran_str = $case_id.gen_rnd_str();
			//
			$inssql = "Insert Into case_crp_type_data value ('$case_id', $itemValue, '$itemDesc', '$ran_str')";
			 //echo $inssql;
			 if(!$conn->query($inssql))
			{
				exit();
			}
		  
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F = 25
function deleteSingleItem()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		if ($key == "jsonData")
		{
			$$a = $value;
		}
		else
		{
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 
		 include "connectionDb.php";
		 // 1. Delete Process =======================
		 if ($del_type == "case_crp_type_data")
		 {
			 $delSQL = "DELETE From case_crp_type_data  Where case_id = '$case_id' And rnd_str = '$rnd_str'";
		 }
		 
		  if ($del_type == "case_ofd_location")
		 {
			 $delSQL = "DELETE From case_ofd_info   Where case_id = '$case_id' And ofd_name = '$rnd_str'";
		 }
		 
		 if ($del_type == "case_hastag")
		 {
			 $delSQL = "DELETE From  hashtag_data   Where rnd_str = '$rnd_str'";
			 //echo  $delSQL;
		 }
		 
		  if ($del_type == "case_JobType")
		 {
			 $delSQL = "DELETE From  case_job_type   Where case_id = '$case_id' And rnd_str = '$rnd_str'";
		 }
		 //case_ofd_name
		  if ($del_type == "case_OFD_Name")
		 {
			 $delSQL = "DELETE From  case_ofd_name   Where case_id = '$case_id' And rnd_str = '$rnd_str'";
		 }
		  //case_Sender
		  if ($del_type == "delSender")
		 {
			 $delSQL = "DELETE From  case_sender   Where case_id = '$case_id' And name = '$rnd_str'";
		 }
		 // deleteCommu
		  if ($del_type == "deleteCommu")
		 {
			 $delSQL = "DELETE From  case_wd_support   Where case_id = '$case_id' And wd_id = '$rnd_str'";
		 }
		 // deleteCaseMSG
		  if ($del_type == "deleteCaseMSG")
		 {
			 $delSQL = "Delete From case_inbox_msg Where case_id = '$case_id' AND MSG_ID = '$rnd_str'";
		 }
		 
		  // deleteCaseMSG
		  if ($del_type == "CaseRelateURL")
		 {
			 $delSQL = "Delete From case_relate_url Where case_id = '$case_id' AND rnd_id = '$rnd_str'";
		 }
		 echo $delSQL ;
		 // Execuite ================================
		 if(!$conn->query($delSQL))
		{
			exit();
		}
		 
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F = 26
function loadProvinceForSelect()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		$sql="Select a.PROVINCE_ID, a.PROVINCE_NAME From add_provinces a  Inner Join add_provinces_order b ON a.PROVINCE_NAME = b.province_name Order By b.No;";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['provinceData'][] = $row;
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F = 27
function loadOrgTypeForSelect()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		$sql="SELECT * FROM m_org_type";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['OrgTypeData'][] = $row;
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F = 28
function add_New_OFD()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		if ($key == "jsonData")
		{
			$$a = $value;
		}
		else
		{
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 
		 include "connectionDb.php";
		  $insSQL = "Insert Into case_ofd_info value ('$caseID', '$ofd_name', '$ofd_type', $org_type_ID, '$odf_Address')";
		 echo $insSQL;
		 // Execuite ================================
		 if(!$conn->query($insSQL))
		{
			exit();
		}
		 
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F = 29
function loadAumpherDataForSelect()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		$sql="SELECT a.AMPHUR_CODE, a.AMPHUR_NAME FROM add_amphures a Where a.PROVINCE_ID = $PROVINCE_ID";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['aumPherData'][] = $row;
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// addNewHashtag
// F = 30
function addNewHashtag()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		if ($key == "jsonData")
		{
			$$a = $value;
		}
		else
		{
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 $rnd_srt = $case_id.gen_rnd_str();
		 include "connectionDb.php";
		 // 1. Insert  Process =======================
		 $insSQL = "Insert Into hashtag_data  value ('$case_id', '$newTag', 'manual', '1', '$rnd_srt')";
		 //echo $delSQL;
		 if(!$conn->query($insSQL))
		{
			exit();
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

//addNewJobType
// F = 31
function addNewJobType()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		if ($key == "jsonData")
		{
			$$a = $value;
		}
		else
		{
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 $rnd_srt = $case_id.gen_rnd_str();
		 include "connectionDb.php";
		 // 1. Insert  Process =======================
		 //$insSQL = "Insert Into case_job_type  value ('$case_id', '$newTag', 'manual', '1', '$rnd_srt')";
		 $insSQL = "Insert Into case_job_type  value ('$case_id', '$newJobType', '$rnd_srt')";
		 //echo $delSQL;
		 if(!$conn->query($insSQL))
		{
			exit();
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

//addNewOFDName
// F = 32
function addNewOFDName()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		if ($key == "jsonData")
		{
			$$a = $value;
		}
		else
		{
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 $rnd_srt = $case_id.gen_rnd_str();
		 include "connectionDb.php";
		 // 1. Insert  Process =======================
		 //$insSQL = "Insert Into case_job_type  value ('$case_id', '$newTag', 'manual', '1', '$rnd_srt')";
		 $insSQL = "Insert Into case_ofd_name  value ('$case_id', '$rnd_srt', '$ofdName', '$ofdPos', '$odsDesc')";
		 //echo $delSQL;
		 if(!$conn->query($insSQL))
		{
			exit();
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F=33
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
		$ins_sql = "Insert Into case_history Value ('$case_id', $status, '$detail', '$url', $staff_kid,  CURRENT_TIMESTAMP() , '$ran_str')";
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
		
		//Temp disable for test  
		download_case_img($case_id, $image_url, '2');


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


// F = 34
function getPubPostSingel()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		// get WIP Case
		$sql=" Select Z.id
			, Z.full_picture
			,  Substring(Z.msg, 1, 100) AS MSG
			, Z.created_time
			, GROUP_CONCAT(Z.CASE_ID) AS CASE_ID
			, IFNULL(Z.STATUS_TEXT, '') AS STATUS_TEXT
			, Z.STATUS_CODE
			, Z.post_type
			, IFNULL(Z.reach, '0') AS reach
			
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
				WHERE a.post_id = '$pubID'
				ORDER BY a.pub_time DESC) Z
				
				Group By Z.id
			, Z.full_picture
			, Z.created_time
			, Z.STATUS_TEXT
			, Z.STATUS_CODE
			, Z.post_type
			, Z.created_time
			
			ORDER BY Z.created_time DESC";
		$res = $conn->query(trim($sql));
		// Get Total Remain
		$data['data']['allpostIntotal']= mysqli_num_rows($res);
		$data['data']['allpost'] = array();
		while ($row = $res->fetch_assoc()) { 
			if ($row['CASE_ID'] != '-') {
				if (strpos($row['CASE_ID'], ",")) {
					$row['print_case_id'] = $row['CASE_ID'];
				} else {
					$row['print_case_id'] = substr($row['CASE_ID'], 0, 2) . '-' . substr($row['CASE_ID'], 2, 2) . '-' . substr($row['CASE_ID'], 4);
				}
			} else {
				$row['print_case_id'] = '-';
			}
			$row['MSG'] = str_replace("\n\n", "\n", $row['MSG']);
			$row['MSG'] = str_replace("\n \n", "\n", $row['MSG']);
			//$row['MSG'] = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
			//$row['full_picture'] = 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Image_created_with_a_mobile_phone.png/800px-Image_created_with_a_mobile_phone.png?20130110144453';
			
			$data['data']['allpost'][] = $row;
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

		// F=35
function pub_new_post()
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

//getCaseSender
// F = 36
function getCaseSender()
{
	//sleep(3);
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		 
		 // Case Sender =======================
		$sql="SELECT a.*, b.name as b_name, b.n_name, b.gen,b.wd_img FROM case_sender a Left Join wd_db b ON a.name = b.wd_id where a.case_id = '$case_id';";
		$res = $conn->query(trim($sql));
		$data['data']['caseSender'] = array();
		while ($row = $res->fetch_assoc()) {
			$data['data']['caseSender'][] = $row;
		}
		
		// Case Creater =======================
		$sql="Select 
				  b.nick_name as nickname, 
				  c.img as img
				From 
				  wd_case a 
				  Inner Join staff_detail b ON a.get_info_staff_id = b.key_ID 
				  Inner Join staff_img c ON b.key_ID = c.key_ID 
				Where 
				  a.case_id = '$case_id' 
				Union All 
				Select 
				  b.n_name  as nickname, 
				  b.wd_img as img
				From 
				  wd_case a 
				  Inner Join wd_db b ON a.get_info_staff_id = b.wd_id 
				Where 
				  a.case_id = '$case_id';";
		$data['data']['caseCreater'] = array();
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['caseCreater'][] = $row;
		}
		
		// Staff Operator =======================
		$sql="SELECT 
			  a.stf_kid, 
			  b.Name, 
			  b.nick_name, 
			  c.img 
			FROM 
			  case_operator a 
			  Inner Join staff_detail b ON a.stf_kid = b.key_ID 
			  Inner Join staff_img c On b.key_ID = c.key_ID 
			WHERE 
			  a.case_id = '$case_id';
			";
		$data['data']['caseOperator'] = array();
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['caseOperator'][] = $row;
		}
		
		// Staff Operator =======================
		$sql="SELECT 
			  a.stf_kid, 
			  b.Name, 
			  b.nick_name, 
			  c.img 
			FROM 
			  case_operator a 
			  Inner Join staff_detail b ON a.stf_kid = b.key_ID 
			  Inner Join staff_img c On b.key_ID = c.key_ID 
			WHERE 
			  a.case_id = '$case_id';
			";
		$data['data']['caseOperator'] = array();
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['caseOperator'][] = $row;
		}
		
		// Staff Communication =======================
		$sql="Select 
				  a.wd_id, 
				  a.n_name, 
				  a.gen, 
				  c.wd_id as exist_wd_id 
				From 
				  (
					Select 
					  b.wd_id, 
					  b.n_name, 
					  b.gen 
					From 
					  wd_team_data a 
					  INNER Join wd_db b ON a.wd_id = b.wd_id 
					Where 
					  a.team_ID = 20 
					Union All 
					Select 
					  a.key_ID as wd_id, 
					  b.nick_name, 
					  0 
					From 
					  staff a 
					  INNER Join staff_detail b ON a.key_ID = b.key_ID 
					Where 
					  a.key_ID in (11, 28, 29, 14, 15, 16, 37) 
					  AND active = 1
				  ) a 
				  Left Join case_wd_support c ON a.wd_id = c.wd_id 
				  And c.case_id = '$case_id' ";
		$data['data']['caseStaffCommu'] = array();
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['caseStaffCommu'][] = $row;
		}
		
		// Staff Communication =======================
		$sql="Select 
				  a.wd_id, 
				  a.n_name, 
				  a.gen, 
				  c.wd_id as exist_wd_id 
				From 
				  (
					Select 
					  b.wd_id, 
					  b.n_name, 
					  b.gen 
					From 
					  wd_team_data a 
					  INNER Join wd_db b ON a.wd_id = b.wd_id 
					Where 
					  a.team_ID = 20 
					Union All 
					Select 
					  a.key_ID as wd_id, 
					  b.nick_name, 
					  0 
					From 
					  staff a 
					  INNER Join staff_detail b ON a.key_ID = b.key_ID 
					Where 
					  a.key_ID in (11, 28, 29, 14, 15, 16, 37) 
					  AND active = 1
				  ) a 
				  Left Join case_wd_support c ON a.wd_id = c.wd_id 
				  And c.case_id = '$case_id' ";
		$data['data']['caseStaffCommu'] = array();
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['caseStaffCommu'][] = $row;
		}
		
		//  caseTeamSupport =======================
		$sql="SELECT 
			  a.team_id, 
			  b.team_name 
			FROM 
			  case_team_support a 
			  Inner Join m_wd_team b ON a.team_id = b.team_ID 
			Where 
			  a.case_id = '$case_id'
			 ";
		$data['data']['caseTeamSupport'] = array();
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['caseTeamSupport'][] = $row;
		}
		
		
		// Case Member Support=======================
		$sql="Select 
				  a.case_id, 
				  a.wd_id, 
				  b.name, 
				  a.support_type, 
				  b.n_name, 
				  b.gen, 
				  b.wd_img 
				From 
				  case_wd_support a 
				  INNER JOIN wd_db b ON a.wd_id = b.wd_id 
				Where 
				  a.case_id = '$case_id' ";
		$data['data']['caseTeamSupport'] = array();
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['caseTeamSupport'][] = $row;
		}
		
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}


// F=37
function addNewsender()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		if ($key == "jsonData")
		{
			$$a = $value;
		}
		else
		{
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 $rnd_srt = $case_id.gen_rnd_str();
		 include "connectionDb.php";
		 // 1. Insert  Process =======================
		 $insSQL = "Insert Into case_sender  value ('$case_id',$type , '$name','$line','$email','$tel','$occ','$relate','$note', CURRENT_DATE)";
		 if(!$conn->query($insSQL))
		{
			exit();
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}
// F = 38
function loadWDActiveforSelect()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		$sql="Select a.wd_id, a.name, a.gen, a.n_name From wd_db a Where a.status = 1 Order By a.wd_id";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['ActiveWD'][] = $row;
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

//F=39
function addCommuStaff()
{
	foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			//echo $key . ":" . $value . "\n";
		}
	include "connectionDb.php";
	
	// Delete if Exist
		$del_sql = "delete FROM case_wd_support Where  case_id = '$case_id' and wd_id = '$wd_id'";
		//echo $del_sql;
		if(!$conn->query($del_sql))
		{
			exit();
		}
		
	// Insert into case History Table
	$sql = "Insert Into case_wd_support value ('$case_id', '$wd_id', '$supportType')";
	// Update case type
	if(!$conn->query($sql))
	{
		exit();
	}
	mysqli_close($conn);	
}

// F=40
function updateCasegovCheck()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		if ($key == "jsonData")
		{
			$$a = $value;
		}
		else
		{
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 
		$detail_data = $name." : ".$detail;
		// Insert into case History Table
		$ran_str = $case_id.gen_rnd_str(5);
		
		include "connectionDb.php";
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
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F=41
function addCasePubInfo()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		if ($key == "jsonData")
		{
			$$a = $value;
		}
		else
		{
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 
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
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F=42
function add_oth_pub()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		if ($key == "jsonData")
		{
			$$a = $value;
		}
		else
		{
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 
		include "connectionDb.php";
		$ran_str = $case_id.gen_rnd_str(5);
		$sql = "Insert Into case_history value ('$case_id', 13, '$detail', '', $stf_kid, '$date 23:59:00', '$ran_str')";
		// Update case type
		if(!$conn->query($sql))
		{
			exit();
		}
		
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}


//loadCaseMSGHeader
// F = 43
function loadCaseMSGHeader()
{
	//sleep(5);
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		 
		$sql="Select 
				  a.msg_id, 
				  a.sender_name, 
				  a.update_time, 
				  b.MSG, 
				  c.msg_id as case_id, 
				  a.msg_link 
				From 
				  page_msg a 
				  Inner Join page_msg_detail b ON a.msg_id = b.MSG_ID 
				  and a.update_time = b.created_time 
				  Left Join (
					Select 
					  DISTINCT(MSG_ID) as MSG_ID 
					From 
					  case_inbox_msg
				  ) c ON a.msg_id = c.MSG_ID 
				wHERE 
				  a.msg_id IN (
					SELECT 
					  a.MSG_ID 
					FROM 
					  case_inbox_msg a 
					Where 
					  a.case_id = '$case_id'
				  ) 
				Order By 
				  a.update_time DESC 
				LIMIT 
				  50;
				";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['caseMSGHdr'][] = $row;
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}


// F=44
function addCaseInboxMSG()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		if ($key == "jsonData")
		{
			$$a = $value;
		}
		else
		{
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 
		include "connectionDb.php";
		$ran_str = $case_id.gen_rnd_str(5);
		$sql = "Insert Into case_inbox_msg value('$case_ID', '$MSG_ID', '$ran_str', CURRENT_TIMESTAMP)";
		// Update case type
		if(!$conn->query($sql))
		{
			exit();
		}
		
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// loadCaseTimeline
// F = 45
function loadCaseTimeline()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		 
		$sql="Select * From vw_case_timeline a Where a.case_id = '$case_id' Order By a.time_stmp;";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			if ($row['IMG'] == "")
			{
				$row['IMG'] = "img/wd_img/default.png";
			}
			$row['IMG'] = "https://www.wdact.co/WD_system/".$row['IMG'];
			
			if (is_numeric($row['url']))
			{
				$row['url'] = "https://www.facebook.com/Watchdog.ACT/posts/".$row['url'];
				
			}
			
			$data['data']['caseTimeLine'][] = $row;
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}


// F=46
function addRelateLink()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		if ($key == "jsonData")
		{
			$$a = $value;
		}
		else
		{
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 
		include "connectionDb.php";
		$ran_str = $case_id.gen_rnd_str(5);
		$sql = "Insert Into case_relate_url  value ('$case_id', '$newURL', '$ran_str', CURRENT_TIMESTAMP)";
		// Update case type
		if(!$conn->query($sql))
		{
			exit();
		}
		
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}


// F=47
function addNewCase()
{
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		if ($key == "jsonData")
		{
			$$a = $value;
		}
		else
		{
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 
		 //echo $case_add_date;
		// Input to system Date
		$case_add_date =  date("d/m/Y");
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
		
		$obj = json_decode($jsonData);
		
		//print_r($obj);
		$c_name = $obj->caseCore[0]->topic;
		$c_summary = $obj->caseCore[0]->t_sum;
		$c_priority = $obj->caseCore[0]->priority;
		$c_postID = $obj->caseCore[0]->casePostID;
		$ran_str = $case_id.gen_rnd_str();
		//echo $case_id;;
		// Add Here ------------------------------------------------------
		// Insert WD Case 
		$ins_sql = "Insert Into wd_case value ('$case_id', $c_priority, 0, '$c_name', '$c_summary', CURRENT_DATE, DATE_ADD(CURRENT_DATE, INTERVAL 7 DAY), '', '', '', 0, 0, 0, $currentUserID, current_timestamp())";
		
		
		if(!$conn->query(trim($ins_sql)))
		{
			echo  $conn->errno;
			exit();
		}
		
		if ($c_postID != 'null')
		{
			// case_group_post
			$ins_sql = "insert Into case_group_post value ('$case_id', '$c_postID', '$ran_str') ";
			if(!$conn->query(trim($ins_sql)))
			{
				echo  $conn->errno;
				exit();
			}
		}
		
		
		
		// Insert WD  Crp Type 
		foreach ($obj->caseCrpType as $obj_s) {
			//print_r($obj_s);
			$itemValue = $obj_s->crp_id;
			$itemDesc = $obj_s->crp_type;
			
			$ran_str = $case_id.gen_rnd_str();
			//
			$inssql = "Insert Into case_crp_type_data value ('$case_id', $itemValue, '$itemDesc', '$ran_str')";
			 //echo $inssql;
			 
			 if(!$conn->query($inssql))
			{
				exit();
			}
		}
		
		
		
		// Insert case Sender 
		foreach ($obj->caseSender as $obj_s) {
			//print_r($obj_s);
			$type = $obj_s->type;
			$name = $obj_s->name;
			$line = $obj_s->line;
			$email = $obj_s->email;
			$tel = $obj_s->tel;
			$occ = $obj_s->occ;
			$relate = $obj_s->relate;
			$note = $obj_s->note;
			//$itemDesc = $obj_s->crp_type;
			
			$ran_str = $case_id.gen_rnd_str();
			//
			 $insSQL = "Insert Into case_sender  value ('$case_id',$type , '$name','$line','$email','$tel','$occ','$relate','$note', CURRENT_DATE)";
			 //echo $insSQL;
			 
			 if(!$conn->query($insSQL))
			{
				exit();
			}
			
		  
		}
		
		
		// Insert Case OFD
		foreach ($obj->caseOfdName as $obj_s) {
			//print_r($obj_s);
			$ofd_name = $obj_s->ofd_name;
			$ofd_type = $obj_s->ofd_type;
			$org_type_id = $obj_s->org_type_id;
			$ofd_address_code = $obj_s->ofd_address_code;
			//$itemDesc = $obj_s->crp_type;
			//
			$inssql = "Insert Into case_ofd_info value ('$case_id', '$ofd_name', '$ofd_type', $org_type_id, '$ofd_address_code')";
			 //echo $inssql;
			 
			 if(!$conn->query($inssql))
			{
				exit();
			}
			
		  
		}
		
		
		// Insert Case Hiostory 
		$ran_str = $case_id.gen_rnd_str();
		// Insert Case History
		$ins_sql = "Insert Into case_history Value ('$case_id', 0, 'เปิดเคสตรวจสอบทุจริต', '', $currentUserID, CURRENT_TIMESTAMP(), '$ran_str ')";
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
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// loadCaseGovCheck
// F = 48
function loadCaseGovCheck()
{
	//sleep(5);
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		 
		$sql="Select 
				  * 
				From 
				  (
					Select 
					  a.gc_id, 
					  a.s_name, 
					  a.name, 
					  b.case_id, 
					  b.gov_dev_name, 
					  b.investigate_date 
					From 
					  m_gov_check a 
					  Inner Join case_gv_check b ON a.gc_id = b.gc_id 
					  AND b.case_id = '$case_id' 
					UNION ALL 
					Select 
					  a.gc_id, 
					  a.s_name, 
					  a.name, 
					  NULL, 
					  NULL, 
					  NULL 
					From 
					  m_gov_check a 
					Where 
					  a.gc_id NOT IN (
						Select 
						  a.gc_id 
						From 
						  m_gov_check a 
						  Inner Join case_gv_check b ON a.gc_id = b.gc_id 
						  AND b.case_id = '$case_id'
					  )
				  ) Z 
				Order By 
				  Z.gc_id
				";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['caseGovCheck'][] = $row;
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F = 49
function loadMapStaffMember()
{
	//sleep(5);
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	$data['data']['StaffMap'] = array();
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		 
		$sql="Select * From staff_member_map a Where a.key_ID = $userID";
		
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['StaffMap'][] = $row;
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F = 50
function insertPostFromMarket()
{
	//sleep(5);
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	 if ($token_key == $token)
	 {
		include "connectionDb.php";
		$ins_sql = "Insert Into group_post_data values ('$objectID', '$objectID', '$msg', '$FullImage', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 'G');";
		//echo $ins_sql;
		if (!$conn->query($ins_sql)) {
			echo  $conn->errno;
			exit();
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}

// F = 51
function getPageStaticGraph()
{
	//sleep(5);
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	$data['data']['GraphResult'] = array();
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		 
		$sql="SELECT MAX(data_date) as data_date, sum(value) as value FROM `static_page` WHERE f_name = '$selected_data_type' And value <> 0 AND data_date > DATE_SUB(now(), INTERVAL 1 MONTH) Group by YEAR(data_date), MONTH(data_date), Day(data_date) Order By data_date";
		
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['GraphResult'][] = $row;
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}


// F = 52
function getPageAccessCount()
{
	//sleep(5);
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	$data['data']['AccessCount'] = array();
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		 
		//$sql="SELECT sub_name, ROUND(AVG(Value)) as cnt_P FROM static_page_detail WHERE main_name = 'page_impressions_by_city_unique' AND (data_date Between '2022-01-01' AND '2022-12-31') Group by sub_name Order By cnt_P DESC LIMIT 10";
		$sql = "SELECT sub_name, ROUND(AVG(Value)) as cnt_P FROM static_page_detail WHERE main_name = 'page_impressions_by_city_unique' AND (data_date Between MAKEDATE(year(now()),1) AND DATE(CONCAT(YEAR(CURDATE()),'-12-31'))) Group by sub_name Order By cnt_P DESC LIMIT 10";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['AccessCount'][] = $row;
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}


// F = 53
function getPageAgeGen()
{
	//sleep(5);
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	$data['data']['AgeCnt'] = array();
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		 
		$sql = "SELECT 
				  LEFT(sub_name, 1) AS Sex, 
				  RIGHT(
					sub_name, 
					LENGTH(sub_name)-2
				  ) as Age, 
				  ROUND(
					AVG(Value)
				  ) as cnt 
				FROM 
				  static_page_detail 
				WHERE 
				  main_name = 'page_impressions_by_age_gender_unique' 
				  AND (
					data_date Between MAKEDATE(
					  year(now()), 
					  1
					) 
					AND DATE(
					  CONCAT(
						YEAR(
						  CURDATE()
						), 
						'-12-31'
					  )
					)
				  ) 
				Group by 
				  sub_name 
				Order By 
				  sub_name, 
				  RIGHT(
					sub_name, 
					LENGTH(sub_name)-2
				  );
				";
		$tmp_data = array();
		//$tmp_data['หญิง'] = [];
		//$tmp_data['ชาย'] = [];
		//$tmp_data['ไม่ระบุ'] = [];
		$res = $conn->query(trim($sql));
		
		while ($row = $res->fetch_assoc()) {
			/*
			switch ($row['Sex']) {
				case "F": {
					$row['Sex'] = "หญิง";
					break;
				}
				case "M": {
					$row['Sex'] = "ชาย";
					break;
				}
				default : 
				{
					$row['Sex'] = "ไม่ระบุ";
				}
			}
			*/
			
			$tmp_data[$row['Age']][] = $row['cnt'];
			
		}
		$data['data']['AgeCnt'][] = $tmp_data;
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}


//getCaseStatic
// F = 54
function getCaseStatic()
{
	//sleep(5);
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
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

	

	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	$data['data']['caseSummary'] = array();
	$data['data']['caseCrpType'] = array();
	$data['data']['caseperProvince'] = array();
	$data['data']['caseMain'] = array();
	
	
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		 
		$sql="Select * From case_summary_report Where year = $selectYear Order By year, month";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$row['new_case'] = $row['new'];
			unset($row['new']);
			$row['month'] = $thai_month_arr_shot[$row['month']];
			
			$data['data']['caseSummary'][] = $row;
		}
		
		$sql="Select a.crp_id, a.crp_type ,sum(case when b.status = 5 then 1 else 0 end) as on_page ,sum(case when b.status = 4 then 1 else 0 end) as stop_case ,count(a.case_id) as count_case From case_crp_type_data a Inner Join wd_case b ON a.case_id = b.case_id WHERE YEAR(b.add_date) = $selectYear Group By a.crp_type, a.crp_id Order By a.crp_id";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$crp_type_name = $row['crp_type'];
			if ((substr($row['crp_id'], 2, 1) <> "0") and ($row['crp_id'] <> "99999")) {
				$crp_type_name = "   |- " . $crp_type_name;
			}

			if ((substr($row['crp_id'], 4, 1) <> "0") and $row['crp_id'] <> "99999") {
				$crp_type_name = "     ;" . $crp_type_name;
			}


			$row['crp_real_name'] = $crp_type_name;
			$row['pending'] = $row['count_case'] - ($row['on_page'] + $row['stop_case']);
			$data['data']['caseCrpType'][] = $row;
		}
		
		
		$sql = "SELECT TRIM(a.PROVINCE_NAME) as PROVINCE_NAME , IFNULL(b.CNT, '-') as cnt FROM add_provinces a LEFT JOIN ( Select d.PROVINCE_ID, d.PROVINCE_NAME, COUNT(d.PROVINCE_ID) AS CNT from wd_case a Inner Join case_ofd_info b ON a.case_id = b.case_id Inner Join add_amphures c ON b.ofd_address_code = c.AMPHUR_CODE Inner Join add_provinces d ON c.PROVINCE_ID = d.PROVINCE_ID Where YEAR(a.add_date) = $selectYear Group By d.PROVINCE_ID) b ON a.PROVINCE_ID = b.PROVINCE_ID order by cnt DESC, a.PROVINCE_NAME DESC;";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['caseperProvince'][] = $row;
		}
		
		// This year Income case
		//$sql = "Select count(*) as value From wd_case WHERE YEAR(add_date) = YEAR(CURDATE())";
		$sql = "Select IFNULL(count(*), 0) as value From wd_case WHERE YEAR(add_date) = $selectYear";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		$data['data']['caseMain']['this_year_income_case'] = $row['value'];

		// Pub case
		//$sql = "Select count(*) as value From wd_case WHERE YEAR(add_date) = YEAR(CURDATE()) AND status = 5";
		$sql = "Select IFNULL(count(*), 0) as value From wd_case WHERE YEAR(add_date) = $selectYear AND status = 5";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		$data['data']['caseMain']['this_year_pub_case'] = $row['value'];
		
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}


//getMemberStatic
// F = 55
function getMemberStatic()
{
	//sleep(5);
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	

	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	$data['data']['memberBySex'] = array();
	$data['data']['memberByGeo'] = array();
	$data['data']['memberByJob'] = array();
	
	
	
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		 
		$sql="Select b.occ_type, count(*) as value From wd_db a Inner Join m_occ_type b ON a.occ_type = b.id Where a.status = 1 Group By b.occ_type;";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			
			$data['data']['memberByJob'][] = $row;
		}
		
		$sql = "Select b.sex_desc, count(*) as value From wd_db a INNER Join m_sex b ON a.sex = b.sex_id Where a.status = 1 Group By b.sex_desc;";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			
			$data['data']['memberBySex'][] = $row;
		}
		
		$sql = "SELECT a.geo_name,
				   Coalesce(a.cnt_active, 0)  AS cnt_active,
				   Coalesce(b.cnt_idle, 0)    AS cnt_idle,
				   Coalesce(d.cnt_upper, 0)   AS cnt_upper,
				   Coalesce(c.cnt_other, 0)   AS cnt_other,
				   Coalesce(a.cnt_active, 0)
				   + Coalesce(b.cnt_idle, 0)
				   + Coalesce(d.cnt_upper, 0)
				   + Coalesce(c.cnt_other, 0) AS cnt_total
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
						  ON a.geo_name = d.geo_name;";
						  
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			
			$data['data']['memberByGeo'][] = $row;
		}
		
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}


// F = 56
function getMemberCrossUser()
{
	//sleep(5);
	$token_key = token_key();
	$token = "";
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	$data_Array = array();
	$data = array();
	// initial setting ---------------
	$data['success'] = "false";
	$data['reason_code'] = null;
	$data['data'] =array();
	$data['data']['staffkid'] = array();
	 if ($token_key == $token)
	 {
		 include "connectionDb.php";
		 
		$sql = "SELECT IFNULL(b.wd_ID, a.user_code) as kid FROM app_access_hash a 
				Left Join staff_member_map b ON a.user_code = b.key_ID
				Where a.hash_key = '$hash_key' and a.Active = 1";
		$res = $conn->query(trim($sql));
		while ($row = $res->fetch_assoc()) {
			$data['data']['staffkid'][] = $row;
		}
		// Close connection
		mysqli_close($conn);
		$data['success'] = "success";
		
	 }
	 $data_Array['RESULT'] = $data;
	 echo json_encode($data_Array, JSON_UNESCAPED_UNICODE );
}





//============================ MAIN =========================================================
switch ($f) {
	case 1: {
			check_qr_code();
			break;
		}
	case 2: {
			update_access_code();
			break;
		}
		
	case 3: {
			check_active_hash_key();
			break;
		}
	case 4: {
			Admin_dashboard_data();
			break;
		}
	case 5: {
			Admin_dashboard_data_WIPCASE_ALL();
			break;
		}
	case 6: {
			Member_dashboard_data();
			break;
		}
	case 7: {
			Update_consent_member();
			break;
		}
	case 8: {
			Update_Member_data();
			break;
		}
	
	case 9: {
			Update_CheckIn();
			break;
		}
	
	case 10: {
			getAddressInitial();
			break;
		}
		
	case 11: {
			getAddressProvinceChange();
			break;
		}
	case 12: {
			getAddressAumpherChange();
			break;
		}
	case 13: {
			getMemberSnd_case();
			break;
		}
	case 14: {
			searchCaseAdmin();
			break;
	}
	case 15: {
			updateMemberSkill();
			break;
	}
	case 16: {
			load_page_post();
			break;
	}
	case 17: {
			load_post_data();
			break;
	}
	case 18: {
			updatePagePostType();
			break;
	}
	// Chat Function ---------------------------
	case 19: {
			loadChatlist();
			break;
	}
	case 20: {
			loadChatDetail();
			break;
	}
	
	// Edit Case Function --------------------------------
	case 21: {
			loadCaseDetail();
			break;
	}
	case 22: {
			updateCaseCoreData();
			break;
	}
	
	case 23: {
			loadCrpypeForSelect();
			break;
	}
	
	case 24: {
			updateCrpType();
			break;
	}
	
	case 25: {
			deleteSingleItem();
			break;
	}
	case 26: {
			loadProvinceForSelect();
			break;
	}
	case 27: {
				loadOrgTypeForSelect();
				break;
		}
		
	case 28: {
				add_New_OFD();
				break;
		}
	case 29: {
				loadAumpherDataForSelect();
				break;
		}
	case 30: {
				addNewHashtag();
				break;
		}
	case 31: {
				addNewJobType();
				break;
		}
	
	case 32: {
				addNewOFDName();
				break;
		}
	case 33: {
				update_status();
				break;
		}
	case 34: {
				getPubPostSingel();
				break;
		}
	case 35: {
				pub_new_post();
				break;
	}
	case 36: {
				getCaseSender();
				break;
	}
	case 37: {
				addNewsender();
				break;
	}
	
	case 38: {
				loadWDActiveforSelect();
				break;
	}
	
	case 39: {
				addCommuStaff();
				break;
	}
	case 40: {
				updateCasegovCheck();
				break;
	}
	case 41: {
				addCasePubInfo();
				break;
	}
	case 42: {
				add_oth_pub();
				break;
	}
	case 43: {
				loadCaseMSGHeader();
				break;
	}
	case 44: {
				addCaseInboxMSG();
				break;
	}
	case 45: {
				loadCaseTimeline();
				break;
	}
	case 46: {
				addRelateLink();
				break;
	}
	case 47: {
				addNewCase();
				break;
	}
	case 48: {
				loadCaseGovCheck();
				break;
	}
	case 49: {
				loadMapStaffMember();
				break;
	}
	case 50: {
				insertPostFromMarket();
				break;
	}
	case 51: {
				getPageStaticGraph();
				break;
	}
	case 52: {
				getPageAccessCount();
				break;
	}
	case 53: {
				getPageAgeGen();
				break;
	}
	case 54: {
				getCaseStatic();
				break;
	}
	case 55: {
				getMemberStatic();
				break;
	}
	case 56: {
				getMemberCrossUser();
				break;
	}

}


?>