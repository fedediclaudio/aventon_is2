<?php

	session_start();
	if(isset($_SESSION["id_usuario"])){
		header("location:pantallaPrincipal.php");
	}

	$error = "";
	
	if(!empty($_POST)){
		include 'conexionClass.php';
		$conn = new conexion();

		$mail = $_POST['mail'];
		$password = $_POST['password'];
		
		$result=$conn->getUsuario($mail,$password);
		$rows = $result->num_rows;
		
		if($rows > 0) {
			$row = $result->fetch_assoc();
			$_SESSION['id_usuario'] = $row['id'];
			$_SESSION['tipo_usuario'] = $row['id_tipo'];
			
			header("location: pantallaPrincipal.php");
			} else { $error = 'El mail o contraseña ingresados no son correctos';}
	}

	include "login.html";
	if($error){
		//echo $error;
		echo "<script type='text/javascript'>alert('$error');</script>";
	}
?>