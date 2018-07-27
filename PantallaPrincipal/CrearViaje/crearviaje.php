<?php
	include 'conexionCrearViaje.php';
	$conexion = new ConexionCrearViaje();
	$conexion->crearViajes();
	header("location:../PantallaPrincipal/pantallaPrincipal.php");
?>
