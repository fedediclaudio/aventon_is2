<?php
  include 'conexionClass.php';
  $c = new conexion();
  $iduser = $_GET["idusuario"];
  $c->updateDatosDeUsuario($iduser);
  echo $_POST['nombre'];
  echo $_POST['apellido'];
  echo $_POST['nacionalidad'];
  echo $_POST['descripcion'];
  echo $_POST['fecha_nacimiento'];

  header("location:perfilUsuario.php?id=$iduser");
?>