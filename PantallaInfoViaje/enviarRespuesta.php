<?php

	echo var_dump($_GET);
	include './conexionInfoViaje.php';
	$conexion = new conexionInfoViaje();
	$sql = "UPDATE pregunta SET respuesta = '$_GET[respuesta]' WHERE idpregunta = '$_GET[idpregunta]'";
	$conexion->consulta($sql);
	header("location: ./informacionViaje.php?id=$_GET[idviajeConcreto]");

?>