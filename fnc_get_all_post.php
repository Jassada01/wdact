<?php
$main_url = "https://graph.facebook.com/v7.0/372488206116588/posts?access_token=EAAf1KjEvz6cBABA16h4ZCMWFrv1OjYchmwx0Fdc7PTZCW8Wvn18AcgDfjguQZB0ZBMwOQQUlcG6kYB6VjHZAZANHCuXKDlJY5AA7HEZC8ssjNbcW2CfeBXkad1B7XvefORJQ6y3F5mk2XzvdoFze5w9sgApAutwfXzbjFlr8JcItmyx2RET5PnZB&pretty=0&limit=100&before=Q2c4U1pXNTBYM0YxWlhKNVgzTjBiM0o1WDJsa0R5SXpOekkwT0RneU1EWXhNVFkxT0RnNk9UVXdOVGs1TkRReE5Ea3lOekF3TURNekR3eGhjR2xmYzNSdmNubGZAhV1FQSURNM01qUTRPREl3TmpFeE5qVTRPRjh4T0RjeU5Ea3pPVFE1TkRRNU16TXlEd1IwYVcxbEJscmlrQjBC";

$json = file_get_contents($main_url);
$obj = json_decode($json);
$data_a = $obj->data;
$paging = $obj->paging;



include "connectionDb.php";
# Delete Current Data
$sql = "delete From system_page_all_pub";
if(!$conn->query($sql))
	{
		exit();
	}

while (array_key_exists('next', $paging))
{
	for ($i = 0 ; $i < count($data_a ) ; $i++)
	{
		if (array_key_exists('message', $data_a[$i]))
		{
			$id = $data_a[$i]->id;
			$msg = $data_a[$i]->message;
			$msg = str_replace("'", " ", $msg);
			$msg = str_replace("--", " ", $msg);
			$id = substr($id, strpos($id, "_") + 1);
			$created_time = $data_a[$i]->created_time;
			$arr = explode("+", $created_time, 2);
			$crt = $arr[0];
			$sql = "Insert Into system_page_all_pub value ('$id', '$msg ', '$crt')";
			echo $sql;
			if(!$conn->query($sql))
			{
				exit();
			}
		}	
	}
	
	$json = file_get_contents($paging->next);
	$obj = json_decode($json);
	$data_a = $obj->data;
	$paging = $obj->paging;
	
}

echo "DONE!!!";
mysqli_close($conn);
?>
