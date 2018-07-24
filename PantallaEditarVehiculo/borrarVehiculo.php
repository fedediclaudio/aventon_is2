<?php
	include "../conexionClass.php";
	$conn = new conexion();
	$conn->borrarVehiculo($_GET['id']);
	header('location:../cargarPerfilUsuarioActual.php');
?>
