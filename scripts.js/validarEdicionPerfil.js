
//Validación igual a la de validacionesRegistro quitandole algunas cosas
function validarNuevaFechaNacimiento(){
  var fecha = (document.getElementById('fecha_nacimiento').value).split("-")
  if(isDate18orMoreYearsOld(parseInt(fecha[2]),parseInt(fecha[1]),parseInt(fecha[0]))){
    document.getElementById('fecha_nacimiento').classList.remove("is-invalid")
    document.getElementById('fecha_nacimiento').classList.add("is-valid")
  } else {
    document.getElementById('fecha_nacimiento').classList.remove("is-valid")
    document.getElementById('fecha_nacimiento').classList.add("is-invalid")
  }
}


function isDate18orMoreYearsOld(day, month, year){
  return new Date(year+18, month-1, day) <= new Date()
} 