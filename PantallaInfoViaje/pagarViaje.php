<?php
  include 'conexionInfoViaje.php';
  $conexion = new ConexionInfoViaje();
  $conexion->pagarViaje($_SESSION["id"],$_GET["idViajeConcreto"]);
  header("location:../index.php");
?>
