<?php

	include './conexionInfoViaje.php';
	$conexion = new conexionInfoViaje();
	$sql = "INSERT INTO pregunta (pregunta, idviajeConcreto) values ('$_GET[pregunta]', '$_GET[idviajeConcreto]')";
	$conexion->consulta($sql);
	header('location: ./informacionViaje.php?id=' . $_GET['idviajeConcreto']);
	
?>