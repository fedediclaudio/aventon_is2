<?php
include 'chequeoSesion.php';
include 'conexionClass.php';
$conn = new conexion();
$result = $conn->getVehiculos($_SESSION['id']);
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo '<div class="jumbotron" style="background-color:#FFF">';
      echo '<h1>';
        echo $row["marca"] . ' ' .	$row["modelo"];
      echo '<h1>';
      echo '<ul class="list-group list-group-flush">';
        echo '<li>Patente:' . $row["patente"] . '</li>';
        echo '<li>Asientos: ' . $row["cantidadAsientos"] . '</li>';
      echo '</ul>';
    echo '</div>';
  }
}
?>
