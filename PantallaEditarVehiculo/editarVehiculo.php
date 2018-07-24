<?php
  include "../conexionClass.php";
  $conn = new conexion();
  $conn->editarVehiculo($_GET['id'], $_POST['marca'], $_POST['modelo'], $_POST['cantidadAsientos']);
  header("location:../cargarPerfilUsuarioActual");
?>
