<?php
  include '../conexionClass.php';

  class ConexionEditarVehiculo extends Conexion{

    function getVehiculo($idVehiculo){
  		if($this->connection) {
  			$result = $this->connection->query("SELECT * FROM vehiculo WHERE idvehiculo = '$idVehiculo'");
  			return $result;
  		}
      return null;
    }

    function sePuedeBorrarVehiculo($id){
  		$result = $this->connection->query("SELECT * FROM vehiculo ve INNER JOIN viaje vi ON (ve.idvehiculo = vi.idVehiculo) WHERE ve.idvehiculo = '$id'");
  		if(mysqli_num_rows($result) == 0){
  			return true;
  		}
  		return false;
  	}

  	function editarVehiculo($id, $marca, $modelo, $cantidadAsientos){
  		$this->connection->query("UPDATE vehiculo SET marca = '$marca', modelo = '$modelo', cantidadAsientos = '$cantidadAsientos' WHERE(vehiculo.idvehiculo = '$id')");
  	}

  	function borrarVehiculo($id){
  		$this->connection->query("DELETE FROM vehiculo WHERE idvehiculo = '$id'");
  	}
  }

?>
