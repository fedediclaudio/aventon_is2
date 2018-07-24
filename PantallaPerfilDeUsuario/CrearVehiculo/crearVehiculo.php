<?php
  include '../../conexionClass.php';
	$c = new conexion();
	$c->crearVehiculo();
	header("location:../../cargarPerfilUsuarioActual");
?>
