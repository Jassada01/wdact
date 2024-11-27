<?php
	$key = $_COOKIE['wds_hiskey'];
	// Get IP Address
	$ip = $_SERVER['REMOTE_ADDR'];
	
	//Create SQL 
	$sql = "select * FROM user_history WHERE IP = '$ip' AND his_key = '$key' AND NOW() < expire_tmp AND active = 1";
	include "connectionDb.php";
	//echo $sql;
	$res = $conn->query($sql);
	$row = $res->fetch_assoc();
	$row_cnt = $res->num_rows;
	//exit();
	if ($row_cnt != 1 )
	{
		unset($_COOKIE['wds_hiskey']);
		setcookie('wds_hiskey', '', time() - 3600); // empty value and old timestamp
		header("location:login.php");
	}
	else
	{
		$limit_time_1hour = time() + (60 * 60 * 24);
		$stf_ID = $row['login_name'];
		$sql = "SELECT a.name, a.admin_level, b.Position, a.key_ID, c.img  From staff a INNER JOIN staff_detail b ON a.key_ID = b.key_ID INNER JOIN staff_img c ON a.key_ID = c.key_ID WHERE a.stf_ID = '$stf_ID' AND a.active = 1 ";
		$res = $conn->query($sql);
		$row = $res->fetch_assoc();
		$user_name = $row['name'];
		$user_image = 'img/wd_img/'.$row['img'];
		$user_level = $row['admin_level'];
		$Position = $row['Position'];
		$staff_key_id = $row['key_ID'];
		setcookie('wds_hiskey', $key, $limit_time_1hour);
		
		// get menu style
		$sql = "SELECT menu_collapse FROM staff_config WHERE key_id = $staff_key_id";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		$row = $res->fetch_assoc();
		$menu_collapse_text = "";
		if ($row['menu_collapse'] == 1)
		{
			$menu_collapse_text = "sidebar-collapse";
		}
	}
	
	mysqli_close($conn);
?>