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
        $result = $conn->informacionDeUnViaje($_GET["id"]); 
        $viaje = mysqli_fetch_assoc($result);
		$iduser = $viaje["idusuario"];
		$result2 = $conn->getUsuarioPorId($iduser);
		$user = mysqli_fetch_assoc($result2);
    ?>
    <!-- Navbar -->
    <?php
        include "vistas/navbar.html"
    ?>
    <div  style="margin:5%">
        <div class="jumbotron p-3 p-md-5 text-black rounded jumbo-infoviaje">
            <div class="row">
                <div class="col col-12 col-lg-4 px-0">
                    <div style="margin: 5px">
                        <h1 class="display-4"><?php $date = new DateTime($viaje["fecha"]); echo 'Viaje desde <font color="#0D47A1">' . $viaje["origen"] . '</font> hasta <font color="#0D47A1">' . $viaje["destino"] . '</font> el dia <font color="#0D47A1">' . $date->format('d-m-Y') . '</font>' ?></h1>
                    </div>
                </div>
                <div class="col col-12 col-lg-8 px-0"  >
                    <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                        <div class="card-body" style="margin: -1%">
                            <h6 class="card-subtitle mb-2 text-muted">Inicio del viaje</h6>
                            <p class="card-text"><?php $horainicio = new DateTime($viaje["horainicio"]); echo 'El viaje comienza el dia ' . $date->format('d-m-Y') . ' a las ' . $horainicio->format('H:m') . ' hs' ?></p>
                        </div>
                    </div>
                    <div class="card card-infoviaje" style="width:100%;  margin-top: 4px;">
                        <div class="card-body" style="margin: -1%">
                            <h6 class="card-subtitle mb-2 text-muted">Fin del viaje</h6>
                            <p class="card-text"><?php $horafin = new DateTime($viaje["horafin"]); echo 'Se estima que termine a las ' . $horafin->format('H:m') . ' hs' ?></p>
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
            </div>
        </div>
        
        <div class="row mb-6"><!--
            <div class="col-md-6">
                <div class="jumbotron p-3 p-md-5 text-black rounded bg-light">
                    <div class="col-md-6 px-0">
                        <h1 class="display-4">Informacion sobre el viaje</h1>
                        <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about     what's most interesting in this post's contents.</p>
                        <p class="lead mb-0"></p>
                    </div>
                </div>
            </div>
		-->
            <div class="col-md-6">
                <div class="jumbotron p-3 p-md-5 text-black rounded jumbo-infoviaje">
                    <div class="row">
						<div class="col col-12 px-0">
							<div style="margin: 5px">
								<h3 class="display-4">Conductor</h3>
							</div>
						</div>
						<div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                        	<div class="card-body" style="margin: -1%">
								<h6 class="card-subtitle mb-2 text-muted">Nombre y apellido</h6>
                            	<p class="card-text"><?php echo $user["nombre"] . ' ' . $user["apellido"]; ?></p>
                        	</div>
						</div>
						<div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                        	<div class="card-body" style="margin: -1%">
								<h6 class="card-subtitle mb-2 text-muted">E-Mail</h6>
                            	<p class="card-text"><?php echo $user["email"]; ?></p>
                        	</div>
						</div>
						<div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                        	<div class="card-body" style="margin: -1%">
								<h6 class="card-subtitle mb-2 text-muted">Fecha de Nacimiento</h6>
                            	<p class="card-text"><?php $fechanacimiento = new DateTime($user["fecha_nacimiento"]); echo $fechanacimiento->format('d-m-Y'); ?></p>
                        	</div>
						</div>
						<div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                        	<div class="card-body" style="margin: -1%">
								<h6 class="card-subtitle mb-2 text-muted">Nacionalidad</h6>
                            	<p class="card-text"><?php echo $user["nacionalidad"]; ?></p>
                        	</div>
						</div>
						<?php if($user["descripcion"]) { echo '
						<div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                        	<div class="card-body" style="margin: -1%">
								<h6 class="card-subtitle mb-2 text-muted">Descripcion</h6>
                            	<p class="card-text">' . $user["descripcion"] . '</p>
                        	</div>
						</div>';} ?>
                    </div>
                </div>
            </div>
		</div> 
	</div>
</body>
</html>