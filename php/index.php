<?php 
    if (isset($_COOKIE["unam"])) {
        # code...
    }
    else{
        header("Location:login.php?s=2");
    }
    $host="localhost";
    $usr="portraym_harshit";
    $password="hello19";
    $db=mysql_connect($host,$usr,$password);
    $scans=0;
    mysql_select_db("portraym_ETCS",$db);
    $data=mysql_query("select count(log_no) from log as logcount;") or die(mysql_error());
    while ($row=mysql_fetch_array($data)) {
        $scans=$row['count(log_no)'];
    }
    $data=mysql_query("select count(reader_id) from reader as readers;") or die(mysql_error());
    while ($row=mysql_fetch_array($data)) {
        $readercount=$row['count(reader_id)'];
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
    <title>Dashboard</title>
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/timeline.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
                <a class="navbar-brand" href="index.php">ETCS</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><i class="fa fa-user fa-fw"></i> <?php echo $_COOKIE['unam']; ?>
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
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $readercount;?></div>
                                    <div>Readers active</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $scans;?></div>
                                    <div>Scans</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Log table
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th><i class="fa fa-th-list">  ID</th>
                                                    <th><i class="fa fa-tag">  Tag number</th>
                                                    <th><i class="fa fa-road">  Reader</th>
                                                    <th><i class="fa fa-automobile">  Type</th>
                                                    <th><i class="fa fa-clock-o">  time</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $db=mysql_connect($host,$usr,$password);
                                                    mysql_select_db("portraym_ETCS",$db);
                                                    $data=mysql_query("select*from log order by log_no desc;") or die(mysql_error());;
                                                    while ($row=mysql_fetch_array($data)) {
                                                        echo "<tr><td>";
                                                        echo $row['log_no'];
                                                        echo "</td><td>";
                                                        echo $row['tagno'];
                                                        echo "</td><td>";
                                                        echo $row['readerno'];
                                                        echo "</td><td>";
                                                        echo $row['type'];
                                                        echo "</td><td>";
                                                        echo $row['time'];
                                                        echo "</td></tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-8">
                                    <div id="morris-bar-chart"></div>
                                </div>
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Scan timeline
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="timeline">
                            <?php
                                $db=mysql_connect($host,$usr,$password);
                                mysql_select_db("portraym_ETCS",$db);
                                $data=mysql_query("select*from log order by log_no desc;") or die(mysql_error());;
                                while ($row=mysql_fetch_array($data)) {
                                    $ico;
                                    if ($row["type"]=="POLICE") {
                                        $ico="fa-shield";
                                    }
                                    else if ($row["type"]=="AMBULANCE") {
                                        $ico="fa-ambulance";
                                    }
                                    else if ($row["type"]=="FIRE") {
                                        $ico="fa-fire-extinguisher";
                                    }

                                    if ($row["log_no"]%2==0) {
                                        echo "<li><div class='timeline-badge'><i class='fa ".$ico."'></i></div><div class='timeline-panel'><div class='timeline-heading'><h4 class='timeline-title'>Scan ".$row['log_no']." ".$row["type"]."</h4>";
                                        echo "<p><small class='text-muted'><i class='fa fa-clock-o'></i> ".$row['time']."</small></p>";
                                        echo "</td><td><div class='timeline-body'><p>Reader number: ".$row['readerno']."</p><p>tag number: ".$row['tagno']."</p></div>";
                                        echo "</div></div></li>";
                                    }
                                    else{
                                        echo "<li class='timeline-inverted'><div class='timeline-badge warning'><i class='fa ".$ico."'></i></div><div class='timeline-panel'><div class='timeline-heading'><h4 class='timeline-title'>Scan ".$row['log_no']." ".$row["type"]."</h4>";
                                        echo "<p><small class='text-muted'><i class='fa fa-clock-o'></i> ".$row['time']."</small></p>";
                                        echo "</td><td><div class='timeline-body'><p>Reader number: ".$row['readerno']."</p><p>tag number: ".$row['tagno']."</p></div>";
                                        echo "</div></div></li>";
                                    }
                                    mysql_close();
                                }

                            ?>
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Active readers
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th><i class="fa fa-th-list">Reader number</th>
                                                    <th><i class="fa fa-tag">Coordinates</th>
                                                    <th><i class="fa fa-road">Location</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $db=mysql_connect($host,$usr,$password);
                                                    mysql_select_db("portraym_ETCS",$db);
                                                    $data=mysql_query("select*from reader;") or die(mysql_error());;
                                                    while ($row=mysql_fetch_array($data)) {
                                                        echo "<tr><td>";
                                                        echo $row['reader_id'];
                                                        echo "</td><td>";
                                                        echo "<a target='_blank' href='https://www.google.co.in/maps/@$".$row['coordinates'].",15z?hl=en'>".$row['coordinates']."</a>";
                                                        echo "</td><td>";
                                                        echo $row['location'];
                                                        echo "</td></tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
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

    <!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>
    <script src="../js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>
</html>
