<?php

class conexion {
	
	function establecerConexion() {
		$conn = new mysqli("localhost", "root", "", "aventon");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error); 
			return null;
		} 
		else { return $conn; }
	}
	
	
	function crearViaje() {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$conn = $this->establecerConexion();
			if($conn) {
				$sql = "INSERT INTO aventon.viaje (origen, destino, fecha, horainicio, horafin, precio, descripcion)
				VALUES ( '" . $_POST["origen"] . "', '" . $_POST["destino"] . "', STR_TO_DATE('" . $_POST["fecha"] . "','%Y-%m-%d'), '" .
					$_POST["horainicio"] . "', '" . $_POST["horafin"] . "', '" . $_POST["precio"] . "', '" . $_POST["contacto"] . "')";
				 if (mysqli_query($conn, $sql)) {
				echo "New record created successfully";
				} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				} 
				$conn->close();
			} 	
			else { echo "no";}
		}
	}
	
	function ultimosViajes($pagina) {
	$conn = $this->establecerConexion();
	if($conn) {
		$result = $conn->query("SELECT MAX(idviaje) FROM viaje");
		$row = mysqli_fetch_assoc($result);
		$ultimoCargado = $row["MAX(idviaje)"] - ( 20 * $pagina);
		$ultimoACargar = $ultimoCargado - 20;
		$result = $conn->query("SELECT * FROM viaje WHERE (idviaje <= " . $ultimoCargado . ") AND (idviaje > " . $ultimoACargar . ") ORDER BY idviaje DESC");
		return $result;
	}
	}
}
?>