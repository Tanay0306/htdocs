<?php

session_start();

if (isset($_SESSION["admin_id"])) {
	session_destroy();
	header("location:login.php");
}else{
	header("location:http://localhost/itp/index1.php");
}


?>