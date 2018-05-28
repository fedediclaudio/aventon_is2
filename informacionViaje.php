<html>
<head>
    <title>Informacion de viaje</title>
      <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
</head>
<body>
    <?php
        include 'conexionClass.php';
        $conn = new Conexion();
        $result = $conn->informacionDeUnViaje($_GET["id"]); 
        $viaje = mysqli_fetch_assoc($result)
    ?>
    <!-- Navbar -->
    <?php
        include "navbar.html"
    ?>
    <div  style="margin:5%">
        <div class="jumbotron p-3 p-md-5 text-black rounded bg-light">
            <div class="row">
                <div class="col col-12 col-lg-4 px-0">
                    <div style="margin: 5px">
                        <h1 class="display-4"><?php echo 'Viaje desde ' . $viaje["origen"] . ' hasta ' . $viaje["destino"] . ' el dia ' . $viaje["fecha"] ?></h1>
                    </div>
                </div>
                <div class="col col-12 col-lg-8 px-0"  >
                    <div class="card" style="width:100%; background-color: #FAFAFA; margin-top: 4px;">
                        <div class="card-body" style="margin: -1%">
                            <h6 class="card-subtitle mb-2 text-muted">Inicio del viaje</h6>
                            <p class="card-text"><?php echo 'El viaje comienza el dia ' . $viaje["fecha"] . ' a las ' . $viaje["horainicio"] ?></p>
                        </div>
                    </div>
                    <div class="card" style="width:100%; background-color: #FAFAFA; margin-top: 4px;">
                        <div class="card-body" style="margin: -1%">
                            <h6 class="card-subtitle mb-2 text-muted">Fin del viaje</h6>
                            <p class="card-text"><?php echo 'Se estima que termine a las ' . $viaje["horafin"] ?></p>
                        </div>
                    </div>
                    <div class="card" style="width:100%; background-color: #FAFAFA; margin-top: 4px;">
                        <div class="card-body" style="margin: -1%">
                            <h6 class="card-subtitle mb-2 text-muted">Precio</h6>
                            <p class="card-text"><?php echo '$' . $viaje["precio"] ?></p>
                        </div>
                    </div>
                    <div class="card" style="width:100%; background-color: #FAFAFA; margin-top: 4px;">
                        <div class="card-body" style="margin: -1%">
                            <h6 class="card-subtitle mb-2 text-muted">Descripcion del contacto</h6>
                            <p class="card-text"><?php echo $viaje["descripcion"] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--
        <div class="row mb-6">
            <div class="col-md-6">
                <div class="jumbotron p-3 p-md-5 text-black rounded bg-light">
                    <div class="col-md-6 px-0">
                        <h1 class="display-4">Informacion sobre el viaje</h1>
                        <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about     what's most interesting in this post's contents.</p>
                        <p class="lead mb-0"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="jumbotron p-3 p-md-5 text-black rounded bg-light">
                    <div class="col-md-6 px-0">
                        <h1 class="display-4">Informacion sobre el viaje</h1>
                        <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>
                        <p class="lead mb-0"></p>
                    </div>
                </div>
            </div> 
        </div>
        -->
    </div>
</body>
</html>