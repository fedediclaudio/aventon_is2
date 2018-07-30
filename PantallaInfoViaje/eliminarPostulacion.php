<?php
  include 'conexionInfoViaje.php';
  $conexion = new ConexionInfoViaje();
  session_start();
  $conexion->eliminarPostulacion($_SESSION["id"], $_GET["idviajeConcreto"]);
  $idViaje = $_GET["idviajeConcreto"];
  header("location:informacionViaje.php?id=$idViaje");
?>
