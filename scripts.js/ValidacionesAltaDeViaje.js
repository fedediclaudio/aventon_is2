function validarFechas(){
  var elemento
  if(!($('#frecuente').is(':checked'))){
    elemento = document.getElementById("inputFechaInicio")
  } else {
    elemento = document.getElementById("inputComienzoRepeticion")
  }
  inicio = setHoraInicio(new Date(elemento.value));
  inicio.setDate(inicio.getDate()+1)
  now = new Date
  now.setHours(now.getHours()-3)
  if(inicio < now){
    elemento.classList.remove("is-valid")
    elemento.classList.add("is-invalid")
  } else {
    elemento.classList.remove("is-invalid")
    elemento.classList.add("is-valid")
  }
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
