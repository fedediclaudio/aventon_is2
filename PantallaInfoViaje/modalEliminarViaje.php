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
        <p>Esta seguro de eliminar este viaje? En caso de tener posutulaciones aceptadas, afectara su reputación</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger"  onclick="location='eliminarViajeConcreto.php?idViajeConcreto=<?php echo $viaje["idviajeConcreto"] ?>'">Eliminar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
