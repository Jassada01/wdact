<?php
$server_name = "localhost";
$UID = "root";
$Pass = "caster@2017";
$DB_name = "wds";
$conn = new mysqli($server_name,$UID,$Pass,$DB_name);

// Setting for support Thai
mysqli_set_charset($conn, "utf8");

if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
	}
?>