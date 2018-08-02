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
	
	<!-- Pantalla de busqueda  -->
	<div class="row" style="background-color:#EEEEEE	">
		<div class="col col-0 col-md-2 col-lg-3">
		</div>
		<div class="col col-12 col-md-8 col-lg-6">
			<div style="margin:10px;">
				<h4 class="display-4" style="text-align:center"><img src="resources/baseline_search_black_18dp.png"> Busca tu proximo viaje</h4>
			</div>
			<br>
			<form action="buscarviajes.php" method="get">
				<div class="form-row">
    			<div class="form-group col-md-6">
      			<input type="text" name="origen" class="form-control" id="origenInput" placeholder="Origen" value="<?php if((isset($_GET["origen"])) && (isset($_GET["destino"])))  { echo $_GET["origen"];} ?>" required>
					</div>
					<div class="form-group col-md-6">
						<input type="text" name="destino" class="form-control" id="destinoInput" placeholder="Destino" value="<?php if((isset($_GET["origen"])) && (isset($_GET["destino"])))  { echo $_GET["destino"];} ?>" required>
					</div>
					<div class="col" style="justify-content:center; display: flex; margin:10px">
						<button type="submit" class="btn btn-light" >Buscar</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col col-0 col-md-2 col-lg-3"> </div>
	</div>

	<!-- Cartas de viajes -->
	<div id="viajes" class="row">
				<?php if(!isset($_GET["origen"])) { if($tieneVehiculos) { $modal= "#crearViajeModal"; } else { $modal = "#modalErrorAlCrearViaje"; } 
																					 echo '
        <div class="col col-12 col-md-6 col-lg-4 col-xl-3" style="justify-content:center; display: flex;" >
            <button type="button" class="btn btn-light " id="botonCartaViaje" data-toggle="modal" data-target="' . $modal .'"  >
                    <div style="background-color: #FAFAFA;" >
                        <div style="  ">
                            <h1 class="display-3"><img src="../img/boton_mas.png"></h1>
                        </div>
                    </div>
            </button>
        </div>';}
				?>
		<!-- Aca se cargan las cartas-->
	</div>

	<!-- Modal de creacion de viaje -->
	<?php
		include "CrearViaje/modalCrearViaje.php";
		include "CrearViaje/modalErrorAlCrearViaje.php";
	?>

</body>
</html>
