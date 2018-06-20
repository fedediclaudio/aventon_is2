<?php
  $c = new conexion();
  $tipos = $c->getTiposVehiculos();
  while($row = mysqli_fetch_assoc($tipos)) {
      echo '<option value="' . $row["idtipoVehiculo"] . '">' . $row["nombreTipo"] . '</option>';
  }
?>  