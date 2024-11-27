<?php
$server_name = "localhost";
$UID = "root";
$Pass = "caster";
$DB_name = "stock_taking";
$conn = new mysqli($server_name,$UID,$Pass,$DB_name);
$sql = "Select * from RM_Stock Where count_no between 1 and 100";
$res = $conn->query($sql);
mysqli_close($conn);
while ($row = $res->fetch_assoc()){
	echo $row['item_c'];
}
?>