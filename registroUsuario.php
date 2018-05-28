<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registrarse</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<!-- Navbar -->
	<?php
		include "navbar.html"
	?>
	<div class="row">
		<div class="col-6" style="margin-top: 20px">
			<img src="logoNue.png" class="col-12" >
		</div>
		<div style="padding-right: 30px; padding-left: 30px; margin-top: 20px; " class="col-12 col-sm-6">
			<form action="crearUsuario.php" method="post">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
							<span class="input-group-text" id="inputNombre">Nombre</span>
					</div>
					<input type="text" class="form-control" name="nombre" placeholder="Ingrese nombre" maxlength=40>
				</div>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
							<span class="input-group-text" id="inputApellido">Apellido</span>
					</div>
					<input type="text" class="form-control" name="apellido" placeholder="Ingrese apellido" maxlength=40>
				</div>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
							<span class="input-group-text"  id="inputFechaNacimiento">Fecha nacimiento</span>
					</div>
					<input type="date" class="form-control" name="fecha_nacimiento">
				</div>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
							<span class="input-group-text" id="inputMail">Mail</span>
					</div>
					<input type="text" class="form-control" name="mail" placeholder="Ingrese e-mail" maxlength=40>
				</div>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
							<span class="input-group-text" id="inputPasswd">Contraseña</span>
					</div>
					<input type="password" class="form-control" name="passwd" placeholder="Ingrese contraseña" maxlength=40>
				</div>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
							<span class="input-group-text" id="inputNacionalidad">Nacionalidad</span>
					</div>
					<input type="text" class="form-control" name="nacionalidad" placeholder="Ingrese nacionalidad" maxlength=280>
				</div>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
							<span class="input-group-text" id="inputTarjeta">Tarjeta</span>
					</div>
					<input type="text" class="form-control" name="tarjeta" placeholder="Ingrese tarjeta" maxlength=40>
				</div>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
							<span class="input-group-text" id="inputDescripcion">Descripcion</span>
					</div>
					<textarea class="form-control" maxlength=240 placeholder="Ingrese descripcion" name="descripcion"></textarea>
				</div>
				<input type="submit" class="btn btn-primary" id="buttonCrear" style="background-color:#00bcd4; border-color:#00bcd4;" value="Crear">
			</form>
		</div>
	</div>
</body>
</html>