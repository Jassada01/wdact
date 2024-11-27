<?php
	ob_start();
	include "f_check_cookie.php";
	ob_end_clean();
	$file_name = $_POST['file_name'];
	$todir = 'img/wd_img/';
	$baseFromJavascript = $_POST['filUpload'];
	// We need to remove the "data:image/png;base64,"
	$base_to_php = explode(',', $baseFromJavascript);
	// the 2nd item in the base_to_php array contains the content of the image
	$data = base64_decode($base_to_php[1]);
	// here you can detect if type is png or jpg if you want
	$filepath = "img/wd_img/".$file_name; // or image.jpg

	// Save the image in a defined path
	file_put_contents($filepath,$data);
?>