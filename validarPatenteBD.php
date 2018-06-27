<?php
	include "conexionClass.php";
	$c = new conexion();
	$existe = $c->existePatente($_POST['patenteIngresada']);
	echo json_encode(array('existe' => $existe));
?>