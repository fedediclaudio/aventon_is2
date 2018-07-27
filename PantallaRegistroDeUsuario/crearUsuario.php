<?php
  include 'conexionRegistroDeUsuario.php';
  $conexion = new ConexionRegistroDeUsuario();
  $conexion->crearUsuario();
  header("location:../index.php");
?>
