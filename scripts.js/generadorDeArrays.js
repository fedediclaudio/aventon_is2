function arrayInicio(){
  var validDates = [];
  if(!($('#frecuente').is(':checked'))){
    var oneDate = setHoraInicio(new Date(document.getElementById("inputFechaInicio").value));
    oneDate.setDate(oneDate.getDate() + 1);
    validDates.push(oneDate);
  } else {
    var days = [];
    Array.from($('.day')).forEach(function(each){
      days.push(each.checked);
    });
    var fechaInicio = new Date(document.getElementById("inputComienzoRepeticion").value);
    var fechaFin = new Date(fechaInicio);
    fechaFin.setDate(fechaFin.getDate() + (document.getElementById("duracionFrecuencia").value*7)-1);
    for (var d = fechaInicio; d <= fechaFin; d.setDate(d.getDate() + 1)) {
      if(days[d.getDay()]){
        var aux = new Date(d);
        aux.setDate(aux.getDate() + 1);
        setHoraInicio(aux);
        validDates.push(aux);
      }
    }
  }
  return validDates;
}

function setHoraInicio(date){
  horaInicio = document.getElementById("horaInicio").value;
  date.setHours(horaInicio.split(":")[0],horaInicio.split(":")[1]);
  date.setHours(date.getHours() - 3);
  return date;
}

function arrayFin(){
  var endDates = [];
  arrayInicio().forEach(function(each){
    var auxDate = new Date(each);
    auxDate=moment(auxDate).add((document.getElementById("duracionMinutos").value),'m').toDate();
    auxDate=moment(auxDate).add((document.getElementById("duracionHoras").value),'hours').toDate();
    console.log('a');
    endDates.push(auxDate);
  });
  return endDates;
}

function postArrays(){
  $('<input>').attr('type','hidden').attr('value',JSON.stringify(arrayInicio())).attr('name','fechasInicio').appendTo('#formCrearViaje');
  $('<input>').attr('type','hidden').attr('value',JSON.stringify(arrayFin())).attr('name','fechasFin').appendTo('#formCrearViaje');
}
