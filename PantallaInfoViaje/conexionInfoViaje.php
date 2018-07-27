<?php
  include '../conexionClass.php';

  class ConexionInfoViaje extends Conexion{

    function fullInfoDeViaje($id) {
      if($this->connection) {
          $result = $this->connection->query("SELECT * FROM viaje vi INNER JOIN vehiculo ve ON (vi.idvehiculo = ve.idvehiculo) INNER JOIN viajeconcreto vc ON (vi.idviaje = vc.idviaje) INNER JOIN usuario u ON (ve.idusuario = u.id) INNER JOIN tipoVehiculo tV ON (ve.idtipoVehiculo = tV.idtipoVehiculo) WHERE vc.idviajeConcreto = '$id'" );
          return $result;
      }
      return null;
    }

    function participacionesEnViajeConEstado($idViaje, $estado){
  		if($this->connection) {
  			$result = $this->connection->query("SELECT * FROM participacion p WHERE p.idviajeConcreto = '$idViaje' AND p.estado = '$estado'");
  			return $result;
  		}
  		return null;
  	}

    function participacionesEnViajeDeUsuario($idViaje,$idUsuario){
  		if($this->connection) {
  			$result = $this->connection->query("SELECT * FROM participacion p WHERE p.idviajeConcreto = $idViaje AND p.idusuario = $idUsuario");
  			return $result;
  		}
  		return null;
  	}

    function postularAViaje($iduser, $viaje) {
  		if($this->connection) {
        if (mysqli_query($this->connection, "INSERT INTO aventon.participacion (idviajeConcreto, idusuario) VALUES ('$viaje', '$iduser')")) {
  			     echo "New record created successfully";
        }
      }
    }

    function cambiarEstadoParticipacionEnViaje($idparticipacion, $estado) {
      if($this->connection) {
        if (mysqli_query($this->connection, "UPDATE participacion SET estado = '$estado' WHERE (participacion.idparticipacion = '$idparticipacion')")) {
  				echo "Record update successfully";
        }
      }
    }

  }

?>
