<?php

	include './conexionInfoViaje.php';

	$sql = "UPDATE participacion set comentario = '$_GET[resenia]' where idparticipacion = '$_GET[idparticipacion]'";
	$conexion = new conexionInfoViaje();
	$conexion->consulta($sql);

	header('location: ./informacionViaje.php?id=' . $_GET['idviajeConcreto']);

?>