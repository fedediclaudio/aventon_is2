<?php
  include "chequeoSesion.php";
  include "conexionClass.php";
  $conn = new conexion();
  $result = $conn->getVehiculo($_GET['id']);
  $vehiculo = mysqli_fetch_assoc($result);
?>

<html>
<head>
    <title>Vehículo (Edición)</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src="bootstrap/jquery.min.js"></script>
  <script src="bootstrap/popper.min.js"></script>
  <script src="bootstrap/bootstrap.min.js"></script>
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
  <script src="scripts.js/validarEdicionPerfil.js"></script>
</head>
<body>
    <!-- Navbar -->
    <?php
        include "vistas/navbar.html";
    ?>
    <div  style="margin:5%">
        <div class="jumbotron p-3 p-md-5 text-black rounded jumbo-infoviaje">
            <div class="row">
                <div class="col col-12 col-lg-4 px-0">
                    <div>
                        <h1 class="display-4 text-center"><?php echo $vehiculo['marca'] . ' ' . $vehiculo['modelo'];?></h1>
                    </div>
                    
                </div>
                    <form action="<?php echo "editarVehiculo.php?id=" . $vehiculo["idvehiculo"]; ?>"  class="col col-12 col-lg-8 px-0" id="formularioEditarVehiculo" method="post">
                      <div class="form-group">
                      <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                        <div class="card-body" style="margin: -1%">
                        <h6 class="card-subtitle mb-2 text-muted">Marca</h6>
                        <input type="text" class="form-control" name="marca" value="<?php echo $vehiculo['marca']?>" required>
                        </div>
                      </div>
                      </div>
                      <div class="form-group">
                      <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                        <div class="card-body" style="margin: -1%">
                        <h6 class="card-subtitle mb-2 text-muted">Modelo</h6>
                        <input type="text" class="form-control" name="modelo" value="<?php echo $vehiculo['modelo']?>" required>
                      </div>
                      </div>
                      </div>
                      <div class="form-group">
                      <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                        <div class="card-body" style="margin: -1%">
                        <h6 class="card-subtitle mb-2 text-muted">Cantidad de asientos</h6>
                        <input type="number" min="1" class="form-control" name="cantidadAsientos" value="<?php echo $vehiculo['cantidadAsientos']?>" required>
                      </div>
                      </div>
                      </div>
                      <input type ="button" id="idBorrarVehiculo" onClick="borrarVehiculo()" class="btn btn-outline-danger" style="float:right; margin:10px; color:black; border-color:#BDBDBD;" value="Borrar vehículo">
                      <input type ="button" onClick="location='cargarPerfilUsuarioActual.php'" class="btn btn-light" style="float:right; margin:10px" value="Cancelar">
                      <input type ="submit" class="btn btn-light" style="float:right; margin:10px" value="Guardar Cambios">
                    </form>
            </div>
          <div id="mensajeDeBorrado" style="margin-top: 30px">
          <p class="text-danger text-center">Este vehículo no puede elminarse porque contiene viajes asignados</p>
          </div>
        </div>

    </div>
</body>
</html>

<script type="text/javascript">

  <?php $sePuedeBorrar = $conn->sePuedeBorrarVehiculo($_GET['id']); ?>

  if("<?php echo $sePuedeBorrar; ?>"){
    $("#mensajeDeBorrado").hide();
  }else{
    document.getElementById("idBorrarVehiculo").disabled = true;
    document.getElementById("idBorrarVehiculo").classList.add('is-invalid');
  }

  function borrarVehiculo(){
    window.location.replace("borrarVehiculo.php?id=" + "<?php echo $_GET['id']?>");
  }

</script>
