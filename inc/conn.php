<?php
    
    $files_dir = "http://localhost/xfiles/files"; //Url to file

    $conn = mysqli_connect("host", "user", "password", "database"); // MySQL Connection
	
	if(!$conn){
		die("Error: Failed to connect to database!");
	}	
?>
