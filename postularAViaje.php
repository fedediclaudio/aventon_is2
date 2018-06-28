<?php
  include 'conexionClass.php';
  $c = new conexion();
  session_start();
  $c->postularAViaje($_SESSION["id"], $_POST["idviajeConcreto"]);
  $idViaje = $_POST["idviaje"];
  header("location:informacionViaje.php?id=$idViaje");
?>