<?php 
$return["error"] = false;
$return["msg"] = "";
//array to return

function gen_rnd_str($length = 10)
{
	$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}


$token = $_POST["token"];
if ($token == "baFTc8tVBYMNXvATYRNuXFsUkNVqkLu7EwkySL4MRFuhWP47X5kqnbSeqNmAJa6Q")
{
		if(isset($_POST["filUpload"])){
		$base64_string = $_POST["filUpload"];
		//$outputfile = "uploads/image.jpg" ;
		$file_name = gen_rnd_str().".png";
		$outputfile = "img/wd_img/".$file_name; // or image.jpg
		//save as image.jpg in uploads/ folder

		$filehandler = fopen($outputfile, 'wb' ); 
		//file open with "w" mode treat as text file
		//file open with "wb" mode treat as binary file
		
		fwrite($filehandler, base64_decode($base64_string));
		// we could add validation here with ensuring count($data)>1
		//$return["msg"]  = $api_server_token;
		$return["msg"]  = $file_name;
		// clean up the file resource
		fclose($filehandler); 
	}else{
		$return["error"] = true;
		$return["msg"] =  "No image is submited.";
}

}else{
    $return["error"] = true;
    $return["msg"] =  "Token Incorrect!!!!";
}

header('Content-Type: application/json');
// tell browser that its a json data
echo json_encode($return);
//converting array to JSON string