 <?php
	include 'conexionPantallaPrincipal.php';
	// Recibe el parametro con la pagina a cargar
	$pagina = $_GET['pagina'];
	// Cargar 20 viajes segun la pagina
	$conexion = new ConexionPantallaPrincipal();
	if(!isset($_GET["viajes"])) {
		if(!isset($_GET["origen"])) {
			$result = $conexion->ultimosViajes($pagina);
		} else {
			$result = $conexion->ultimosViajesBusqueda($_GET["origen"], $_GET["destino"]);
		}
	} else {
		if($_GET["viajes"] == "misviajes") {
			session_start();
			$result = $conexion->misViajesActuales($_SESSION["id"]);
		} else {
			if($_GET["viajes"] == "viajespasados") {
				session_start();
				$result = $conexion->misViajesPasados($_SESSION["id"]);
			} else {
				$result = $conexion->ultimosViajes($pagina);
			}
		}
	}
	// Mostrar los cargados
	if (mysqli_num_rows($result) > 0) {
    	// output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	    	echo '<div class=" col col-12 col-md-6 col-lg-4 col-xl-3" style="justify-content:center; display: flex; margin-bottom:10px; padding:0px">';
	        echo '<button type="button" class="btn btn-light" id="botonCartaViaje" onclick="location=\'../PantallaInfoViaje/informacionViaje.php?id=' . $row["idviajeConcreto"] . '\'">';
  					echo '<div class="card">';
  					  echo '<div class="card-header">';
  					    echo $row["origen"] . ' - ' .	$row["destino"];
  					  echo '</div>';
    					echo '<ul class="list-group list-group-flush">';
    				    echo '<li class="list-group-item item-cardviaje" >' . $row["fechaInicio"]/*$f->format('d-m-Y')*/ . '</li>';
    					  echo '<li class="list-group-item item-cardviaje" >$' . $row["precio"] . '</li>';
    					echo '</ul>';
  					echo '</div>';
					echo '</button>';
				echo '</div>';
	    }
	} else {
		echo '<div class="col-12"><h1 align="center" class="h4">No se encontraron viajes para tu busqueda</h1></div>';
	}

?>
