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

    function postularAViaje($iduser, $viaje, $cantidad) {
      mysqli_query($this->connection, "INSERT INTO aventon.participacion (idviajeConcreto, idusuario, cantidad) VALUES ('$viaje', '$iduser', '$cantidad')");
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

    function imprimirParticipacionesOAviso($viaje){
      if (!$this->viajeFinalizado($viaje["idviajeConcreto"])){
        $this->imprimirParticipaciones($viaje);
      }else{
        $this->imprimirAvisoDeViajeRealizado($viaje);
      }
    }

    function imprimirAvisoDeViajeRealizado($viaje){
      if(!$this->viajeEsDeUsuarioActual($viaje)){
          echo '<div class="alert alert-warning"> <strong>Aviso:</strong> El viaje ya comenzó </div>';
        }
    }

    function imprimirParticipaciones($viaje) {
      if($this->viajeEsDeUsuarioActual($viaje)){
        echo '<div class="jumbotron p-3 p-md-5 text-black rounded jumbo-infoviaje" style=" border:1px; border-style:solid; border-color:rgb(13, 71, 161)" >
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
						$cantidadDeAsientosLibres = $this->cantidadAsientosLibres($viaje);
						echo " <form action=\"postularAViaje.php\" method=\"get\"> <div class=\"row\"> <div class=\"col col-0 col-sm-6 col-lg-8\"> <input type=\"hidden\" name=\"idviajeConcreto\" value=\"". $viaje["idviajeConcreto"] . "\"></input> </div> <div class=\" col col-6 col-sm-3 col-lg-2 form-group\">
    								<label for=\"exampleFormControlSelect1\">Cantidad</label>
										<select class=\"form-control\" name=\"cantidad\">";
											for($i=1; $i <= $cantidadDeAsientosLibres; $i++){
												echo "<option>$i</option>";
											}
						echo "	</select>
									</div>";
            echo "<div class=\"col col-6 col-sm-3 col-lg-2 form-group\"><button class=\"btn btn-light\" type=\"submit\" style=\"border-color:rgb(13, 71, 161); float:right\">Postularse</button></div> </div></form>";
          } else {
            echo '<div class="alert alert-warning" role="alert"> El viaje esta completo </div>';
          }
        }
      }
    }

		function cantidadAsientosLibres($viaje) {
			$cantidadOcupados = mysqli_fetch_assoc($this->consulta("SELECT SUM(cantidad) FROM viajeconcreto vc INNER JOIN participacion p ON (vc.idviajeConcreto = p.idviajeConcreto) WHERE ((p.estado = 'aceptado') AND (vc.idviajeConcreto = '" . $viaje["idviajeConcreto"] . "'))"));
			return ($viaje["cantidadAsientos"] - $cantidadOcupados["SUM(cantidad)"]);
		}

    function cantidadAsientosOcupados($viaje) {
			$cantidadOcupados = mysqli_fetch_assoc($this->consulta("SELECT SUM(cantidad) FROM viajeconcreto vc INNER JOIN participacion p ON (vc.idviajeConcreto = p.idviajeConcreto) WHERE ((p.estado = 'aceptado') AND (vc.idviajeConcreto = '" . $viaje["idviajeConcreto"] . "'))"));
			return ($cantidadOcupados["SUM(cantidad)"]);
		}

    function viajeEsDeUsuarioActual($viaje) {
      return ($_SESSION['id']==$viaje["id"]);
    }

    function usuarioActualEstaPostulado($viaje) {
      return (mysqli_num_rows($this->participacionesEnViajeDeUsuario($viaje["idviajeConcreto"],$_SESSION["id"])) > 0);
    }

    function hayAsientosLibres($viaje) {
			$cantidadOcupados = mysqli_fetch_assoc($this->consulta("SELECT SUM(cantidad) FROM viajeconcreto vc INNER JOIN participacion p ON (vc.idviajeConcreto = p.idviajeConcreto) WHERE ((p.estado = 'aceptado') AND (vc.idviajeConcreto = '" . $viaje["idviajeConcreto"] . "'))"));
      return ($cantidadOcupados["SUM(cantidad)"] < $viaje["cantidadAsientos"]);
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
                          <p class="card-text"><button class="btn btn-link" style="color:black" onclick="location=\'../PantallaPerfilDeUsuario/perfilUsuario?id=' . $row["idusuario"] . '\'">' . $user["nombre"] . " " . $user["apellido"] . '</button> ('. $row["cantidad"] .')</p>';
                        echo '
												</div>';
                          if(($this->cantidadAsientosLibres($viaje)) < $row["cantidad"]){


                          echo '<div class="alert alert-warning" role="alert">
                                  No hay suficiente espacio para aceptar esta postulacion
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
                  <div class="card-body row" style="margin: -1%">
										<div class="col col-10" style="display: flex; align-items: left ">
                    	<p class="card-text"><button class="btn btn-link" style="color:black" onclick="location=\'../PantallaPerfilDeUsuario/perfilUsuario?id=' . $row["idusuario"] . '\'">' . $user["nombre"] . " " . $user["apellido"] . '</button></p>
										</div>
										<div class="col col-2">
											<button type="button" onclick="location=\'cambiarEstadoDePostulacion.php?idviaje='.$viaje["idviajeConcreto"].'&idpostulacion='.$row["idparticipacion"].'&estado=pendiente\'" class="btn btn-outline-danger" style="color: black; border-color:#BDBDBD; margin: auto; display: block; ">Quitar</button>
										</div>
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

    function imprimirPreguntasYRespuestas($viaje){
      echo '<h3>Últimas preguntas</h3>';
      $result = $this->getPreguntasYRespuestas($viaje['idviajeConcreto']);
      while($pregYRta = mysqli_fetch_assoc($result)){
          if($pregYRta['respuesta']){
            echo '<div class="card card-infoviaje" style="width:100%; margin-top: 4px;">';
            echo  '<div class="card-body" style="margin: -1%">';
            echo   '<h6 class="card-subtitle mb-2 text-muted">Pregunta</h6>';
            echo   '<p class="card-text">' . $pregYRta['pregunta'] . '</p>';
            echo   '<h6 class="card-subtitle mb-2 text-muted">Respuesta</h6>';
            echo   '<p class="card-text">' . $pregYRta['respuesta'] . '</p>';
            echo  '</div>';
            echo '</div>';
          }else {
            if($_SESSION['id'] != $viaje['idusuario']){
              echo '<div class="card card-infoviaje" style="width:100%; margin-top: 4px;">';
              echo  '<div class="card-body" style="margin: -1%">';
              echo   '<h6 class="card-subtitle mb-2 text-muted">Pregunta</h6>';
              echo   '<p class="card-text">' . $pregYRta['pregunta'] . '</p>';
              echo   '<h6 class="card-subtitle mb-2 text-muted">Respuesta</h6>';
              echo '<p class="card-text"> <small><em> Aún sin responder </em></small> </p>';
              echo  '</div>';
              echo '</div>';
            }else{

              echo '<div class="card card-infoviaje" style="width:100%; margin-top: 4px;">';
              echo  '<div class="card-body" style="margin: -1%">';
              echo   '<h6 class="card-subtitle mb-2 text-muted">Pregunta</h6>';
              echo   '<p class="card-text">' . $pregYRta['pregunta'] . '</p>';
              echo   '<h6 class="card-subtitle mb-2 text-muted">Respuesta</h6>';
              echo '<form action="./enviarRespuesta.php">';
              echo '<div class="form-group">';
              echo  '<input type="hidden" name="idviajeConcreto" value="' . $viaje['idviajeConcreto'] . '">';
              echo  '<input type="hidden" name="idpregunta" value="'. $pregYRta['idpregunta'] .'">';
              echo  '<textarea class="form-control" rows="2" name="respuesta" placeholder="Escriba una respuesta..."> </textarea>';
              echo '</div>';
              echo '<button type="submit" class="btn" style="border-color:rgb(13, 71, 161); float:right">Responder</button>';
              echo '</form>';
              echo  '</div>';
              echo '</div>';
            }
          }
        }

      }

    function getPreguntasYRespuestas($idViaje){
      $sql = "SELECT * FROM pregunta p WHERE p.idviajeConcreto = $idViaje ORDER BY p.idpregunta DESC";
      return $this->consulta($sql);
    }

    function imprimirHazNuevaPregunta($viaje){
      echo '<br>';
      echo  '<div class="container">';
      echo    '<h3>Hazle una pregunta al conductor</h3>';
      echo    '<form action="./hacerPregunta.php" method="get">';
      echo      '<div class="form-group">';
      echo        '<input type="hidden" name="idviajeConcreto" value= "' . $viaje['idviajeConcreto'] . '">';
      echo        '<textarea class="form-control" rows="3" name="pregunta" id="comment"></textarea>';
      echo      '</div>';
      echo      '<button type="submit" class="btn" style="border-color:rgb(13, 71, 161); float:right">Preguntar</button>';
      echo    '</form>';
      echo  '</div>';
      echo  '<br>';
    }

    function getIDUsuarioDeVehiculo($idvehiculo){
      $sql = "SELECT * FROM vehiculo WHERE idvehiculo = $idvehiculo";
      $result = $this->consulta($sql);
      $rows = mysqli_fetch_assoc($result);
      return $rows['idusuario'];
    }

    function precioDeViajePorUsuario($viaje) {
      return ($viaje["precio"]*1.10/$this->cantidadAsientosOcupados($viaje));
    }

    function pagarViaje($idUsuario,$idViajeConcreto) {
      $participacion = mysqli_fetch_assoc($this->participacionesEnViajeDeUsuario($idViajeConcreto,$idUsuario));
      $this->consulta("UPDATE 'participacion' SET 'pago' = '1' WHERE 'idparticipacion' = $participacion[idparticipacion];");
    }

    function estaPago($idUsuario,$idViajeConcreto) {
      $participacion = mysqli_fetch_assoc($this->participacionesEnViajeDeUsuario($idViajeConcreto,$idUsuario));
      return $participacion["pago"];
    }

    function imprimirSeccionPreguntas($viaje){
      echo '<h3 class="display-4">Preguntas</h3>';
      if($_SESSION['id'] != $this->getIDUsuarioDeVehiculo($viaje['idvehiculo'])){
        $this->imprimirHazNuevaPregunta($viaje);                      
      }
      $this->imprimirPreguntasYRespuestas($viaje);
    }

    function imprimirSeccionResenias($viaje){

     echo '<h3 class="display-4">Reseñas</h3>';
     echo '</div>'; //cierra de html

     include "./formEscribirResenia.html";

     $result = $this->participacionesEnViajeConEstado($viaje['idviajeConcreto'], 'aceptado');
     while($rows = mysqli_fetch_assoc($result)){
       if($rows['comentario']){

        echo '<div class="card card-infoviaje" style="width:100%; margin-top: 4px;">';
        echo '<div class="card-body" style="margin: -1%">';
        echo '<h6 class="card-subtitle mb-2 text-muted">Comentario de un usuario</h6>';
        echo '<div class="row">';
        echo '<p class="card-text col-10">'. $rows['comentario'] .'</p>';
        if($rows['calificacion']){
          echo '<div class="col-md-2">';
          echo '<p><img src="../img/like.png"></p>';          
          echo '</div>';
        }else{
          echo '<div class="col-md-2">';
          echo '<p><img src="../img/dislike.png"></p>';
          echo '</div>';
        }
        echo '</div>';
        echo '</div>';

       }
       echo '</div>'; //cierra de html 
     }
     echo '</div>'; //cierra de html
    }
		
		function verificarSuperposicionAlPostularse($idUser, $viaje){
			$result1 = $this->consulta("SELECT * FROM viaje vi INNER JOIN vehiculo ve ON (vi.idvehiculo = ve.idvehiculo) INNER JOIN viajeconcreto vc ON (vi.idviaje = vc.idviaje) INNER JOIN usuario u ON ( u.id = ve.idusuario) WHERE ( u.id = '$idUser' ) AND ( ( STR_TO_DATE( '" .$viaje["fechaFin"] . "' ,'%Y-%m-%d') >= vc.fechaInicio ) AND ( ( STR_TO_DATE('". $viaje["fechaInicio"] . "' ,'%Y-%m-%d') <= vc.fechaFin ) AND ( (STR_TO_DATE('". $viaje["horaInicio"] . "', '%H:%i') ) <= vi.horaFin ) AND ( STR_TO_DATE('". $viaje["fechaFin"] ."', '%H:%i') >= vi.horaInicio ) ) )");
			$result2 = $this->consulta("SELECT * FROM usuario u INNER JOIN participacion p ON (u.id = p.idusuario) INNER JOIN viajeconcreto vc ON (p.idviajeConcreto = vc.idviajeConcreto) INNER JOIN viaje vi ON (vc.idviaje = vi.idviaje) WHERE (u.id = '$idUser') AND ( ( str_to_date('" . $viaje["fechaFin"] . "','%Y-%m-%d') >= vc.fechaInicio) AND (str_to_date('" . $viaje["fechaInicio"] . "', '%Y-%m-%d') <= vc.fechaFin) AND (str_to_date('" . $viaje["horaInicio"] . "', '%H:%i') <= vi.horaFin) AND (str_to_date('" . $viaje["fechaFin"] . "', '%H:%i') >= vi.horaInicio) )");
			if ((mysqli_num_rows($result1) > 0) || (mysqli_num_rows($result2) > 0)) {
				return true;
			} else {
				return false;
			}
		}

  }

?>
