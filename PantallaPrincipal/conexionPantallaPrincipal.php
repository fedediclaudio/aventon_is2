<?php

  include_once '../conexionClass.php';

  class ConexionPantallaPrincipal extends Conexion{

  	function tieneVehiculos($idUser) {
			return (mysqli_num_rows($this->consulta("SELECT * FROM aventon.vehiculo WHERE idusuario = $idUser")) != 0);
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
		
		function ultimosViajesBusqueda($origen ,$destino) {
			return $this->consulta("SELECT * FROM aventon.viaje v INNER JOIN aventon.viajeconcreto vc ON (v.idviaje = vc.idviaje) WHERE (v.origen = '$origen') AND (v.destino = '$destino') ORDER BY vc.idviajeConcreto DESC");
		}
		
		function misViajesActuales($iduser) {
			$hoy = date("Y-m-d");
			return $this->consulta("SELECT * FROM aventon.viaje vi INNER JOIN aventon.viajeconcreto vc ON (vi.idviaje = vc.idviaje) INNER JOIN participacion p ON(p.idviajeconcreto = vc.idviajeconcreto)  WHERE ((p.idusuario = '$iduser') AND (vc.fechaInicio >= (str_to_date('$hoy', '%Y-%m-%d')))) ORDER BY vc.idviajeConcreto DESC");
		}
		
		function misViajesPasados($iduser) {
			$hoy = date("Y-m-d");
			return $this->consulta("SELECT * FROM aventon.viaje vi INNER JOIN aventon.viajeconcreto vc ON (vi.idviaje = vc.idviaje) INNER JOIN participacion p ON(p.idviajeconcreto = vc.idviajeconcreto)  WHERE ((p.idusuario = '$iduser') AND (vc.fechaInicio < (str_to_date('$hoy', '%Y-%m-%d')))) ORDER BY vc.idviajeConcreto DESC");
		}

  }

?>
