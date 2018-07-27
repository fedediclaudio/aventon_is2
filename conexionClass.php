
<?php

class Conexion {
	public $connection = null;

	function __construct(){
		$this->connection = $this->establecerConexion();
	}

	function establecerConexion() {
		$conn = new mysqli("localhost", "root", "", "aventon");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			return null;
		}
		return $conn;
	}

	function getUsuarioPorId($idUsuario){
		if($this->connection) {
			$result = $this->connection->query("SELECT * FROM usuario WHERE id = '$idUsuario'");
			return $result;
		}
	}

	function getVehiculosPorIdUsuario($idUsuario) {
    if($this->connection) {
      $result = $this->connection->query("SELECT * FROM vehiculo v INNER JOIN tipoVehiculo t ON (v.idtipoVehiculo = t.idtipoVehiculo) WHERE v.idusuario = " . $idUsuario);
      return $result;
    }
  }

	function crearViajes() {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$conn = $this->establecerConexion();
			if($conn) {
        //Arreglos de Fechas
				$fechasInicio = json_decode($_POST["fechasInicio"]);
        $fechasFin = json_decode($_POST["fechasFin"]);
        //Se obtiene la hora inicio.
        $hora = $this->obtenerHoraEnFormatoDesdeFecha($fechasInicio[0]);
        //Se Obtiene la hora fin
        $horaF = $this->obtenerHoraEnFormatoDesdeFecha($fechasFin[0]);
        // Creacion del viaje abstracto
        $idViaje = $this->crearViajeAbstracto($conn, $_POST["origen"], $_POST["destino"], $hora, $horaF, $_POST["precio"], $_POST["vehiculo"]);
        // Creacion de los viajes concretos
        for ($i = 0; $i < count($fechasInicio); $i++) {
          $fechaI = explode('T', $fechasInicio[$i]);
          $fechaF = explode('T', $fechasFin[$i]);
          $this->crearViajeConcreto($conn, $fechaI[0], $fechaF[0], $idViaje);
        }
			}
			else { echo "No se pudo establecer la conexion";}
		}
	}

  function obtenerHoraEnFormatoDesdeFecha($fecha) {
    list($dia, $horaCompleta) = explode('T', $fecha);
    list($hora, $minuto) = explode( ':',$horaCompleta);
    return $hora . ':' . $minuto;
  }

  function validarFechasDeViaje($arrayInicio, $arrayFin) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$conn = $this->establecerConexion();
			if($conn) {
        //Arreglos de Fechas
				$fechasInicio = json_decode($arrayInicio);
        $fechasFin = json_decode($arrayFin);
        //Se obtiene la hora inicio.
        $hora = $this->obtenerHoraEnFormatoDesdeFecha($fechasInicio[0]);
        //Se Obtiene la hora fin
        $horaF = $this->obtenerHoraEnFormatoDesdeFecha($fechasFin[0]);
        session_start();
        $mail = $_SESSION["mail"];
        for ($i = 0; $i < count($fechasInicio); $i++) {
          $fechaI = explode('T', $fechasInicio[$i]);
          $fechaF = explode('T', $fechasFin[$i]);
          $sql = "SELECT * FROM viaje vi INNER JOIN vehiculo ve ON (vi.idvehiculo = ve.idvehiculo) INNER JOIN viajeconcreto vc ON (vi.idviaje = vc.idviaje) INNER JOIN usuario u ON ( u.id = ve.idusuario) WHERE ( u.email = '$mail' ) AND ( ( STR_TO_DATE( '$fechaF[0]' ,'%Y-%m-%d') >= vc.fechaInicio ) AND ( ( STR_TO_DATE('$fechaI[0]' ,'%Y-%m-%d') <= vc.fechaFin ) ) )";
					$result = $conn->query($sql);
          if (mysqli_num_rows($result) > 0) {
   		       return false;
		      }
        }
        return true;
      }
    }
  }

  function crearViajeAbstracto($conn, $origen, $destino, $horaInicio, $horaFin, $precio, $idVehiculo) {
    $sql = "INSERT INTO aventon.viaje (origen, destino, horaInicio, horaFin, precio, idvehiculo) VALUES ( '$origen' , '$destino' , STR_TO_DATE( '$horaInicio' , '%H:%i') , STR_TO_DATE( '$horaFin' , '%H:%i') , '$precio'  , '$idVehiculo' )";
    $this->ejecutarInsert($conn, $sql);
    return $this->ultimoViajeSegunID($conn);
  }

  function crearViajeConcreto($conn, $fechaInicio, $fechaFin, $idViaje) {
    $sql = "INSERT INTO aventon.viajeConcreto (fechaInicio, fechaFin, idViaje) VALUES ( STR_TO_DATE('$fechaInicio','%Y-%m-%d') , STR_TO_DATE('$fechaFin', '%Y-%m-%d') , '$idViaje')";
    $this->ejecutarInsert($conn, $sql);
  }

  function ejecutarInsert($conn , $sql ){
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
		} else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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

  function getIdUsuario() {
    session_start();
    $username = $_SESSION['mail'];
		$user =  $this->getUsuario($username);
    $row = mysqli_fetch_assoc($user);
    return $row["id"];
  }

  function ultimoViajeSegunID($conn){
    $result = $conn->query("SELECT MAX(idviaje) FROM viaje");
		$row = mysqli_fetch_assoc($result);
    return $row["MAX(idviaje)"];
  }

  function ultimoViajeConcretoSegunID($conn){
    $result = $conn->query("SELECT MAX(idviajeConcreto) FROM viajeConcreto");
		$row = mysqli_fetch_assoc($result);
    return $row["MAX(idviajeConcreto)"];
  }

	function ultimosViajes($pagina) {
		$conn = $this->establecerConexion();
		if($conn) {
			$ultimoCargado = ($this->ultimoViajeConcretoSegunID($conn)) - ( 20 * $pagina);
			$ultimoACargar = $ultimoCargado - 20;
			$result = $conn->query("SELECT * FROM viaje vi INNER JOIN viajeconcreto vc ON (vi.idviaje = vc.idviaje) WHERE (vc.idviajeConcreto <= " . $ultimoCargado . ") AND (vc.idviajeConcreto > " . $ultimoACargar . ") ORDER BY vc.idviajeConcreto DESC");
			return $result;
		}
	}


	//mismo método de arriba pero necesitaba que el mail llegue como variable y no por post. se podría refactorizar.
  //SI SEGURO QUE LO VAMOS A HACER... (repondio alguien)
	/*
	hecho
					\(•_•)
					 ) )z
				 	/ \
	*/

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
			$sql = "SELECT * FROM usuario WHERE email = '" . $mail . "'";
			$result=$conn->query($sql);
			return $result;
		}
		else {return nil;}
	}

	// Devuelve si un usuario tiene o no vehiculos, para mostrar el modal de cracion de viaje
	function tieneVehiculos($idUser) {
		$conn = $this->establecerConexion();
		if($conn){
			$sql = "SELECT * FROM aventon.vehiculo WHERE idusuario = $idUser";
			$result = $conn->query($sql);
			$conn->close();
			if(mysqli_num_rows($result) == 0) {
				return false;
			}
			else { return true; }
		}
	}

}
?>
