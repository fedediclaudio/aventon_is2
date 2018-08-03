<?php
	session_start();
	if(!isset($_SESSION["mail"])){
		header("location:index.php");
	}
?>
