<?php

  include_once '../conexionClass.php';

  class ConexionPantallaPrincipal extends Conexion{

  	function tieneVehiculos($idUser) {
  		if($this->connection){
  			$result = $this->connection->query("SELECT * FROM aventon.vehiculo WHERE idusuario = $idUser");
  			if(mysqli_num_rows($result) == 0) {
  				return false;
  			}
  			return true;
  		}
  	}

    function ultimosViajes($pagina) {
  		if($this->connection) {
  			$ultimoCargado = ($this->ultimoViajeConcretoSegunID()) - ( 20 * $pagina);
  			$ultimoACargar = $ultimoCargado - 20;
  			$result = $this->connection->query("SELECT * FROM viaje vi INNER JOIN viajeconcreto vc ON (vi.idviaje = vc.idviaje) WHERE (vc.idviajeConcreto <= " . $ultimoCargado . ") AND (vc.idviajeConcreto > " . $ultimoACargar . ") ORDER BY vc.idviajeConcreto DESC");
  			return $result;
  		}
  	}

    function ultimoViajeConcretoSegunID(){
      $result = $this->connection->query("SELECT MAX(idviajeConcreto) FROM viajeConcreto");
  		$row = mysqli_fetch_assoc($result);
      return $row["MAX(idviajeConcreto)"];
    }

  }

?>
