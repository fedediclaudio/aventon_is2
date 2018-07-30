<?php
  include 'conexionInfoViaje.php';
  $conexion = new ConexionInfoViaje();
  $conexion->eliminarViajeConcreto($_GET["idViajeConcreto"]);
  header("location:../index.php");
?>
