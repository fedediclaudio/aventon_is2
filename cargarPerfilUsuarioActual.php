<?php
	include 'chequeoSesion.php';
	header("location:PantallaPerfilDeUsuario/perfilUsuario.php?id=". $_SESSION["id"]);
?>
