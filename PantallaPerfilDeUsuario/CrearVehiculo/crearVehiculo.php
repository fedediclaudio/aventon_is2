<?php
  include 'conexionCrearVehiculo.php';
	$conexion = new ConexionCrearVehiculo();
	$conexion->crearVehiculo();
	header("location:../../cargarPerfilUsuarioActual");
?>
