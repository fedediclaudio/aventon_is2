<?php
  include '../conexionClass.php';
  $c = new conexion();
  $iduser = $_GET["idusuario"];
  $c->updateDatosDeUsuario($iduser);
  header("location:../PantallaPerfilDeUsuario/perfilUsuario.php?id=$iduser");
?>
