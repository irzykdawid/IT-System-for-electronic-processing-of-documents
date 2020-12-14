<?php 
	require 'validator.php';
	require_once 'conn.php'
?>

<?php 
    error_reporting(0);    
    require_once('phpmailer/class.phpmailer.php');
    require_once('phpmailer/class.smtp.php');

    function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
        }

        return $key;
    }

    $log = mysqli_query($conn, "SELECT * FROM employee WHERE employee_id = '$_SESSION[employee]'") or die(mysqli_error());
    $log_value = mysqli_fetch_array($log);

    $share_email = $_POST['share_email'];

    $mail = new PHPMailer();
    $mail->CharSet = "UTF-8";
    $mail->From = "[email nadawcy]";
    $mail->AddReplyTo('[email nadawcy]', '[email nadawcy]');
    $mail->Host = "[host]";
    $mail->Mailer = "smtp";
    $mail->SMTPAuth = true;
    $mail->Username = "[adres email]";
    $mail->Password = "[hasło]";
    $mail->Port = 587; // port do serwera SMTP domyślnie to 587
    $mail->IsHTML(true); 
    
    $store_id = $_GET['store_id'];
    $employee_id = $log_value['employee_id'];
    $token = random_string(32);
    
    //$check = mysqli_query($conn, "SELECT * FROM share s JOIN storage st ON s.store_id=st.store_id WHERE s.stud_id='$stud_id' AND st.store_id='$store_id'") or die(mysqli_error());

    $share = mysqli_query($conn, "SELECT * FROM share WHERE store_id='$store_id' AND employee_id='$employee_id'") or die(mysqli_error());       
    
         if(ISSET($_POST['share_email']) and $_POST['share_email']!="")   {

            if(mysqli_num_rows($share) > 0) {            
                            
            //jeżeli istnieje wypisz token
                
            $share_value = mysqli_fetch_array($share);
            $token_exist = $share_value['token'];
                                    
            $name = mysqli_query($conn, "SELECT CONCAT(s.firstname, \" \", s.lastname) as name FROM employee s JOIN share sh ON sh.employee_id=s.employee_id WHERE sh.store_id='$store_id' AND sh.employee_id='$employee_id'") or die(mysqli_error());
            $name_value = mysqli_fetch_array($name);
                
            $mail->FromName = $name_value['name'];
            $mail->Subject = "XFILES | Udostępniono plik od: ".$name_value['name'];
            $mail->Body = "<br><img src='http://klient.codetype.pl/logo_xfiles.png'><br><br><b><h4>Plik od użytkownika: ".$name_value['name']."</h4></b><br>"."<a href='https://xfiles.pl/inc/get.php?token=$token_exist'>"."Kliknij, aby pobrać plik"."</a><br><br><em>Data wysłania maila: ".date("Y-m-d H:i:s")."</em><br><br><p style='font-size: 12px;'>Wiadomość generowana automatycznie.<br>Prosimy na nią nie odpowiadać.</p>";
            $mail->AddAddress ($share_email,$name_value['name']);
            
            if($mail->Send()) {                      
                echo 'E-mail został wysłany';
            }            
        
            else {         
                echo 'E-mail nie mógł zostać wysłany';
            }
   
        } 

        else {
        
            //jeżeli wpis nie istnieje        
        
            mysqli_query($conn, "INSERT INTO share(share_id, employee_id, store_id, token) VALUES ('','$employee_id', '$store_id', '$token')") or die(mysqli_error());
            $share = mysqli_query($conn, "SELECT * FROM share WHERE store_id='$store_id' AND employee_id='$employee_id'") or die(mysqli_error());
            $share_value = mysqli_fetch_array($share);
        
            $token_exist = $share_value['token'];
                                    
            $name = mysqli_query($conn, "SELECT CONCAT(s.firstname, \" \", s.lastname) as name FROM employee s JOIN share sh ON sh.employee_id=s.employee_id WHERE sh.store_id='$store_id' AND sh.employee_id='$employee_id'") or die(mysqli_error());
            $name_value = mysqli_fetch_array($name);
                
            $mail->FromName = $name_value['name'];
            $mail->Subject = "XFILES | Udostępniono plik od: ".$name_value['name'];
            $mail->Body = "<br><img src='http://klient.codetype.pl/logo_xfiles.png'><br><br><b><h4>Plik od użytkownika: ".$name_value['name']."</h4></b><br>"."<a href='https://xfiles.pl/inc/get.php?token=$token_exist'>"."Kliknij, aby pobrać plik"."</a><br><br><em>Data wysłania maila: ".date("Y-m-d H:i:s")."</em><br><br><p style='font-size: 12px;'>Wiadomość generowana automatycznie.<br>Prosimy na nią nie odpowiadać.</p>";
            $mail->AddAddress ($share_email,$name_value['name']);         
                
            if($mail->Send()) {                      
                echo 'E-mail został wysłany';
            }            
        
            else {         
                echo 'E-mail nie mógł zostać wysłany';
            }         
        
        }        
    }

    else {
        echo "Bad request";
    }
    

?>
