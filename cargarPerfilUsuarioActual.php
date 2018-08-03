<?php
	include 'chequeoSesion.php';
	include 'chequeoDePago.php';
	header("location:PantallaPerfilDeUsuario/perfilUsuario.php?id=". $_SESSION["id"]);
?>
