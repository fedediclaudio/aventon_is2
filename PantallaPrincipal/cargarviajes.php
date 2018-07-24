 <?php
	include '../conexionClass.php';
	// Recibe el parametro con la pagina a cargar
	$pagina = $_GET['pagina'];
	// Cargar 20 viajes segun la pagina
	$conn = new conexion();
	$result = $conn->ultimosViajes($pagina);
	// Mostrar los cargados
	if (mysqli_num_rows($result) > 0) {
    	// output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
					//echo $row["idviaje"] . "<br>";
	    	echo '<div class=" col col-12 col-md-6 col-lg-4 col-xl-3" style="justify-content:center; display: flex; margin-bottom:10px; padding:0px">';
	        echo '<button type="button" class="btn btn-light" id="botonCartaViaje" onclick="location=\'../PantallaInfoViaje/informacionViaje.php?id=' . $row["idviajeConcreto"] . '\'">';
					echo '<div class="card">';
					echo '<div class="card-header">';
					echo $row["origen"] . ' - ' .	$row["destino"];
					echo '</div>';
					echo '<ul class="list-group list-group-flush">';
          //$f = new Date($row["vc.fechaInicio"]);
					echo '<li class="list-group-item item-cardviaje" >' . $row["fechaInicio"]/*$f->format('d-m-Y')*/ . '</li>';
					echo '<li class="list-group-item item-cardviaje" >$' . $row["precio"] . '</li>';
					echo '</ul>';
					echo '</div>';
					echo '</button>';
					echo '</div>';
	    }
	}

?>
