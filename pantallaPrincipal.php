<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aventon</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
  <script src="scripts.js/cargadeviajes.js"></script>
</head>
<body class="body-general">
	<!-- Navbar -->
	<?php
		include "navbar.html"
	?>
	
	<!-- Cartas de viajes -->
	<div id="viajes" class="row">
        <div class="col col-12 col-md-6 col-lg-4 col-xl-3" style="justify-content:center; display: flex;" >
            <button type="button" class="btn btn-light " id="botonCartaViaje" data-toggle="modal" data-target="#crearViajeModal" id="boton-crearViaje; widght:100%; height: 100%">
                    <div style="background-color: #FAFAFA;" >
                        <div style="  ">
                            <h1 class="display-3"><img src="boton_mas.png"></h1>
                        </div>
                    </div>
            </button>
        </div>
		<!-- Aca se cargan las cartas-->
	</div>

	<!-- Modal crear viaje -->
	<?php
		include "modalCrearViaje.html"
	?>
</body>
</html>