<?php
	session_start();
	require 'conn.php';
	
	if(ISSET($_POST['login'])){
		$employee_no = $_POST['employee_no'];
		$password = hash('sha256', $_POST['password']);
		
		$query = mysqli_query($conn, "SELECT * FROM employee WHERE employee_no = '$employee_no' && password = '$password'") or die(mysqli_error());
		$fetch = mysqli_fetch_array($query);
		$row = $query->num_rows;
		
		if($row > 0){
			$_SESSION['employee'] = $fetch['employee_id'];
			header("location:employee_profile");
		}else{
			echo "<div class='text-center'><label class='text-danger'>Invalid username or password</label></div>";
		}
	}
?>
