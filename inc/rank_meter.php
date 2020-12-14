<?php

$upload_result = mysqli_query($conn, "SELECT COUNT(*) as upload_value FROM storage WHERE employee_id = '$_SESSION[employee]'") or die(mysqli_error());
$upload_result_value = mysqli_fetch_array($upload_result);

$share_result = mysqli_query($conn, "SELECT COUNT(*) as share_value FROM share WHERE employee_id = '$_SESSION[employee]'") or die(mysqli_error());
$share_result_value = mysqli_fetch_array($share_result);
            
$word = mysqli_query($conn, "SELECT COUNT(*) as value FROM storage st WHERE (st.filename Like '%docx%' OR '%doc%') AND employee_id = '$_SESSION[employee]'") or die(mysqli_error());
$word_value = mysqli_fetch_array($word);
            
$excel = mysqli_query($conn, "SELECT COUNT(*) as value FROM storage st WHERE (st.filename Like '%xls%' OR '%xlsx%' OR '%xlsm%') AND employee_id = '$_SESSION[employee]'") or die(mysqli_error());
$excel_value = mysqli_fetch_array($excel);
            
$pp = mysqli_query($conn, "SELECT COUNT(*) as value FROM storage st WHERE (st.filename Like '%ppt%' OR '%pptx%') AND employee_id = '$_SESSION[employee]'") or die(mysqli_error());
$pp_value = mysqli_fetch_array($pp);
            
$jpg = mysqli_query($conn, "SELECT COUNT(*) as value FROM storage st WHERE (st.filename Like '%jpg%' OR '%jpeg%' OR '%JPG%' OR '%JPEG%') AND employee_id = '$_SESSION[employee]'") or die(mysqli_error());
$jpg_value = mysqli_fetch_array($jpg);
            
$zip = mysqli_query($conn, "SELECT COUNT(*) as value FROM storage st WHERE (st.filename Like '%zip%') AND employee_id = '$_SESSION[employee]'") or die(mysqli_error());
$zip_value = mysqli_fetch_array($zip);
            
$png = mysqli_query($conn, "SELECT COUNT(*) as value FROM storage st WHERE (st.filename Like '%png%' OR '%PNG%') AND employee_id = '$_SESSION[employee]'") or die(mysqli_error());
$png_value = mysqli_fetch_array($png);

$txt = mysqli_query($conn, "SELECT COUNT(*) as value FROM storage st WHERE (st.filename Like '%txt%') AND employee_id = '$_SESSION[employee]'") or die(mysqli_error());
$txt_value = mysqli_fetch_array($txt);

$pdf = mysqli_query($conn, "SELECT COUNT(*) as value FROM storage st WHERE (st.filename Like '%pdf%' OR '%pdfa%') AND employee_id = '$_SESSION[employee]'") or die(mysqli_error());
$pdf_value = mysqli_fetch_array($pdf);

?>
