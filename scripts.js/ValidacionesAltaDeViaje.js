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
