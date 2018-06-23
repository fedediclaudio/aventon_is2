<div class="modal fade" id="crearViajeModal" tabindex="-1" role="dialog" aria-labelledby="crarViajeModal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color:#C5CAE9;">
				<h5 class="modal-title" id="exampleModalLongTitle">Crear Viaje</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" style="background-color:#FAFAFA">
				<div class="container-fluid">
					<form action="crearViaje.php" method="post" onsubmit="return validarFechas()">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
									<span class="input-group-text">Origen</span>
							</div>
							<input type="text" class="form-control" name="origen" placeholder="Ingrese origen" maxlength=40 required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
									<span class="input-group-text">Destino</span>
							</div>
							<input type="text" class="form-control" name="destino" id="inputDestino" placeholder="Ingrese destino" maxlength=40 required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
									<span class="input-group-text">Fecha de inicio</span>
							</div>
							<input type="datetime-local" class="form-control" id="inputFechaInicio" name="fechaInicio" oninput="validarFechas()" required>
						</div>
							<div class="input-group mb-3">
							<div class="input-group-prepend">
									<span class="input-group-text" >Fecha fin</span>
							</div>
							<input type="datetime-local" class="form-control" name="fechaFin" id="inputFechaFin" oninput="validarFechas()" required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<input type="number" class="form-control" name="precio" placeholder="Precio" step="0.50" required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
									<span class="input-group-text" id="inputVehiculo">Vehiculo</span>
							</div>
							<select class="form-control" name="vehiculo">
                <?php
	                  include 'cargarOpcionesVehiculos.php';
                ?>
							</select>
						</div>
						<div class="input-group">
							<div class="input-group-prepend">
									<span class="input-group-text">Contacto</span>
							</div>
							<textarea class="form-control" maxlength=240 placeholder="Ingrese información de contacto" name="contacto"></textarea>
						</div>
						<input type="submit" disabled class="btn btn-primary" id="buttonCrear" value="Crear">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>