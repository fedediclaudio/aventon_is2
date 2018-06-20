<?php
include 'conexionClass.php';
$c = new conexion();
if($c->crearUsuario()){
  header("location:index.php");
} else {
  header("location:registroUsuario.php?error=1");
}
?>
