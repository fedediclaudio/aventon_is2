<?php
  //A veces se incluye este archivo desde archivos dentro de la carpeta CrearVehiculo y a veces desde afuera, ver si se puede refactorizar
  if (file_exists('../conexionClass.php')) {
    include_once '../conexionClass.php';
  }else {
    if (file_exists('../../conexionClass.php')) {
      include_once '../../conexionClass.php';
    }
  }

  class ConexionCrearVehiculo extends Conexion{

    function getTiposVehiculos() {
      if($this->connection) {
        $result = $this->connection->query("SELECT * FROM aventon.tipoVehiculo");
        return $result;
      }
    }

    function cargarTiposVehiculos() {
      $tipos = $this->getTiposVehiculos();
      while($row = mysqli_fetch_assoc($tipos)) {
          echo '<option value="' . $row["idtipoVehiculo"] . '">' . $row["nombreTipo"] . '</option>';
      }
    }

    function crearVehiculo() {
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (mysqli_query($this->connection, "INSERT INTO aventon.vehiculo (marca, modelo, patente, cantidadAsientos, idusuario, idtipoVehiculo) VALUES ('" . $_POST["marca"] . "', '" . $_POST["modelo"] . "', '" . $_POST["patente"] . "', '" . $_POST["cantidadAsientos"] . "', '" . $this->getIdUsuario() ."', '" . $_POST["tipo"] . "' )")) {
  				echo "New record created successfully";
  		  }
      }
    }

    function getIdUsuario() {
  		session_start();
  		$username = $_SESSION['mail'];
  		$user =  $this->getUsuario($username);
  		$row = mysqli_fetch_assoc($user);
  		return $row["id"];
  	}

    function existePatente($patente) {
      $result = $this->connection->query("SELECT * FROM aventon.vehiculo WHERE patente = '$patente'");
      if(mysqli_num_rows($result) == 0) {
        return false;
      }
      return true;
    }

  }
?>
