<?php
  include "../chequeoSesion.php";
?>
<html>
<head>
    <title>Informacion de viaje</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../bootstrap/jquery.min.js"></script>
    <script src="../bootstrap/popper.min.js"></script>
    <script src="../bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../styles.css">
    <script type="text/javascript" src="../jquery-3.3.1.min.js"></script>
</head>
<body class="body-general">
    <?php
        include 'conexionInfoViaje.php';
        $conexion = new ConexionInfoViaje();
        $result = $conexion->fullInfoDeViaje($_GET["id"]);
        $viaje = mysqli_fetch_assoc($result);
        $fechaInicio = new DateTime($viaje["fechaInicio"]);
        $fechaFin = new DateTime($viaje["fechaFin"]);
        $horaInicio = new DateTime ($viaje["horaInicio"]);
        $horaFin = new DateTime ($viaje["horaFin"]);
        include 'modalEliminarViaje.php';
        include 'modalPago.php';
    ?>
    <!-- Navbar -->
    <?php
        include "../vistas/navbar.html"
    ?>
    <div  style="margin:5%">
      <div class="jumbotron p-3 p-md-5 text-black rounded jumbo-infoviaje" id="infoViaje">
        <div class="row">
          <div class="col col-12 col-lg-4 px-0">
            <div style="margin: 5px">
              <h1 class="display-4"><?php  echo 'Viaje desde <font color="#0D47A1">' . $viaje["origen"] . '</font> hasta <font color="#0D47A1">' . $viaje["destino"] . '</font> el dia <font color="#0D47A1">' . $fechaInicio->format('d-m-Y') . '</font>' ?></h1>
            </div>
          </div>
          <div class="col col-12 col-lg-8 px-0"  >
            <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
              <div class="card-body" style="margin: -1%">
                <h6 class="card-subtitle mb-2 text-muted">Inicio del viaje</h6>
                <p class="card-text"><?php echo 'El viaje comienza el dia ' . $fechaInicio->format('d-m-Y') . ' a las ' . $horaInicio->format('H:i') . ' hs' ?></p>
              </div>
            </div>
            <div class="card card-infoviaje" style="width:100%;  margin-top: 4px;">
              <div class="card-body" style="margin: -1%">
                <h6 class="card-subtitle mb-2 text-muted">Fin del viaje</h6>
                <p class="card-text"><?php echo 'Se estima que termina el día ' . $fechaFin->format('d-m-Y') . ' a las ' . $horaFin->format('H:i') . ' hs' ?></p>
              </div>
            </div>
            <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
              <div class="card-body" style="margin: -1%">
                <h6 class="card-subtitle mb-2 text-muted">Precio</h6>
                <p class="card-text"><?php echo '$' . $viaje["precio"] ?></p>
              </div>
            </div>
          </div>
          <div class="col-12" style="margin-top:20px">
          </div>
        </div>
				<?php $conexion->imprimirParticipacionesOAviso($viaje); ?>

        <?php
          if ($conexion->viajeEsDeUsuarioActual($viaje)) {
            echo "<button class='btn btn-outline-danger' style='float:right'data-toggle='modal' data-target='#modalEliminarViaje'> Eliminar viaje</button>";
          } elseif ($conexion->usuarioParticipo($_SESSION["id"],$viaje["idviajeConcreto"]) && !$conexion->estaPago($_SESSION["id"],$viaje["idviajeConcreto"])) {
            echo "<button class='btn btn-outline-danger' style='float:right'data-toggle='modal' data-target='#modalPago'> Pagar</button>";
          }
        ?>
			</div>
      <div class="row mb-6">
        <div class="col-md-6">
          <div class="jumbotron p-3 p-md-5 text-black rounded jumbo-infoviaje" id="infoConductor">
            <div class="row">
      				<div class="col col-12 px-0">
      					<div style="margin: 5px">
      						<h3 class="display-4">Conductor</h3>
      					</div>
      				</div>
      				<div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                <div class="card-body" style="margin: -1%">
            			<h6 class="card-subtitle mb-2 text-muted">Nombre y apellido</h6>
                  <p class="card-text"><?php echo $viaje["nombre"] . ' ' . $viaje["apellido"]; ?></p>
                </div>
              </div>
              <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                <div class="card-body" style="margin: -1%">
                  <h6 class="card-subtitle mb-2 text-muted">Reputación</h6>

                    <div class="row" style="margin: -1%">
                      <div class="col-md-1.5">
                        <p class="text-success">
                          <?php
                            echo $conexion->getLikes($_GET["id"]);
                          ?>
                        </p>
                      </div>
                      <div class="col-md-2">
                        <p><img src="../img/like.png"></p>
                      </div>
                      <div class="col-md-1.5">
                        <p class="text-danger">
                          <?php
                            echo $conexion->getDislikes($_GET["id"]);
                          ?>
                        </p>
                      </div>
                      <div class="col-md-2">
                        <p><img src="../img/dislike.png"></p>
                      </div>
                    </div>

                </div>
  						</div>
  						<div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                <div class="card-body" style="margin: -1%">
  								<h6 class="card-subtitle mb-2 text-muted">E-Mail</h6>
                  <p class="card-text"><?php echo $viaje["email"]; ?></p>
                </div>
  						</div>
  						<div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                <div class="card-body" style="margin: -1%">
  								<h6 class="card-subtitle mb-2 text-muted">Fecha de Nacimiento</h6>
                  <p class="card-text"><?php $fechanacimiento = new DateTime($viaje["fecha_nacimiento"]); echo $fechanacimiento->format('d-m-Y'); ?></p>
                </div>
  						</div>
  						<div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                <div class="card-body" style="margin: -1%">
  								<h6 class="card-subtitle mb-2 text-muted">Nacionalidad</h6>
                  <p class="card-text"><?php echo $viaje["nacionalidad"]; ?></p>
                </div>
  						</div>
  					<?php $conexion->imprimirDescripcion($viaje["descripcion"]); ?>
            </div>
          </div>
        </div>
      <div class="col-md-6">
        <div class="jumbotron p-3 p-md-5 text-black rounded jumbo-infoviaje" id="infoVehiculo">
          <div class="row">
              <div class="col col-12 px-0">
                <div style="margin: 5px">
                  <h3 class="display-4">Vehículo</h3>
                </div>
              </div>
              <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                <div class="card-body" style="margin: -1%">
                  <h6 class="card-subtitle mb-2 text-muted">Marca y modelo de <?php echo $viaje["nombreTipo"]; ?></h6>
                  <p class="card-text"><?php echo $viaje["marca"] . ' ' . $viaje["modelo"]; ?></p>
                </div>
              </div>
              <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                <div class="card-body" style="margin: -1%">
                  <h6 class="card-subtitle mb-2 text-muted">Patente</h6>
                  <p class="card-text"><?php echo $viaje["patente"]; ?></p>
                </div>
              </div>
              <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                <div class="card-body" style="margin: -1%">
                  <h6 class="card-subtitle mb-2 text-muted">Asientos</h6>
                  <p class="card-text"><?php echo $viaje["cantidadAsientos"]; ?></p>
                </div>
              </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="jumbotron p-3 p-md-5 text-black rounded jumbo-infoviaje" id="infoVehiculo">
          <div class="col col-12 px-0">
              <div style="margin: 5px">
                	<?php 
                		if($conexion->viajeTermino($viaje['idviajeConcreto'])){
                			$conexion->imprimirSeccionResenias($viaje);
                		}else{
                			$conexion->imprimirSeccionPreguntas($viaje);
                		}
                	?>
        </div>

       </div>
            </div>
        </div>
      </div>
	 </div>
	</div>
</body>
</html>
