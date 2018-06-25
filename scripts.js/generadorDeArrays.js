function arrayInicio(){
  var days = [];
  Array.from($('.day')).forEach(function(each){
    days.push(each.checked);
  });
  var fechaInicio = new Date(document.getElementById("inputComienzoRepeticion").value);
  var fechaFin = new Date;
  fechaFin.setDate(fechaInicio.getDate() + (document.getElementById("duracionFrecuencia").value*7)-1);
  var validDates = [];
  for (var d = fechaInicio; d <= fechaFin; d.setDate(d.getDate() + 1)) {
    if(days[d.getDay()]){
      var aux = new Date(d);
      var hours = ((document.getElementById("horaInicio").value).split(":")[0]);
      var minutes = ((document.getElementById("horaInicio").value).split(":")[1]);
      aux.setHours(hours,minutes,0,0);
      validDates.push(aux);
    }
  }
  return validDates;
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
