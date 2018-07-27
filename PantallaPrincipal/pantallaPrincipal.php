<?php
  include "../chequeoSesion.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aventon</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="../bootstrap/jquery.min.js"></script>
  <script src="../bootstrap/popper.min.js"></script>
  <script src="../bootstrap/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
  <script src="CrearViaje/scripts/validacionesAltaDeViaje.js"></script>
  <script src="CrearViaje/scripts/generadorDeArrays.js"></script>
  <script src="CrearViaje/scripts/moment.js"></script>
  <script type="text/javascript" src="../jquery-3.3.1.min.js"></script>
  <script src="cargadeviajes.js"></script>
  <link rel="stylesheet" type="text/css" href="../styles.css">
</head>
<body class="body-general">
  <?php
    include 'conexionPantallaPrincipal.php';
    $conexion = new ConexionPantallaPrincipal();
    $idUser = $_SESSION["id"];
    $tieneVehiculos = $conexion->tieneVehiculos($idUser);
  ?>

	<!-- Navbar -->
	<?php
		include "../vistas/navbar.html";
	?>

	<!-- Cartas de viajes -->
	<div id="viajes" class="row">
        <div class="col col-12 col-md-6 col-lg-4 col-xl-3" style="justify-content:center; display: flex;" >
            <button type="button" class="btn btn-light " id="botonCartaViaje" data-toggle="modal" data-target="<?php if($tieneVehiculos) { echo "#crearViajeModal"; } else { echo "#modalErrorAlCrearViaje"; }  ?>"  >
                    <div style="background-color: #FAFAFA;" >
                        <div style="  ">
                            <h1 class="display-3"><img src="../img/boton_mas.png"></h1>
                        </div>
                    </div>
            </button>
        </div>
		<!-- Aca se cargan las cartas-->
	</div>

	<!-- Modal de creacion de viaje -->
	<?php
		include "CrearViaje/modalCrearViaje.php";
		include "CrearViaje/modalErrorAlCrearViaje.php";
	?>

</body>
</html>
