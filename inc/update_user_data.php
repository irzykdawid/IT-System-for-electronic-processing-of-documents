<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['edit'])){
		$employee_id = $_POST['employee_id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$username = $_POST['username'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
		
		mysqli_query($conn, "UPDATE `employee` SET `firstname`='$firstname',`lastname`='$lastname',`gender`='$gender',`email`='$email' WHERE employee_id = '$employee_id'") or die(mysqli_error());
		
		header('location:../my_profile');
	}
?>