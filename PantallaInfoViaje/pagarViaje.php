<?php
  session_start();
  include 'conexionInfoViaje.php';
  $conexion = new ConexionInfoViaje();
  $conexion->pagarViaje($_SESSION["id"],$_GET["idViajeConcreto"]);
  header("location:informacionViaje.php?id=$_GET[idViajeConcreto]");
?>
