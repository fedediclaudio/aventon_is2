<?php
	include '../conexionClass.php';
	$c = new conexion();
	$c->crearViajes();
	header("location:../PantallaPrincipal/pantallaPrincipal.php");
?>
