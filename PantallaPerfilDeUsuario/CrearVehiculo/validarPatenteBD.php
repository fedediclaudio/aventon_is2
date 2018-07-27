<?php
	include "conexionCrearVehiculo.php";
	$conexion = new ConexionCrearVehiculo();
	$existe = $conexion->existePatente($_POST['patenteIngresada']);
	echo json_encode(array('existe' => $existe));
?>
