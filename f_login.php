<?php
	function safe($value){
		//return mysql_real_escape_string($value);
		$value = str_replace("'", '', $value); //reject '
		$value = str_replace('"', '', $value); //reject "
		$value = str_replace(';', '', $value); //reject ;
		$value = str_replace('-', '', $value); //reject -
		$value = str_replace(' ', '', $value); //reject (space)
		return $value;
	} 
	// Get data from post and send to function safe for protect SQL Injection
    $username = safe($_POST['username']);
	$password = safe($_POST['password']);
	
	// Connect to MySQL Database
	include "connectionDb.php";
	
	// Get information about USER ID And Password
	$sql = "SELECT * FROM staff WHERE stf_ID = '$username' AND stf_pass = sha('$password') And active = 1";
	$res = $conn->query($sql);
	$row = $res->fetch_assoc();
	
	// Count Record
	$row_cnt = $res->num_rows;
	
	
	// Result only 1 row record can login.
	if ($row_cnt == 1)
	{
		// Create random history key
		$hiskey = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,64);
		$login_name =  $row['stf_ID'];
		
		// Get IP Address
		$ip = $_SERVER['REMOTE_ADDR'];
		
		// Disable all Current active key to
		$UpdateSQL = "UPDATE user_history SET active = 0 WHERE login_name = '$login_name' AND IP = '$ip';";
		if(!$conn->query($UpdateSQL))
		{
			echo '<Font color="red"><B>Error!!</B></Font><br>';
			exit();
		}

		// Create and Insert New Hiskey Statement
		//$SQL = "Insert Into user_history VALUES ('$login_name', '$ip', '$hiskey', current_timestamp, TIMESTAMP(DATE_SUB(NOW(), INTERVAL -1 hour)),1)";
		$SQL = "Insert Into user_history VALUES ('$login_name', '$ip', '$hiskey', current_timestamp, TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL -1 day)),1)";
		
		if(!$conn->query($SQL))
		{
			echo '<Font color="red"><B>Error!!</B></Font><br>';
			exit();
		}
		
		//$limit_time_1hour = time() + (60 * 60*12);
		date_default_timezone_set("Asia/Bangkok");
		//echo date("c",  strtotime('+1 day'))."<BR>";
		//echo date("d-m-Y",  strtotime('+1 day'))."<BR>";
		//echo date("d-m-Y",  strtotime(date("d-m-Y",  strtotime('+1 day'))))."<BR>";
		//echo date("U",  strtotime(date("d-m-Y",  strtotime('+1 day'))))."<BR>";
		//echo date("c",  strtotime(date("d-m-Y",  strtotime('+1 day'))))."<BR>";
		$limit_time =  date("U",  strtotime(date("d-m-Y",  strtotime('+1 day'))));
		//echo $limit_time_1hour;
		//$datetime = new DateTime('tomorrow');
		//echo $datetime;
		setcookie('wds_hiskey', $hiskey, $limit_time);
		echo "1";
	}
	else
	{
		echo '<font color="#FF4A4A"><B>ชื่อ หรือ รหัสผ่านไม่ถูกต้อง !!</B><font>';
	}
	
	//echo $row_cnt;
	mysqli_close($conn);
?>