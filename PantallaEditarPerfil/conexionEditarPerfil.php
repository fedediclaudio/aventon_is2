<?php
  include_once '../conexionClass.php';

  class ConexionEditarPerfil extends Conexion{

    function updateDatosDeUsuario($idUser) {
      mysqli_query($this->connection, "UPDATE usuario SET nombre ='". $_POST["nombre"] ."', apellido ='". $_POST["apellido"] ."', nacionalidad = '" . $_POST["nacionalidad"] . "', fecha_nacimiento = STR_TO_DATE('". $_POST["fecha_nacimiento"] . "', '%Y-%m-%d'), descripcion = '". $_POST["descripcion"] . "' WHERE usuario.id = $idUser");
    }

  }

?>
