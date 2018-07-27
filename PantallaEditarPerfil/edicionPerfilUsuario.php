<?php
    include "../chequeoSesion.php"
?>
<html>
<head>
    <title>Editar Mi Perfil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../bootstrap/jquery.min.js"></script>
    <script src="../bootstrap/popper.min.js"></script>
    <script src="../bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../styles.css">
    <script type="text/javascript" src="../jquery-3.3.1.min.js"></script>
    <script src="validarEdicionPerfil.js"></script>
</head>
<body>
    <?php
        include 'conexionEditarPerfil.php';
        $username = $_GET["id"];
        $conexion = new ConexionEditarPerfil();
        $userTable =  $conexion->getUsuarioPorId($username);
        $user = mysqli_fetch_assoc($userTable);
    ?>
    <!-- Navbar -->
    <?php
        include "../vistas/navbar.html"
    ?>
    <div  style="margin:5%">
        <div class="jumbotron p-3 p-md-5 text-black rounded jumbo-infoviaje">
            <div class="row">
                <div class="col col-12 col-lg-4 px-0">
                    <div>
                        <p class="text-center"><img src="../img/perfilPorDefecto.png"></p>
                        <h1 class="display-4 text-center"><?php echo $user['nombre'] . ' ' . $user['apellido']; ?></h1>
                    </div>
                </div>
                    <form action="<?php echo "editarUsuario.php?idusuario=" . $user["id"]; ?>"  class="col col-12 col-lg-8 px-0" id="formularioEditarPerfil" action="actualizarPerfil.php" method="post">
                      <div class="form-group">
                      <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                        <div class="card-body" style="margin: -1%">
                        <h6 class="card-subtitle mb-2 text-muted">Nombre</h6>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $user['nombre']?>" required>
                        </div>
                      </div>
                      </div>
                      <div class="form-group">
                      <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                        <div class="card-body" style="margin: -1%">
                        <h6 class="card-subtitle mb-2 text-muted">Apellido</h6>
                        <input type="text" class="form-control" name="apellido" value="<?php echo $user['apellido']?>" required>
                      </div>
                      </div>
                      </div>
                      <div class="form-group">
                      <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                        <div class="card-body" style="margin: -1%">
                        <h6 class="card-subtitle mb-2 text-muted">Fecha de nacimiento</h6>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" oninput="validarNuevaFechaNacimiento()" required>
                        <div class="invalid-feedback">
                            Debe ser mayor de 18 para poder registrarse
                        </div>

                        <script type="text/javascript">

                            document.getElementById("fecha_nacimiento").defaultValue = "<?php echo $user['fecha_nacimiento']?>"

                        </script>

                      </div>
                      </div>
                      </div>
                      <div class="form-group">
                      <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                        <div class="card-body" style="margin: -1%">
                        <h6 class="card-subtitle mb-2 text-muted">Nacionalidad</h6>
                        <input type="text" class="form-control" name="nacionalidad" placeholder="Ingrese nacionalidad" value="<?php echo $user['nacionalidad']?>" required>
                      </div>
                      </div>
                      </div>
                      <div class="form-group">
                      <div class="card card-infoviaje" style="width:100%; margin-top: 4px;">
                        <div class="card-body" style="margin: -1%">
                        <h6 class="card-subtitle mb-2 text-muted">Descripción</h6>
                        <textarea class="form-control" maxlength=240 name="descripcion"><?php echo $user['descripcion']?></textarea>
                      </div>
                      </div>
                      </div>
                      <input type ="button" onClick="location='../cargarPerfilUsuarioActual.php'" class="btn btn-light" style="float:right; margin:10px" value="Cancelar">
                      <input type ="submit" id="editarButton" class="btn btn-light" style="float:right; margin:10px" value="Guardar Cambios">
                    </form>
            </div>
        </div>

    </div>
</body>
</html>
