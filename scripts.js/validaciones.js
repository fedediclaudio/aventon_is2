var isMailValid = false;
var isDateValid = false;

function validarMail(){
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById('mailInput').value))
  {
    document.getElementById('mailInput').classList.remove("is-invalid")
    document.getElementById('mailInput').classList.add("is-valid")
    isMailValid = true;
  } else {
    document.getElementById('mailInput').classList.remove("is-valid")
    document.getElementById('mailInput').classList.add("is-invalid")
    isMailValid = false;
  }
  validarRegistro()
}

function validarFechaNacimiento(){
  var fecha = (document.getElementById('fechaInput').value).split("-")
  if(isDate18orMoreYearsOld(parseInt(fecha[2]),parseInt(fecha[1]),parseInt(fecha[0]))){
    document.getElementById('fechaInput').classList.remove("is-invalid")
    document.getElementById('fechaInput').classList.add("is-valid")
    isDateValid = true;
  } else {
    document.getElementById('fechaInput').classList.remove("is-valid")
    document.getElementById('fechaInput').classList.add("is-invalid")
    isDateValid = false;
  }
  validarRegistro()
}

function isDate18orMoreYearsOld(day, month, year){
  return new Date(year+18, month-1, day) <= new Date()
}

function validarRegistro(){
  if(isDateValid && isMailValid){
    document.getElementById('buttonCrear').disabled = false
  } else {
    document.getElementById('buttonCrear').disabled = true
  }
}
