<?php
    if (isset($_COOKIE["unam"])) {
        $host="localhost";
        $usr="portraym_harshit";
        $password="hello19";
        $db=mysql_connect($host,$usr,$password);
        $scans=0;
        mysql_select_db("portraym_ETCS",$db);
    }
    else{
        header("Location:login.php?s=2");
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ETCS-Register</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Vehicle maintenance</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $_COOKIE['unam']; ?></a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i>Tools<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="register.php">Vehicle maintenance</a>
                                </li>
                                <li>
                                    <a href="reader.php">Reader maintenance</a>
                                </li>
                                <li>
                                    <a href="changepass.php">Change Password</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header">Register</h1>
                </div>
                <div class="col-lg-6">
                    <h1 class="page-header">Cancel</h1>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Register vehicle
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" action="change.php?c=dkdkdkdkdkdk" method="post">
                                        <div class="form-group">
                                            <label>Vehicle UID number</label>
                                            <input type="number" class="form-control" name=uid placeholder="Enter UID" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Vehicle type</label>
                                            <select class="form-control" name="type">
                                                <option>POLICE</option>
                                                <option>FIRE</option>
                                                <option>AMBULANCE</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-default">Submit</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-6">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th><i class="fa fa-th-list">  ID</th>
                                    <th><i class="fa fa-automobile">  Type</th>
                                    <th><i class="fa fa-tag">  Tag number</th>
                                    <th><i class="fa fa-gear">  Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $db=mysql_connect($host,$usr,$password);
                                    mysql_select_db("portraym_ETCS",$db);
                                    $data=mysql_query("select*from vehicle;") or die(mysql_error());;
                                    while ($row=mysql_fetch_array($data)) {
                                        echo "<tr><td>";
                                        echo $row['vehicleno'];
                                        echo "</td><td>";
                                        echo $row['type'];
                                        echo "</td><td>";
                                        echo $row['UID'];
                                        echo "</td><td>";
                                        echo "<a href='change.php?c=yhshyhsye21&id=".$row['UID']."'><button type='button' class='btn btn-warning btn-circle'><i class='fa fa-times'></i>
                            </button></a>";
                                        echo "</td></tr>";
                                    }
                                ?>
                            </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
