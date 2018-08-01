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

		function consulta($sql){
			if($this->connection) {
				return $this->connection->query($sql);
			}
			return null;
		}

		function getUsuarioPorId($idUsuario){
			return $this->consulta("SELECT * FROM usuario WHERE id = '$idUsuario'");
		}

		function getVehiculosPorIdUsuario($idUsuario) {
			return $this->consulta("SELECT * FROM vehiculo v INNER JOIN tipoVehiculo t ON (v.idtipoVehiculo = t.idtipoVehiculo) WHERE v.idusuario = " . $idUsuario);
	  }

		function getUsuarioPorMail($mail){
			return $this->consulta("SELECT * FROM usuario WHERE email = '" . $mail . "'");
		}

		function getUsuarioLogin($mail, $password){
			$sha1_pass = sha1($password);
			return $this->consulta("SELECT * FROM usuario WHERE email = '$mail' AND password = '$sha1_pass'");
		}

		//mismo método de arriba pero necesitaba que el mail llegue como variable y no por post. se podría refactorizar.
	  //SI SEGURO QUE LO VAMOS A HACER... (repondio alguien)
		/*
		hecho
						\(•_•)
					 	  ) )z
					 	 / \
		*/

    	function getLikes($idUser){
    		//acá iría la consulta cuando tengamos reputación en la BD
    		return 14;
    	}
    	function getDislikes($idUser){
    		//acá iría la consulta cuando tengamos reputación en la BD
    		return 3;
    	}


	}

?>
