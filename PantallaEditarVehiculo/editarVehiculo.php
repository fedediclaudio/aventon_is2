<?php
  include "conexionEditarVehiculo.php";
  $conexion = new ConexionEditarVehiculo();
  $conexion->editarVehiculo($_GET['id'], $_POST['marca'], $_POST['modelo'], $_POST['cantidadAsientos']);
  header("location:../cargarPerfilUsuarioActual");
?>
