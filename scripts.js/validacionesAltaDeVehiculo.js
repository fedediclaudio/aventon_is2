var patenteNoExiste = false;

function isPatenteValid() {
  return true; // Se tendria que verificar que la patente sea valida
}

function alertPatenteExiste(){
  document.getElementById('patenteInput').classList.remove("is-valid")
  document.getElementById('patenteInput').classList.add("is-invalid")
  document.getElementById("invalidFeedbackPatente").textContent="Esta patente ya se encuentra en uso."
}

function validarPatenteExistente(){
  if(isPatenteValid){
    var parametros = {
        "patenteIngresada" : document.getElementById('patenteInput').value
      };
      //Peticion AJAX
      $.ajax({
        data: parametros,
        url: 'scripts.js/validarPatenteBD.php',
        type: 'post',
        success: function(resultado){
          resultado = JSON.parse(resultado)
          if(resultado['existe']){
            alertPatenteExiste();
          }else{
            patenteNoExiste = true;
            validarPatente();
          }
        },
        error: function(){
          alert('No pudo conectarse con el servidor')
        }
      });
  }
}

function validarPatente(){
  if(patenteNoExiste){
    document.getElementById('buttonCrear').disabled = true
  } else {
    document.getElementById('buttonCrear').disabled = false
  }
}