<?php
  if($_GET["error"] == 1){
    echo "<script type='text/javascript'>alert('El mail ingresado ya existe');</script>";
  }
  include 'vistas\registroUsuario.html'
?>
