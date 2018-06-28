<script type="text/javascript">
	function vistaRecurrente(){
		$('.required').prop('required', function(){
			return  !$(this).is(':visible');
		});
		$(".frecuenciasDeViaje").slideToggle(200);
	}
</script>
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
					<form action="" method="post" onsubmit="return fechasValidas()" id="formCrearViaje">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
									<span class="input-group-text">Origen</span>
							</div>
							<input type="text" class="form-control required" name="origen" placeholder="Ingrese origen" maxlength=40 required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
									<span class="input-group-text">Destino</span>
							</div>
							<input type="text" class="form-control required" name="destino" id="inputDestino" placeholder="Ingrese destino" maxlength=40 required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<input type="number" min="0" class="form-control required" name="precio" placeholder="Precio" step="0.50" required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
									<span class="input-group-text" >Vehiculo</span>
							</div>
							<select class="form-control required" id="inputVehiculo" name="vehiculo" required>
                <?php
	                  include 'cargarOpcionesVehiculos.php';
                ?>
							</select>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">Hora de inicio</span>
							</div>
							<input type="time" min="0" class="form-control required" name="horaInicio" id="horaInicio" required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
									<span class="input-group-text" >Duración</span>
							</div>
							<div class="row">
								<div class="col">
									<input type="number" min="0" max="23" class="form-control required" placeholder="hh" id="duracionHoras" required>
								</div>
								<div class="col">
									<input type="number" min="0" max="59" class="form-control required" placeholder="mm" id="duracionMinutos" required>
								</div>
							</div>
						</div>
						<div class="form-check">
							<input type="checkbox" class="form-check-input" id="frecuente" onclick="vistaRecurrente()">
							<label class="form-check-label" for="frecuente">Viaje frecuente</label>
							<hr>
						</div>
						<div class="frecuenciasDeViaje">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
										<span class="input-group-text">Fecha</span>
								</div>
								<input type="date" class="form-control required" id="inputFechaInicio" name="fechaInicio" required>
							</div>
						</div>
						<div class="frecuenciasDeViaje" style="display:none">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
										<span class="input-group-text">Desde</span>
								</div>
								<input type="date" class="form-control required" id="inputComienzoRepeticion" name="comienzoFrecuencia">
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">Duración en semanas</span>
								</div>
								<input type="number" min="0" class="form-control required" name="duracionFrecuencia" id="duracionFrecuencia" placeholder="Ingrese cantidad de semanas">
							</div>
							<div id="daysContainer">
								<div class="form-check-inline">
									<input type="checkbox" class="form-check-input day" id="lunes">
									<label class="form-check-label" for="lunes">Lunes</label>
								</div>
								<div class="form-check-inline">
									<input type="checkbox" class="form-check-input day" id="martes">
									<label class="form-check-label" for="martes">Martes</label>
								</div>
								<div class="form-check-inline">
									<input type="checkbox" class="form-check-input day" id="miercoles">
									<label class="form-check-label" for="miercoles">Miercoles</label>
								</div>
								<div class="form-check-inline">
									<input type="checkbox" class="form-check-input day" id="jueves">
									<label class="form-check-label" for="jueves">Jueves</label>
								</div>
								<div class="form-check-inline">
									<input type="checkbox" class="form-check-input day" id="viernes">
									<label class="form-check-label" for="viernes">Viernes</label>
								</div>
								<div class="form-check-inline">
									<input type="checkbox" class="form-check-input day" id="sabado">
									<label class="form-check-label" for="sabado">Sabado</label>
								</div>
								<div class="form-check-inline">
									<input type="checkbox" class="form-check-input day" id="domingo">
									<label class="form-check-label" for="domingo">Domingo</label>
								</div>
							</div>
						</div>
						<div class="alert alert-danger" id="alertaFechas" role="alert" style="display:none"></div>
						<input type="submit" class="btn btn-primary" id="buttonCrear" value="Crear">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
