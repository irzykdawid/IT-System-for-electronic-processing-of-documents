<?php
	require 'validator.php';
	require_once 'conn.php';
	
	if(ISSET($_REQUEST['store_id'])){
		$store_id = $_REQUEST['store_id'];
		
		$query = mysqli_query($conn, "SELECT * FROM `storage` WHERE `store_id` = '$store_id'") or die(mysqli_error());
		$fetch  = mysqli_fetch_array($query);
		$filename = $fetch['filename'];
		$employee_id = $fetch['employee_id'];
        
		header("Content-Disposition: attachment; filename=".substr($filename, 11));
		header("Content-Type: application/octet-stream;");
		readfile("../files/".$employee_id."/".$filename);
	}
?>