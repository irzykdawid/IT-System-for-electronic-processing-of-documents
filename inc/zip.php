<title>Download BACKUP XFILES</title>
<?php
session_start();  
error_reporting(0);

function is_dir_empty($dir)
{
    if (!is_readable($dir))
        return NULL;
    return (count(scandir($dir)) == 2);
}

	require_once 'conn.php';
    
    $query = mysqli_query($conn, "SELECT * FROM storage WHERE employee_id = '$_SESSION[employee]'") or die(mysqli_error());
    
    if (mysqli_num_rows($query) > 0) {
        
        $fetch = mysqli_fetch_array($query);
        $employee_id = $fetch['employee_id'];
        
        $dir = "../files/".$employee_id."/backup/";
        
        $pathdir = "../files/".$employee_id."/";
        
        if (!is_dir_empty($pathdir)) {
            
            if (!is_dir($dir)) {
                mkdir("../files/".$employee_id."/backup/", 0705);
            }
			
			$get_name = mysqli_query($conn, "SELECT LOWER(CONCAT(e.firstname,e.lastname)) as name FROM storage s JOIN employee e ON e.employee_id=s.employee_id WHERE e.employee_id = '$employee_id'") or die(mysqli_error());
			$get_name_value = mysqli_fetch_array($get_name);
            
            $zipcreated = "../files/".$employee_id."/backup/"."XFILES_BACKUP_".$get_name_value['name'].".zip";
            
            $zip = new ZipArchive;
            
            if ($zip->open($zipcreated, ZipArchive::CREATE) == TRUE) {
                
                $dir = opendir($pathdir);
                
                while ($file = readdir($dir)) {
                    if (is_file($pathdir . $file)) {
                        $zip->addFile($pathdir . $file, $file);
                    }
                }
                $zip->close();
            }
			
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='."XFILES_BACKUP_".$get_name_value['name'].".zip");
			header('Content-Transfer-Encoding: binary');
			
			readfile($zipcreated);
			
			if(file_exists($zipcreated)){
				unlink($zipcreated);
				rmdir("../files/".$employee_id."/backup");
			}
			
        } else
            echo "<b>You have no files in your directory.</b>";
			header("Refresh:2; url=../employee_profile");
    }
	else 
		echo "<b>You have no files in your directory.</b>";
		header("Refresh:2; url=../employee_profile");


?>