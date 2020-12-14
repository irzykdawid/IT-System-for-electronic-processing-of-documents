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
    <title>Accounts | XFILESControl Cloud</title>
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

                <h2>Accounts</h2>

                <div class="grid-columns">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="item_box w-100 pl-4 pr-4">


                                <button class="btn btn-success mb-4" data-toggle="modal" data-target="#form_modal"> Add employee</button>
                                
                                <table id="table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Employee number</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
					$query = mysqli_query($conn, "SELECT * FROM employee") or die(mysqli_error());
					while($fetch = mysqli_fetch_array($query)){
				?>
                                        <tr class="del_employee<?php echo $fetch['employee_id']?>">
                                            <td><?php echo $fetch['employee_no']?></td>
                                            <td><?php echo $fetch['firstname']?> <?php echo $fetch['lastname']?></td>
                                            <td><?php echo $fetch['gender']?></td>
                                            <td><?php echo $fetch['email']?></td>
                                            <td>
                                                <center><button class="btn btn-warning" data-toggle="modal" data-target="#edit_modal<?php echo $fetch['employee_id']?>"><span class="glyphicon glyphicon-edit"></span> Edit</button>
                                                    <button class="btn btn-danger btn-delete" id="<?php echo $fetch['employee_id']?>" type="button"><span class="glyphicon glyphicon-trash"></span> Delete</button></center>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="edit_modal<?php echo $fetch['employee_id']?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form method="POST" action="inc/update_employee.php">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Employee</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-3"></div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Number</label>
                                                                    <input type="hidden" name="employee_id" value="<?php echo $fetch['employee_id']?>" class="form-control" />
                                                                    <input type="number" name="employee_no" value="<?php echo $fetch['employee_no']?>" class="form-control" required="required" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Firstname</label>
                                                                    <input type="text" name="firstname" value="<?php echo $fetch['firstname']?>" class="form-control" required="required" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Lastname</label>
                                                                    <input type="text" name="lastname" value="<?php echo $fetch['lastname']?>" class="form-control" required="required" />
                                                                </div>
                                                                <div class="form-inline">
                                                                    <label>Email</label>
                                                                    <input type="text" name="email" value="<?php echo $fetch['email']?>" class="form-control" required="required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                                                            <button name="update" class="btn btn-warning"><span class="glyphicon glyphicon-save"></span> Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
					}
				?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="modal fade" id="modal_confirm" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <img src="images/logo.svg">
                                        </div>
                                        <div class="modal-body">
                                            <h5>Are you sure you want to delete this user?<br><b>(This operation is irreversible!)</b></h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-success" id="btn_yes">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="form_modal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form method="POST" action="inc/save_employee.php">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Add Employee</h4>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('.btn-delete').on('click', function() {
                var employee_id = $(this).attr('id');
                $("#modal_confirm").modal('show');
                $('#btn_yes').attr('name', employee_id);
            });
            $('#btn_yes').on('click', function() {
                var id = $(this).attr('name');
                $.ajax({
                    type: "POST",
                    url: "inc/delete_employee.php",
                    data: {
                        employee_id: id
                    },
                    success: function() {
                        $("#modal_confirm").modal('hide');
                        $(".del_employee" + id).empty();
                        $(".del_employee" + id).html("<td colspan='12'><div class=\"d-flex justify-content-center\"><div class=\"spinner-border\" role=\"status\"><span class=\"sr-only\">Loading...</span></div></div></td>");
                        setTimeout(function() {
                            $(".del_employee" + id).fadeOut('slow');
                        }, 1000);
                    }
                });
            });
        });

    </script>
</body>

</html>
