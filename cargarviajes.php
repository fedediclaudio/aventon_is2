<?php
	include 'conexionClass.php';
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
	    	echo '<div class="col-12 col-md-6 col-lg-4 col-xl-3" style="justify-content:center; display: flex; margin-bottom:10px">';
	        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearViajeModal" id="botonCartaViaje">';
					echo '<div class="card">';
					echo '<div class="card-header">';
					echo $row["origen"] . ' - ' .	$row["destino"];
					echo '</div>';
					echo '<ul class="list-group list-group-flush">';
					echo '<li class="list-group-item">' . $row["fecha"] . '</li>';
					echo '<li class="list-group-item">' . $row["precio"] . '</li>';
					echo '</ul>';
					echo '</div>';
					echo '</button>';
					echo '</div>';
	    }
	}
	
?>