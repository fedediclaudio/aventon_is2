<?php
	include "conexionCrearViaje.php";
	$conexion = new ConexionCrearViaje();
	$existe = $conexion->validarFechasDeViaje($_POST["arrayInicio"], $_POST["arrayFin"]);
	echo json_encode(array('existe' => $existe));
?>
