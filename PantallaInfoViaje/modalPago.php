<div class="modal fade" tabindex="-1" role="dialog" id="modalPago">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pago de viaje</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <h5 style="text-align:center">Se le descontaran $ <?php echo ($conexion->precioDeViajePorUsuario($viaje)); ?> de su cuenta</h5>
          <h6 style="text-align:center">Por favor, ingrese los datos de su tarjeta</h6>
          <div class="row" style="margin-top:20px">
            <div class="col-9">
              <input type="text" class="form-control" placeholder="XXXX-XXXX-XXXX-XXXX" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}">
            </div>
            <div class="col-3">
              <input type="text" class="form-control" placeholder="XXX" pattern="[0-9]{3}">
            </div>
          </div>
          <input style="margin-top:10px" type="text" class="form-control" placeholder="MM/YY" pattern="[0-9]{2}/[0-9]{2}">
        </form>
      </div>
      <div class="modal-footer">
        <button id="botonEliminarAbstracto" type="button" class="btn btn-primary" onclick="location='pagarViaje.php?idViajeConcreto=<?php echo $viaje["idviajeConcreto"] ?>'">Pagar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
