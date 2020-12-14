<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['store_id'])){
		$store_id = $_POST['store_id'];
		$query = mysqli_query($conn, "SELECT * FROM share WHERE `store_id` = '$store_id'") or die(mysqli_error());
		$fetch  = mysqli_fetch_array($query);
		$filename = $fetch['filename'];
		$employee_id = $fetch['employee']; // sprawdzić
        
        mysqli_query($conn, "DELETE FROM `share` WHERE `store_id` = '$store_id'") or die(mysqli_error());
		
	}
?>
