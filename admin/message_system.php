<!DOCTYPE html>
<?php 
	require 'inc/validator.php';
	require_once 'inc/conn.php'
?>

<?php 
    $query = mysqli_query($conn, "SELECT * FROM user WHERE user_id = '$_SESSION[user]'") or die(mysqli_error());
    $fetch = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Message | XFILESControl Cloud</title>
    <meta name="description" content="IT System for electronic processing of documents. - Dawid Irzyk">
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style_inner.css">
    <script src="js/all.min.js"></script>
    <script src="js/Chart.min.js"></script>
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
            
            $message = mysqli_query($conn, "SELECT system_message FROM message") or die(mysqli_error());
            $message_value = mysqli_fetch_array($message);
            
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

                <h2>Message</h2>

                <div class="grid-columns">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="item_box w-100 pl-4 pr-4">
                                <form id="mes" action="inc/save_message.php" method="post">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Create notification for Employees'</h4>
                                    </div>
                                    <div class="col-md-12 pt-4">
                                        <textarea name="message" id="text_message" class="w-100 pl-3 pt-2"><?php echo $message_value['system_message'];?></textarea>
                                    </div>
                                    <div class="col-md-12 pt-4">
                                        <button name="save" type="submit" class="btn btn-success">Save notification</button>
                                        <button id="clear" type="submit" class="btn btn-danger">Clear notification</button>
                                    </div>
                                </form>
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

    <script type="text/javascript">
        $("#mes").submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(data) {
                    $.toaster({
                        message: 'The&nbsp;message has been updated',
                        title: 'XFILES Control Panel',
                        priority: 'success'

                    });
                }
            });
        });

    </script>

    <script type="text/javascript">
        $("#clear").click(function() {
            $('#text_message').val('');
        });

    </script>

</body>

</html>
