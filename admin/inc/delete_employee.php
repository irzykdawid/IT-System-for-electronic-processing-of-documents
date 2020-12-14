<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['employee_id'])){
		$employee_id = $_POST['employee_id'];
		$query = mysqli_query($conn, "SELECT * FROM employee WHERE employee_id = '$employee_id'") or die(mysqli_error());
		$fetch  = mysqli_fetch_array($query);
		
        mysqli_query($conn, "DELETE FROM share WHERE employee_id = '$employee_id'") or die(mysqli_error());
        mysqli_query($conn, "DELETE FROM storage WHERE employee_id = '$employee_id'") or die(mysqli_error());
        mysqli_query($conn, "DELETE FROM employee WHERE employee_id = '$employee_id'") or die(mysqli_error());
        
		if(file_exists("../../files/".$employee_id)){
			removeDir("../../files/".$employee_id);			
		}
	}
	
	function removeDir($dir) {
		$items = scandir($dir);
		foreach ($items as $item) {
			if ($item == '.' || $item == '..') {
				continue;
			}
			$path = $dir.'/'.$item;
			if (is_dir($path)) {
				xrmdir($path);
			} else {
				unlink($path);
			}
		}
		rmdir($dir);
	}
?>
