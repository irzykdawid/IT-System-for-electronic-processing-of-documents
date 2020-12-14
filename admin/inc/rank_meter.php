<?php

$word = mysqli_query($conn, "SELECT COUNT(*) as value FROM storage st WHERE st.filename Like '%docx%' OR '%doc%'") or die(mysqli_error());
$word_value = mysqli_fetch_array($word);
            
$excel = mysqli_query($conn, "SELECT COUNT(*) as value FROM storage st WHERE st.filename Like '%xls%' OR '%xlsx%' OR '%xlsm%'") or die(mysqli_error());
$excel_value = mysqli_fetch_array($excel);
            
$pp = mysqli_query($conn, "SELECT COUNT(*) as value FROM storage st WHERE st.filename Like '%ppt%' OR '%pptx%'") or die(mysqli_error());
$pp_value = mysqli_fetch_array($pp);
            
$jpg = mysqli_query($conn, "SELECT COUNT(*) as value FROM storage st WHERE st.filename Like '%jpg%' OR '%jpeg%' OR '%JPG%' OR '%JPEG%'") or die(mysqli_error());
$jpg_value = mysqli_fetch_array($jpg);
            
$zip = mysqli_query($conn, "SELECT COUNT(*) as value FROM storage st WHERE st.filename Like '%zip%'") or die(mysqli_error());
$zip_value = mysqli_fetch_array($zip);
            
$png = mysqli_query($conn, "SELECT COUNT(*) as value FROM storage st WHERE st.filename Like '%png%' OR '%PNG%'") or die(mysqli_error());
$png_value = mysqli_fetch_array($png);

$txt = mysqli_query($conn, "SELECT COUNT(*) as value FROM storage st WHERE st.filename Like '%txt%'") or die(mysqli_error());
$txt_value = mysqli_fetch_array($txt);

$pdf = mysqli_query($conn, "SELECT COUNT(*) as value FROM storage st WHERE st.filename Like '%pdf%' OR '%pdfa%'") or die(mysqli_error());
$pdf_value = mysqli_fetch_array($pdf);
            
$users = mysqli_query($conn, "SELECT COUNT(*) as value FROM employee") or die(mysqli_error());
$users_value = mysqli_fetch_array($users);

$files = mysqli_query($conn, "SELECT COUNT(*) as value FROM storage") or die(mysqli_error());
$files_value = mysqli_fetch_array($files);

$share = mysqli_query($conn, "SELECT COUNT(*) as value FROM share") or die(mysqli_error());
$share_value = mysqli_fetch_array($share);

?>
