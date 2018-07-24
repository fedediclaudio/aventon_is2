<?php
	session_start();
	if(!isset($_SESSION["mail"])){
		header("location:index.php");
	} else {
		echo $_SESSION["id"];
		header("location:PantallaPerfilDeUsuario/perfilUsuario.php?id=". $_SESSION["id"]);
	}
?>
