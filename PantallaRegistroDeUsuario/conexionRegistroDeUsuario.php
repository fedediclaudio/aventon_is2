<?php
  include '../conexionClass.php';

  class ConexionRegistroDeUsuario extends Conexion{

  	function crearUsuario() {
      echo "INSERT INTO aventon.usuario(nombre, apellido, password, tarjeta, email, nacionalidad, fecha_nacimiento, descripcion) VALUES('$_POST[nombre]','$_POST[apellido]','sha1($_POST[passwd])','','$_POST[mail]','$_POST[nacionalidad]',STR_TO_DATE('$_POST[fecha_nacimiento]','%Y-%m-%d'),'$_POST[descripcion]')";
  		if ($_SERVER["REQUEST_METHOD"] == "POST") {
  			if($this->connection) {
          $password = sha1($_POST["passwd"]);
					if (mysqli_query($this->connection, "INSERT INTO aventon.usuario(nombre, apellido, password, tarjeta, email, nacionalidad, fecha_nacimiento, descripcion) VALUES('$_POST[nombre]','$_POST[apellido]','$password','','$_POST[mail]','$_POST[nacionalidad]',STR_TO_DATE('$_POST[fecha_nacimiento]','%Y-%m-%d'),'$_POST[descripcion]')")) {
						echo "New record created successfully";
					} else {
						echo "Error";
					}
  			}
  		}
  	}

    function existeMail($mail){
  		$result = $this->connection->query("SELECT * FROM usuario WHERE email = '$mail'");
  		if (mysqli_num_rows($result) == 0) {
     		return false;
  		}
  		return true;
  	}

  }

?>
