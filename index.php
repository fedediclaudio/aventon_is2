<?php

	session_start();
	if(isset($_SESSION["mail"])){
		header("location:PantallaPrincipal/pantallaPrincipal.php");
	}

	$error = "";

	if(!empty($_POST)){
		include 'conexionClass.php';
		$conn = new conexion();

		$mail = $_POST['mail'];
		$password = $_POST['password'];

		$result=$conn->getUsuarioLogin($mail,$password);
		$rows = $result->num_rows;

		if($rows > 0) {
			$row = mysqli_fetch_assoc($result);
			$_SESSION['mail'] = $row['email'];
			$_SESSION['id'] = $row['id'];
			$_SESSION['password'] = $row['password'];

			header("location: PantallaPrincipal/pantallaPrincipal.php");
			} else { $error = 'El mail o contraseña ingresados no son correctos';}
	}

	include "vistas/login.html";

	if($error){
		echo "<script type='text/javascript'>alert('$error');</script>";
	}
?>
