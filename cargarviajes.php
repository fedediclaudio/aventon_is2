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
        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearViajeModal" style="widht:25%; color:black; border-color:#FAFAFA; background-color:#FAFAFA">';
				echo '<div class="card " style="width: 18rem; margin:10px;">';
				echo '<div class="card-header">';
				echo $row["origen"] . ' - ' .	$row["destino"];
				echo '</div>';
				echo '<ul class="list-group list-group-flush">';
				echo '<li class="list-group-item">' . $row["fecha"] . '</li>';
				echo '<li class="list-group-item">' . $row["precio"] . '</li>';
				echo '</ul>';
				echo '</div>';
				echo '</button>';
    }
	}
	
?>