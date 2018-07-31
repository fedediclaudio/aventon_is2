<?php
  include 'conexionInfoViaje.php';
  $conexion = new ConexionInfoViaje();
  $conexion->eliminarViajeConcreto($_GET["idViajeConcreto"]);
  //header("location:../index.php");
  echo "<script type='text/javascript'>";
  echo "window.history.go(-2)";
  echo "</script>";
?>
