<?php
  include 'conexionClass.php';
  $c = new conexion();
  session_start();
  $c->postularAViaje($_SESSION["id"], $_GET["idviajeConcreto"]);
  $idViaje = $_GET["idviajeConcreto"];
  header("location:informacionViaje.php?id=$idViaje");
?>
