<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Pago de deudas</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <script src="bootstrap/jquery.min.js"></script>
    <script src="bootstrap/popper.min.js"></script>
    <script src="bootstrap/bootstrap.min.js"></script>
  </head>
  <body>
    <?php include 'vistas/navbar.html'; ?>
    <div class="alert alert-danger" role="alert" style="margin:40px">
      <h4 class="alert-heading">Alerta de endeudamiento</h4>
      <p>Lo sentimos, parece que adeudas algunos de tus viajes realizados, para poder continuar utilizando el servicio Aventon deberás antes saldarlas.</p>
      <hr>
      <p class="mb-0">Estos son los siguientes viajes en los que detectamos que tienes deudas pendientes:</p>
      <?php
        session_start();
        include 'conexionClass.php';
        $conexion = new Conexion();
        $deudas = $conexion->getDeudas();
        foreach ($deudas as $key => $deuda) {
          cargarViajeEnDeuda($deuda, $conexion);
        }
      ?>
    </div>
  </body>
</html>


<?php
  function cargarViajeEnDeuda($deuda, $conexion){
    echo '<div class="card card-infoviaje" style="margin-top: 4px;">';
      echo '<div class="card-body" style="background-color: #e9967a99;">';
        echo '<div class="row">';
          echo '<div class="col col-9"> ';
            echo '<div>';
              echo '<h5 class="card-subtitle mb-2">'. $deuda["origen"] . ' - ' .	$deuda["destino"] . '</h5>';
            echo '</div>';
            echo '<div class="row">';
              echo '<div class="col col-6"> ';
                echo '<p class="card-text">Fecha del viaje: ' . $deuda["fechaInicio"] . '</p>';
              echo '</div>';
              echo '<div class="col col-6"> ';
                echo '<p class="card-text">Deuda: $' . $conexion->precioDeViajePorUsuario($deuda) . '</p>';
              echo '</div>';
            echo '</div>';
          echo '</div>';
          echo '<div class="col col-3"> ';
            echo "<button type=\"button\" onClick=\"location='PantallaInfoViaje/informacionViaje.php?id=$deuda[idviajeConcreto]&aPagar=1'\" class=\"btn btn-outline-danger\" style=\"float:right; margin:auto\">Ver</button>";
          echo '</div>';
        echo '</div>';
      echo '</div>';
    echo '</div>';
  }
?>
