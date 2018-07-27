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
  			if($this->connection) {
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
  			else { echo "No se pudo establecer la conexion";}
  		}
  	}

    function obtenerHoraEnFormatoDesdeFecha($fecha) {
      list($dia, $horaCompleta) = explode('T', $fecha);
      list($hora, $minuto) = explode( ':',$horaCompleta);
      return $hora . ':' . $minuto;
    }

    function crearViajeAbstracto($origen, $destino, $horaInicio, $horaFin, $precio, $idVehiculo) {
      $this->ejecutarInsert("INSERT INTO aventon.viaje (origen, destino, horaInicio, horaFin, precio, idvehiculo) VALUES ( '$origen' , '$destino' , STR_TO_DATE( '$horaInicio' , '%H:%i') , STR_TO_DATE( '$horaFin' , '%H:%i') , '$precio'  , '$idVehiculo' )");
      return $this->ultimoViajeSegunID();
    }

    function crearViajeConcreto($fechaInicio, $fechaFin, $idViaje) {
      $this->ejecutarInsert("INSERT INTO aventon.viajeConcreto (fechaInicio, fechaFin, idViaje) VALUES ( STR_TO_DATE('$fechaInicio','%Y-%m-%d') , STR_TO_DATE('$fechaFin', '%Y-%m-%d') , '$idViaje')");
    }

    function ejecutarInsert($sql){
      if (mysqli_query($this->connection, $sql)) {
          echo "New record created successfully";
  		} else {
          echo "Error";
      }
    }

    function ultimoViajeSegunID(){
      $result = $this->connection->query("SELECT MAX(idviaje) FROM viaje");
  		$row = mysqli_fetch_assoc($result);
      return $row["MAX(idviaje)"];
    }

    function validarFechasDeViaje($arrayInicio, $arrayFin) {
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
  			if($this->connection) {
          //Arreglos de Fechas
  				$fechasInicio = json_decode($arrayInicio);
          $fechasFin = json_decode($arrayFin);
          //Se obtiene la hora inicio.
          $hora = $this->obtenerHoraEnFormatoDesdeFecha($fechasInicio[0]);
          //Se Obtiene la hora fin
          $horaF = $this->obtenerHoraEnFormatoDesdeFecha($fechasFin[0]);
          session_start();
          $mail = $_SESSION["mail"];
          for ($i = 0; $i < count($fechasInicio); $i++) {
            $fechaI = explode('T', $fechasInicio[$i]);
            $fechaF = explode('T', $fechasFin[$i]);
            $sql = "SELECT * FROM viaje vi INNER JOIN vehiculo ve ON (vi.idvehiculo = ve.idvehiculo) INNER JOIN viajeconcreto vc ON (vi.idviaje = vc.idviaje) INNER JOIN usuario u ON ( u.id = ve.idusuario) WHERE ( u.email = '$mail' ) AND ( ( STR_TO_DATE( '$fechaF[0]' ,'%Y-%m-%d') >= vc.fechaInicio ) AND ( ( STR_TO_DATE('$fechaI[0]' ,'%Y-%m-%d') <= vc.fechaFin ) ) )";
  					$result = $this->connection->query($sql);
            if (mysqli_num_rows($result) > 0) {
     		       return false;
  		      }
          }
          return true;
        }
      }
    }

  }

?>
