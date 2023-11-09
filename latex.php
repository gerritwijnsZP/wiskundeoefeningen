<?php
session_start();
if(!isset($_SESSION['latex']))
{
	$_SESSION['latex'] = True;
}else{
	/*
	session_unset();
	session_destroy();
	*/
	unset($_SESSION['latex']); 
}
header("Location:index.php");
?>
