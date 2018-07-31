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

    function imprimirDescripcion($descripcion) {
      if($descripcion) { echo '
        <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
            <div class="card-body" style="margin: -1%">
                <h6 class="card-subtitle mb-2 text-muted">Descripcion del contacto</h6>
                <p class="card-text">' . $descripcion . '</p>
            </div>
        </div>';
      }
    }

    function imprimirParticipaciones($viaje) {
      if($this->viajeEsDeUsuarioActual($viaje)){
        echo '<div class="jumbotron p-3 p-md-5 text-black rounded jumbo-infoviaje" style=" border:1px; border-style:solid; border-color:rgb(13, 71, 161)"	>
          <h4 class="h4">Postulaciones pendientes</h4>';
          $this->imprimirPostulacionesPendientes($viaje);
          $this->imprimirPostulacionesConEstado($viaje,'aceptado');
          $this->imprimirPostulacionesConEstado($viaje,'rechazado');
        echo '</div>';
      } else {
        if($this->usuarioActualEstaPostulado($viaje)){
          $postulacion = mysqli_fetch_assoc($this->participacionesEnViajeDeUsuario($viaje["idviajeConcreto"],$_SESSION["id"]));
          echo "<div class=\"alert alert-info\" role=\"alert\"> Tu postulación para este viaje se encuentra " . $postulacion["estado"];
          if($postulacion["estado"] != 'rechazado') {
            echo "<a href='eliminarPostulacion.php?idviajeConcreto=$viaje[idviajeConcreto]' style='float:right'>Cancelar</a>";
          }
          echo "</div>";
        } else {
          if($this->hayAsientosLibres($viaje)){
            echo "<button type=\"button\"onclick=\"location='postularAViaje.php?idviajeConcreto=".$viaje["idviajeConcreto"]."'\"class=\"btn\" style=\"border-color:rgb(13, 71, 161); float:right\">Postularse</button>";
          } else {
            echo '<div class="alert alert-warning" role="alert"> El viaje esta completo </div>';
          }
        }
      }
    }

    function viajeEsDeUsuarioActual($viaje) {
      return ($_SESSION['id']==$viaje["id"]);
    }

    function usuarioActualEstaPostulado($viaje) {
      return (mysqli_num_rows($this->participacionesEnViajeDeUsuario($viaje["idviajeConcreto"],$_SESSION["id"])) > 0);
    }

    function hayAsientosLibres($viaje) {
      return (mysqli_num_rows($this->participacionesEnViajeConEstado($viaje["idviajeConcreto"],'aceptado')) < $viaje["cantidadAsientos"]);
    }

    function imprimirPostulacionesPendientes($viaje) {
      $result = $this->participacionesEnViajeConEstado($viaje["idviajeConcreto"],'pendiente');
      if (mysqli_num_rows($result) == 0) {
         echo '<p class="lead">No hay postulaciones pendientes en este viaje</p>';
      } else {
        echo '<div class="row">';
        while ($row = mysqli_fetch_assoc($result)) {
          $user = mysqli_fetch_assoc($this->getUsuarioPorId($row["idusuario"]));
          echo '
                
								<div class="col col-12 col-lg-6" style="padding-left:10px; padding-right:10px">
									
                  <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                    <div class="card-body" style="margin: -1%">
                      <div class="row">
                        <div class="col col-7" style="display: flex; align-items: center ">
                          <p class="card-text"><button class="btn btn-link" style="color:black" onclick="location=\'../PantallaPerfilDeUsuario/perfilUsuario?id=' . $row["idusuario"] . '\'">' . $user["nombre"] . " " . $user["apellido"] . '</button></p>';
                        echo '
												</div>';
                          if(mysqli_num_rows($this->participacionesEnViajeConEstado($viaje["idviajeConcreto"],'aceptado')) >= $viaje["cantidadAsientos"]){
                          echo '<div class="alert alert-warning" role="alert">
                                  El viaje esta completo, no puedes aceptar mas postulaciones
                                </div>';
                          } else {

                        echo '<div class="col col-2" style="padding:2px; padding-left:30px">
                          <button type="button" onclick="location=\'cambiarEstadoDePostulacion.php?idviaje='.$viaje["idviajeConcreto"].'&idpostulacion='.$row["idparticipacion"].'&estado=aceptado\'"class="btn btn-outline-success" style="color: black; border-color:#BDBDBD; margin: auto; display: block;">Aceptar</button>
                        	</div>
                        <div class="col col-2" style="padding:2px;padding-left:30px">
                          <button type="button" onclick="location=\'cambiarEstadoDePostulacion.php?idviaje='.$viaje["idviajeConcreto"].'&idpostulacion='.$row["idparticipacion"].'&estado=rechazado\'" class="btn btn-outline-danger" style="color: black; border-color:#BDBDBD; margin: auto; display: block;">Rechazar</button>
                        </div>';
                        }
                          echo 			'
                      </div>
                    </div>
                  </div>
									
                </div>
								
								
              ';
        }
        echo '</div>';
      }
    }

    function imprimirPostulacionesConEstado($viaje, $estado) {
      $result = $this->participacionesEnViajeConEstado($viaje["idviajeConcreto"],$estado);
      if (!(mysqli_num_rows($result) == 0)) {
        echo '<br><h4 class="h4">Postulaciones ' . $estado . 's</h4>
              <div class="row">';
        while ($row = mysqli_fetch_assoc($result)) {
          $user = mysqli_fetch_assoc($this->getUsuarioPorId($row["idusuario"]));
          echo ' <div class="col col-12 col-lg-6">
                  <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                  <div class="card-body" style="margin: -1%">
                    <h6 class="card-subtitle mb-2 text-muted">Usuario</h6>
                    <p class="card-text"><button class="btn btn-link" style="color:black" onclick="location=\'../PantallaPerfilDeUsuario/perfilUsuario?id=' . $row["idusuario"] . '\'">' . $user["nombre"] . " " . $user["apellido"] . '</button></p>
                  </div>
                  </div>
                </div>';
        }
        echo '</div>';
      }
    }

    function eliminarPostulacion($user, $viaje) {
      $this->consulta("DELETE FROM participacion WHERE idviajeConcreto = '$viaje' AND idusuario = '$user'");
    }

    function eliminarViajeConcreto($idViajeConcreto) {
      $this->eliminarTodasLasPostulaciones($idViajeConcreto);
      $idViaje = $this->getIdViajeAbstracto($idViajeConcreto);
      $this->consulta("DELETE FROM viajeconcreto WHERE idviajeConcreto = '$idViajeConcreto'");
      $this->limpiarViajeAbstracto($idViaje);
    }

    function eliminarTodasLasPostulaciones($idViajeConcreto) {
      $this->consulta("DELETE FROM participacion WHERE idviajeConcreto = '$idViajeConcreto'");
    }

    function limpiarViajeAbstracto($idViaje) {
      if (!(mysqli_fetch_assoc($this->consulta("SELECT * FROM viajeconcreto v WHERE v.idviaje = $idViaje")))) {
        $this->eliminarViajeAbstracto($idViaje);
      }
    }

    function eliminarViajeAbstracto($idViaje) {
      $this->eliminarViajesConcretosDe($idViaje);
      $this->consulta("DELETE FROM viaje WHERE idviaje = '$idViaje'");
    }

    function eliminarViajesConcretosDe($idViaje) {
      $viajesConcretos = $this->consulta("SELECT * FROM viajeconcreto WHERE idviaje = $idViaje");
      while($viajeConcreto = mysqli_fetch_assoc($viajesConcretos)) {
        $this->eliminarViajeConcreto($viajeConcreto['idviajeConcreto']);
      }
    }

    function getIdViajeAbstracto($idViajeConcreto) {
      $viaje = mysqli_fetch_assoc($this->fullInfoDeViaje($idViajeConcreto));
      return $viaje["idviaje"];
    }

    function viajeSeRepite($idViaje){
     $sql = "SELECT * FROM viajeconcreto WHERE idviaje = $idViaje";
     //return $sql;
     $result = $this->consulta($sql);
     if(mysqli_num_rows($result) > 1){
      return true;
     }else{
      return false;
     }
    }

  }

?>
