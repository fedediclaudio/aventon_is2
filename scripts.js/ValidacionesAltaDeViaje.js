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
  return (inicio > now)
}

$( "#formCrearViaje" ).submit(function( event ) {
  event.preventDefault();
});

function fechasValidas(){
  if(validarFechas()){
    var parametros = {
      "arrayInicio" : JSON.stringify(arrayInicio()),
      "arrayFin" : JSON.stringify(arrayFin()),
    };
    $.ajax({
      data: parametros,
      url: 'validarFechasCreacionViaje.php',
      type: 'post',
      success: function(resultado){
        console.log(resultado);
        resultado = JSON.parse(resultado)
        if(!resultado['existe']){
          estadoDeFechas(true, 'Esta fecha se superpone con uno de tus viajes!');
        } else {
          estadoDeFechas(false, '');
          postArrays();
          $.ajax({
             type: "POST",
             url: 'crearviaje.php',
             data: $("#formCrearViaje").serialize(),
             success: function(data)
             {
                 location.assign(location.href)
             }
           });
          return true
        }
      },
      error: function(requestObject, error, errorThrown){
        alert('No pudo conectarse con el servidor');
        return false;
      }
    });
  } else {
    estadoDeFechas(true, 'No se puede utilizar una fecha anterior a la actual');
    return false;
  }
  return false
}

function estadoDeFechas(invalida, texto){
  if(invalida){
    $("#alertaFechas").fadeIn()
    document.getElementById("alertaFechas").textContent=texto
  }
}
