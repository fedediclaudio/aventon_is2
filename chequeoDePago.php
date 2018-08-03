<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  include_once 'conexionClass.php';
  $conn = new conexion();
	if($conn->esDeudor()){
		header("location:/aventon/pagarDeuda.php");
	}
?>
