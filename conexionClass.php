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
				$sql = "INSERT INTO aventon.viaje (origen, destino, fecha, horainicio, horafin, precio, descripcion,idusuario)
				VALUES ( '" . $_POST["origen"] . "', '" . $_POST["destino"] . "', STR_TO_DATE('" . $_POST["fecha"] . "','%Y-%m-%d'), '" .
					$_POST["horainicio"] . "', '" . $_POST["horafin"] . "', '" . $_POST["precio"] . "', '" . $_POST["contacto"] . "', '" . $row["id"] ."')";
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

	function getVehiculos($idUsuario) {
		$conn = $this->establecerConexion();
		if($conn) {
			$result = $conn->query("SELECT * FROM vehiculo WHERE idusuario = " . $idUsuario);
			return $result;
		}
	}

	function crearUsuario() {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$conn = $this->establecerConexion();
			if($conn) {
				$sql = "INSERT INTO aventon.usuario (nombre, apellido, password, descripcion, tarjeta, email, nacionalidad, fecha_nacimiento)
				VALUES ( '" . $_POST["nombre"] . "', '" . $_POST["apellido"] ."', '" . sha1($_POST["passwd"]) . "', '" . $_POST["descripcion"] . "', '" . "" . "', '" . $_POST["mail"] . "', '" . $_POST["nacionalidad"] . "', STR_TO_DATE('" . $_POST["fecha_nacimiento"] . "','%Y-%m-%d')" .")";
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

	function getUsuario($mail){
		$conn = $this->establecerConexion();
		if($conn) {
			$sql = "SELECT * FROM usuario WHERE email = '$mail'";
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
            return nil;
        }
    }
}
?>
