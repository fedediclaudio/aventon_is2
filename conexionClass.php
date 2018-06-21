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
			session_start();
			$username = $_SESSION['mail'];
			$conn = new conexion();
			$user =  $conn->getUsuario($username);
			$row = mysqli_fetch_assoc($user);
			$conn = $this->establecerConexion();
			if($conn) {
				$fechaInicio = date("Y-m-d H:i:s", strtotime($_POST["fechaInicio"]));
				$fechaFin = date("Y-m-d H:i:s", strtotime($_POST["fechaFin"]));
				if($this->fechaValida($conn, $fechaInicio, $fechaFin, $row["id"])){
					$sql = "INSERT INTO aventon.viaje (origen, destino, fechaInicio, fechaFin, precio, descripcion, idusuario)
					VALUES ( '" . $_POST["origen"] . "', '" . $_POST["destino"] . "', '" . $fechaInicio .
						"', '" . $fechaFin . "', '" . $_POST["precio"] . "', '" . $_POST["contacto"] . "', '" . $row["id"] . "')";
					 if (mysqli_query($conn, $sql)) {
					echo "New record created successfully";
					} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
				} else {echo "fecha inválida";}
				$conn->close();
			}
			else { echo "no";}
		}
	}

	function fechaValida($conn, $fechaInicio, $fechaFin, $idUsuario){
		if($conn){
			$sql = "SELECT * FROM aventon.viaje WHERE (idusuario = " . $idUsuario .") AND (('$fechaInicio' > fechaInicio AND '$fechaInicio' < fechaFin) OR ('$fechaInicio' < fechaInicio AND '$fechaFin' > fechaFin) OR ('$fechaFin' > fechaInicio AND '$fechaFin' < fechaFin) OR ('$fechaInicio' = fechaInicio) OR ('$fechaFin' = fechaFin))";
			$viajes = $conn->query($sql);
			if(mysqli_num_rows($viajes) == 0){
				return true;
			}
			else{
				return false;
			}
		}
	}

  function crearVehiculo() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		  $conn = $this->establecerConexion();
      $sql = "INSERT INTO aventon.vehiculo (marca, modelo, patente, cantidadAsientos, idusuario, idtipoVehiculo) VALUES ('" . $_POST["marca"] . "', '" . $_POST["modelo"] . "', '" . $_POST["patente"] . "', '" . $_POST["cantidadAsientos"] . "', '" . $this->getIdUsuario() ."', '" . $_POST["tipo"] . "' )";
      if (mysqli_query($conn, $sql)) {
				echo "New record created successfully";
		  } else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		  }
		  $conn->close();
    }
  }

  function getIdUsuario() {
    session_start();
    $username = $_SESSION['mail'];
		$user =  $this->getUsuario($username);
    $row = mysqli_fetch_assoc($user);
    return $row["id"];
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

	function crearUsuario() {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$conn = $this->establecerConexion();
			if($conn) {
				if($this->validarMailUnico($conn)){
					$sql = "INSERT INTO aventon.usuario (nombre, apellido, password, descripcion, tarjeta, email, nacionalidad, fecha_nacimiento)
					VALUES ( '" . $_POST["nombre"] . "', '" . $_POST["apellido"] ."', '" . sha1($_POST["passwd"]) . "', '" . $_POST["descripcion"] . "', '" . "" . "', '" . $_POST["mail"] . "', '" . $_POST["nacionalidad"] . "', STR_TO_DATE('" . $_POST["fecha_nacimiento"] . "','%Y-%m-%d')" .")";
					if (mysqli_query($conn, $sql)) {
						echo "New record created successfully";
					} else {
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
					$conn->close();
					return True;
				} else {
					$conn->close();
					return False;
				}
			}
			else {
				echo "Error de conexion";
			}
		}
	}

	function validarMailUnico($conn){
		$sql = "SELECT * FROM usuario WHERE email = '" . $_POST["mail"] . "'";
		$result=$conn->query($sql);
		if (mysqli_num_rows($result) == 0) {
   		return true;
		} else {
				return False;
		}
	}

	function getUsuarioLogin($mail, $password){
		$conn = $this->establecerConexion();
		if($conn) {
			$sha1_pass = sha1($password);
			$sql = "SELECT * FROM usuario WHERE email = '$mail' AND password = '$sha1_pass'";
			$result=$conn->query($sql);
			return $result;
		}
		else {return nil;}
	}

	function getVehiculos($idUsuario) {
    $conn = $this->establecerConexion();
    if($conn) {
      $result = $conn->query("SELECT * FROM vehiculo v INNER JOIN tipoVehiculo t ON (v.idtipoVehiculo = t.idtipoVehiculo) WHERE v.idusuario = " . $idUsuario);
      return $result;
    }
  }

	function getUsuario($mail){
		$conn = $this->establecerConexion();
		if($conn) {
			$sql = "SELECT * FROM usuario WHERE email = '" . $mail . "'";
			$result=$conn->query($sql);
			return $result;
		}
		else {return nil;}
	}

	function getUsuarioPorId($id){
		$conn = $this->establecerConexion();
		if($conn) {
			$sql = "SELECT * FROM usuario WHERE id = '$id'";
			$result=$conn->query($sql);
			return $result;
		}
		else {return nil;}
	}

    function informacionDeUnViaje($id) {
        $conn = $this->establecerConexion();
        if($conn) {
            $result = $conn->query("SELECT * FROM aventon.viaje WHERE idviaje = " . $id );
            return $result;
        }
        else {
            return null;
        }
    }
  
  function getTiposVehiculos() {
    $conn = $this->establecerConexion();
    if($conn) {
      $result = $conn->query("SELECT * FROM aventon.tipoVehiculo");
      return $result;
    }
    else {
      return null;
    }
  }
}
?>
