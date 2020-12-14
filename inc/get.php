<?php
	require_once 'conn.php';

    error_reporting(0);
		
    if(ISSET($_GET['token']) and $_GET['token']!="")   {

        $get_token = $_GET['token'];       
        
        $query = mysqli_query($conn, "SELECT s.filename, s.employee_id, s.store_id, sh.token FROM storage s JOIN share sh ON s.store_id=sh.store_id WHERE sh.token = '$get_token'") or die(mysqli_error());
		$fetch  = mysqli_fetch_array($query);

        $filename = $fetch['filename'];
		$employee_id = $fetch['employee_id'];
        $token = $fetch['token'];
        
        if($token==$get_token) {
            header("Content-Disposition: attachment; filename=".substr($filename, 11));
            header("Content-Type: application/octet-stream;");
            readfile("https://xfiles.pl/files/".$employee_id."/".$filename);
        }
        
        else {
            echo "<b>The token for file does not exist</b>";
            header( "refresh:2;url=https://xfiles.pl" );
        }        
    }

    else {    
        echo "Bad request";
    }
?>
