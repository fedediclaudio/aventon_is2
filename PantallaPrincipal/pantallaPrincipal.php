<?php
  include "../chequeoSesion.php";
  include "../chequeoDePago.php";
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
	<?php
			include 'pantallaDeBusqueda.php';
	?>

	<!--input oculto -->
	<input type="hidden" value="<?php if(isset($_GET["viajes"])) { echo $_GET["viajes"]; } else { echo "";} ?>" id="viajesSelector">

	<!-- Nav -->
	
	<ul class="nav justify-content-center " style="background-color:#E0E0E0	">
  <li class="nav-item">
    <a class="nav-link" href="pantallaPrincipal.php">Ultimos viajes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="pantallaPrincipal.php?viajes=misviajes">Mis viajes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="pantallaPrincipal.php?viajes=viajespasados">Viajes Pasados</a>
  </li>
</ul>

	<!-- Cartas de viajes -->
	<div id="viajes" class="row">
				<?php
					if(!isset($_GET["viajes"])) {
						include 'cartaCrearViaje.php';
					}
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
