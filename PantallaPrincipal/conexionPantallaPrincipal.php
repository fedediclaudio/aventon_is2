<?php

  include_once '../conexionClass.php';

  class ConexionPantallaPrincipal extends Conexion{

  	function tieneVehiculos($idUser) {
			return (mysqli_num_rows($this->consulta("SELECT * FROM aventon.vehiculo WHERE idusuario = $idUser")) != 0);
  	}

    function ultimosViajes($pagina) {
			date_default_timezone_set('America/Buenos_Aires');
			$hoy = date("Y-m-d");
			$hora = date("H:i");
      $ultimoCargado = ($this->ultimoViajeConcretoSegunID()) - ( 20 * $pagina);
      $ultimoACargar = $ultimoCargado - 20;
      return $this->consulta("SELECT * FROM viaje vi INNER JOIN viajeconcreto vc ON (vi.idviaje = vc.idviaje) WHERE ((vc.idviajeConcreto <= " . $ultimoCargado . ") AND (vc.idviajeConcreto > " . $ultimoACargar . ") AND 
			(
				(vc.fechaInicio > (str_to_date('$hoy', '%Y-%m-%d')))
				OR
				(
					(vc.fechaInicio = (str_to_date('$hoy', '%Y-%m-%d')))
					AND
					(vi.horaInicio > (str_to_date('$hora','%H:%i')))
				)
				)) ORDER BY vc.idviajeConcreto DESC");
  	}

    function ultimoViajeConcretoSegunID(){
  		$row = mysqli_fetch_assoc($this->consulta("SELECT MAX(idviajeConcreto) FROM viajeConcreto"));
      return $row["MAX(idviajeConcreto)"];
    }
		
		function ultimosViajesBusqueda($origen ,$destino) {
			$hoy = date("Y-m-d");
			date_default_timezone_set('America/Buenos_Aires');
			$hora = date("H:i");
			return $this->consulta("SELECT * FROM aventon.viaje vi INNER JOIN aventon.viajeconcreto vc ON (vi.idviaje = vc.idviaje) WHERE ((vi.origen = '$origen') AND (vi.destino = '$destino') AND 
			(
				(vc.fechaInicio > (str_to_date('$hoy', '%Y-%m-%d')))
				OR
				(
					(vc.fechaInicio = (str_to_date('$hoy', '%Y-%m-%d')))
					AND
					(vi.horaInicio > (str_to_date('$hora','%H:%i')))
				)
				)) ORDER BY vc.idviajeConcreto DESC");
		}
		
		function misViajesActuales($iduser) {
			$hoy = date("Y-m-d");
			date_default_timezone_set('America/Buenos_Aires');
			$hora = date("H:i");
			return $this->consulta("SELECT * FROM aventon.viaje vi INNER JOIN aventon.viajeconcreto vc ON (vi.idviaje = vc.idviaje) INNER JOIN participacion p ON(p.idviajeconcreto = vc.idviajeconcreto)  WHERE ((p.idusuario = '$iduser') AND 
			(
				(vc.fechaInicio > (str_to_date('$hoy', '%Y-%m-%d')))
				OR
				(
					(vc.fechaInicio = (str_to_date('$hoy', '%Y-%m-%d')))
					AND
					(vi.horaInicio > (str_to_date('$hora','%H:%i')))
				)
				)) ORDER BY vc.idviajeConcreto DESC");
		}
		
		function misViajesPasados($iduser) {
			$hoy = date("Y-m-d");
			date_default_timezone_set('America/Buenos_Aires');
			$hora = date("H:i");
			return $this->consulta("SELECT * FROM aventon.viaje vi INNER JOIN aventon.viajeconcreto vc ON (vi.idviaje = vc.idviaje) INNER JOIN participacion p ON(p.idviajeconcreto = vc.idviajeconcreto)  WHERE ((p.idusuario = '$iduser') AND 
			( 
				(vc.fechaInicio < (str_to_date('$hoy', '%Y-%m-%d'))) 
				OR 
				(
					(vc.fechaInicio = (str_to_date('$hoy', '%Y-%m-%d')))
					AND
					(vi.horaInicio < (str_to_date('$hora','%H:%i'))) 
				)
			)) ORDER BY vc.idviajeConcreto DESC");
		}

  }

?>
