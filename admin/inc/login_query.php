<?php
	session_start();
	require 'conn.php';
	
	if(ISSET($_POST['login'])){
		$username = $_POST['username'];
		$password = hash('sha256', $_POST['password']);
		
		$query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' && password = '$password'") or die(mysqli_error());
		$fetch = mysqli_fetch_array($query);
		$row = $query->num_rows;
		
		if($row > 0) {
			$_SESSION['user'] = $fetch['user_id'];
			$_SESSION['status'] = $fetch['status'];
			header("location: home");
		}
        else {
			echo "<div class='text-center'><label class='text-danger'>Invalid username or password</label></div>";
		}
	}
?>
