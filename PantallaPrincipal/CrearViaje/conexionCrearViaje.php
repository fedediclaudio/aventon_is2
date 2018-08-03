<?php
  //A veces se incluye este archivo desde archivos dentro de la carpeta CrearVehiculo y a veces desde afuera, ver si se puede refactorizar
  if (file_exists('../conexionClass.php')) {
    include_once '../conexionClass.php';
  }else {
    if (file_exists('../../conexionClass.php')) {
      include_once '../../conexionClass.php';
    }
  }

  class ConexionCrearViaje extends Conexion{

    function cargarOpcionesVehiculos(){
      $vehiculos = $this->getVehiculosPorIdUsuario($_SESSION["id"]);
      while($row = mysqli_fetch_assoc($vehiculos)) {
          echo '<option value="' . $row["idvehiculo"] . '">' . $row["marca"] . ' ' . $row["modelo"] . '</option>';
      }
    }

    function crearViajes() {
  		if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Arreglos de Fechas
				$fechasInicio = json_decode($_POST["fechasInicio"]);
        $fechasFin = json_decode($_POST["fechasFin"]);
        //Se obtiene la hora inicio.
        $hora = $this->obtenerHoraEnFormatoDesdeFecha($fechasInicio[0]);
        //Se Obtiene la hora fin
        $horaF = $this->obtenerHoraEnFormatoDesdeFecha($fechasFin[0]);
        // Creacion del viaje abstracto
        $idViaje = $this->crearViajeAbstracto($_POST["origen"], $_POST["destino"], $hora, $horaF, $_POST["precio"], $_POST["vehiculo"]);
        // Creacion de los viajes concretos
        for ($i = 0; $i < count($fechasInicio); $i++) {
          $fechaI = explode('T', $fechasInicio[$i]);
          $fechaF = explode('T', $fechasFin[$i]);
          $this->crearViajeConcreto($fechaI[0], $fechaF[0], $idViaje);
        }
  		}
  	}

    function obtenerHoraEnFormatoDesdeFecha($fecha) {
      list($dia, $horaCompleta) = explode('T', $fecha);
      list($hora, $minuto) = explode( ':',$horaCompleta);
      return $hora . ':' . $minuto;
    }

    function crearViajeAbstracto($origen, $destino, $horaInicio, $horaFin, $precio, $idVehiculo) {
      mysqli_query($this->connection, "INSERT INTO aventon.viaje (origen, destino, horaInicio, horaFin, precio, idvehiculo) VALUES ( '$origen' , '$destino' , STR_TO_DATE( '$horaInicio' , '%H:%i') , STR_TO_DATE( '$horaFin' , '%H:%i') , '$precio'  , '$idVehiculo' )");
      return $this->ultimoViajeSegunID();
    }

    function crearViajeConcreto($fechaInicio, $fechaFin, $idViaje) {
      mysqli_query($this->connection, "INSERT INTO aventon.viajeConcreto (fechaInicio, fechaFin, idViaje) VALUES ( STR_TO_DATE('$fechaInicio','%Y-%m-%d') , STR_TO_DATE('$fechaFin', '%Y-%m-%d') , '$idViaje')");
    }

    function ultimoViajeSegunID(){
  		$row = mysqli_fetch_assoc($this->consulta("SELECT MAX(idviaje) FROM viaje"));
      return $row["MAX(idviaje)"];
    }

    function validarFechasDeViaje($arrayInicio, $arrayFin) {
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Arreglos de Fechas
        $fechasInicio = json_decode($arrayInicio);
        $fechasFin = json_decode($arrayFin);
        //Se obtiene la hora inicio.
        $hora = $this->obtenerHoraEnFormatoDesdeFecha($fechasInicio[0]);
        //Se Obtiene la hora fin
        $horaF = $this->obtenerHoraEnFormatoDesdeFecha($fechasFin[0]);
        session_start();
        $idUser = $_SESSION["id"];
        for ($i = 0; $i < count($fechasInicio); $i++) {
          $fechaI = explode('T', $fechasInicio[$i]);
          $fechaF = explode('T', $fechasFin[$i]);
          $sql1 = "SELECT * FROM viaje vi INNER JOIN vehiculo ve ON (vi.idvehiculo = ve.idvehiculo) INNER JOIN viajeconcreto vc ON (vi.idviaje = vc.idviaje) INNER JOIN usuario u ON (u.id = ve.idusuario)
			WHERE ( u.id = '$idUser' ) 
			AND ( 
					(str_to_date('" . $fechaI[0] . "', '%Y-%m-%d') <= vc.fechaFin)
				AND
					(str_to_date('" . $fechaF[0] . "','%Y-%m-%d') >= vc.fechaInicio)
				AND
					(
						(str_to_date('" . $fechaI[0] . "', '%Y-%m-%d') <> vc.fechaFin) 
					OR
						(str_to_date('" . $hora . "', '%H:%i') <= vi.horaFin)
					)
				AND
					(
						(str_to_date('" . $fechaF[0] . "','%Y-%m-%d') <> vc.fechaFin)
					OR
						(str_to_date('" . $horaF . "', '%H:%i') >= vi.horaInicio)
					)
			) ";
					$sql2 = "SELECT * FROM usuario u INNER JOIN participacion p ON (u.id = p.idusuario) INNER JOIN viajeconcreto vc ON (p.idviajeConcreto = vc.idviajeConcreto) INNER JOIN viaje vi ON (vc.idviaje = vi.idviaje) 
			WHERE (u.id = '$idUser') 
			AND ( 
					(str_to_date('" . $fechaI[0] . "', '%Y-%m-%d') <= vc.fechaFin)
				AND
					(str_to_date('" . $fechaF[0] . "','%Y-%m-%d') >= vc.fechaInicio)
				AND
					(
						(str_to_date('" . $fechaI[0] . "', '%Y-%m-%d') <> vc.fechaFin) 
					OR
						(str_to_date('" . $hora . "', '%H:%i') <= vi.horaFin)
					)
				AND
					(
						(str_to_date('" . $fechaF[0] . "','%Y-%m-%d') <> vc.fechaFin)
					OR
						(str_to_date('" . $horaF . "', '%H:%i') >= vi.horaInicio)
					)
			)";
          if ((mysqli_num_rows($this->consulta($sql1)) > 0) || (mysqli_num_rows($this->consulta($sql2)) > 0)) {
            return false;
          }
        }
        return true;
      }
    }

  }

?>
