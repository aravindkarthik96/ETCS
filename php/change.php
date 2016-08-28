<?php
	$host="localhost";
    $usr="portraym_harshit";
    $password="hello19";
    $db=mysql_connect($host,$usr,$password);
    mysql_select_db("portraym_ETCS",$db);
	if ($_GET["c"]=="dkdkdkdkdkdk") {
        $type=$_POST["type"];
        $uid=$_POST["uid"];
        $query ="insert into vehicle VALUES (NULL ,'$type','$uid');";
        mysql_query($query);
        header("Location:register.php");
	}
	elseif ($_GET["c"]=="yhshyhsye21") {
		$id=$_GET['id'];
		$query ="delete from vehicle where uid=$id;";
        mysql_query($query) or die("Unable to delete from database:".mysql_error());
        header("Location:register.php");
		# code...
	}
	elseif ($_GET["c"]=="mickeighekl31121") {
		$rid=$_POST["rnumber"];
		$coordinates=$_POST["rcoordinates"];
		$location=$_POST["rlocation"];
		$rstatus=$_POST["rstatus"];
		$query ="insert into reader VALUES (null ,'$coordinates','$location',$rstatus,now());";
        mysql_query($query);
        header("Location:reader.php");
	}
	elseif ($_GET["c"]=="xkkdkkkdqqny4222") {
		$rid=$_GET['id'];
		$query ="delete from reader where reader_id=$rid";
        mysql_query($query) or die("Unable to delete from database:".mysql_error());
        header("Location:reader.php");
		# code...
	}
?>