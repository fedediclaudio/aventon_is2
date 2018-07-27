<?php
  include '../conexionClass.php';

  class ConexionEditarVehiculo extends Conexion{

    function getVehiculo($idVehiculo){
      return $this->consulta("SELECT * FROM vehiculo WHERE idvehiculo = '$idVehiculo'");
    }

    function sePuedeBorrarVehiculo($id){
  		return (mysqli_num_rows($this->consulta("SELECT * FROM vehiculo ve INNER JOIN viaje vi ON (ve.idvehiculo = vi.idVehiculo) WHERE ve.idvehiculo = '$id'")) == 0);
  	}

  	function editarVehiculo($id, $marca, $modelo, $cantidadAsientos){
      $this->consulta("UPDATE vehiculo SET marca = '$marca', modelo = '$modelo', cantidadAsientos = '$cantidadAsientos' WHERE(vehiculo.idvehiculo = '$id')");
  	}

  	function borrarVehiculo($id){
      $this->consulta("DELETE FROM vehiculo WHERE idvehiculo = '$id'");
  	}
  }

?>
