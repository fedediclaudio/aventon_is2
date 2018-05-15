<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<style> 
			span.input-group-text {
					background-color:#e0f7fa;	
			}
			#buttonCrear{
					float: right;
					margin-top: 17px;
			}
			div.card-header{
					background-color:#e3f2fd;
			}
		</style>
</head>
<body style="background-color:#FAFAFA" >
		<!-- Barra navegacion-->
		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #b2ebf2;">
			<a class="navbar-brand" href="#"><!--<img src="logo.png"/>-->AVENTON</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
						<!--<a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>-->
						<!-- Button Crear viaje -->
				</div>
			</div>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearViajeModal" style="float:right; color:black; border-color:#FAFAFA; background-color:#FAFAFA">
							CREAR VIAJE
					</button>
		</nav>
		
		<!-- Cartas de viajes -->
		<div class="row" style="margin:auto">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearViajeModal" style="widht:25%; color:black; border-color:#FAFAFA; background-color:#FAFAFA">
								<div class="card " style="width: 18rem; margin:10px;">
									<div class="card-header">
										La Plata - Chivilcoy
									</div>
									<ul class="list-group list-group-flush">
										<li class="list-group-item">24/12/2200</li>
										<li class="list-group-item">$21000000</li>
										<li class="list-group-item">Vestibulum at eros</li>
									</ul>
								</div>
					</button>
		</div>

		<!-- Modal crear viaje -->
		<div class="modal fade" id="crearViajeModal" tabindex="-1" role="dialog" aria-labelledby="crarViajeModal" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header" style="background-color:#b2ebf2;">
						<h5 class="modal-title" id="exampleModalLongTitle">Crear Viaje</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" style="background-color:#FAFAFA">
						<div class="container-fluid">
							<form action="crearviaje.php" method="post">
								
								<div class="input-group mb-3">
									<div class="input-group-prepend">
											<span class="input-group-text">Origen</span>
									</div>
									<input type="text" class="form-control" name="origen" placeholder="Ingrese origen" maxlength=40>
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
											<span class="input-group-text" id="inputDestino">Destino</span>
									</div>
									<input type="text" class="form-control" name="destino" placeholder="Ingrese destino" maxlength=40>
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
											<span class="input-group-text"  id="inputFecha">Fecha</span>
									</div>
									<input type="date" class="form-control" name="fecha">
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
											<span class="input-group-text"  id="inputHoraInicio">Hora Inicio</span>
									</div>
									<input type="time" name="horainicio" class="form-control">
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
											<span class="input-group-text"  id="inputHoraFin">Hora Fin</span>
									</div>
									<input type="time" name="horafin" class="form-control">
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">$</span>
									</div>
									<input type="number" class="form-control" name="precio" placeholder="Precio" step="0.50">
								</div>
								<div class="input-group">
									<div class="input-group-prepend">
											<span class="input-group-text">Contacto</span>
									</div>
									<textarea class="form-control" maxlength=240 placeholder="Ingrese infromación de contacto" name="contacto"></textarea>
								</div>
								<input type="submit" class="btn btn-primary" id="buttonCrear" style="background-color:#00bcd4; border-color:#00bcd4;" value="Crear">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
</body>
</html>