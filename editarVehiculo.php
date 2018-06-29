<?php
include "conexionClass.php";
$conn = new conexion();
//echo var_dump($_POST);
//echo var_dump($_GET);
$conn->editarVehiculo($_GET['id'], $_POST['marca'], $_POST['modelo'], $_POST['cantidadAsientos']);
header("location:cargarPerfilUsuarioActual");
?>