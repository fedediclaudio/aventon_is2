<?php
  include 'conexionClass.php';
  $c = new conexion();
  $c->cambiarEstadoParticipacionEnViaje($_GET["idpostulacion"], $_GET["estado"]);
  $idViaje = $_GET["idviaje"];
  header("location:informacionViaje.php?id=$idViaje");
?>
