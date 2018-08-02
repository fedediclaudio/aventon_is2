<?php
  include 'conexionInfoViaje.php';
  $conexion = new ConexionInfoViaje();
  session_start();
  $conexion->postularAViaje($_SESSION["id"], $_GET["idviajeConcreto"], $_GET["cantidad"]);
  $idViaje = $_GET["idviajeConcreto"];
  header("location:informacionViaje.php?id=$idViaje");
?>
