<?php
  include 'conexionEditarPerfil.php';
  $c = new ConexionEditarPerfil();
  $idUser = $_GET["idusuario"];
  $c->updateDatosDeUsuario($idUser);
  header("location:../PantallaPerfilDeUsuario/perfilUsuario.php?id=$idUser");
?>
