<?php

  include_once '../conexionClass.php';

  class ConexionPantallaPrincipal extends Conexion{

  	function tieneVehiculos($idUser) {
			if(mysqli_num_rows($this->consulta("SELECT * FROM aventon.vehiculo WHERE idusuario = $idUser")) == 0) {
				return false;
			}
			return true;
  	}

    function ultimosViajes($pagina) {
      $ultimoCargado = ($this->ultimoViajeConcretoSegunID()) - ( 20 * $pagina);
      $ultimoACargar = $ultimoCargado - 20;
      return $this->consulta("SELECT * FROM viaje vi INNER JOIN viajeconcreto vc ON (vi.idviaje = vc.idviaje) WHERE (vc.idviajeConcreto <= " . $ultimoCargado . ") AND (vc.idviajeConcreto > " . $ultimoACargar . ") ORDER BY vc.idviajeConcreto DESC");
  	}

    function ultimoViajeConcretoSegunID(){
  		$row = mysqli_fetch_assoc($this->consulta("SELECT MAX(idviajeConcreto) FROM viajeConcreto"));
      return $row["MAX(idviajeConcreto)"];
    }

  }

?>