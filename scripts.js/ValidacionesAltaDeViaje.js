function validarFechas(){
  var fechaI = document.getElementById('inputFechaInicio').value
  var fechaF = document.getElementById('inputFechaFin').value
  if(fechaI >= fechaF ){
  	document.getElementById('inputFechaInicio').classList.remove("is-valid")
    document.getElementById('inputFechaInicio').classList.add("is-invalid")
    document.getElementById('inputFechaFin').classList.remove("is-valid")
    document.getElementById('inputFechaFin').classList.add("is-invalid")
    document.getElementById('buttonCrear').disabled = true;
  } else {
    document.getElementById('buttonCrear').disabled = false
    document.getElementById('inputFechaInicio').classList.remove("is-invalid")
    document.getElementById('inputFechaInicio').classList.add("is-valid")
    document.getElementById('inputFechaFin').classList.remove("is-invalid")
    document.getElementById('inputFechaFin').classList.add("is-valid");
  }

}

function fechasValidas(){
  if(true){//función que valida frontend
    validarFechasBD(){
      var parametros = {
        "arrayInicio" : arrayInicio(),
        "arrayFin" : arrayFin(),
      };
      

      $.ajax({
        data: parametros,
        url: 'validarFechasCreacionDeViaje.php',
        type: 'post',
        success: function(resultado){
          resultado = JSON.parse(resultado)
          if(resultado['existe']){
            estadoDeFechas(true, 'Esta fecha se superpone con uno de tus viajes!');
            return false
          }else{
            estadoDeFechas(false, '');
            postArrays();
          }
        },
        error: function(){
          alert('No pudo conectarse con el servidor')
        }
      });
    }
  }else{
    return false;
  }
}

function estadoDeFechas(invalida, texto){
  if(invalida){
    $.("#alertaFechas").show()
    document.getElementById("alertaFechas").textContent=texto
    document.getElementById('buttonCrear').disabled = true
  } else {
    
    document.getElementById('buttonCrear').disabled = false
  }
}