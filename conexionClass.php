
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


	//mismo método de arriba pero necesitaba que el mail llegue como variable y no por post. se podría refactorizar.
  //SI SEGURO QUE LO VAMOS A HACER... (repondio alguien)
	/*
	hecho
					\(•_•)
				 	  ) )z
				 	 / \
	*/

	function getIdUsuario() {
		session_start();
		$username = $_SESSION['mail'];
		$user =  $this->getUsuario($username);
		$row = mysqli_fetch_assoc($user);
		return $row["id"];
	}

	function getUsuarioLogin($mail, $password){
		$conn = $this->establecerConexion();
		if($conn) {
			$sha1_pass = sha1($password);
			$sql = "SELECT * FROM usuario WHERE email = '$mail' AND password = '$sha1_pass'";
			$result=$conn->query($sql);
			return $result;
		}
		else {return null;}
	}

	function getUsuario($mail){
		$conn = $this->establecerConexion();
		if($conn) {
			$sql = "SELECT * FROM usuario WHERE email = '" . $mail . "'";
			$result=$conn->query($sql);
			return $result;
		}
		else {return null;}
	}

}
?>
