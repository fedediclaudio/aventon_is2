<?php
  include "chequeoSesion.php"
?>
<html>
<head>
    <title>Mi Perfil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src="bootstrap/jquery.min.js"></script>
  <script src="bootstrap/popper.min.js"></script>
  <script src="bootstrap/bootstrap.min.js"></script>
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
  <script src="scripts.js/validacionesAltaDeVehiculo.js"></script>
</head>
<body>
    <?php
        include 'conexionClass.php';
        $username = $_GET["id"];
        $conn = new conexion();
        $userTable =  $conn->getUsuarioPorId($username);
        $user = mysqli_fetch_assoc($userTable);
    ?>
    <!-- Navbar -->
    <?php
        include "vistas/navbar.html"
    ?>
    <div  style="margin:5%">
        <div class="jumbotron p-3 p-md-5 text-black rounded jumbo-infoviaje">
            <div class="row">
                <div class="col col-12 col-lg-4 px-0">
                    <div>
                        <p class="text-center"><img src="img/profile-pic.png"></p>
                        <h1 class="display-4 text-center"><?php echo $user['nombre'] . ' ' . $user['apellido']; ?></h1>
                    </div>
                </div>
                <div class="col col-12 col-lg-8 px-0"  >
                    <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                        <div class="card-body" style="margin: -1%">
                            <h6 class="card-subtitle mb-2 text-muted">E-mail</h6>
                            <p class="card-text"><?php echo $user['email']?></p>
                        </div>
                    </div>
                    <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                        <div class="card-body" style="margin: -1%">
                            <h6 class="card-subtitle mb-2 text-muted">Fecha de nacimiento</h6>
                            <p class="card-text"><?php echo $user['fecha_nacimiento']?></p>
                        </div>
                    </div>
                    <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                        <div class="card-body" style="margin: -1%">
                            <h6 class="card-subtitle mb-2 text-muted">Nacionalidad</h6>
                            <p class="card-text"><?php echo $user['nacionalidad']?></p>
                        </div>
                    </div>
					          <?php if($user['descripcion'] != ''){ echo '
                    <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                        <div class="card-body" style="margin: -1%">
                            <h6 class="card-subtitle mb-2 text-muted">Descripcion</h6>
                            <p class="card-text">' . $user['descripcion'] . '</p>
                        </div>
                    </div>';} ?>
                  <button class="btn btn-light" style="float:right; margin:10px" onclick="location='edicionPerfilUsuario.php?id=<?php echo $user['id']; ?>'">Editar</button>
                </div>
            </div>
        </div>
        <div class="jumbotron p-3 p-md-5 text-black rounded jumbo-infoviajee col col-lg-6">
          <div class="row">
            <div class="col col-8">
              <h2 >Vehiculos</h2>
            </div>
            <div class="col col-4">
              <button type="button" class="btn btn-light" data-toggle="modal" data-target="#crearVehiculoModal" id="botonCrearVehiculo" style="float:right">Crear vehículo</button>
            </div>
            
          </div>
          
          <?php
        		include "cargarVehiculos.php"
        	?>
        </div>
      
    </div>
    <?php
  		include "vistas/modalCrearVehiculo.php";
  	?>
</body>
</html>
