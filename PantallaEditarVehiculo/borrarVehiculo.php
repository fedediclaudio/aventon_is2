<?php
	include "conexionEditarVehiculo.php";
	$conexion = new conexionEditarVehiculo();
	$conexion->borrarVehiculo($_GET['id']);
	header('location:../cargarPerfilUsuarioActual.php');
?>
