<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['update_password'])){
		$user_id = $_POST['user_id'];
		$password = hash('sha256', $_POST['password']);
		
		mysqli_query($conn, "UPDATE user SET password = '$password' WHERE user_id = '$user_id'") or die(mysqli_error());
		
		session_start();
	    unset($_SESSION['user']);
	    header("location: ../index.php");
	}
?>