function validarMail(){
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById('mailInput').value))
  {
    document.getElementById('formularioViaje').setAttribute('action',"../crearUsuario.php")
    return (true)
  } else {
    return (false)
  }
}

function validarFechaNacimiento(){
  var fecha = (document.getElementById('fechaInput').value).split("-")
  console.log(fecha[0]);
  console.log(fecha[1]);
  console.log(fecha[2]);
  return isDate18orMoreYearsOld(parseInt(fecha[2]),parseInt(fecha[1]),parseInt(fecha[0]))
}

function isDate18orMoreYearsOld(day, month, year){
  return new Date(year+18, month-1, day) <= new Date()
}

function validarRegistro(){
  if(validarMail() && validarFechaNacimiento()){
    document.getElementById('buttonCrear').disabled = false
  } else {
    document.getElementById('buttonCrear').disabled = true
  }
}
