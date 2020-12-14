<?php

function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

	require_once 'conn.php';
	
	if(ISSET($_POST['save'])){
		$employee_id = $_POST['employee_id'];
			
			$file_name = generateRandomString()."_".$_FILES['file']['name'];
			$file_name = str_replace(' ', '_', $file_name);
			$file_name = str_replace(' ', '_', $file_name);
			$file_name = str_replace(';', '_', $file_name);
			$custom_name = $_POST['custom_name'];
			$file_type = $_FILES['file']['type'];
			$file_temp = $_FILES['file']['tmp_name'];
			$location = "../files/".$employee_id."/".$file_name;
			$date = date("Y-m-d H:i:s");
			if(!file_exists("../files/".$employee_id)){
				mkdir("../files/".$employee_id);
			}
		
			if(move_uploaded_file($file_temp, $location)){
				mysqli_query($conn, "INSERT INTO storage VALUES('', '$employee_id', '$file_name', '$custom_name', '$file_type', '$date')") or die(mysqli_error());
				header('location: ../my_files');
			}
	}
?>
