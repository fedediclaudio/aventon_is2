var isMailValid = false;
var isDateValid = false;
var mailExist = true;

function validarMail(){
  mailExist = true;
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById('mailInput').value))
  {
    document.getElementById('mailInput').classList.remove("is-invalid")
    document.getElementById('mailInput').classList.add("is-valid")
    isMailValid = true;
  } else {
    document.getElementById('mailInput').classList.remove("is-valid")
    document.getElementById('mailInput').classList.add("is-invalid")
    document.getElementById("invalidFeedbackMail").textContent="Por favor, ingrese un email correcto."
    isMailValid = false;
  }
  validarRegistro()
}

function alertMailExiste(){
  document.getElementById('mailInput').classList.remove("is-valid")
  document.getElementById('mailInput').classList.add("is-invalid")
  document.getElementById("invalidFeedbackMail").textContent="Este mail ya se encuentra en uso."
}

function validarMailExist(){
  if(isMailValid){
    var parametros = {
        "mailIngresado" : document.getElementById('mailInput').value
      };
      

      $.ajax({
        data: parametros,
        url: 'validarMailBD.php',
        type: 'post',
        success: function(resultado){
          resultado = JSON.parse(resultado)
          if(resultado['existe']){
            alertMailExiste();
          }else{
            mailExist = false;
            validarRegistro();
          }
        },
        error: function(){
          alert('No pudo conectarse con el servidor')
        }
      });
  }
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
  if(isDateValid && isMailValid && !mailExist){
    document.getElementById('buttonCrear').disabled = false
  } else {
    document.getElementById('buttonCrear').disabled = true
  }
}