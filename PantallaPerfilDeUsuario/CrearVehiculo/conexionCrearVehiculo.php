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
      return $this->consulta("SELECT * FROM aventon.tipoVehiculo");
    }

    function cargarTiposVehiculos() {
      $tipos = $this->getTiposVehiculos();
      while($row = mysqli_fetch_assoc($tipos)) {
          echo '<option value="' . $row["idtipoVehiculo"] . '">' . $row["nombreTipo"] . '</option>';
      }
    }

    function crearVehiculo() {
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        mysqli_query($this->connection, "INSERT INTO aventon.vehiculo (marca, modelo, patente, cantidadAsientos, idusuario, idtipoVehiculo) VALUES ('" . $_POST["marca"] . "', '" . $_POST["modelo"] . "', '" . $_POST["patente"] . "', '" . $_POST["cantidadAsientos"] . "', '" . $this->getIdUsuario() ."', '" . $_POST["tipo"] . "' )");
      }
    }

    function getIdUsuario() {
  		session_start();
  		$username = $_SESSION['mail'];
  		$user =  $this->getUsuarioPorMail($username);
  		$row = mysqli_fetch_assoc($user);
  		return $row["id"];
  	}

    function existePatente($patente) {
      return (mysqli_num_rows($this->consulta("SELECT * FROM aventon.vehiculo WHERE patente = '$patente'")) != 0);
    }

  }
?>
