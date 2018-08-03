<?php
  include_once '../conexionClass.php';

  class ConexionPerfilDeUsuario extends Conexion{

    function cargarVehiculos(){
      $result = $this->getVehiculosPorIdUsuario($_GET['id']);
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
                  if ($this->esUsuarioActual()) { echo '<button type="button" onClick=editar(' . (int)$row['idvehiculo'] . ') class="btn btn-light" style="float:right">Editar/Borrar</button>';}
                echo '</div>';
              echo '</div>';
            echo '</div>';
          echo '</div>';
        }
      }
    }

    function getViajesDeUsuario($idUsuario) {
      return $this->consulta("SELECT * FROM viaje v INNER JOIN vehiculo ve ON (v.idvehiculo = ve.idvehiculo) INNER JOIN usuario u ON (ve.idusuario = u.id) WHERE u.id = $idUsuario");
    }

    function cargarViajes(){
      $viajes = $this->getViajesDeUsuario($_GET['id']);
      if (mysqli_num_rows($viajes) > 0) {
        while($row = mysqli_fetch_assoc($viajes)) {
          echo '<div class="card card-infoviaje" style="width:100%; margin-top: 4px;">';
            echo '<div class="card-body" style="margin: -1%">';
              echo '<div class="row">';
                echo '<div class="col col-9"> ';
                  echo '<div>';
                    echo '<h5 class="card-subtitle mb-2">Desde: '. $row["origen"] . ' a: ' .	$row["destino"] . '</h5>';
                  echo '</div>';
                  echo '<div class="row">';
                    echo '<div class="col col-12"> ';
                      echo '<p class="card-text">Precio: ' . $row["precio"] . '</p>';
                    echo '</div>';
                    echo '<div class="col col-12"> ';
                      echo "Disponible en fechas: ";
                      echo "<ul style='list-style-type: none'>";
                      $viajesConcretos = $this->getViajesConcretos($row["idviaje"]);
                      while ($viajeConcreto = mysqli_fetch_assoc($viajesConcretos)) {
                        echo "<li>";
                        echo "<a href='../PantallaInfoViaje/informacionViaje.php?id=$viajeConcreto[idviajeConcreto]'>" . $viajeConcreto["fechaInicio"] . "</a>";
                        echo "</li>";
                      }
                      echo "</ul>";
                    echo '</div>';
                  echo '</div>';
                echo '</div>';
              echo '</div>';
            echo '</div>';
          echo '</div>';
        }
      }
    }

    function getViajesConcretos ($idViaje) {
      return $this->consulta("SELECT * FROM viajeconcreto vc WHERE vc.idviaje = $idViaje");
    }

    function esUsuarioActual() {
      return ($_GET["id"] == $_SESSION["id"]);
    }

  }

?>
