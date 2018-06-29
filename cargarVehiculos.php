<?php
$conn = new conexion();
$result = $conn->getVehiculos($_SESSION['id']);
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo '<div class="card card-infoviaje" style="width:100%; margin-top: 4px;">';
    echo '<div class="card-body" style="margin: -1%">';
    echo '<div class="row">';
    echo '<div class="col col-9"> ';
    echo '<div>';
    echo '<h5 class="card-subtitle mb-2">'. $row["marca"] . ' ' .	$row["modelo"] . '</h5>';
    echo '</div>';
    echo '<div class="row">';
    echo '<div class="col col-6"> ';
    echo '<p class="card-text">Patente: ' . $row["patente"] . '</p>';
    echo '</div>';
    echo '<div class="col col-6"> ';
    echo '<p class="card-text">Asientos: ' . $row["cantidadAsientos"] . '</p>';
    echo '</div>';
    echo '</div>'; 
    echo '</div>';
    echo '<div class="col col-3"> ';
    echo '<button type="button" onClick=editar(' . (int)$row['idvehiculo'] . ') class="btn btn-light" style="float:right">Editar/Borrar</button>';
    echo '</div>';
    echo '</div>';
      
    echo '</div>';
    echo '</div>';
  }
}
?>

<script>
    function editar(row){
        window.location.replace("pantallaEditarVehiculo.php?id=" + row);
    }
</script>