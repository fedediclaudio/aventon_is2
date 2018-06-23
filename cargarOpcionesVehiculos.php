<?php
  include 'conexionClass.php';
  $c = new conexion();
  $vehiculos = $c->getVehiculos($_SESSION["id"]);
  while($row = mysqli_fetch_assoc($vehiculos)) {
      echo '<option value="' . $row["idvehiculo"] . '">' . $row["marca"] . ' ' . $row["modelo"] . '</option>';
  }
?>
