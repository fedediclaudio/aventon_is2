<?php
	include "conexionRegistroDeUsuario.php";
	$conexion = new ConexionRegistroDeUsuario();
	$existe = $conexion->existeMail($_POST['mailIngresado']);
	echo json_encode(array('existe' => $existe));
?>
