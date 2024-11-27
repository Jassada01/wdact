<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include('dist/js/phpqrcode/qrlib.php');


require 'dist/js/PHPMailer/Exception.php';
require 'dist/js/PHPMailer/PHPMailer.php';
require 'dist/js/PHPMailer/SMTP.php';




// Support Function ======================================
function gen_rnd_num($length = 5) {
	$characters = '0123456789';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

// Load paramitor =========================================
foreach ($_POST as $key => $value) {
    $a = htmlspecialchars($key);
    $$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
}
	
//QRcode::png('PHP QR Code :)');

// Generate QR Code=================================================================
$codeContents = 'https://www.wdact.co/WD_system/user_profile.php?token='.$token;
$date   = new DateTime(); //this returns the current date time
$result = $date->format('Y-m-d-H-i-s');
// we need to generate filename somehow, 
// with md5 or with database ID used to obtains $codeContents...
$fileName = 'img/temp_qr_code/'.md5($result.$codeContents).'.png';
$pngAbsoluteFilePath = $fileName;
QRcode::png($codeContents, $pngAbsoluteFilePath, QR_ECLEVEL_H);

// Generate New Password =======================================================
include "connectionDb.php";
$rnd_num = gen_rnd_num();
$sql = "Update wd_access_password SET pwd = '$rnd_num', temp_flg = 'Y' Where wd_id = '$wd_id'";
$conn->query(trim($sql));
mysqli_close($conn);
		


// Start Mail =================================================================
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->SMTPDebug = 0;                      //Disable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'act.wdsystem@gmail.com';                     //SMTP username
    $mail->Password   = 'zNV3,9_NZ[$qG#Le';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
	$mail->CharSet = "utf-8";



    //Recipients
    $mail->setFrom('act.wdsystem@gmail.com', 'หมาหมายเลขศูนย์');
    $mail->addAddress($target_email);     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment($fileName);         //Add attachments
	$mail->AddEmbeddedImage($fileName, 'QR_LOGO');

    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'แจ้งการ Reset รหัสเข้าสู่ระบบ';
    $mail->Body    = 'แจ้งการ Reset รหัสเข้าสู่ระบบ<BR>
	1. สแกน QR Code หรือ กดที่ลิ้ง <BR>
		<a href="'.$codeContents.'">'.$codeContents.'</a>
		<BR><img src="cid:QR_LOGO">
		<BR> รหัสชั่วคราว : <font color="red"><B>'.$rnd_num.'</B></font>';
    $mail->AltBody = 'แจ้งการ Reset รหัสเข้าสู่ระบบ';

    $mail->send();
    echo 'OK';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
