<?php


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



function update_follow_information()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}
	// Insert system_page_static
	include "connectionDb.php";


	$sql = "Insert Into system_page_static value ($v_like, $v_follow, CURRENT_TIMESTAMP())";
	include "connectionDb.php";
	if (!$conn->query($sql)) {
		exit();
	}

	// Delete From static_page_follow
	$sql = "Delete From static_page_follow Where time_stmp = CURRENT_DATE()";
	include "connectionDb.php";
	if (!$conn->query($sql)) {
		exit();
	}


	// Insert to static_page_follow
	$sql = "Insert Into static_page_follow Value ($v_follow, CURRENT_DATE())";
	include "connectionDb.php";
	if (!$conn->query($sql)) {
		exit();
	}
	mysqli_close($conn);
}

//============================ MAIN =========================================================
switch ($f) {
	case 1: {
			update_follow_information();
			break;
		}
}
