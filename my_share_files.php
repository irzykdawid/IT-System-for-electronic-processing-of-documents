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
    <title>My share files | XFILESControl Cloud</title>
    <meta name="description" content="IT System for electronic processing of documents. - Dawid Irzyk">
    <link rel="stylesheet" href="admin/css/bootstrap.min.css" crossorigin="anonymous">
	<link rel="stylesheet" href="admin/css/datatables.min.css">
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
                        <h2>My Shared Files</h2>
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
                                    <div class="col-md-12 pt-2">
                                        <table id="table" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>File name</th>
                                                    <th>File type</th>
                                                    <th>Date added</th>
                                                    <Th>Manage</th>                                                     
                                                    <th>Direct link</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php							                     
							                     $query = mysqli_query($conn, "SELECT * FROM share s JOIN storage st ON s.store_id=st.store_id WHERE s.employee_id = '$_SESSION[employee]'") or die(mysqli_error());
							                     while($fetch = mysqli_fetch_array($query)){
						                         ?>
                                                <tr class="del_file<?php echo $fetch['store_id']?>">
                                                    <td><?php echo $fetch['custom_name']?></td>
                                                    <td><?php echo $fetch['file_type']?></td>
                                                    <td><?php echo $fetch['date_uploaded']?></td>
                                                    <td><a href="inc/download.php?store_id=<?php echo $fetch['store_id']; ?>" class="btn btn-success">Download</a> &nbsp;<button class="btn btn-primary btn_remove" type="button" id="<?php echo $fetch['store_id']?>">Delete</button></td>
                                                    <td>
                                                        <?php echo "<a href='inc/get.php?token=".$fetch['token']."'>https://xfiles.pl/inc/get.php?token=".$fetch['token']."</a>"; ?>
                                                    </td>
                                                </tr>
                                                <?php
							                                }
						                                    ?>
                                            </tbody>
                                        </table>
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

    <div class="modal fade" id="modal_remove" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="admin/images/logo.svg">
                </div>
                <div class="modal-body">
                    <h5>Are you sure you want to delete the file share link?<br><b>(This operation is irreversible!)</b></h5>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-success" data-dismiss="modal">No</a>
                    <button type="button" class="btn btn-primary" id="btn_yes">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <?php include('inc/script.php'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.btn_remove').on('click', function() {
                var store_id = $(this).attr('id');
                $("#modal_remove").modal('show');
                $('#btn_yes').attr('name', store_id);
            });

            $('#btn_yes').on('click', function() {
                var id = $(this).attr('name');
                $.ajax({
                    type: "POST",
                    url: "inc/remove_share.php",
                    data: {
                        store_id: id
                    },
                    success: function(data) {
                        $("#modal_remove").modal('hide');
                        $(".del_file" + id).empty();
                        $(".del_file" + id).html("<td colspan='12'><div class=\"d-flex justify-content-center\"><div class=\"spinner-border\" role=\"status\"><span class=\"sr-only\">Loading...</span></div></div></td>");
                        setTimeout(function() {
                            $(".del_file" + id).fadeOut('slow');
                        }, 1000);
                    }
                });
            });
        });

    </script>

</body>

</html>
