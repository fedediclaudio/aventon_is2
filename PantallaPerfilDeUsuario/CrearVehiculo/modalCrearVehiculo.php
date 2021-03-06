<?php
	include 'conexionCrearVehiculo.php';
?>
<div class="modal fade" id="crearVehiculoModal" tabindex="-1" role="dialog" aria-labelledby="crearVehiculoModal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color:#C5CAE9;">
				<h5 class="modal-title" id="exampleModalLongTitle">Agregar vehículo</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" style="background-color:#FAFAFA">
				<div class="container-fluid">
					<form action="CrearVehiculo/crearVehiculo.php" method="post">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
									<span class="input-group-text">Marca</span>
							</div>
							<input type="text" class="form-control" name="marca" placeholder="Ingrese marca del vehículo" maxlength=45 required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
									<span class="input-group-text" id="inputDestino">Modelo</span>
							</div>
							<input type="text" class="form-control" name="modelo" placeholder="Ingrese modelo del vehículo" maxlength=45 required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
									<span class="input-group-text" id="inputDestino">Patente</span>
							</div>
							<input type="text" class="form-control" name="patente" id="patenteInput" placeholder="Ingrese patente en mayusculas y sin guiones" maxlength=45 oninput="validarPatenteExistente()" required>
              <div id="invalidFeedbackPatente" class="invalid-feedback"></div>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
									<span class="input-group-text" id="inputDestino">Asientos disponibles</span>
							</div>
							<input type="number" min="1" class="form-control" name="cantidadAsientos" placeholder="Ingrese la cantidad de asientos" maxlength=45 required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
									<span class="input-group-text" id="inputTipo">Tipo</span>
							</div>
							<select class="form-control" name="tipo" required>
                <?php
									$conexion = new ConexionCrearVehiculo();
									$conexion->cargarTiposVehiculos();
                ?>
							</select>
						</div>
						<input type="submit" class="btn btn-primary" disabled id="buttonCrear" value="Agregar vehículo">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
