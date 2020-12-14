<?php
	require_once 'conn.php';
	
	
		$text = $_POST['message'];
        $date = date("Y-m-d H:i:s");
        
        $message = mysqli_real_escape_string($conn, $text);
				
		mysqli_query($conn, "UPDATE message SET system_message='$message', date='$date' WHERE id=1") or die(mysqli_error());
		
		header('location: ../message_system');
	
?>
