<?php
  include 'conexionInfoViaje.php';
  $conexion = new ConexionInfoViaje();
  $conexion->eliminarViajeAbstracto($_GET["idViaje"]);
  //header("location:../index.php");
  echo "<script type='text/javascript'>";
  echo "window.history.go(-2)";
  echo "</script>";
?>
