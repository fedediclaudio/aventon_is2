function isPatenteValid() {
  if (/^[A-ZÑ]{3}\d{3}$/.test(document.getElementById('patenteInput').value) || /^[A-ZÑ]{2}\d{3}[A-ZÑ]{2}$/.test(document.getElementById('patenteInput').value)){
    estadoDePatente(false,'')
    return true
  }
  estadoDePatente(true,'Patente invalida')
  return false
}

function estadoDePatente(invalida,texto){
  if(invalida){
    document.getElementById('patenteInput').classList.remove("is-valid")
    document.getElementById('patenteInput').classList.add("is-invalid")
    document.getElementById("invalidFeedbackPatente").textContent=texto
    document.getElementById('buttonCrear').disabled = true
  } else {
    document.getElementById('patenteInput').classList.remove("is-invalid")
    document.getElementById('patenteInput').classList.add("is-valid")
    document.getElementById('buttonCrear').disabled = false
  }
}

function validarPatenteExistente(){
  if(isPatenteValid()) {
    var parametros = {
        "patenteIngresada" : document.getElementById('patenteInput').value
      };
      //Peticion AJAX
      $.ajax({
        data: parametros,
        url: '../validarPatenteBD.php',
        type: 'post',
        success: function(resultado){
          resultado = JSON.parse(resultado)
          if(resultado['existe']){
            estadoDePatente(true,'La patente ingresada ya existe en el sistema')
          }else{
            estadoDePatente(false,'')
          }
        },
        error: function(){
          alert('No pudo conectarse con el servidor')
        }
      });
  }
}
