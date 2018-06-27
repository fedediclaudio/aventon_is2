<?php
	include "conexionClass.php";
	$c = new conexion();
	$existe = $c->validarFechasDeViaje($_POST["arrayInicio"], $_POST["arrayFin"], $_POST["idvehiculo"]);
	echo json_encode(array('existe' => $existe));
?>