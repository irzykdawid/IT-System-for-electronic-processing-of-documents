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
    <title>My profile | XFILESControl Cloud</title>
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
                        <h2>My profile</h2>
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
                        <div class="col-md-12 col-sm-12">
                            <div class="item_box w-100">
                                <div class="row">
                                    <div class="col-12 pl-3">
                                        <form method="POST" action="inc/update_user_data.php">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Enter the data and then click <b>"Update"</b> button.</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Firstname</label>
                                                        <input type="hidden" name="employee_id" value="<?php echo $fetch['employee_id']?>" />
                                                        <input type="text" name="firstname" value="<?php echo $fetch['firstname']?>" class="form-control" required="required" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Lastname</label>
                                                        <input type="text" name="lastname" value="<?php echo $fetch['lastname']?>" class="form-control" required="required" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Gender</label>
                                                        <select type="text" name="gender" class="form-control" required="required">
                                                            <?php if($fetch['gender']=="Male") {
                                                                echo "<option selected='selected' value='Male'>Male</option>";
                                                                echo "<option value='Female'>Female</option>";
                                                            }
                                                            else {
                                                                echo "<option selected='selected' value='Female'>Female</option>";
                                                                echo "<option value='Male'>Male</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" name="email" value="<?php echo $fetch['email']?>" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="clear:both;"></div>
                                            <div class="modal-footer">
                                                <button name="edit" class="btn btn-success">Update</button>
                                            </div>
                                        </form>
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
    </div>

    <?php include('inc/script.php'); ?>

</body>

</html>
