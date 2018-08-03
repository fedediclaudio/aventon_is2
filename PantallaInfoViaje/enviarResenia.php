<?php

	include './conexionInfoViaje.php';

	$sql = "UPDATE participacion set comentario = '$_GET[resenia]', calificacion = '$_GET[calificacion]' where idparticipacion = '$_GET[idparticipacion]'";
	$conexion = new conexionInfoViaje();
	$conexion->consulta($sql);
	echo var_dump($_GET);
	echo $sql;
	header('location: ./informacionViaje.php?id=' . $_GET['idviajeConcreto']);

?>