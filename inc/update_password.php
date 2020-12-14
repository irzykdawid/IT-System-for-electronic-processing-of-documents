<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['update_password'])){
		$employee_id = $_POST['employee_id'];
        $password = hash('sha256', $_POST['password']);
                	
		mysqli_query($conn, "UPDATE employee SET password='$password' WHERE employee_id = '$employee_id'") or die(mysqli_error());
		
        session_start();
	    unset($_SESSION['employee']);
	    header("location: ../index");
	}
?>