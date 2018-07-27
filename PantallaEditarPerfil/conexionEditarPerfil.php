<?php
  include '../conexionClass.php';

  class ConexionEditarPerfil extends Conexion{

    function updateDatosDeUsuario($idUser) {
      if($this->connection) {
        $sql = "UPDATE usuario SET nombre ='". $_POST["nombre"] ."', apellido ='". $_POST["apellido"] ."', nacionalidad = '" . $_POST["nacionalidad"] . "', fecha_nacimiento = STR_TO_DATE('". $_POST["fecha_nacimiento"] . "', '%Y-%m-%d'), descripcion = '". $_POST["descripcion"] . "' WHERE usuario.id = $idUser";
  			if (mysqli_query($this->connection, $sql)) {
  				echo "Record update successfully";
        } else {
  				echo "Error: " . $sql . "<br>" . mysqli_error($this->connection);
        }
      }
    }
  }

?>
