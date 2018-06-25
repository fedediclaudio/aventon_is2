<?php
  include "chequeoSesion.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aventon</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="bootstrap/jquery.min.js"></script>
  <script src="bootstrap/popper.min.js"></script>
  <script src="bootstrap/bootstrap.min.js"></script>
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
  <script src="scripts.js/validacionesAltaDeViaje.js"></script>
  <script src="scripts.js/generadorDeArrays.js"></script>
  <script src="scripts.js/moment.js"></script>
  <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
  <script src="scripts.js/cargadeviajes.js"></script>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body class="body-general">

	<!-- Navbar -->
	<?php
		include "vistas/navbar.html";
	?>

	<!-- Cartas de viajes -->
	<div id="viajes" class="row">
        <div class="col col-12 col-md-6 col-lg-4 col-xl-3" style="justify-content:center; display: flex;" >
            <button type="button" class="btn btn-light " id="botonCartaViaje" data-toggle="modal" data-target="#crearViajeModal" id="boton-crearViaje; widght:100%; height: 100%">
                    <div style="background-color: #FAFAFA;" >
                        <div style="  ">
                            <h1 class="display-3"><img src="img/boton_mas.png"></h1>
                        </div>
                    </div>
            </button>
        </div>
		<!-- Aca se cargan las cartas-->
	</div>

	<!-- Modal crear viaje -->
	<?php
		include "vistas/modalCrearViaje.php"
	?>

</body>
</html>
