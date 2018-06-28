<?php
  include 'conexionClass.php';
  $c = new conexion();
  $iduser = $_GET["idusuario"];
  $c->updateDatosDeUsuario($iduser);
  header("location:perfilUsuario.php?id=$iduser");
?>
