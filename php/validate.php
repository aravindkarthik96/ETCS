<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'portraym_ETCS');
define('DB_USER', 'portraym_harshit');
define('DB_PASSWORD', 'hello19');

$con = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Unable to connect to database: ".mysql_error());
$db = mysql_select_db(DB_NAME,$con) or die("Unable to connect to database:".mysql_error());

$UserID = $_POST['username'];
$Password = $_POST['password'];
    if (!empty($UserID)) 
    {
        $query = "select usernumber,username from users where username = '".$UserID."' and password ='".md5($Password)."'";
        $runQuery = mysql_query($query);
        if ($row = mysql_fetch_array($runQuery))
        {
            $query ="UPDATE  users SET  timestamp =now() WHERE usernumber=".$row['usernumber'].";";
            mysql_query($query);
            setcookie(unum,$row['usernumber'],time() +16400);
            setcookie(unam,$row['username'],time() +16400);
            header("Location:index.php");
        }
        else{
            header("Location:login.php?s=1");
        }
    }
?>