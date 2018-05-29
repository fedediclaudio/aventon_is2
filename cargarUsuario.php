<?php
	session_start();
	$username = $_SESSION['mail'];
	include  'conexionClass.php';
	$conn = new conexion();
	$user =  $conn->getUsuario($username);
	$row = mysqli_fetch_assoc($user);
	foreach ($row as $v) {
		echo $v;
		echo "<br>";
	}
?>
