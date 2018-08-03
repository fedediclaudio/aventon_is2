<?php
  if (!isset($_SESSION["id"])) {
    session_start();
  }
  include_once 'conexionClass.php';
  $conn = new conexion();
	if($conn->esDeudor()){
		header("location:/aventon/pagarDeuda.php");
	}
?>
