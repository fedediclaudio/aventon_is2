<?php
include 'conexionClass.php';	
$c = new conexion();
$c->crearUsuario();
header("location:index.php");
?>