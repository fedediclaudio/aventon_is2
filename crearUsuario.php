<?php
include 'conexionClass.php';
$c = new conexion();
if($c->crearUsuario()){
  header("location:index.php");
}
?>
