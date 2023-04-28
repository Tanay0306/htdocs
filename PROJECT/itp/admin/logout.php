<?php
	session_start();
	unset($_SESSION['ADMIN_LOGIN']);
	unset($_SESSION['ADMIN_USERNAME']);
	header('location:http://localhost/itp/index1.php');
	die();
?>