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
    <title>Admin cockpit | XFILESControl Cloud</title>
    <meta name="description" content="IT System for electronic processing of documents. - Dawid Irzyk">
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style_inner.css">
    <script src="js/all.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <link rel="stylesheet" href="css/datatables.min.css">
    <link rel="apple-touch-icon" sizes="57x57" href="images/icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="images/icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="images/icon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="images/icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/icon/favicon-16x16.png">
    <link rel="manifest" href="images/icon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="images/icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>

<body>

    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <a href="home"><img src="images/logo_w.svg" alt="XFILES Control Panel"></a>
                <a style="text-align: left!important;"><b>ADMIN PANEL</b></a>
            </div>

            <ul class="list-unstyled components">
                <?php include("inc/menu.php");?>
            </ul>
        </nav>

        <div id="content">
            <?php            
            include("inc/rank_meter.php");
		    ?>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button class="btn btn-blue d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <p class="mini-title-page">Admin Panel</p>
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link"><i class="normal">Hi</i>, Admin</a>
                                <div class="pull-right ">
                                    <a href="logout" class="settings">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div id="inner">

                <h2>Admin cockpit</h2>

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
                            <div class="item_box w-100 ">
                                <div class="row">
                                    <h5 class="pl-3 pb-3"><b class="grey">System Information</b></h5>
                                </div>
                                <div class="row">
                                    <p class="pl-3"><b>Registered employees:</b> <?php echo $users_value['value']?></p>
                                </div>
                                <div class="row">
                                    <p class="pl-3"><b>Transferred files:</b> <?php echo $files_value['value']?></p>
                                </div>
                                <div class="row">
                                    <p class="pl-3"><b>Shared files:</b> <?php echo $share_value['value']?></p>
                                    </p>
                                </div>

                                <div class="row">
                                    <h5 class="pl-3 pt-3"><b class="grey">Configuration information</b></h5>
                                </div>

                                <div class="row">
                                    <p class="pl-3">Website: <?php echo $_SERVER['SERVER_NAME']."<br>Server: ".$_SERVER['SERVER_SOFTWARE']."<br> Maximum size of sent file: ".(int)(ini_get('upload_max_filesize'))." MB<br>"." Server memory limit: ".(int)(ini_get('memory_limit'))." MB"; ?> </p>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="item_box w-100">
                                <div class="row">
                                    <div class="col-3 border-r">
                                        <p class="icon"><i class="far fa-file-alt icon"></i></p>
                                    </div>
                                    <div class="col-9 pl-5">
                                        <h2 class="box">Files on the system</h2>
                                        <ul class="list-unstyled">
                                            <li><a href="files_system"><b>File List</b></li>
                                            <li><a href="shared_system"><b>Shared Files</b></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="item_box w-100">
                                <div class="row">
                                    <div class="col-3 border-r">
                                        <p class="icon"><i class="far fa-user icon"></i></p>
                                    </div>
                                    <div class="col-9 pl-5">
                                        <h2 class="box">Accounts</h2>
                                        <ul class="list-unstyled">
                                            <li><a data-toggle="modal" data-target="#form_modal" style="cursor: pointer;" role="button"><b>Add employee</b></li>
                                            <li><a href="accounts_system"><b>Manage accounts</b></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="item_box w-100">
                                <div class="row">
                                    <div class="col-3 border-r">
                                        <p class="icon"><i class="fas fa-rss icon"></i></p>
                                    </div>
                                    <div class="col-9 pl-5">
                                        <h2 class="box">System</h2>
                                        <ul class="list-unstyled">
                                            <li><a href="message_system"><b>Notification for users</b></li>
                                            <li><a href="password_system"><b>Change Admin password</b></a></li>
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

    <div class="modal fade" id="form_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="inc/save_employee.php">
                    <div class="modal-header">
                        <h4 class="modal-title">Add employee</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Number</label>
                                <input type="number" name="employee_no" class="form-control" required="required" />
                            </div>
                            <div class="form-group">
                                <label>Firstname</label>
                                <input type="text" name="firstname" class="form-control" required="required" />
                            </div>
                            <div class="form-group">
                                <label>Lastname</label>
                                <input type="text" name="lastname" class="form-control" required="required" />
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <select name="gender" class="form-control" required="required">
                                    <option value=""></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required="required" />
                            </div>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                        <button name="save" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include('inc/script.php'); ?>

</body>

</html>
