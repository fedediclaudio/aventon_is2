<?php
  include '../conexionClass.php';

  class ConexionInfoViaje extends Conexion{

    function fullInfoDeViaje($id) {
      return $this->consulta("SELECT * FROM viaje vi INNER JOIN vehiculo ve ON (vi.idvehiculo = ve.idvehiculo) INNER JOIN viajeconcreto vc ON (vi.idviaje = vc.idviaje) INNER JOIN usuario u ON (ve.idusuario = u.id) INNER JOIN tipoVehiculo tV ON (ve.idtipoVehiculo = tV.idtipoVehiculo) WHERE vc.idviajeConcreto = '$id'");
    }

    function participacionesEnViajeConEstado($idViaje, $estado){
  		return $this->consulta("SELECT * FROM participacion p WHERE p.idviajeConcreto = '$idViaje' AND p.estado = '$estado'");
  	}

    function participacionesEnViajeDeUsuario($idViaje,$idUsuario){
  		return $this->consulta("SELECT * FROM participacion p WHERE p.idviajeConcreto = $idViaje AND p.idusuario = $idUsuario");
  	}

    function postularAViaje($iduser, $viaje) {
      mysqli_query($this->connection, "INSERT INTO aventon.participacion (idviajeConcreto, idusuario) VALUES ('$viaje', '$iduser')");
    }

    function cambiarEstadoParticipacionEnViaje($idparticipacion, $estado) {
      mysqli_query($this->connection, "UPDATE participacion SET estado = '$estado' WHERE (participacion.idparticipacion = '$idparticipacion')");
    }

  }

?>
