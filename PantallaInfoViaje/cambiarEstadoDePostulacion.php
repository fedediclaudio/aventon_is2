<?php
  include 'conexionInfoViaje.php';
  $conexion = new ConexionInfoViaje();
  $conexion->cambiarEstadoParticipacionEnViaje($_GET["idpostulacion"], $_GET["estado"]);
  $idViaje = $_GET["idviaje"];
  header("location:informacionViaje.php?id=$idViaje");
?>
