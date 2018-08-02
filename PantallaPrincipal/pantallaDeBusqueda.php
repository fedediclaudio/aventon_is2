<div class="row" style="background-color:#EEEEEE	">
		<div class="col col-0 col-md-2 col-lg-3">
		</div>
		<div class="col col-12 col-md-8 col-lg-6">
			<div style="margin:10px;">
				<h4 class="display-4" style="text-align:center"><img src="resources/baseline_search_black_18dp.png"> Busca tu proximo viaje</h4>
			</div>
			<br>
			<form action="buscarviajes.php" method="get">
				<div class="form-row">
    			<div class="form-group col-md-6">
      			<input type="text" name="origen" class="form-control" id="origenInput" placeholder="Origen" value="<?php if((isset($_GET["origen"])) && (isset($_GET["destino"])))  { echo $_GET["origen"];} ?>" required>
					</div>
					<div class="form-group col-md-6">
						<input type="text" name="destino" class="form-control" id="destinoInput" placeholder="Destino" value="<?php if((isset($_GET["origen"])) && (isset($_GET["destino"])))  { echo $_GET["destino"];} ?>" required>
					</div>
					<div class="col" style="justify-content:center; display: flex; margin:10px">
						<button type="submit" class="btn btn-light" >Buscar</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col col-0 col-md-2 col-lg-3"> </div>
	</div>