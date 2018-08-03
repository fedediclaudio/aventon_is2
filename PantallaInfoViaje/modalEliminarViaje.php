<div class="modal fade" tabindex="-1" role="dialog" id="modalEliminarViaje">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar viaje</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 style="text-align:center">Realmente desea eliminar este viaje?</h5>
        <h6 style="text-align:center">En caso de tener posutulaciones aceptadas, afectara su reputación</h6>
        <div class="form-check">
          <?php
            if($conexion->viajeSeRepite($viaje["idviaje"])){
              echo '<input type="checkbox" class="form-check-input" id="eliminarViajeAbstracto" onclick="toggleEliminacion()">';
              echo '<label class="form-check-label" for="eliminarViajeAbstracto">Cancelar todas las repeticiones del viaje</label>';
            }
              //echo $conexion->viajeSeRepite($viaje["idviaje"]);
          ?>
        </div>
      </div>
      <div class="modal-footer">
        <button id="botonEliminarConcreto" type="button" class="btn btn-danger" onclick="location='eliminarViajeConcreto.php?idViajeConcreto=<?php echo $viaje["idviajeConcreto"] ?>'">Cancelar viaje</button>
        <button id="botonEliminarAbstracto" type="button" class="btn btn-danger" style="display: none" onclick="location='eliminarViajeAbstracto.php?idViaje=<?php echo $viaje["idviaje"] ?>'">Cancelar viaje</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function toggleEliminacion() {
    $('#botonEliminarConcreto').toggle()
    $('#botonEliminarAbstracto').toggle()
  }
</script>
