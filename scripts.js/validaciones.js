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
  var fecha = document.getElementById('inputFechaNacimiento').value;
  console.log($("#inputFechaNacimiento"));
  var anio = parseInt(fecha[2],10);
  var mes = parseInt(fecha[1],10);
  var dia = parseInt(fecha[0],10);
  return isDate18orMoreYearsOld(dia,mes,anio);
}

function isDate18orMoreYearsOld(day, month, year){
  return new Date(year+18, month-1, day) <= new Date();
}

function validarRegistro(){
  if(validarMail() && validarFechaNacimiento()){
    document.getElementById('buttonCrear').disabled = false;
  } else {
    document.getElementById('buttonCrear').disabled = true;
  }
}
