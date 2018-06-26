<?php
	include "conexionClass.php";
	$c = new conexion();
	$existe = $c->existeMail($_POST['mailIngresado']);
	echo json_encode(array('existe' => $existe));
?>