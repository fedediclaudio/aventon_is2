function cargardatos(){
	//document.getElementById("viajes").innerHTML = "Hello JavaScript"
	$("#loader").html("<img src='loader2.gif'/>");
	var viajesSelector = document.getElementById("viajesSelector").value;
	if(viajesSelector == "") {
		var origen = document.getElementById("origenInput").value;
		if(origen == "") {
			$.get("cargarviajes.php?pagina=" + pagina,
			function(data){
				if (data != "") {
					$("#viajes").append(data); 
				}
			});
		} else {
			var destino = document.getElementById("destinoInput").value
			$.get("cargarviajes.php?pagina=" + pagina + "&origen=" + origen + "&destino=" + destino,
			function(data){
				if (data != "") {
					$("#viajes").append(data); 
				}
			});
		}
	}
	else {
		$.get("cargarviajes.php?pagina=0&viajes=" + viajesSelector,
			function(data){
				if (data != "") {
					$("#viajes").append(data); 
				}
			});
	}
}
var pagina=0;
$(document).ready(function() {
	cargardatos();	
});
$(window).scroll(function(){
	if ($(window).scrollTop() == $(document).height() - $(window).height()){
		pagina++;
		cargardatos()
	}					
});