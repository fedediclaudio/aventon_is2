<?php
  include 'conexionInfoViaje.php';
  $conexion = new ConexionInfoViaje();
  $conexion->eliminarViajeAbstracto($_GET["idViaje"]);
  header("location:../index.php");
?>
