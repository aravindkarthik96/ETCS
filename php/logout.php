<?php
	unset($_COOKIE['unum']);
	unset($_COOKIE['unam']);
	setcookie("unum",null,time() - 36);
	setcookie("unam",null,time() - 36);
	header("Location:login.php?s=3");
?>