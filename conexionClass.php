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

		function getUsuario($mail){
			if($this->connection) {
				$result = $conn->query("SELECT * FROM usuario WHERE email = '" . $mail . "'");
				return $result;
			}
			return null;
		}

		function getUsuarioLogin($mail, $password){
			if($this->connection) {
				$sha1_pass = sha1($password);
				$result = $this->connection->query("SELECT * FROM usuario WHERE email = '$mail' AND password = '$sha1_pass'");
				return $result;
			}
			return null;
		}

		//mismo método de arriba pero necesitaba que el mail llegue como variable y no por post. se podría refactorizar.
	  //SI SEGURO QUE LO VAMOS A HACER... (repondio alguien)
		/*
		hecho
						\(•_•)
					 	  ) )z
					 	 / \
		*/

	}
?>
