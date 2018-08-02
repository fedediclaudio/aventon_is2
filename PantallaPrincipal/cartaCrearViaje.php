<?php if(!isset($_GET["origen"])) { if($tieneVehiculos) { $modal= "#crearViajeModal"; } else { $modal = "#modalErrorAlCrearViaje"; } 
																					 echo '
        <div class="col col-12 col-md-6 col-lg-4 col-xl-3" style="justify-content:center; display: flex;" >
            <button type="button" class="btn btn-light " id="botonCartaViaje" data-toggle="modal" data-target="' . $modal .'"  >
                    <div style="background-color: #FAFAFA;" >
                        <div style="  ">
                            <h1 class="display-3"><img src="../img/boton_mas.png"></h1>
                        </div>
                    </div>
            </button>
        </div>';}
				?>