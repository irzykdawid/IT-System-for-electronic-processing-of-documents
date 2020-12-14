<?php
	require_once 'conn.php';

	if(ISSET($_REQUEST['store_id'])){
		$store_id = $_REQUEST['store_id'];		
		$query = mysqli_query($conn, "SELECT * FROM storage WHERE store_id = '$store_id'") or die(mysqli_error());
		$fetch  = mysqli_fetch_array($query);
        $employee_id = $_GET['employee_id'];
		$filename = $fetch['filename'];
        
		header("Content-Disposition: attachment; filename=".substr($filename, 11));
		header("Content-Type: application/octet-stream;");
		readfile("../../files/".$employee_id."/".$filename);
	}
?>