<!DOCTYPE html>
<?php 
	require 'inc/validator.php';
	require_once 'inc/conn.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Employee's cockpit | XFILESControl Cloud</title>
    <meta name="description" content="IT System for electronic processing of documents. - Dawid Irzyk">
    <link rel="stylesheet" href="admin/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="admin/css/all.min.css">
    <link rel="stylesheet" href="admin/css/style_inner.css">
    <script src="admin/js/all.min.js"></script>
    <script src="admin/js/Chart.min.js"></script>
    <link rel="apple-touch-icon" sizes="57x57" href="admin/images/icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="admin/images/icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="admin/images/icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="admin/images/icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="admin/images/icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="admin/images/icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="admin/images/icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="admin/images/icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="admin/images/icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="admin/images/icon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="admin/images/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="admin/images/icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="admin/images/icon/favicon-16x16.png">
    <link rel="manifest" href="admin/images/icon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="admin/images/icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>

<body>

    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <a href="employee_profile"><img src="admin/images/logo_w.svg" alt="XFILES Control Panel"></a>
            </div>

            <ul class="list-unstyled components">
                <?php include("inc/menu.php");?>
            </ul>
        </nav>

        <div id="content">
            <?php
			$query = mysqli_query($conn, "SELECT * FROM employee WHERE employee_id = '$_SESSION[employee]'") or die(mysqli_error());
			$fetch = mysqli_fetch_array($query);
            
            $message = mysqli_query($conn, "SELECT * FROM message") or die(mysqli_error());
            $message_value = mysqli_fetch_array($message);
            
            include("inc/rank_meter.php");
		?>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button class="btn btn-blue d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <p class="mini-title-page">User's cockpit</p>
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link"><i class="normal">Hi</i>, <?php echo $fetch['firstname']." ".$fetch['lastname']." (".$fetch['employee_no'].")"?></a>
                                <div class="pull-right ">
                                    <a href="logout" class="settings">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div id="inner">
                <div class="row">
                    <div class="col-md-3">
                        <h2>User's cockpit</h2>
                    </div>
                    <div class="col-md-9">
                        <?php
                            
                            if(!empty($message_value['system_message'])) {
                                
                                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>";
                                echo "<strong>".$message_value['system_message']."</strong><br /></b>(".$message_value['date'].")";
                                echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                                echo "<span aria-hidden='true'>&times;</span>";
                                echo "</button>";
                                echo "</div>";
                                
                            }
                            
                            ?>
                    </div>
                </div>
                <div class="grid-columns">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="item_box w-100">
                                <div class="row">

                                    <div class="col-12 pl-5">
                                        <canvas id="ranking" style="position: relative; height:80vh; width:100vw"></canvas>
                                        <script>
                                            new Chart(document.getElementById("ranking"), {
                                                type: 'line',
                                                data: {
                                                    labels: ["WORD", "EXCEL", "POWER POINT", "JPG", "PNG", "ZIP", "TXT", "PDF"],
                                                    datasets: [{
                                                        label: "Ranking of the most popular files",
                                                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850", "#283185", "#483185", "#883185"],
                                                        data: [<?php echo $word_value['value']?>, <?php echo $excel_value['value']?>, <?php echo $pp_value['value']?>, <?php echo $jpg_value['value']?>, <?php echo $png_value['value']?>, <?php echo $zip_value['value']?>, <?php echo $txt_value['value']?>, <?php echo $pdf_value['value']?>]
                                                    }]
                                                },

                                            });

                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="item_box w-100">
                                <div class="row">

                                    <div class="col-12 pl-5">
                                        <canvas id="pliki" style="position: relative; height:80vh; width:100vw"></canvas>
                                        <script>
                                            new Chart(document.getElementById("pliki"), {
                                                type: 'pie',
                                                data: {
                                                    labels: ["Added", "Shared"],
                                                    datasets: [{
                                                        label: "Count",
                                                        backgroundColor: ["#358507", "#283185"],
                                                        data: [<?php echo $upload_result_value['upload_value']?>, <?php echo $share_result_value['share_value']; ?>]
                                                    }]
                                                },

                                            });

                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="item_box w-100">
                                <div class="row">
                                    <div class="col-3 border-r">
                                        <p class="icon"><i class="far fa-file-alt icon"></i></p>
                                    </div>
                                    <div class="col-9 pl-5">
                                        <h2 class="box">My files</h2>
                                        <ul class="list-unstyled">
                                            <li><a href="my_files"><b>File List</b></li>
                                            <li><a href="my_share_files"><b>Shared files</b></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="item_box w-100">
                                <div class="row">
                                    <div class="col-3 border-r">
                                        <p class="icon"><i class="far fa-user icon"></i></p>
                                    </div>
                                    <div class="col-9 pl-5">
                                        <h2 class="box">My profile</h2>
                                        <ul class="list-unstyled">
                                            <li><a href="edit_profile"><b>Edit profile</b></li>
                                            <li><a href="change_password"><b>Reset password</b></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item_box w-100">
                    <div class="row pl-3">
                        <p><b class="grey">System Information:</b></p>
                        <p class="pl-3 green">All system components are functioning properly.</p>
                    </div>
                    <div class="row">
                        <p class="pl-3" style="font-size: 14px;"><?php echo php_uname(); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('inc/script.php'); ?>

</body>

</html>
