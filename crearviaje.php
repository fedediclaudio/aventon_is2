<?php
include 'conexionClass.php';	
$c = new conexion();
$c->crearViaje();
header("location:index.php");
?>