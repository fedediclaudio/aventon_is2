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
			return false;
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



	function getReputacion($idUsuario){

      $sql = "SELECT * FROM usuario u inner join vehiculo v on (u.id = v.idusuario) inner join viaje vi on (vi.idvehiculo = v.idvehiculo) inner join viajeconcreto vic on (vic.idviaje = vi.idviaje) inner join participacion p on (p.idviajeConcreto = vic.idViajeConcreto) where u.id = '$idUsuario' and p.calificacion is not null";
      	  $result = $this->consulta($sql);
      	  $sql = $this->consulta("SELECT * FROM usuario where id = '$idUsuario'");
      	  $row = mysqli_fetch_assoc($sql);
      	  $negativos = $row['negativosExtra'];
      	  $reputacion;
      	  $reputacion['likes'] = 0;
      	  $reputacion['dislikes'] = 0;
      	  while($row = mysqli_fetch_assoc($result)){
      	  	if($row['calificacion'] != null){
      	  		if($row['calificacion'] == 1){
      	  			$reputacion['likes']++;
      	  		}elseif($row['calificacion'] == 0){
      	  			$reputacion['dislikes']++;
      	  		}
      	  	}
      	  }
      	  $reputacion['dislikes']+=$negativos;
      	  return $reputacion;

    }

		function viajeFinalizado($idViajeConcreto) {
			$fechaHora = mysqli_fetch_assoc($this->consulta("SELECT fechaInicio, horaInicio FROM viajeconcreto vc INNER JOIN viaje v ON (vc.idviaje = v.idviaje) WHERE idviajeConcreto = $idViajeConcreto"));
			$fecha = new DateTime($fechaHora["fechaInicio"].$fechaHora["horaInicio"]);
			if($fecha < new DateTime()) {
			    return true;
			}
			return false;
		}

		function getDeudas() {
			date_default_timezone_set('America/Buenos_Aires');
			$result = $this->consulta("SELECT * FROM usuario u INNER JOIN participacion p ON (u.id = p.idusuario) INNER JOIN viajeconcreto v ON (p.idviajeConcreto = v.idviajeConcreto) INNER JOIN viaje vi ON (v.idviaje = vi.idviaje) WHERE id = '$_SESSION[id]' AND pago = '0'");
			$deudas = array();
			while ($each = mysqli_fetch_assoc($result)) {
				if($each["fechaInicio"] < date("Y-m-d", mktime(0,0,0,date("m"),date("d")-7,date("Y")))){
					array_push($deudas,$each);
				}
			}
			return $deudas;
		}

		function esDeudor() {
			if (!isset($_SESSION["id"])) {
				    session_start();
				}
			$deudas = $this->getDeudas();
			if (sizeof($deudas)> 0) {
				return true;
			}
			return false;
		}

		function cantidadAsientosOcupados($viaje) {
			$cantidadOcupados = mysqli_fetch_assoc($this->consulta("SELECT SUM(cantidad) FROM viajeconcreto vc INNER JOIN participacion p ON (vc.idviajeConcreto = p.idviajeConcreto) WHERE ((p.estado = 'aceptada') AND (vc.idviajeConcreto = '" . $viaje["idviajeConcreto"] . "'))"));
			return ($cantidadOcupados["SUM(cantidad)"]);
		}

		function cantidadDeAsientosReservadosPorUsuario($idviajeConcreto, $idUsuario){
			$sql= "SELECT * FROM viajeconcreto vc inner join participacion p on (vc.idviajeConcreto = p.idviajeConcreto) WHERE p.idviajeConcreto = '$idviajeConcreto'";
			$participacion = mysqli_fetch_assoc($this->consulta($sql));
			return $participacion["cantidad"];
		}

    function precioDeViajePorUsuario($viaje) {
      return (($viaje["precio"]*1.10/($this->cantidadAsientosOcupados($viaje)+1))*$this->cantidadDeAsientosReservadosPorUsuario($viaje["idviajeConcreto"],$_SESSION["id"]));
    }

	}

?>
