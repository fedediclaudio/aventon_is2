<?php
  include "chequeoSesion.php"
?>
<html>
<head>
    <title>Informacion de viaje</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="bootstrap/jquery.min.js"></script>
    <script src="bootstrap/popper.min.js"></script>
    <script src="bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
</head>
<body class="body-general">
    <?php
        include 'conexionClass.php';
        $conn = new Conexion();
        $result = $conn->fullInfoDeViaje($_GET["id"]);
        $viaje = mysqli_fetch_assoc($result);
        $fechaInicio = new DateTime($viaje["fechaInicio"]);
        $fechaFin = new DateTime($viaje["fechaFin"]);
        $horaInicio = new DateTime ($viaje["horaInicio"]);
        $horaFin = new DateTime ($viaje["horaFin"]);
    ?>
    <!-- Navbar -->
    <?php
        include "vistas/navbar.html"
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
					          <?php if($viaje["descripcion"]) { echo '
                      <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                          <div class="card-body" style="margin: -1%">
                              <h6 class="card-subtitle mb-2 text-muted">Descripcion del contacto</h6>
                              <p class="card-text">' . $viaje["descripcion"] . '</p>
                          </div>
                      </div>';} ?>
                </div>
                <div class="col-12" style="margin-top:20px">
                  <?php
                  if($_SESSION['id']==$viaje["id"]){
                    echo '<div class="jumbotron" style=" border:1px; border-style:solid; border-color:rgb(13, 71, 161)">
                      <h4>Postulaciones pendientes</h4>';
                      $result = $conn->participacionesEnViajeConEstado($viaje["idviajeConcreto"],'pendiente');
                      if (mysqli_num_rows($result) == 0) {
               		       echo "Aún no hay postulaciones pendientes en este viaje";
            		      } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                          echo '<div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                          <div class="card-body" style="margin: -1%">
                          <h6 class="card-subtitle mb-2 text-muted">Usuario</h6>
                          <p class="card-text">' . $conn->getUsuarioPorId($row["idusuario"]) . '</p>
                          </div>
                          </div>';
                        }
                      }
                      $result = $conn->participacionesEnViajeConEstado($viaje["idviajeConcreto"],'aceptado');
                      if (!(mysqli_num_rows($result) == 0)) {
                        echo '<h4>Postulaciones aceptadas</h4>';
                        while ($row = mysqli_fetch_assoc($result)) {
                          echo '<div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                          <div class="card-body" style="margin: -1%">
                          <h6 class="card-subtitle mb-2 text-muted">Usuario</h6>
                          <p class="card-text">' . $conn->getUsuarioPorId($row["idusuario"]) . '</p>
                          </div>
                          </div>';
                        }
                      }
                      $result = $conn->participacionesEnViajeConEstado($viaje["idviajeConcreto"],'rechazado');
                      if (!(mysqli_num_rows($result) == 0)) {
                        echo '<h4>Postulaciones rechazadas</h4>';
                        while ($row = mysqli_fetch_assoc($result)) {
                          echo '<div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                          <div class="card-body" style="margin: -1%">
                          <h6 class="card-subtitle mb-2 text-muted">Usuario</h6>
                          <p class="card-text">' . $conn->getUsuarioPorId($row["idusuario"]) . '</p>
                          </div>
                          </div>';
                        }
                      }
                    echo '</div>';
                  } else {
                    if(mysqli_num_rows($conn->participacionesEnViajeConEstado($viaje["idviajeConcreto"],'aceptado')) < $viaje["cantidadAsientos"]){
                      echo '<button type="button" class="btn" style="border-color:rgb(13, 71, 161); float:right">Postularse</button>';
                    } else {
                      echo '<div class="alert alert-danger" role="alert">
                      El viaje esta completo
                      </div>';
                    }
                  }
                  ?>
                </div>
            </div>
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
            						<?php if($viaje["descripcion"]) { echo '
            						<div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                                    	<div class="card-body" style="margin: -1%">
            								<h6 class="card-subtitle mb-2 text-muted">Descripcion</h6>
                                        	<p class="card-text">' . $viaje["descripcion"] . '</p>
                                    	</div>
            						</div>';} ?>
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
		</div>
	</div>
</body>
</html>
