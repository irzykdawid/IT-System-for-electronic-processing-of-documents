<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['save'])){
		
		$employee_no = $_POST['employee_no'];
		$email = $_POST['email'];
		
		$query = mysqli_query($conn, "SELECT * FROM employee WHERE employee_no = '$employee_no' OR email = '$email'") or die(mysqli_error());
		
		if (mysqli_num_rows($query) > 0) {
			echo "<b>A user with this number or email exists in the system. Try again.</b><br>Automatic refresh in 5 seconds.";
			header("Refresh:5; ../accounts_system");
		}
		else {
			
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$gender = $_POST['gender'];			
			$password = hash('sha256', $_POST['password']);
		
			mysqli_query($conn, "INSERT INTO employee VALUES('', '$employee_no', '$firstname', '$lastname', '$gender', '$email', '$password')") or die(mysqli_error());
		
			header('location: ../accounts_system');
		}
	}
?>