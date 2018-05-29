<?php

	session_start();
	if(isset($_SESSION["mail"])){
		header("location:pantallaPrincipal.php");
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
			$_SESSION['password'] = $row['password'];
			
			header("location: pantallaPrincipal.php");
			} else { $error = 'El mail o contraseña ingresados no son correctos';}
	}

	include "login.html";
	if($error){
		//echo $error;
		echo "<script type='text/javascript'>alert('$error');</script>";
	}
?>